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

			if ($row) {
				if (password_verify($_POST['password'], $row->password)) {
					$_SESSION['USER'] = $row;
					
					redirect('dashboard');
				}
			}

			$user->errors['username'] = "Wrong username or password";

			$data['errors'] = $user->errors;
		}

		$this->view('login', $data);
	}
}
