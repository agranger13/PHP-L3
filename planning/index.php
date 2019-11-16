<html>

<?php
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $db = $manager->planning;

    // $planningCollection = $db->affectation;
    // var_dump($planningCollection);
    // echo "Collection 'affectation' created succsessfully";

    $annee = "2018";
    
    if(!empty($_POST['action'])){
        if($_POST['action']=="Changer" && !empty($_POST['annee'])){
            $annee = $_POST['annee'];
        }

        $query = new MongoDB\Driver\Query(['annee'=>$annee]);
        $affectation = $manager->executeQuery('planning.affectation',$query);
        $affectation = $affectation->toArray();

        if($_POST['action'] == 'valider'){

            foreach($affectation as $i=>$affect){
    
                $query = new MongoDB\Driver\Query(["userId"=>$affect->userId]);
                $actifUser = $manager->executeQuery('planning.users',$query);
                $actifUser = $actifUser->toArray();
    
                if($_POST['affect'.$i] != $actifUser[0]->userId){
                    $bulk = new MongoDB\Driver\BulkWrite;
                    $bulk->update(
                        ['date' => $affect->date],
                        ['$set' => ['userId' => (int)$_POST['affect'.$i]]],
                        ['multi' => false, 'upsert' => false]
                    );
                    $result = $manager->executeBulkWrite('planning.affectation', $bulk);
                }
            }

            $query = new MongoDB\Driver\Query(['annee'=>$annee]);
            $affectation = $manager->executeQuery('planning.affectation',$query);
            $affectation = $affectation->toArray();
        }
    } else{
        $query = new MongoDB\Driver\Query(['annee'=>$annee]);
        $affectation = $manager->executeQuery('planning.affectation',$query);
        $affectation = $affectation->toArray();
    }

    $query = new MongoDB\Driver\Query([]);
    $users = $manager->executeQuery('planning.users',$query);
    $users = $users->toArray();
?>

    <head>
        <meta charset="UTF-8">
        <title> Planning </title>
    </head>
    <body>
        <h1> Planning </h1>
        <form action='' method="post">
            <label>Année : </label>
            <select name="annee" autocomplete='off'>
                <option value="2018" <?php 
                    if(!empty($_POST['annee']) && $_POST['annee']=="2018"){ 
                        echo "selected='select'" ;
                    } ?>>2018</option>
                <option value="2019" <?php 
                    if(!empty($_POST['annee']) && $_POST['annee']=="2019"){ 
                        echo "selected='select'" ;
                    } ?> >2019</option>
                <option value="2020" <?php 
                    if(!empty($_POST['annee']) && $_POST['annee']=="2020"){ 
                        echo "selected='select'" ;
                    } ?>>2020</option>
            </select>

            <button type="submit" value="Changer" name="action"> Changer l'année </button>

            <table border="1">
                <?php
                
                    foreach($affectation as $i=>$affect){
                        
                        if($i%4 == 0){
                            echo "<tr>";
                        }

                        echo "<td>".$affect->date;
                        echo "<select  autocomplete='off' name='affect".$i."'>";

                        $query = new MongoDB\Driver\Query(["userId"=>$affect->userId]);
                        $actifUser = $manager->executeQuery('planning.users',$query);
                        $actifUser = $actifUser->toArray();
                     
                        foreach($users as $user){
                            if($actifUser[0]->userId != $user->userId){
                                echo "<option value=".$user->userId." >".$user->name."</option>";
                            }else {
                                echo "<option value=".$actifUser[0]->userId." selected='select'>".$actifUser[0]->name."</option>";
                            }                  
                        }

                        echo "</select>";
                        echo "</td>";
                        

                        if($i%4 == 3){
                            echo "</tr>";
                        }
                    }
                ?>
            </table>
            <button type="submit" value="valider" name="action"> Valider le planning </button>
        </form>
    </body>

</html>
