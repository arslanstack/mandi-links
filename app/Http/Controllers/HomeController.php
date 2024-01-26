<?php

namespace App\Http\Controllers;

use App\Models\City;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cities = [
            ["city_name" => "Abbottabad"],
            ["city_name" => "Abdul Hakeem"],
            ["city_name" => "Adda jahan khan"],
            ["city_name" => "Adda shaiwala"],
            ["city_name" => "Ahmed Pur East"],
            ["city_name" => "Ahmedpur Lamma"],
            ["city_name" => "Akora khattak"],
            ["city_name" => "Ali chak"],
            ["city_name" => "Alipur Chatta"],
            ["city_name" => "Allahabad"],
            ["city_name" => "Amangarh"],
            ["city_name" => "Arifwala"],
            ["city_name" => "Attock"],
            ["city_name" => "Babarloi"],
            ["city_name" => "Babri banda"],
            ["city_name" => "Badin"],
            ["city_name" => "Bahawalnagar"],
            ["city_name" => "Bahawalpur"],
            ["city_name" => "Balakot"],
            ["city_name" => "Bannu"],
            ["city_name" => "Baroute"],
            ["city_name" => "Basirpur"],
            ["city_name" => "Basti Shorekot"],
            ["city_name" => "Bat khela"],
            ["city_name" => "Batang"],
            ["city_name" => "Bhai pheru"],
            ["city_name" => "Bhakkar"],
            ["city_name" => "Bhalwal"],
            ["city_name" => "Bhan saeedabad"],
            ["city_name" => "Bhera"],
            ["city_name" => "Bhikky"],
            ["city_name" => "Bhimber∙"],
            ["city_name" => "Bhirya road"],
            ["city_name" => "Bhuawana"],
            ["city_name" => "Buchay key"],
            ["city_name" => "Buner"],
            ["city_name" => "Burewala"],
            ["city_name" => "Chaininda"],
            ["city_name" => "Chak 4 b c"],
            ["city_name" => "Chak 46"],
            ["city_name" => "Chak jamal"],
            ["city_name" => "Chak jhumra"],
            ["city_name" => "Chak Shahzad"],
            ["city_name" => "Chaklala"],
            ["city_name" => "Chaksawari"],
            ["city_name" => "Chakwal"],
            ["city_name" => "Charsadda"],
            ["city_name" => "Chashma"],
            ["city_name" => "Chawinda"],
            ["city_name" => "Chenab Nagar"],
            ["city_name" => "Chichawatni"],
            ["city_name" => "Chiniot"],
            ["city_name" => "Chishtian"],
            ["city_name" => "Chitral"],
            ["city_name" => "Chohar jamali"],
            ["city_name" => "Choppar hatta"],
            ["city_name" => "Chowha saidan shah"],
            ["city_name" => "Chowk azam"],
            ["city_name" => "Chowk mailta"],
            ["city_name" => "Chowk munda"],
            ["city_name" => "Chunian"],
            ["city_name" => "D.G.Khan"],
            ["city_name" => "Dadakhel"],
            ["city_name" => "Dadu"],
            ["city_name" => "Dadyal Ak"],
            ["city_name" => "Daharki"],
            ["city_name" => "Dandot"],
            ["city_name" => "Dargai"],
            ["city_name" => "Darya khan"],
            ["city_name" => "Daska"],
            ["city_name" => "Daud khel"],
            ["city_name" => "Daulatpur"],
            ["city_name" => "Deh pathan"],
            ["city_name" => "Depal pur"],
            ["city_name" => "Dera Allah Yar∙"],
            ["city_name" => "Dera ismail khan"],
            ["city_name" => "Dera murad jamali"],
            ["city_name" => "Dera nawab sahib"],
            ["city_name" => "Dhatmal"],
            ["city_name" => "Dhoun kal"],
            ["city_name" => "Digri"],
            ["city_name" => "Dijkot"],
            ["city_name" => "Dina"],
            ["city_name" => "Dinga"],
            ["city_name" => "Dir"],
            ["city_name" => "Doaba"],
            ["city_name" => "Doltala"],
            ["city_name" => "Domeli"],
            ["city_name" => "Donga Bonga"],
            ["city_name" => "Dudial"],
            ["city_name" => "Dunia Pur"],
            ["city_name" => "Eminabad"],
            ["city_name" => "Esa Khel"],
            ["city_name" => "Faisalabad"],
            ["city_name" => "Faqirwali"],
            ["city_name" => "Farooqabad"],
            ["city_name" => "Fateh Jang"],
            ["city_name" => "Fateh pur"],
            ["city_name" => "Feroz walla"],
            ["city_name" => "Feroz watan"],
            ["city_name" => "Feroz Watwan"],
            ["city_name" => "Fiza got"],
            ["city_name" => "Fort Abbass"],
            ["city_name" => "Gadoon amazai"],
            ["city_name" => "Gaggo mandi"],
            ["city_name" => "Gakhar mandi"],
            ["city_name" => "Gambat"],
            ["city_name" => "Gambet"],
            ["city_name" => "Garh maharaja"],
            ["city_name" => "Garh more"],
            ["city_name" => "Garhi yaseen"],
            ["city_name" => "Gari habibullah"],
            ["city_name" => "Gari mori"],
            ["city_name" => "Gharo"],
            ["city_name" => "Ghazi"],
            ["city_name" => "Ghotki"],
            ["city_name" => "Gilgit"],
            ["city_name" => "Gohar ghoushti∙"],
            ["city_name" => "Gojra"],
            ["city_name" => "Goth Machi"],
            ["city_name" => "Goular khel"],
            ["city_name" => "Guddu"],
            ["city_name" => "Gujar Khan"],
            ["city_name" => "Gujranwala"],
            ["city_name" => "Gujrat"],
            ["city_name" => "Gwadar"],
            ["city_name" => "Hafizabad"],
            ["city_name" => "Hala"],
            ["city_name" => "Hangu"],
            ["city_name" => "Harappa"],
            ["city_name" => "Haripur"],
            ["city_name" => "Hariwala"],
            ["city_name" => "Haroonabad"],
            ["city_name" => "Hasilpur"],
            ["city_name" => "Hassan abdal"],
            ["city_name" => "Hattar"],
            ["city_name" => "Hattian"],
            ["city_name" => "Hattian lawrencepur"],
            ["city_name" => "Havali Lakhan"],
            ["city_name" => "Hawilian"],
            ["city_name" => "Hayatabad"],
            ["city_name" => "Hazro"],
            ["city_name" => "Head marala"],
            ["city_name" => "Hub"],
            ["city_name" => "Hub-Balochistan"],
            ["city_name" => "Hujra Shah Mukeem"],
            ["city_name" => "Hunza"],
            ["city_name" => "Hyderabad"],
            ["city_name" => "Iskandarabad"],
            ["city_name" => "Islamabad"],
            ["city_name" => "Jacobabad"],
            ["city_name" => "Jahaniya"],
            ["city_name" => "Jaja abasian"],
            ["city_name" => "Jalalpur Jattan"],
            ["city_name" => "Jalalpur Pirwala"],
            ["city_name" => "Jampur"],
            ["city_name" => "Jamrud road"],
            ["city_name" => "Jamshoro"],
            ["city_name" => "Jan pur"],
            ["city_name" => "Jand"],
            ["city_name" => "Jandanwala∙"],
            ["city_name" => "Jaranwala"],
            ["city_name" => "Jatlaan"],
            ["city_name" => "Jatoi"],
            ["city_name" => "Jauharabad"],
            ["city_name" => "Jehangira"],
            ["city_name" => "Jhal Magsi"],
            ["city_name" => "Jhand"],
            ["city_name" => "Jhang"],
            ["city_name" => "Jhatta bhutta"],
            ["city_name" => "Jhelum"],
            ["city_name" => "Jhudo"],
            ["city_name" => "Jin Pur"],
            ["city_name" => "K.N. Shah"],
            ["city_name" => "Kabirwala"],
            ["city_name" => "Kacha khooh"],
            ["city_name" => "Kahuta"],
            ["city_name" => "Kakul"],
            ["city_name" => "Kakur town"],
            ["city_name" => "Kala bagh"],
            ["city_name" => "Kala shah kaku"],
            ["city_name" => "Kalaswala"],
            ["city_name" => "Kallar Kahar"],
            ["city_name" => "Kallar Saddiyian"],
            ["city_name" => "Kallur kot"],
            ["city_name" => "Kamalia"],
            ["city_name" => "Kamalia musa"],
            ["city_name" => "Kamber ali khan"],
            ["city_name" => "Kameer"],
            ["city_name" => "Kamoke"],
            ["city_name" => "Kamra"],
            ["city_name" => "Kandh kot"],
            ["city_name" => "Kandiaro"],
            ["city_name" => "Karachi"],
            ["city_name" => "Karak"],
            ["city_name" => "Karoor pacca"],
            ["city_name" => "Karore lalisan"],
            ["city_name" => "Kashmir"],
            ["city_name" => "Kashmore"],
            ["city_name" => "Kasur"],
            ["city_name" => "Kazi ahmed"],
            ["city_name" => "Khairpur"],
            ["city_name" => "Khairpur Mir"],
            ["city_name" => "Khan Bela"],
            ["city_name" => "Khan qah sharif∙"],
            ["city_name" => "Khandabad"],
            ["city_name" => "Khanewal"],
            ["city_name" => "Khangarh"],
            ["city_name" => "Khanpur"],
            ["city_name" => "Khanqah dogran"],
            ["city_name" => "Khanqah sharif"],
            ["city_name" => "Kharian"],
            ["city_name" => "Khewra"],
            ["city_name" => "Khoski"],
            ["city_name" => "Khudian Khas"],
            ["city_name" => "Khurian wala"],
            ["city_name" => "Khurrianwala"],
            ["city_name" => "Khushab"],
            ["city_name" => "Khushal kot"],
            ["city_name" => "Khuzdar"],
            ["city_name" => "Khyber"],
            ["city_name" => "Klaske"],
            ["city_name" => "Kohat"],
            ["city_name" => "Kot addu"],
            ["city_name" => "Kot bunglow"],
            ["city_name" => "Kot ghulam mohd"],
            ["city_name" => "Kot mithan"],
            ["city_name" => "Kot Momin"],
            ["city_name" => "Kot radha kishan"],
            ["city_name" => "Kotla"],
            ["city_name" => "Kotla arab ali khan"],
            ["city_name" => "Kotla jam"],
            ["city_name" => "Kotla Pathan"],
            ["city_name" => "Kotli Ak"],
            ["city_name" => "Kotli Loharan"],
            ["city_name" => "Kotri"],
            ["city_name" => "Kumbh"],
            ["city_name" => "Kundina"],
            ["city_name" => "Kunjah"],
            ["city_name" => "Kunri"],
            ["city_name" => "Lahore"],
            ["city_name" => "Lakki marwat"],
            ["city_name" => "Lala musa"],
            ["city_name" => "Lala rukh"],
            ["city_name" => "Laliah"],
            ["city_name" => "Lalshanra"],
            ["city_name" => "Larkana"],
            ["city_name" => "Lasbela"],
            ["city_name" => "Lawrence pur∙"],
            ["city_name" => "Layyah"],
            ["city_name" => "Liaqat Pur"],
            ["city_name" => "Lodhran"],
            ["city_name" => "Lower Dir"],
            ["city_name" => "Ludhan"],
            ["city_name" => "Madina"],
            ["city_name" => "Makli"],
            ["city_name" => "Malakand Agency"],
            ["city_name" => "Malakwal"],
            ["city_name" => "Mamu kunjan"],
            ["city_name" => "Mandi bahauddin"],
            ["city_name" => "Mandra"],
            ["city_name" => "Manga mandi"],
            ["city_name" => "Mangal sada"],
            ["city_name" => "Mangi"],
            ["city_name" => "Mangla"],
            ["city_name" => "Mangowal"],
            ["city_name" => "Manoabad"],
            ["city_name" => "Mansehra"],
            ["city_name" => "Mardan"],
            ["city_name" => "Mari indus"],
            ["city_name" => "Mastoi"],
            ["city_name" => "Matli"],
            ["city_name" => "Mehar"],
            ["city_name" => "Mehmood kot"],
            ["city_name" => "Mehrabpur"],
            ["city_name" => "Melsi"],
            ["city_name" => "Mian Channu"],
            ["city_name" => "Mian Wali"],
            ["city_name" => "Minchanabad"],
            ["city_name" => "Mingora"],
            ["city_name" => "Mir ali"],
            ["city_name" => "Miran shah"],
            ["city_name" => "Mirpur A.K."],
            ["city_name" => "Mirpur khas"],
            ["city_name" => "Mirpur mathelo"],
            ["city_name" => "Mithi"],
            ["city_name" => "Mitiari"],
            ["city_name" => "Mohen jo daro"],
            ["city_name" => "More kunda"],
            ["city_name" => "Morgah"],
            ["city_name" => "Moro"],
            ["city_name" => "Mubarik pur∙"],
            ["city_name" => "Multan"],
            ["city_name" => "Muridke"],
            ["city_name" => "Murree"],
            ["city_name" => "Musafir khana"],
            ["city_name" => "Mustung"],
            ["city_name" => "Muzaffar Gargh"],
            ["city_name" => "Muzaffarabad"],
            ["city_name" => "Nankana sahib"],
            ["city_name" => "Narang mandi"],
            ["city_name" => "Narowal"],
            ["city_name" => "Naseerabad"],
            ["city_name" => "Naukot"],
            ["city_name" => "Naukundi"],
            ["city_name" => "Nawabshah"],
            ["city_name" => "New saeedabad"],
            ["city_name" => "Nilore"],
            ["city_name" => "Noor kot"],
            ["city_name" => "Nooriabad"],
            ["city_name" => "Noorpur nooranga"],
            ["city_name" => "Noshero Feroze"],
            ["city_name" => "Noudero"],
            ["city_name" => "Nowshera"],
            ["city_name" => "Nowshera cantt"],
            ["city_name" => "Nowshera Virka"],
            ["city_name" => "Okara"],
            ["city_name" => "Other"],
            ["city_name" => "Other Cities"],
            ["city_name" => "Padidan"],
            ["city_name" => "Pak china fertilizer"],
            ["city_name" => "Pak pattan sharif"],
            ["city_name" => "Panjan kisan"],
            ["city_name" => "Panjgoor"],
            ["city_name" => "Pano Aqil"],
            ["city_name" => "Pano Aqil"],
            ["city_name" => "Pasni"],
            ["city_name" => "Pasrur"],
            ["city_name" => "Pattoki"],
            ["city_name" => "Peshawar"],
            ["city_name" => "Phagwar"],
            ["city_name" => "Phalia"],
            ["city_name" => "Phool nagar"],
            ["city_name" => "Piaro goth"],
            ["city_name" => "Pind Dadan Khan"],
            ["city_name" => "Pindi Bhattian"],
            ["city_name" => "Pindi bohri∙"],
            ["city_name" => "Pindi gheb"],
            ["city_name" => "Piplan"],
            ["city_name" => "Pir mahal"],
            ["city_name" => "Pishin"],
            ["city_name" => "Popular Cities"],
            ["city_name" => "Qalandarabad"],
            ["city_name" => "Qamber Ali Khan"],
            ["city_name" => "Qasba gujrat"],
            ["city_name" => "Qazi ahmed"],
            ["city_name" => "Qila Deedar Singh"],
            ["city_name" => "Quaid Abad"],
            ["city_name" => "Quetta"],
            ["city_name" => "Quetta"],
            ["city_name" => "Rahim Yar Khan"],
            ["city_name" => "Rahwali"],
            ["city_name" => "Raiwind"],
            ["city_name" => "Rajana"],
            ["city_name" => "Rajanpur"],
            ["city_name" => "Rangoo"],
            ["city_name" => "Ranipur"],
            ["city_name" => "Rato Dero"],
            ["city_name" => "Rawalakot"],
            ["city_name" => "Rawalpindi"],
            ["city_name" => "Rawat"],
            ["city_name" => "Renala khurd"],
            ["city_name" => "Risalpur"],
            ["city_name" => "Rohri"],
            ["city_name" => "Sadiqabad"],
            ["city_name" => "Sagri"],
            ["city_name" => "Sahiwal"],
            ["city_name" => "Saidu sharif"],
            ["city_name" => "Sajawal"],
            ["city_name" => "Sakhi Sarwar"],
            ["city_name" => "Samanabad"],
            ["city_name" => "Sambrial"],
            ["city_name" => "Samma satta"],
            ["city_name" => "Sanghar"],
            ["city_name" => "Sanghi"],
            ["city_name" => "Sangla Hills"],
            ["city_name" => "Sangote"],
            ["city_name" => "Sanjarpur"],
            ["city_name" => "Sanjwal"],
            ["city_name" => "Sara e naurang"],
            ["city_name" => "Sara-E-Alamgir"],
            ["city_name" => "Sarai alamgir"],
            ["city_name" => "Sargodha∙"],
            ["city_name" => "Satiana"],
            ["city_name" => "Sehar baqlas"],
            ["city_name" => "Sehwan Sharif"],
            ["city_name" => "Sekhat"],
            ["city_name" => "Shadiwal"],
            ["city_name" => "Shah kot"],
            ["city_name" => "Shahdad kot"],
            ["city_name" => "Shahdadpur"],
            ["city_name" => "Shahdara"],
            ["city_name" => "Shahpur chakar"],
            ["city_name" => "Shahpur Saddar"],
            ["city_name" => "Shakargarh"],
            ["city_name" => "Shamsabad"],
            ["city_name" => "Shankiari"],
            ["city_name" => "Shedani sharif"],
            ["city_name" => "Sheikhupura"],
            ["city_name" => "Sheikhupura"],
            ["city_name" => "Shemier"],
            ["city_name" => "Shikar pur"],
            ["city_name" => "Shorkot"],
            ["city_name" => "Shorkot Cantt"],
            ["city_name" => "Shuja Abad"],
            ["city_name" => "Sialkot"],
            ["city_name" => "Sibi"],
            ["city_name" => "Sihala"],
            ["city_name" => "Sikandarabad"],
            ["city_name" => "Sillanwali"],
            ["city_name" => "Sita road"],
            ["city_name" => "Skardu"],
            ["city_name" => "Skrand"],
            ["city_name" => "Sohawa"],
            ["city_name" => "Sohawa district daska"],
            ["city_name" => "Sukkur"],
            ["city_name" => "Sumandari"],
            ["city_name" => "Swabi"],
            ["city_name" => "Swat"],
            ["city_name" => "Swatmingora"],
            ["city_name" => "Takhtbai"],
            ["city_name" => "Talagang"],
            ["city_name" => "Talamba"],
            ["city_name" => "Talhur"],
            ["city_name" => "Tandiliyawala"],
            ["city_name" => "Tando adam∙"],
            ["city_name" => "Tando Allah Yar"],
            ["city_name" => "Tando jam"],
            ["city_name" => "Tando Muhammad Khan"],
            ["city_name" => "Tank"],
            ["city_name" => "Tarbela"],
            ["city_name" => "Tarmatan"],
            ["city_name" => "Tatlay Wali"],
            ["city_name" => "Taunsa sharif"],
            ["city_name" => "Taxila"],
            ["city_name" => "Tharo shah"],
            ["city_name" => "Thatta"],
            ["city_name" => "Theing jattan more"],
            ["city_name" => "Thull"],
            ["city_name" => "Tibba sultanpur"],
            ["city_name" => "Toba Tek Singh"],
            ["city_name" => "Topi"],
            ["city_name" => "Toru"],
            ["city_name" => "Tranda Muhammad Pannah"],
            ["city_name" => "Turbat"],
            ["city_name" => "Ubaro"],
            ["city_name" => "Ubauro"],
            ["city_name" => "Ugoke"],
            ["city_name" => "Ukba"],
            ["city_name" => "Umer Kot"],
            ["city_name" => "Upper deval"],
            ["city_name" => "Usta Muhammad"],
            ["city_name" => "Vehari"],
            ["city_name" => "Village Sunder"],
            ["city_name" => "Wah cantt"],
            ["city_name" => "Wahi hassain"],
            ["city_name" => "Wahn Bachran"],
            ["city_name" => "Wan radha ram"],
            ["city_name" => "Warah"],
            ["city_name" => "Warburton"],
            ["city_name" => "Wazirabad"],
            ["city_name" => "Yazman mandi"],
            ["city_name" => "Zahir Peer"],
            ["city_name" => "Zafarwal"],
            ["city_name" => "Zahir Peer"],
            ["city_name" => "Zhob"],
            ["city_name" => "Ziarat"]
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}