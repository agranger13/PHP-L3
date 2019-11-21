<?php
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $images = scandir ("Images");

    $query = new MongoDB\Driver\Query([]);
    $albums = $manager->executeQuery('galerie.albums',$query);
    $albums = $albums->toArray();

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title> Galerie </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="style.css">
        
    </head>
    <body>
        <div class="container-fluid">
            <h1 class="text-center"> Ma galerie </h1>
            <div class="row">

                <!-- Options -->
                <form class="col-4 bg-dark" method="post">
                    <div class="row image-list">
                        <div class="col">
                            <p class="text-light">Images</p>
                            <div class="list-group overflow-auto" id="list-img" role="tablist">
                                <?php
                                    foreach($images as $img){
                                        if($img != "." && $img != ".."){
                                            echo "<a href='#' onclick='selectImages(this)' class='list-group-item list-group-item-action'>";
                                            
                                            echo "<input type='checkbox' name='image[]' value='".$img."'> ";
                                            echo $img;

                                            echo "</a>";
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col">
                            <p class="text-light">Albums</p>
                            <ul class="list-group overflow-auto" id="list-galerie" role="tablist">
                                <?php
                                    echo "<a href='#' onclick='selectGalerie(this)' class='list-group-item list-group-item-action'>";
                                    echo "<input type='checkbox' name='album' value='all'>";
                                    echo "Toute les images";
                                    echo "</a>";
                                    foreach($albums as $alb){
                                        echo "<a href='#' onclick='selectGalerie(this)' class='list-group-item list-group-item-action'>";
                                        echo "<input type='checkbox' name='album' value='".$alb."'>";
                                        echo $alb;
                                        echo "</a>";
                                    }
                                    
                                    
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="row justify-content-center" id="modifyCollect">
                        <button type="submit" name="action" value="AddToCollect" class="col-3 btn btn-light">Ajouter</button>
                        <button type="submit" name="action" value="RemoveFromCollect" class="col-3 btn btn-light">Retirer</button>
                    </div>

                    <div class="row justify-content-center"  id="createCollect">
                        <input type="text" name="nameCollect" class="col-8" placeholder="Nom de la Collection">
                        <button type="submit" name="action" value="CreateCollect" class="col-3 btn btn-light">Creer</button>
                    </div>
                </form>

                <!-- Defilement images -->
                <div class="col bg-light">
                
                </div>
            </div>
        </div>

        <script>
            function selectImages (elem){
                if(elem.classList.contains('active')){
                    elem.classList.remove('active');
                }else{
                    elem.classList.add('active');
                }
            }

            function selectGalerie (elem){
                if(!elem.classList.contains('active')){
                    elem.classList.add('active');
                    listG = document.querySelectorAll("#list-galerie a");
                    for(var g of listG){
                        console.log(g);
                        if(elem != g){
                            g.childNodes[0].checked = false;
                            g.classList.remove('active');
                        }
                            
                    }
                }else{
                    elem.childNodes[0].checked = true;
                }
            }
        </script>
    </body>
</html>