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
			$myposts = new Post;
			$arr['creator_id'] = $_SESSION['USER']->id;
			$narr['status'] = '2';
			$data['posts'] = $myposts->where($arr, $narr);

			if ($_SERVER['REQUEST_METHOD'] == "POST") {
				$post = new Post;

				if (!empty($_POST['delete'])) {
					$_POST['id'] = $_POST['delete'];
					$_POST['status'] = 2;
					$post->update($_POST['id'], $_POST);
				}

				redirect('dashboard');
			}

			$this->view('dashboard', $data);
		}
	}
}
