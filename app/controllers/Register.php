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
