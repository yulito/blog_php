
</main>
<!--------------------------------------------------------------->
<section class="section">

<div class="login">
<?php if(isset($_SESSION['error_login']['campos'])): ?>
    <div>
        <strong class="alert_red"><?=$_SESSION['error_login']['campos'] ?></strong>
    </div>
<?php elseif(isset($_SESSION['error_login']['identificacion'])): ?>
    <div>
        <strong class="alert_red"><?=$_SESSION['error_login']['identificacion'] ?></strong>
    </div>
<?php endif; ?>

<?php if(!isset($_SESSION['usuario'])): ?>

    <h2>Ingresar</h2>
    <br>
    <div class="formulario">
        <form action="<?=base_url?>usuario/login" method="post">
        <!------ recuerda poner mas adelante el token csrf ----->
            <input type="text" name="correo" id="correo" placeholder="Correo">
            <input type="password" name="password" id="password" placeholder="Password" maxlength="8">
            <input id="btn-login" type="submit" value="Enviar">
        </form>
        <br>
        <!--<a href="#">recuperar contraseña</a>-->
    </div>

<?php endif; ?>

    <ul>
        <?php if(isset($_SESSION['admin'])): ?>
            <h2>Panel administrador</h2>
            <hr><br>
            <li><a href="<?=base_url?>categoria/index">Gestionar categorias</a></li> <!--input para agregar y panel que lista las cat -->
            <li><a href="<?=base_url?>usuario/gestion">Gestionar Usuarios</a></li> <!-- activa o desactiva usuario-->
             <!--<li><a href="#">Gestionar Historias</a></li> activa o desactiva historia -->
             <!-- <li><a href="#">Mensaje de inicio</a></li> poner o quitar mensaje de inicio de pagina -->
            <br>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['usuario'])): ?>
            <h2>Menú actividad</h2>
            <hr><br>
            <li><a href="<?=base_url?>historias/agregar">Nueva Historia</a></li>
            <li><a href="<?=base_url?>historias/misHistorias">Mis historias</a></li>
            <li><a href="<?=base_url?>historias/favoritos">Favoritos</a></li>
            <!-- <li><a href="#">Usuarios agregados</a></li> -->
        <?php endif; ?> 
    </ul>
</div>
</section>