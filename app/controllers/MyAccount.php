<?php
use OTPHP\TOTP;
require '../vendor/autoload.php';
/**
 * myaccount class
 */
class MyAccount
{
	use Controller;

	public function index()
	{
		if (empty($_SESSION['USER'])) {
			redirect('login');
		} else {
			$data = [];

			if(empty($_SESSION['USER']->secret)){
				// A random secret will be generated from this.
				// You should store the secret with the user for verification.
				$otp = TOTP::create();
				$secret = $otp->getSecret();
				//echo "The OTP secret is: {$secret}\n";
				$_SESSION['SECRET'] = $secret;

				$otp = TOTP::create($secret);
				//echo "The current OTP is: {$otp->now()}\n";

				// Note: You must set label before generating the QR code
				$otp->setLabel('2FA M183 Janis Arnold');
				$data['totpqr'] = $otp->getQrCodeUri(
					'https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=[DATA]&chld=M',
					'[DATA]'
				);
			}

			if ($_SERVER['REQUEST_METHOD'] == "POST") {

				$user = new User;

				if ($_POST['token'] == $_SESSION['TOKEN'] && $_SESSION['TOKENEXPIRE'] > time()) {
					unset($_SESSION['TOKEN']);
					unset($_SESSION['TOKENEXPIRE']);
					$user->update($_SESSION['USER']->id, $_POST);

					redirect('dashboard');
				} else {
					$user->errors['Token'] = "SMS Token not correct or expired";
				}

				addToErrorLog($user->errors, $_SESSION['USER']->username);
				$data['errors'] = $user->errors;
			}

			$this->view('myaccount', $data);
		}
	}
}
