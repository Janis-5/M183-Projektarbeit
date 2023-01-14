<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Page</title>
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
        <? if (empty($post)) { ?>
            <div>Post not found</div>
        <? } else { ?>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted"><?= getCreatorName($post->creator_id) ?></h6>
                                    <h5 class="card-title"><?= $post->title ?></h5>
                                    <p class="card-text"><?= $post->description ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <h2>Comments</h2>
                            <? if (!empty($_SESSION['USER'])) { ?>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <form method="POST">
                                            <?php if (!empty($errors)) : ?>
                                                <div class="alert alert-danger">
                                                    <?= implode("<br>", $errors) ?>
                                                </div>
                                            <?php endif; ?>

                                            <legend>Write new Comment</legend>

                                            <div class="mb-3">
                                                <textarea maxlength="200" class="form-control" id="inputCommpent" name="content"></textarea>
                                                <div class="form-text">
                                                    Max. 200 characters
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <button type="submit" class="btn btn-primary">New Comment</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            <? } ?>
                            <? if (empty($comments)) { ?>
                                <div>No comments yet</div>
                            <? } else { ?>
                                <? foreach ($comments as $comment) { ?>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <?= $comment->content ?>
                                        </div>
                                        <div class="card-footer">
                                            <?= getCreatorName($comment->creator_id) ?>
                                            <?= date("d.m.Y, H:i", $comment->creation_date) ?>
                                        </div>
                                    </div>
                            <? }
                            } ?>
                        </div>
                    </div>
                </div>
            </section>
        <? } ?>




    </main>
    <? include("global/footer.view.php"); ?>
</body>

</html>