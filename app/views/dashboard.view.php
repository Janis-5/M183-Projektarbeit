<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="<?= ROOT ?>/assets/css/custom.css" rel="stylesheet">
</head>

<body>
    <header>
        <? include("global/nav.view.php"); ?>
    </header>

    <main>
        <section>
            <div class="row">
                <div class="col-md-1 offset-md-11 mb-3">
                    <a type="button" href="<?= ROOT ?>/NewPost" class="btn btn-primary">New Post</a>
                </div>
            </div>
            <div class="container">
                <div class="row row-cols-md-4 row-cols-sm-2">
                    <? if (empty($posts)) { ?>
                        <div>No Posts yet</div>
                    <? } else { ?>
                        <? foreach ($posts as $post) { ?>

                            <div class="col">
                                <div class="card mb-3">
                                    <div class="card-header <?
                                                            if ($post->status == 1) { ?>
                                    text-white bg-success
                                <? } ?>">
                                        <h5 class="card-title"><?= $post->title ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text"><?= $post->description ?></p>
                                        <form method="POST">
                                            <button type="submit" id="deleteButton" name="delete" value="<?= $post->id ?>" class="btn btn-danger">Delete</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                    <? }
                    } ?>
                </div>
        </section>

    </main>
    <? include("global/footer.view.php"); ?>
    <script src="<?= ROOT ?>/assets/js/main.js"></script>
</body>

</html>