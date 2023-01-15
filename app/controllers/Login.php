<?php

/**
 * login class
 */
class Login
{
	use Controller;

	public function index()
	{
		if (!empty($_SESSION['USER'])) {
			redirect('dashboard');
		} else {
			$data = [];

			if ($_SERVER['REQUEST_METHOD'] == "POST") {
				$user = new User;
				$arr['username'] = $_POST['username'];

				$row = $user->first($arr);

				if ($row && password_verify($_POST['password'], $row->password)) {
					if ($_POST['token'] == $_SESSION['TOKEN'] && $_SESSION['TOKENEXPIRE'] > time()) {
						$_SESSION['USER'] = $row;
						unset($_SESSION['TOKEN']);
						unset($_SESSION['TOKENEXPIRE']);
						addToAccessLog(' User Loggt in', $_SESSION['USER']->username);

						redirect('dashboard');
					} else {
						$user->errors['Token'] = "SMS Token not correct or expired";
					}
				} else {
					$user->errors['Login'] = "Wrong username or password";
				}

				addToErrorLog($user->errors, $_SESSION['USER']->username);
				$data['errors'] = $user->errors;
			}

			$this->view('login', $data);
		}
	}
}
