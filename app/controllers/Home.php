<?php

/**
 * home class
 */
class Home
{
	use Controller;

	public function index()
	{
		$data = [];

		//get all To-Do's for view
		$allposts = new Post;
		$data['posts'] = $allposts->findall();

		$this->view('home', $data);
	}
}
