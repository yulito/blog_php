<?php
    session_start();
    require_once "views/layout/header.php";
?>
<!--- Luego sacamos el main de aca y lo ponemos en destacados.php, en su lugar iran los controladores principales--->
<h2>Historias destacadas</h2>

    <div class="publicacion">
        <a href="#">
            <label for="titulo" id="titulo"><strong>Titulo</strong></label>
            
            <div id="texto">
                <ol>
                    <li>Categoria: <strong>Comedia</strong></li>
                    <li>Publicado por: <strong>yulito</strong> | fecha <strong>03/06/2022</strong></li>                
                </ol>
                <br>
                <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt aliquid eaque 
                    possimus, inventore recusandae non tenetur odit assumenda, excepturi amet, magni 
                    culpa! Perspiciatis tempora dignissimos magni nesciunt, suscipit amet sequi!...
                </p>    
            </div>
        </a>
    </div>

<?php
    require_once "views/layout/section.php";
    require_once "views/layout/footer.php";
?>