<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Jullián Amigo">
    <meta name="description" content="Esta es una web destinada a compartir historias de los usuarios con temática variada, desde historias de vida a historias fantasticas, todo esto, con el fin de pasar un rato ameno a través de la lectura.">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuéntanos tu Historia</title>
    <link rel="shortcut icon" href="<?=base_url?>CTH.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?=base_url?>assets/css/style.css">
</head>
<body>    
    <!--------------------------------------------------------------->
    <header class="header">

        <div class="portada header-item">
            <h1> Cuéntanos tu historia... </h1>
            <img id="logo" src="<?=base_url?>assets/image/jo.png" alt="logo" target="logo">
        </div>                
        <nav class="menu header-item">
            <ul class="menu-item">
                <li><a href="<?=base_url?>index.php">Inicio</a></li>
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