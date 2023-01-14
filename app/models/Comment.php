<?php 


/**
 * Comment class
 */
class Comment
{
	use Model;

	protected $table = 'comment';

	protected $allowedColumns = [
		'content',
		'creator_id',
        'post_id',
		'creation_date',
	];

	public function validate($data)
	{
		$this->errors = [];
		
		if(empty($data['content']))
		{
			$this->errors['content'] = "Content is Required";
		}elseif(strlen($data['content']) > 200){
			$this->errors['content'] = "Too many characters, only 200 allowed";
		}

		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}
}