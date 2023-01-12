<?php

/**
 * Register class
 */
class Register
{
	use Controller;

	public function index()
	{
		if (!empty($_SESSION['USER'])) {
			redirect('home');
		} else {
			$data = [];


			/*$fields = json_encode(array(
				"mobileNumber" => "41793672870",
				"message" => "123456"
			));
			$curl_session = curl_init();
			curl_setopt($curl_session, CURLOPT_URL, "https://m183.gibz-informatik.ch/api/sms/message");
			curl_setopt($curl_session, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($curl_session, CURLOPT_POSTFIELDS, $fields);
			curl_setopt(
				$curl_session,
				CURLOPT_HTTPHEADER,
				array(
					'Content-Type: application/json',
					'X-Api-Key: NQAxADgAMAA2ADgAMwA2ADgAMgAyADYANAAzADQANgA5ADUA'
				)
			);
			curl_exec($curl_session);
			curl_close($curl_session);*/


			if ($_SERVER['REQUEST_METHOD'] == "POST") {
				$user = new User;

				$arr['username'] = $_POST['username'];

				$row = $user->first($arr);

				if (!$row) {
					if ($user->validate($_POST)) {
						$_POST['password'] = password_hash($_POST['password'], PASSWORD_ARGON2I);
						$user->insert($_POST);
						redirect('login');
					}
				} else {
					$user->errors['username'] = "Username already exists";
				}

				$data['errors'] = $user->errors;
			}

			$this->view('register', $data);
		}
	}
}
