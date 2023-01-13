<?php


/**
 * User class
 */
class User
{
	use Model;

	protected $table = 'user';

	protected $allowedColumns = [
		'username',
		'password',
		'phone',
	];

	public function validate($data)
	{
		$this->errors = [];

		if (empty($data['username'])) {
			$this->errors['Username'] = "Username is required";
		}

		if (empty($data['password'])) {
			$this->errors['Password'] = "Password is required";
		}

		if (empty($data['passwordrepeat'])) {
			$this->errors['PasswordRepeat'] = "Password Repeat is required";
		}

		if ($data['password'] != $data['passwordrepeat']) {
			$this->errors['PasswordRepeat'] = "Password and Password Repeat do not match";
		}

		if (!empty($data['token'])) {
			if ($data['token'] != $_SESSION['TOKEN']) {
				$this->errors['token'] = "SMS Token not correct";
			}
		}

		if (empty($this->errors)) {
			return true;
		}

		return false;
	}
}
