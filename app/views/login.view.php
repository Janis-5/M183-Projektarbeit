<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="cred-tab" data-bs-toggle="tab" data-bs-target="#cred" type="button" role="tab" aria-controls="cred" aria-selected="true">Cred</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="phone-tab" data-bs-toggle="tab" data-bs-target="#phone" type="button" role="tab" aria-controls="phone" aria-selected="false">Phone</button>
                            </li>
                        </ul>

                        <form method="POST">

                            <?php if (!empty($errors)) : ?>
                                <div class="alert alert-danger">
                                    <?= implode("<br>", $errors) ?>
                                </div>
                            <?php endif; ?>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="cred" role="tabpanel" aria-labelledby="cred-tab">
                                    <legend>Login</legend>
                                    <div class="mb-2">
                                        <label for="inputUsername" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="inputUsername" name="username" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="inputPassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="inputPassword" name="password" required>
                                    </div>
                                    <div class="mt-3">
                                        <div id="alertLogin" class="alert alert-danger" role="alert" style="display: none;"></div>
                                        <button onclick="checkLogin('inputUsername','inputPassword')" type="button" class="btn btn-primary">Continue</button>
                                        <a href="<?= ROOT ?>/register">Register</a>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="phone" role="tabpanel" aria-labelledby="phone-tab">
                                    <legend>2FA with Phone Number</legend>
                                    <div>
                                        <label for="inputToken" class="form-label">Token</label>
                                        <input type="number" class="form-control" id="inputToken" name="token">
                                        <div class="form-text">
                                            e.g 123456
                                        </div>
                                        <div id="dangerToken" class="alert alert-danger" role="alert" style="display: none;"></div>
                                        <div id="successToken" class="alert alert-success" role="alert" style="display: none;"></div>
                                    </div>
                                    <div class="mt-3">
                                        <button type="button" onclick="form.submit()" class="btn btn-primary">Login</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <? include("global/footer.view.php"); ?>
    <script src="<?= ROOT ?>/assets/js/main.js"></script>
</body>

</html>