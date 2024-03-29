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

			if ($_SERVER['REQUEST_METHOD'] == "POST") {

				$user = new User;

				$arr['username'] = $_POST['username'];

				$row = $user->first($arr);

				if (!$row) {
					if ($user->validate($_POST, true)) {
						$_POST['password'] = password_hash($_POST['password'], PASSWORD_ARGON2I);
						$_POST['recovery_code'] = generateRandomString(16);
						$user->insert($_POST);
						unset($_SESSION['TOKEN']);
						unset($_SESSION['TOKENEXPIRE']);

						//Auto Login after Register
						$user1 = new User;
						$arr1['username'] = $_POST['username'];

						$row1 = $user1->first($arr1);
						$_SESSION['USER'] = $row1;

						addToAccessLog(' User Registered', $_SESSION['USER']->username);
						redirect('dashboard');
						//echo '<script>alert(Recovery Code: '.$_POST['recovery_code'].')</script>';
					}
				} else {
					$user->errors['username'] = "Username already exists";
				}

				addToErrorLog($user->errors);
				$data['errors'] = $user->errors;
			}

			$this->view('register', $data);
		}
	}
}
