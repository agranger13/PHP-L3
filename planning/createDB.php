<?php
// Initialise la base de donnée MongoDB avec les différentes dates
try{
    // Connexion à MongoDB
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    var_dump($manager);
        
    $annees = array('2018','2019','2020');

    foreach($annees as &$annee){
        $date =  date("Y-m-d", strtotime("mon jan".$annee));
        // echo $date;
        // echo "<br>";

        $document_date = array("date"=>date('d/m/Y',strtotime($date)),
        "annee"=>date('Y',strtotime($date)),
        "userId"=>1);

        $single_insert = new MongoDB\Driver\BulkWrite();
        $single_insert->insert($document_date);
        var_dump($single_insert);

        $manager->executeBulkWrite('planning.affectation', $single_insert) ;
        echo "Création d un objet users OK";
        
        while(date("Y", strtotime($date.' Monday next week')) == $annee){
            $date = date('Y-m-d',strtotime( $date.' Monday next week'));
            // echo $date;
            // echo "<br>";
            $document_date = array("date"=>date('d/m/Y',strtotime($date)),
                                    "annee"=>date('Y',strtotime($date)),
                                    "userId"=>1);

            $single_insert = new MongoDB\Driver\BulkWrite();
            $single_insert->insert($document_date);
            var_dump($single_insert);

            $manager->executeBulkWrite('planning.affectation', $single_insert) ;
            echo "Création d un objet users OK";
        }
    }

    $users = array(array("name"=>"Jean","userId"=>1),
    array("name"=>"Michel","userId"=>2),
    array("name"=>"Patrick","userId"=>3));

    foreach($users as &$user){
        $single_insert = new MongoDB\Driver\BulkWrite();
        $single_insert->insert($user);
        var_dump($single_insert);

        $manager->executeBulkWrite('planning.users', $single_insert) ;
    }

}catch (MongoDB\Driver\Exception\InvalidArgumentException $e )
{
    echo $e->getMessage();
}
?>
