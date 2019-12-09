
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Manager Entité</title>
    <meta name="viewport" content="width=device-width">
    <link href="style.css" rel="stylesheet" type="text/css">
    <!--Font -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Glegoo" rel="stylesheet">
</head>

<body>
    <header>
        <h1>Création/Modification d'un User</h1>
    </header>
    <hr />
    <section id="main-section">
        <form action="" method="POST"><label>Mail :</label><br /><input type="email" name="email"
                placeholder="Mail.." /><br><label>Mot de passe :</label><br /><input type="password" name="password"
                placeholder="Mot de passe.." /><br><label>Nom :</label><br /><input type="text" name="lastName"
                placeholder="Nom.." /><br><label>Prénom :</label><br /><input type="text" name="firstName"
                placeholder="Prénom.." /><br><label>Adresse :</label><br /><input type="text" name="address"
                placeholder="Adresse.." /><br><label>Code Postal :</label><br /><input type="text" name="postalCode"
                placeholder="Code Postal.." /><br><label>Ville :</label><br /><input type="text" name="city"
                placeholder="Ville.." /><br>
            <p><input type="submit" class="submit-btn" value="Créer/Valider"></p>
        </form>
    </section>
</body>
</html>

<?php
    require_once('../Model/Connection.php');
    require_once("../Model/User.php");
    require_once("../Model/UserManager.php");
    $connection = new Connection;
    $userManage = new UserManager($connection->getDb()); 

    if(!empty($_POST['email']) && !empty($_POST['password'])){

        $user = new User;
        $user->hydrate(array("email"=>$_POST['email'],
        "password"=>$_POST['password'],
        "lastName"=>$_POST['lastName'],
        "firstName"=>$_POST['firstName'],
        "address"=>$_POST['address'],
        "postalCode"=>$_POST['postalCode'],
        "city"=>$_POST['city']));
        $userManage->create($user);
    }

?>