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
	];

	public function validate($data)
	{
		$this->errors = [];

		if(empty($data['username']))
		{
			$this->errors['username'] = "Username is required";
		}
		
		if(empty($data['password']))
		{
			$this->errors['password'] = "Password is required";
		}

		if(empty($data['passwordrepeat']))
		{
			$this->errors['passwordrepeat'] = "Password Repeat is required";
		}

		if($data['password'] != $data['passwordrepeat'])
		{
			$this->errors['passwordmatch'] = "Password and Password Repeat do not match";
		}

		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}
}