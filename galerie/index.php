<?php
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $images = scandir ("Images");

    $query = new MongoDB\Driver\Query([]);
    $albums = $manager->executeQuery('galerie.albums',$query);
    $albums = $albums->toArray();

?>


<head>
        <meta charset="UTF-8">
        <title> Galerie </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid">
            <h1 class="text-center"> Ma galerie </h1>
            <div class="row h-75">

                <!-- Options -->
                <form class="col-4 bg-dark" method="post">
                    <div class="row">
                        <div class="col">
                            <p class="text-light">Images</p>
                            <div class="list-group overflow-auto">
                                <?php
                                    foreach($images as $img){
                                        if($img != "." && $img != "..")
                                            echo "<button class='list-group-item list-group-item-action' type='sumbit' name='image' value='".$img."'>".$img."</button>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col">
                            <p class="text-light">Albums</p>
                            <ul class="list-group overflow-auto">
                                <?php
                                     echo "<button class='list-group-item list-group-item-action' type='sumbit' name='album' value='all'>Toute les images</button>";
                                    foreach($albums as $alb){
                                        echo "<button class='list-group-item list-group-item-action' type='sumbit' name='album' value='".$alb."'>".$alb."</button>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </form>

                <!-- Defilement images -->
                <div class="col bg-light">
                
                </div>
            </div>
        </div>
    </body>
</html>