<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mandi Links | Password Reset OTP</title>
</head>

<body>
	<div style="font-family:Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
		<div style="margin:50px auto;width:70%;padding:20px 0">
			<div style="border-bottom:1px solid #eee">
			<img src="{{ asset('assets/img/logo.png') }}" style="width:120px">
			</div>
			<p style="font-size:1.1em">Hi,</p>
			<p>Please use the following code as One Time Password (OTP) to reset your password.</p>
			<h2 style="background:#8ec63f;margin:0 auto;width:max-content;padding:0 10px;color:#fff;border-radius:4px">{{ $otp }}</h2>
			<p style="font-size:0.9em">Regards,<br><b>Team Mandilinks</b></p>
			<hr style="border:none;border-top:1px solid #eee">
		</div>
	</div>
</body>

</html>