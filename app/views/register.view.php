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

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="cred-tab" data-bs-toggle="tab" data-bs-target="#cred" type="button" role="tab" aria-controls="cred" aria-selected="true">Cred</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="phone-tab" data-bs-toggle="tab" data-bs-target="#phone" type="button" role="tab" aria-controls="phone" aria-selected="false">Phone</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="recovery-tab" data-bs-toggle="tab" data-bs-target="#recovery" type="button" role="tab" aria-controls="recovery" aria-selected="false">Recovery</button>
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
                                    <legend>Register</legend>
                                    <div class="mb-2">
                                        <label for="inputUsername" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="inputUsername" name="username" required>
                                        <div class="form-text">
                                            3-16 characters, only letters, numbers, "-" and "_"
                                        </div>
                                        <div id="alertUsername" class="alert alert-danger" role="alert" style="display: none;"></div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="inputPassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="inputPassword" name="password" required>
                                        <div class="form-text">
                                            8-20 characters, must contain letter(lowercase and capital), number and special character
                                        </div>
                                        <div id="alertPassword" class="alert alert-danger" role="alert" style="display: none;"></div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="inputPasswordRepeat" class="form-label">Repeat Password</label>
                                        <input type="password" class="form-control" id="inputPasswordRepeat" name="passwordrepeat" required>
                                        <div class="form-text">
                                            Must match password
                                        </div>
                                        <div id="alertPasswordRepeat" class="alert alert-danger" role="alert" style="display: none;"></div>
                                    </div>
                                    <div class="mt-3">
                                        <button onclick="checkRegister('inputUsername','inputPassword','inputPasswordRepeat')" type="button" class="btn btn-primary">Continue</button>
                                        <a href="<?= ROOT ?>/login">Login</a>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="phone" role="tabpanel" aria-labelledby="phone-tab">
                                    <legend>2FA with Phone Number</legend>
                                    <div class="mb-2">
                                        <label for="inputPhone" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" id="inputPhone" name="phone">
                                        <div class="form-text">
                                            e.g 417********
                                        </div>
                                        <div id="alertPhone" class="alert alert-danger" role="alert" style="display: none;"></div>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <button type="button" onclick="sendToken('inputPhone')" class="btn btn-primary">Send Token</button>
                                        <div id="dangerToken" class="alert alert-danger" role="alert" style="display: none;"></div>
                                        <div id="successToken" class="alert alert-success" role="alert" style="display: none;"></div>
                                    </div>
                                    <div>
                                        <label for="inputToken" class="form-label">Token</label>
                                        <input type="number" class="form-control" id="inputToken" name="token">
                                        <div class="form-text">
                                            e.g 123456
                                        </div>
                                        <div id="alertToken" class="alert alert-danger" role="alert" style="display: none;"></div>
                                    </div>
                                    <div class="mt-3">
                                        <button type="button" onclick="registUser('inputUsername','inputPassword','inputPasswordRepeat', 'inputPhone', 'inputToken')" class="btn btn-primary">Register</button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="recovery" role="tabpanel" aria-labelledby="recovery-tab">
                                    <legend>Recovery Code</legend>
                                    <div class="form-text">
                                            Save this Code incase you lose access to phone number.
                                        </div>
                                    <div class="mt-3" id="recovery_code"></div>
                                    <div class="mt-3">
                                        <button type="button" onclick="window.location.href = 'dashboard'" class="btn btn-primary">To Dashboard</button>
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