<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    protected $guard = 'api';

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function sendMessage(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'receiver_id' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['success' => false, 'message' => $validate->errors()], 400);
        }
        if (!$request->has('message') && !$request->hasFile('image')) {
            return response()->json(['success' => false, 'message' => 'Please send a valid message or attachment'], 400);
        }
        $other_user_id = $data['receiver_id'];
        $other_user = User::find($other_user_id);
        if (!$other_user || $other_user->id == auth()->user()->id) {
            return response()->json(['success' => false, 'message' => 'Please send a valid receiver id'], 400);
        }
        $user = auth()->user();
        $chat = Chat::where('sender_id', $user->id)
            ->where('receiver_id', $other_user_id)
            ->first();
        if (!$chat) {
            $chat = Chat::where('sender_id', $other_user_id)
                ->where('receiver_id', $user->id)
                ->first();
        }
        if (!$chat) {
            $chat = Chat::create([
                'sender_id' => $user->id,
                'receiver_id' => $other_user_id,
            ]);
        }
        $msg_type = 0;
        if ($request->hasFile('image')) {
            $msg_type = 1;
            $image = $request->file('image');
            $image_name = 'chat' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/chat/');
            $image->move($destinationPath, $image_name);
        }
        isset($data['message']) ?  $message_text =  $data['message'] : $message_text = null;
        $image_data = $request->hasFile('image') ? $image_name : null;
        $message = Message::create([
            'chat_id' => $chat->id,
            'sender_id' => $user->id,
            'receiver_id' => $other_user_id,
            'msg_type' => $msg_type,
            'message' => $message_text,
            'image' => $image_data,
            'is_read' => 0,
        ]);
        if($message->msg_type == 1){
            $message->image = url('/public/uploads/chat/'.$message->image);
        }
        $message->msg_id = $message->id;
        $message->sender = $user;
        $message->receiver = $other_user;
        


        unset($message->id);
        unset($message->sender_id);
        unset($message->receiver_id);
        unset($message->updated_at);
        unset($message->sender->email);
        unset($message->sender->phone_no);
        unset($message->sender->city_id);
        unset($message->sender->address);
        unset($message->sender->zip);
        unset($message->sender->otp);
        unset($message->sender->status);
        unset($message->sender->is_blocked);
        unset($message->sender->status);
        unset($message->sender->updated_at);
        unset($message->receiver->email);
        unset($message->receiver->phone_no);
        unset($message->receiver->city_id);
        unset($message->receiver->address);
        unset($message->receiver->zip);
        unset($message->receiver->otp);
        unset($message->receiver->status);
        unset($message->receiver->is_blocked);
        unset($message->receiver->status);
        unset($message->receiver->updated_at);


        

        return response()->json(['success' => true, 'message' => 'Message sent successfully', 'data' => $message], 200);
    }

    public function Chats()
    {
        $user = auth()->user();
        $chats = Chat::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->get();
        // dd($chats);
        $chats = $this->addInformationChats($chats);
        return response()->json(['success' => true, 'message' => 'All Chats', 'data' => $chats], 200);
    }

    public function getAllMsgsInChatThread($chat_id)
    {
        $user = auth()->user();
        $chat = Chat::find($chat_id);
        if ($chat->sender_id == $user->id || $chat->receiver_id == $user->id) {
            $msgs = Message::where('chat_id', $chat_id)
                ->orderBy('id', 'desc')
                ->get();
            // also mark all unread msgs as read now as all msgs have been served via api to user now
            foreach ($msgs as $msg) {
                if ($msg->receiver_id == $user->id && $msg->is_read == 0) {
                    $msg->is_read = 1;
                    $msg->save();
                }
                if($msg->msg_type == 1){
                    $msg->image = url('/public/uploads/chat/'.$msg->image);
                }
                $msg->msg_id = $msg->id;
                unset($msg->id);
                unset($msg->updated_at);
            }
            return response()->json(['success' => true, 'message' => 'All messages in chat thread', 'data' => $msgs], 200);
        }
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
    }

    public function getUnreadNumberOfChatThreads()
    {
        $user = auth()->user();
        $chats = Chat::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->get();
        $unread_chats = 0;
        foreach ($chats as $chat) {
            if ($this->getUnreadNumberOfMsgsInChat($chat->id) > 0) {
                $unread_chats++;
            }
        }


        return response()->json(['success' => true, 'message' => 'Number of unread chat threads', 'count' => $unread_chats], 200);
    }

    public function getUnreadNumberOfMsgsInChat($chat_id)
    {
        $user = auth()->user();
        $chat = Chat::find($chat_id);
        if ($chat->sender_id == $user->id || $chat->receiver_id == $user->id) {
            $unread_msgs = Message::where('chat_id', $chat_id)
                ->where('receiver_id', $user->id)
                ->where('is_read', 0)
                ->count();
            return $unread_msgs;
        }
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
    }

    public function addInformationChats($chats)
    {
        // what we need is foreach chat, get the other user's information 
        // (name, image_name, last message, last message time, number of unreadmessages in chat)

        foreach ($chats as $chat) {
            
            $chat->chat_id = $chat->id;
            $chat->other_user = $this->getOtherUser($chat->id);
            $chat->last_message = $this->getLastMessage($chat->id);
            $chat->last_message->msg_id = $chat->last_message->id;
            $chat->last_message_time = $this->getLastMessageTime($chat->id);
            $chat->unread_messages = $this->getUnreadNumberOfMsgsInChat($chat->id);
            
            unset($chat->id);
            unset($chat->sender_id);
            unset($chat->receiver_id);
            unset($chat->created_at);
            unset($chat->updated_at);
            unset($chat->other_user->email);
            unset($chat->other_user->phone_no);
            unset($chat->other_user->city_id);
            unset($chat->other_user->address);
            unset($chat->other_user->zip);
            unset($chat->other_user->otp);
            unset($chat->other_user->status);
            unset($chat->other_user->is_blocked);
            unset($chat->other_user->updated_at);
            unset($chat->last_message->id);
            unset($chat->last_message->chat_id);
            unset($chat->last_message->created_at);
            unset($chat->last_message->updated_at);
        }

        return $chats;
    }

    public function getOtherUser($chat_id)
    {
        $user = auth()->user();
        $chat = Chat::find($chat_id);
        if ($chat->sender_id == $user->id) {
            return User::find($chat->receiver_id);
        }
        return User::find($chat->sender_id);
    }

    public function getLastMessage($chat_id)
    {
        $last_message = Message::where('chat_id', $chat_id)
            ->orderBy('id', 'desc')
            ->first();
        if($last_message->msg_type == 1){
            $last_message->image = url('/public/uploads/chat/'.$last_message->image);
        }
        return $last_message;
    }

    public function getLastMessageTime($chat_id)
    {
        $last_message = $this->getLastMessage($chat_id);
        return $last_message->created_at;
    }
}
