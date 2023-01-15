<?php

/**
 * detail class
 */
class Detail
{
	use Controller;

	public function index()
	{
		$data = [];

			$detailpost = new Post;
			$arr['id'] = $_GET['post'];
			$post = $detailpost->first($arr);

			//check if post is published
			if (!empty($post) && $post->status == 1) {
				$data['post'] = $post;

				$comments = new Comment;
				$arr1['post_id'] = $_GET['post'];
				$data['comments'] = $comments->where($arr1);
			}


		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$comment = new Comment;

			//XSS Prevention
			$_POST['content'] = htmlspecialchars($_POST['content']);

			if ($comment->validate($_POST) && !empty($_SESSION['USER'])) {
				$_POST["creator_id"] = strval($_SESSION['USER']->id);
				$_POST["post_id"] = strval($_GET['post']);
				$_POST["creation_date"] = time();	
				$comment->insert($_POST);
				redirect('detail?post='.$_GET['post']);
			}

			$data['errors'] = $comment->errors;
		}

		$this->view('detail', $data);
	}
}
