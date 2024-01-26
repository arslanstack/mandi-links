<!DOCTYPE html>
<html>

<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<title>Mandi Links | User Contacted for Support</title>
</head>

<body>
	<div style='font-family:Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2'>
		<div style='margin:50px auto;width:70%;padding:20px 0'>
			<div style='border-bottom:1px solid #eee'>
				<img src="{{ asset('assets/img/logo.png') }}" style="width:120px">
			</div>
			<p style='font-size:1.1em'>Dear Administrator,</p>
			<p>A user contacted you via Mandilinks App Contact Form. Below you can find user details:</p>

			<p><span style='background:#edede9;'>User Name: </span>{{ $data['name'] }}</p>
			<p><span style='background:#edede9;'>User Phone No: </span>{{ $data['phone_no'] }}</p>
			<p><span style='background:#edede9;'>User Message: </span>{{ $data['message'] }}</p> <br><br>
			<p style='font-size:0.9em'>Regards,<br><b>Mandi Links Mail Delivery System</b></p>
			<hr style='border:none;border-top:1px solid #eee'>
		</div>
	</div>
</body>

</html>