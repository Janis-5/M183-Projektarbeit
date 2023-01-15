<?php

/**
 * NewPost class
 */
class NewPost
{
	use Controller;

	public function index()
	{
		if (empty($_SESSION['USER'])) {
			redirect('login');
		} else {
			$data = [];

			if ($_SERVER['REQUEST_METHOD'] == "POST") {
				$post = new Post;
				if ($post->validate($_POST)) {
					$_POST["creator_id"] = strval($_SESSION['USER']->id);
					$post->insert($_POST);
					redirect('dashboard');
				}

				addToErrorLog($post->errors, $_SESSION['USER']->username);
				$data['errors'] = $post->errors;
			}

			$this->view('newpost', $data);
		}
	}
}
