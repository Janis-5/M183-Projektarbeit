<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

                            <legend>Register</legend>
                            <div>
                                <label for="inputUsername" class="form-label">Username</label>
                                <input type="text" class="form-control" id="inputUsername" name="username">
                            </div>
                            <div>
                                <label for="inputPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="inputPassword" name="password">
                            </div>
                            <div>
                                <label for="inputPasswordRepeat" class="form-label">Repeat Password</label>
                                <input type="password" class="form-control" id="inputPasswordRepeat" name="passwordrepeat">
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Register</button>
                                <a href="<?=ROOT?>/home" class="btn btn-secondary">Cancel</a>
                                <a href="<?=ROOT?>/login">Login</a>
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