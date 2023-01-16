<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
                <div class="row row-cols-md-4 row-cols-sm-2">
                    <? if (empty($posts)) { ?>
                        <div>No Posts yet</div>
                    <? } else { ?>
                        <? foreach ($posts as $post) { ?>

                            <div class="col">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <? if ($post->status == 0) { ?>
                                            <span class="badge text-bg-secondary status">Hidden</span>
                                        <? } elseif ($post->status == 1) { ?>
                                            <span class="badge text-bg-primary status">Published</span>
                                        <? } elseif ($post->status == 2) { ?>
                                            <span class="badge text-bg-danger status">Deleted</span>
                                        <? } ?>
                                        <?= getCreatorName($post->creator_id) ?>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($post->title) ?></h5>
                                    </div>
                                    <div class="card-footer">
                                        <form method="POST">
                                            <input type="hidden" name="id" value="<?= $post->id ?>">
                                            <select name="status" class="form-select" aria-label="Default select example" onchange="this.form.submit()">
                                                <option <? if ($post->status == 0) { ?>selected<? } ?> value="0">Hidden</option>
                                                <option <? if ($post->status == 1) { ?>selected<? } ?> value="1">Published</option>
                                                <option <? if ($post->status == 2) { ?>selected<? } ?> value="2">Deleted</option>
                                            </select>
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