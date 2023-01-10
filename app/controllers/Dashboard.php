<?php

/**
 * dashboard class
 */
class Dashboard
{
	use Controller;

	public function index()
	{
		if (empty($_SESSION['USER'])) {
			redirect('login');
		} else {
			$data = [];

			//get all To-Do's for view
			$allposts = new Post;
			$data['posts'] = $allposts->findall();

			if ($_SERVER['REQUEST_METHOD'] == "POST") {
				$post = new Post;

				if (!empty($_POST['delete'])) {
					$post->delete($_POST['delete']);
					redirect('home');
				}
				elseif ($post->validate($_POST)) {

					if (!empty($_POST['id'])) {
						if (empty($_POST['isdone'])) {
							$_POST['isdone'] = "0";
						}
						$post->update($_POST['id'], $_POST);
					} else {
						$_POST["creator_id"] = strval($_SESSION['USER']->id);
						$post->insert($_POST);
					}
					redirect('home');
				}

				$data['errors'] = $post->errors;
			}

			$this->view('dashboard', $data);
		}
	}
}
