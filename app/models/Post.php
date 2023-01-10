<?php 


/**
 * Post class
 */
class Post
{
	use Model;

	protected $table = 'post';

	protected $allowedColumns = [
		'title',
		'description',
		'creator_id',
        'status',
	];

	public function validate($data)
	{
		$this->errors = [];

		if(empty($data['title']))
		{
			$this->errors['title'] = "Title is required";
		}
		
		if(empty($data['description']))
		{
			$this->errors['description'] = "Description is required";
		}

		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}
}