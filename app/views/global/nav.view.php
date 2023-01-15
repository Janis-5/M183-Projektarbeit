<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= ROOT ?>">M183 Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= ROOT ?>/home">Home</a>
                </li>
                <? if (empty($_SESSION['USER'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/login">Login</a>
                    </li>
                <? } ?>
                <? if (!empty($_SESSION['USER'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= ROOT ?>/dashboard">Dashboard</a>
                    </li>
                    <? if ($_SESSION['USER']->isadmin == 1) { ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="<?= ROOT ?>/admindashboard">Admin Dashboard</a>
                        </li>
                    <? } ?>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= ROOT ?>/myaccount">My Account</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/logout">Logout</a>
                    </li>
                <? } ?>

            </ul>
        </div>
    </div>
</nav>