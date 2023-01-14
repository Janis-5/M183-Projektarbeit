<?php

/**
 * login class
 */
class Login
{
	use Controller;

	public function index()
	{
		$data = [];

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$user = new User;
			$arr['username'] = $_POST['username'];

			$row = $user->first($arr);

			if ($row && password_verify($_POST['password'], $row->password)) {
				if ($_POST['token'] == $_SESSION['TOKEN']) {
					$_SESSION['USER'] = $row;

					redirect('dashboard');
				} else {
					$user->errors['Token'] = "SMS Token not correct";
				}
			} else {
				$user->errors['Login'] = "Wrong username or password";
			}

			$data['errors'] = $user->errors;
		}

		$this->view('login', $data);
	}
}
