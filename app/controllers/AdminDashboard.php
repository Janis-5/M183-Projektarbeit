<?php

/**
 * Admin Dashboard class
 */
class AdminDashboard
{
	use Controller;

	public function index()
	{
		if (empty($_SESSION['USER']) && $_SESSION['USER']->isadmin !=1) {
			redirect('dashboard');
		} else {
			$data = [];

			//get all To-Do's for view
			$allposts = new Post;
			$data['posts'] = $allposts->findAll();

			if ($_SERVER['REQUEST_METHOD'] == "POST") {
				$post = new Post;

				if (!empty($_POST['id'])) {
					$post->update($_POST['id'], $_POST);
				}

				redirect('admindashboard');
			}

			$this->view('admindashboard', $data);
		}
	}
}
