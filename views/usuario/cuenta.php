<!-------------------------------------------------------------------------------------->
<?php if(isset($_SESSION['error']['insertar'])): ?>
    <strong class="alert_red"><?=$_SESSION['error']['insertar']; ?></strong>
<?php elseif(isset($_SESSION['error']['campos']) ): ?>
    <strong class="alert_red"><?=$_SESSION['error']['campos']; ?></strong>
<?php elseif(isset($_SESSION['error']['tipo']) ): ?>
    <strong class="alert_red"><?=$_SESSION['error']['tipo']; ?></strong>
<?php elseif(isset($_SESSION['ejecucion']['guardar']) ): ?>
    <strong class="alert_green"><?=$_SESSION['ejecucion']['guardar']; ?></strong>
<?php endif; ?>
<?php Utils::deleteSession('ejecucion'); ?>
<?php Utils::deleteSession('error'); ?>
<!-------------------------------------------------------------------------------------->

<h2>Este es el perfil de <span class="usuarioTitulo"><?=$_SESSION['usuario']->_usuario; ?></span></h2>
<?php
    $perfil = Utils::mostrarUsuario($_SESSION['usuario']->id_usuario);
    $idUsuario = $perfil->id_usuario;
    $foto = $perfil->foto_perfil;
    $nombre = $perfil->_usuario;
    $descripcion = $perfil->descripcion;
    $edad = $perfil->edad;

?>

<?php if($foto != null): ?>
    <img src="<?=base_url?>media/images/<?= $foto?>" alt="foto-perfil" id="img">
<?php else :?>
    <img src="<?=base_url?>assets/image/silueta.png" alt="foto-perfil" id="img">
<?php endif; ?>


<div class="formEdit">
    <form action="<?=base_url?>usuario/editar" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $_SESSION['usuario']->id_usuario;?>">
        
        <div class="formItemEdit">
            <span class="item-titulo">Nombre:</span> 
            <input type="text" name="usuario" id="" value="<?= isset($nombre) ? $nombre : '' ?>">
        </div>
        <div class="formItemEdit">
            <span class="item-titulo">Descripción:</span> 
            <textarea name="descripcion" id="" cols="30" rows="10"><?= isset($descripcion) ? $descripcion : '' ?></textarea>
        </div>
        <div class="formItemEdit">
            <span class="item-titulo">Edad:</span> 
            <input type="text" name="edad" id="" value="<?=isset($edad) ? $edad : '' ?>">
        </div>

        <div class="formItemEdit foto">
            <span class="item-titulo">Foto perfil:</span>
            <input type="file" name="foto">
        </div>
        <input type="submit" value="Enviar">
    </form>
    <hr><br>
    <label for="">Eliminar Cuenta: </label>
        <div>
            <a href="<?=base_url ?>usuario/eliminarUsuario&id=<?= $idUsuario?>">Eliminar</a>
        </div>
</div>