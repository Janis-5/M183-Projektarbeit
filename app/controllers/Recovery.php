<?php

/**
 * Recovery class
 */
class Recovery
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
					if ($_POST['recovery_code'] == $row->recovery_code) {
						$_SESSION['USER'] = $row;

						addToAccessLog(' User Loggt in', $_SESSION['USER']->username);

						redirect('dashboard');
					} else {
						$user->errors['Recovery'] = "Recovery Code not correct";
					}
				} else {
					$user->errors['Login'] = "Wrong username or password";
				}

				addToErrorLog($user->errors);
				$data['errors'] = $user->errors;
			}

			$this->view('recovery', $data);
		}
	}
}
