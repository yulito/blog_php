<?php if(isset($_SESSION['error']['campos'])):?>
    <strong class="alert_red"><?=$_SESSION['error']['campos']; ?></strong>
<?php elseif(isset($_SESSION['error']['password'])):?>
    <strong class="alert_red"><?=$_SESSION['error']['password']; ?></strong>
<?php elseif(isset($_SESSION['error']['comparacion'])):?>
    <strong class="alert_red"><?=$_SESSION['error']['comparacion']; ?></strong>
<?php elseif(isset($_SESSION['actualizacion']['correcta'])):?>
    <strong class="alert_green"><?=$_SESSION['actualizacion']['correcta']; ?></strong>
<?php elseif(isset($_SESSION['actualizacion']['incorrecta'])):?>
    <strong class="alert_green"><?=$_SESSION['actualizacion']['incorrecta']; ?></strong>
<?php endif;?>

<h2>Cambiar Password</h2>

<div class="form-registro">
    <form id="registroForm" action="<?=base_url?>usuario/cambioRegistro" method="post">
        <label for="clave1">Password Nuevo</label>
        <input type="password" name="passwordNew" id="passwordNew" maxlength="8" placeholder="Min 5, max 8 caracteres">
        <br>
        <label for="clave1">Repite password nuevo para confirmar</label>
        <input type="password" name="passwordNew2" id="passwordNew" maxlength="8">
        <br>
        <input type="submit" id="btnPass" value="Guardar">
    </form>
<?php if(isset($_SESSION['actualizacion']['correcta'])):?>
    <div class="item-registro">
        <p class="nota">
            Cuando Vuelvas a iniciar sesión, deberas ingresar con tu nuevo password.
        </p>
    </div>
<?php endif; ?>
</div>

<?php Utils::deleteSession('error'); ?>
<?php Utils::deleteSession('actualizacion'); ?>