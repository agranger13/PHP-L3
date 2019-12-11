<header>
    <div id="info-bar">
        <p>My wonderful platform</p>
    </div>

    <div id="banner-bloc">
        <h1>TP Authentification et MVC</h1>
    </div>

    <div id="account_bar">
        <div class="connection center">
            <a href="./index.php?ctrl=user&action=<?php echo $_SESSION['user']?"logout":"login"; ?>" class="no-deco" title="Login or create account">
                <?php echo $_SESSION['user']?"Bonjour ".$_SESSION['user']['firstName']:""; ?>
                <i class="fas fa-user"> 
                <div class="text"><?php echo $_SESSION['user']?"Logout":"Login"; ?></div>
            </a>
        </div>
    </div>

    <ul id="menu_bar">
        <a href="./index.php?ctrl=user&action=usersList" class="no-deco"><li>Liste des utilisateurs</li></a>
        <a href="./" class="no-deco"><li>Le mémoire</li></a>
        <a href="./" class="no-deco"><li>La soutenance</li></a>
        <a href="./" class="no-deco"><li>Le carnet de liaison</li></a>
        <a href="./" class="no-deco"><li>Les espaces de travail</li></a>
    </ul>
</header>