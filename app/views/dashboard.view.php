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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postModal" data-bs-type="New" data-bs-title="" data-bs-description="" data-bs-id="">New</button>
                </div>
            </div>
            <div class="container">
                <div class="row row-cols-md-4 row-cols-sm-2">
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
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postModal" data-bs-type="Edit" data-bs-title="<?= $post->title ?>" data-bs-description="<?= $post->description ?>" data-bs-id="<?= $post->id ?>" data-bs-status="<?= $post->status ?>">Edit</button>
                                </div>
                            </div>
                        </div>
                    <? } ?>
                </div>
        </section>

        <div class="modal fade" id="postModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="postModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="postForm" method="POST">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="postModalLabel">add Post</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3 blockId" id="blockId">
                                <label for="inputId" class="col-form-label">Id:</label>
                                <input type="text" class="form-control" id="inputId" name="id" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="inputTitle" class="col-form-label">Title:</label>
                                <input type="text" class="form-control" id="inputTitle" name="title">
                            </div>
                            <div class="mb-3">
                                <label for="inputDescription" class="col-form-label">Description:</label>
                                <textarea class="form-control" id="inputDescription" name="description"></textarea>
                            </div>
                            <div class="mb-3 blockId">
                                <div class="form-check">
                                    <input id="inputStatus" class="form-check-input" type="checkbox" value="1" name="status">
                                    <label class="form-check-label" for="inputStatus">
                                        Finished
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="deleteButton" name="delete" class="btn btn-danger blockId">Delete</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal" id="errorModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content postError">
                    <div class="modal-header postError">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php if (!empty($errors)) : ?>
                            <?= implode("<br>", $errors) ?>
                            <script>
                                new bootstrap.Modal(errorModal).show();
                            </script>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <? include("global/footer.view.php"); ?>
    <script src="<?= ROOT ?>/assets/js/homeModal.js"></script>
</body>

</html>