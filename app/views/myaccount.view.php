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
            <div class="container">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <form method="POST">

                            <?php if (!empty($errors)) : ?>
                                <div class="alert alert-danger">
                                    <?= implode("<br>", $errors) ?>
                                </div>
                            <?php endif; ?>

                            <h2><?= $_SESSION['USER']->username ?> Account</h2>
                            <legend>Change 2FA Phone Number</legend>
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
                            </div>
                            <div class="mt-3">
                                <button type="button" onclick="form.submit()" class="btn btn-primary">Change Number</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <form method="POST">
                            <legend>TOTP</legend>
                            <? if (!empty($totpqr)) { ?>
                                <div class="mt-3">
                                    <div class="form-text">
                                        TOTP not yet set
                                    </div>
                                </div>
                                <img src="<?= $totpqr ?>">
                                <div>
                                    <label for="inputTotp" class="form-label">TOTP TOKEN</label>
                                    <input type="number" class="form-control" id="inputTotp" name="totp">
                                    <div class="form-text">
                                        e.g 123456
                                    </div>
                                    <div id="alertTotp" class="alert alert-danger" role="alert" style="display: none;"></div>
                                </div>
                                <div class="mt-3">
                                    <button type="button" onclick="setTotp('inputTotp')" class="btn btn-primary">Set TOTP</button>
                                </div>
                            <? } else { ?>
                                <div id="successTotp" class="alert alert-success" role="alert">
                                    TOTP is set
                                </div>
                            <? } ?>
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