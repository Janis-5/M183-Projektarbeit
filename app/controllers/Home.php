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

		//get all Posts for view
		$publishedposts = new Post;
		$arr['status'] = '1';
		$data['posts'] = $publishedposts->where($arr);

		$this->view('home', $data);
	}
}
