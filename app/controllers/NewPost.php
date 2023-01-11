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

				/*if (!empty($_POST['status'])) {
					$post->delete($_POST['delete']);
					redirect('home');
				}
				else*/
				if ($post->validate($_POST)) {

					/*if (!empty($_POST['id'])) {
						if (empty($_POST['isdone'])) {
							$_POST['isdone'] = "0";
						}
						$post->update($_POST['id'], $_POST);
					} else {
						$_POST["creator_id"] = strval($_SESSION['USER']->id);
						$post->insert($_POST);
					}*/
					$_POST["creator_id"] = strval($_SESSION['USER']->id);
					$post->insert($_POST);
					redirect('dashboard');
				}

				$data['errors'] = $post->errors;
			}

			$this->view('newpost', $data);
		}
	}
}
