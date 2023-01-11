<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Post</title>
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
            <div class="container">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <form method="POST">

                            <?php if (!empty($errors)) : ?>
                                <div class="alert alert-danger">
                                    <?= implode("<br>", $errors) ?>
                                </div>
                            <?php endif; ?>

                            <legend>New Post</legend>
                            <div>
                                <label for="inputTitle" class="form-label">Title</label>
                                <input type="text" class="form-control" id="inputTitle" name="title">
                            </div>

                            <div class="mb-3">
                                <label for="inputDescription" class="col-form-label">Description:</label>
                                <textarea class="form-control" id="inputDescription" name="description"></textarea>
                            </div>
                            
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Add Post</button>
                                <a href="<?=ROOT?>/dashboard" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <? include("global/footer.view.php"); ?>
</body>

</html>