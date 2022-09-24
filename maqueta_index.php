<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Jullián Amigo">
    <meta name="description" content="Esta es una web destinada a compartir historias de los usuarios con temática variada, desde historias de vida a historias fantasticas, todo esto, con el fin de pasar un rato ameno a través de la lectura.">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuéntanos tu Historia</title>
    <link rel="shortcut icon" href="CTH.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>    
    <!--------------------------------------------------------------->
    <header class="header">

        <div class="portada header-item">
            <h1> Cuéntanos tu historia... </h1>
            <img id="logo" src="assets/image/jo.png" alt="logo" target="logo">
        </div>                
        <nav class="menu header-item">
            <ul class="menu-item">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Acerca de</a></li>
                <li><a href="#">Registrate</a></li>
                <li>
                    <select class="categoria" id="categoria">
                        <option selected disabled>Categoria</option>
                        <option><a href="#">Drama</a></option>
                        <option><a href="#">Poliamor</a></option>
                    </select>
                </li>
            </ul>
            <div class="menu-item seleccion">                
                <select class="perfil" id="perfil">
                    <option selected disabled>Perfil</option>
                    <option><a href="#">Editar</a></option>
                    <option><a href="#">Salir</a></option>
                </select>
            </div>
        </nav>

    </header>
    <!--------------------------------------------------------------->
    <main class="main">

        <h2>Historias destacadas</h2>
        <!------------------------------------------------------------------->
        
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

        <!------------------------------------------------------------------->

    </main>
    <!--------------------------------------------------------------->
    <section class="section">

        <div class="login">
            <h2>Ingresar</h2>
            <br>
            <div class="formulario">
                <form action="#" method="post">
                    <input type="text" name="correo" id="correo" placeholder="Correo">
                    <input type="password" name="password" id="password" placeholder="Password">
                    <input id="btn-login" type="submit" value="Enviar">
                </form>
            </div>
        </div>

    </section>
    <!--------------------------------------------------------------->
    <footer class="footer">
        <h4>Desarrollado por Jullián Amigo &copy; 2022</h4>
    </footer>

</body>
<!------------------- JS ------------------------->
<script src="assets/js/main.js"></script>
<!------------------ APIs ------------------------>

<!---------------- BOOTSTRAP --------------------->

</html>