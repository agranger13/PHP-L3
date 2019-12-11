<?php
    $images = scandir ("Images");

    $fileGal = fopen('galerie.json', 'r');
    $albums = fread($fileGal, filesize('galerie.json'));
    fclose($fileGal);
    $albums = json_decode($albums,true);
    // echo '<pre>' , var_dump($albums) , '</pre>';
?>

<?php
    if(!empty($_POST['action'])){
         
        if($_POST['action'] == 'AddToCollect'){
            // print_r($_POST['image']);
            if(!empty($_POST['image']) && !empty($_POST['album'])){
                foreach($albums as $alb){
                    if($alb["name"] == $_POST['album']){
                        $i = array_search($alb, $albums);
                        foreach($_POST['image'] as $img){
                            array_push($albums[$i]['images'],$img);
                        }

                        $albums[$i]['modified'] = date('Y-m-d H:i:s',strtotime("now"));

                        $fileGal = fopen('galerie.json', 'w');
                        fwrite($fileGal, json_encode($albums));
                        fclose($fileGal);

                        break;
                    }
                }
            }
        }
        else if($_POST['action'] == 'RemoveFromCollect'){
            if(!empty($_POST['image']) && !empty($_POST['album'])){
                foreach($albums as $alb){
                    if($alb["name"] == $_POST['album']){
                        $i = array_search($alb, $albums);
                        foreach($_POST['image'] as $img){
                            $j = array_search($img,$albums[$i]['images']);
                            
                            if($j === 0 || $j){
                                array_splice($albums[$i]['images'],$j,1);
                            }
                        }

                        $albums[$i]['modified'] = date('Y-m-d H:i:s',strtotime("now"));

                        $fileGal = fopen('galerie.json', 'w');
                        fwrite($fileGal, json_encode($albums));
                        fclose($fileGal);

                        break;
                    }
                }
            }
        }
        else if($_POST['action'] == 'CreateCollect'){
            if(strlen($_POST['nameCollect'])>0){
                $date = date('Y-m-d H:i:s',strtotime("now"));

                $imagesCollect = (!empty($_POST['image']) ? $_POST['image'] : array());
                $new = array("name" => $_POST['nameCollect'], "images"=> $imagesCollect, "created" => $date, "modified" => $date );
                array_push($albums,$new);

                $fileGal = fopen('galerie.json', 'w');
                fwrite($fileGal, json_encode($albums));
                fclose($fileGal);
            }
        }
        else if($_POST['action'] == 'deleteCollect'){
            if(!empty($_POST['album']) && $_POST['album'] != 'all'){
                foreach($albums as $alb){
                    if($alb["name"] == $_POST['album']){

                        array_splice($albums, array_search($alb, $albums),1);

                        $fileGal = fopen('galerie.json', 'w');
                        fwrite($fileGal, json_encode($albums));
                        fclose($fileGal);

                        break;
                    }
                }
            }
        }
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Galerie </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="style.css">
        
    </head>
    <body>
        <div id="container" class="container-fluid">
            <h1 class="text-center title align-middle"> Ma galerie </h1>
            <div class="row content">

                <!-- Options -->
                <form class="col-4 bg-dark" method="post">
                    <div class="row image-list">
                        <div class="col">
                            <p class="text-light">Images</p>
                            <div class="list-group overflow-auto" id="list-img" role="tablist">
                                <?php
                                    foreach($images as $img){
                                        if($img != "." && $img != ".."){
                                            echo "<a onclick='selectImages(this)' class='list-group-item list-group-item-action'>";
                                            
                                            echo "<input type='checkbox' name='image[]' value='".$img."'>";
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
                                    echo "<a id='allCollect' onclick='selectGalerie(this)' class='list-group-item list-group-item-action'>";
                                    echo "<input id='allCollectCheckbox' type='checkbox' name='album' value='all'>";
                                    echo "Toute les images";
                                    echo "</a>";
                                    foreach($albums as $alb){
                                        echo "<a onclick='selectGalerie(this)' class='list-group-item list-group-item-action'>";
                                        echo "<input type='checkbox' name='album' value='".$alb['name']."'>";
                                        echo $alb['name'];
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
                        <input type="text" name="nameCollect" class="col-8" placeholder="Nom de votre album">
                        <button type="submit" name="action" value="CreateCollect" class="col-3 btn btn-light">Creer</button>
                    </div>

                    <div class="row justify-content-center"  id="deleteCollect">
                        <button type="submit" name="action" value="deleteCollect" class="col-5 btn btn-light">Supprimer l'album selectionné</button>
                    </div>
                </form>

                <!-- Defilement images -->
                <div id="col-carousel" class="col mt-auto mb-auto">
                    <?php
                        echo '<div id="carousel_Toutelesimages" class="carousel slide" data-ride="carousel" style="display:none;">
                        <div class="carousel-inner">';
                        foreach($images as $i=>$img){
                            if($img != "." && $img != ".."){
                                if($i == 2){
                                    echo '  <div class="carousel-item active">';
                                }else {
                                    echo '  <div class="carousel-item">';
                                }
                                echo '
                                            <img src="Images/'.$img.'" class="d-block" height="500" alt="'.$img.'">
                                        </div>';
                                    
                            }
                        }
                        echo    '</div>';
                        echo '  <a class="carousel-control-prev" href="#carousel_Toutelesimages" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel_Toutelesimages" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>';

                        foreach($albums as $alb){
                            $nameAlb = str_replace(" ","",$alb['name']);
                            echo '<div id="carousel_'.$nameAlb.'" class="carousel slide" data-ride="carousel" style="display:none;">
                                    <div class="carousel-inner">';
                            foreach($alb['images'] as $i=>$img){
                                if($i == 0){
                                    echo '  <div class="carousel-item active">';
                                }else {
                                    echo '  <div class="carousel-item">';
                                }
                                echo '
                                            <img src="Images/'.$img.'" class="d-block" height="500" alt="'.$img.'">
                                        </div>';
                                    
                            }
                            echo    '</div>';
                            echo '  <a class="carousel-control-prev" href="#carousel_'.$nameAlb.'" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel_'.$nameAlb.'" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>';
                        }                        
                    ?>
                </div>
            </div>
            <div id="infos">
            </div>
        </div>

        <script>
            window.onload = function(){
                let label = document.getElementById("allCollect");
                let checkbox = document.getElementById("allCollectCheckbox");

                selectGalerie(label);
                checkbox.checked = true;

                listI = document.querySelectorAll("#list-img a input");
                    for(var img of listI){
                        img.checked = false;
                    }
            }

            function selectImages (elem){
                if(elem.classList.contains('active')){
                    elem.classList.remove('active');
                }else{
                    elem.classList.remove('bg-secondary');
                    elem.classList.add('active');
                }
            }

            function selectGalerie (elem){
                if(!elem.classList.contains('active')){
                    elem.classList.add('active');
                    listG = document.querySelectorAll("#list-galerie a");
                    for(var g of listG){
                        if(elem != g){
                            g.childNodes[0].checked = false;
                            g.classList.remove('active');
                        }
                    }
                    linkedImg(elem);
                    showCarousel(elem);
                    informationsGalerie(elem);
                }else{
                    elem.childNodes[0].checked = true;
                }
            }

            function informationsGalerie(elem){
                var list_alb = <?php echo json_encode($albums); ?>;
                
                if(elem != document.getElementById("allCollect")){
                    for(var alb of list_alb){
                        if(alb['name'] == elem.childNodes[1].textContent){

                            divInfo = document.getElementById("infos");
                            if(divInfo.childNodes.length > 0){
                                divInfo.innerHTML = '';
                            }

                            infoCrea = document.createTextNode("Créé le : " + alb["created"]);
                            infoModif = document.createTextNode(" Modifié le : " + alb["modified"]);
                            divInfo.appendChild(infoCrea);
                            divInfo.appendChild(infoModif);
                            break;
                        }
                        
                    }
                }else {
                    divInfo = document.getElementById("infos");
                    if(divInfo.childNodes.length > 0){
                        divInfo.innerHTML = '';
                    }
                }

            }

            function showCarousel(elem){
                var list_alb = <?php echo json_encode($albums); ?>;

                nameGal = elem.textContent.replace(/ /g,"");
                carousel = document.getElementById("carousel_"+nameGal);
                carousel.style.display = "block";

                if(nameGal != "Toutelesimages"){
                    carousel = document.getElementById("carousel_Toutelesimages");
                    carousel.style.display = "none";
                }

                for(var alb of list_alb){
                    if(elem.textContent != alb.name){
                        nameGal =  alb.name.replace(/ /g,"");
                        carousel = document.getElementById("carousel_"+nameGal);
                        carousel.style.display = "none";
                    }
                }
            }

            function linkedImg(elem){
                var list_alb = <?php echo json_encode($albums); ?>;
                if(elem != document.getElementById("allCollect")){
                    for(var alb of list_alb){
                        if(alb.name == elem.childNodes[1].textContent){
                            listI = document.querySelectorAll("#list-img a");
                            for(var img of listI){
                                if(alb.images.includes(img.textContent)){
                                    img.style.opacity = "0.7";
                                }else{
                                    img.style.opacity = "1";
                                }
                            }
                        }
                    }
                }else{
                    listI = document.querySelectorAll("#list-img a");
                    for(var img of listI){
                        img.style.opacity = "1";
                    }
                }
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
    </body>
</html>
