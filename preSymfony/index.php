<head>
    <meta name="viewport" content="width=device-width">
    <link href="View/style/general.css" rel="stylesheet" type="text/css">
    <link href="View/style/header-footer.css" rel="stylesheet" type="text/css">
    <link href="View/style/mainSection.css" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro|Nunito|Glegoo" rel="stylesheet">
    <!-- Fontawesome -->
    <script src="./View/js/fontawesome-all.min.js"></script>
    
</head>
<?php
    session_start();

    require_once('Model/Connection.php');
    require_once("Model/User.php");
    require_once("Model/UserManager.php");

    $pdoBuilder = new Connection();
    $db = $pdoBuilder->getDb();
    if (( isset($_GET['ctrl']) && !empty($_GET['ctrl']) ) &&( isset($_GET['action']) && !empty($_GET['action']) )) {
        $ctrl = $_GET['ctrl'];
        $action = $_GET['action'];
    }else {
        $ctrl = 'user';
        $action = 'display';
    }
    require_once('./Controller/' . $ctrl  . 'Controller.php');
    $ctrl = $ctrl . 'Controller';
    $controller = new $ctrl($db);
    $controller->$action();
?>