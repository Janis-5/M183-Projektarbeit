<?php

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
