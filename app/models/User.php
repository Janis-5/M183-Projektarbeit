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

	public function validate($data, $checkToken = false, $checkPhone = false)
	{
		$this->errors = [];

		// Validate password strength
		$uppercase = preg_match('@[A-Z]@', $data['password']);
		$lowercase = preg_match('@[a-z]@', $data['password']);
		$number    = preg_match('@[0-9]@', $data['password']);
		$specialChars = preg_match('@[^\w]@', $data['password']);

		//Username  Validation
		$allowed = array("-", "_");

		if (empty($data['username'])) {
			$this->errors['Username'] = "Username is required";
		}elseif (!ctype_alnum(str_replace($allowed, '', $data['username'])) || strlen($data['username']) < 3 || strlen($data['username']) > 16) {
			$this->errors['Username'] = "Username should be between 3 and 16 characters in length and schould only contain alphabetic, numeric, '-' and '_' characters.";
		}

		if (empty($data['password'])) {
			$this->errors['Password'] = "Password is required";
		}elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($data['password']) < 8 || strlen($data['password']) > 20) {
			$this->errors['Password'] = "Password should be between 8 and 20 characters in length and should include at least one upper case letter, one number, and one special character.";
		}

		if (empty($data['passwordrepeat'])) {
			$this->errors['PasswordRepeat'] = "Repeat Password is required";
		}elseif($data['password'] != $data['passwordrepeat']){
			$this->errors['PasswordRepeat'] = "Password and Password Repeat do not match";
		}

		if ($checkToken) {
			if ($data['token'] != $_SESSION['TOKEN']) {
				$this->errors['Token'] = "SMS Token not correct";
			}
		}

		if (empty($this->errors)) {
			return true;
		}

		return false;
	}
}
