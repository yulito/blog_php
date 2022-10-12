<?php Utils::deleteSession('error_login'); ?>
<h2>Formulario de registro</h2>
<hr><br> 
<?php if(isset($_SESSION['error']['insertar'])): ?>
    <strong class="alert_red"><?=$_SESSION['error']['insertar']; ?></strong>
<?php elseif(isset($_SESSION['error']['registro']) ): ?>
    <strong class="alert_red"><?=$_SESSION['error']['registro']; ?></strong>
<?php elseif(isset($_SESSION['ejecucion']['guardar']) ): ?>
    <strong class="alert_green"><?=$_SESSION['ejecucion']['guardar']; ?></strong>
<?php endif; ?>
<?php Utils::deleteSession('ejecucion'); ?>

<div class="form-registro">
    <form id="registroForm" action="<?=base_url?>usuario/guardar" method="post" enctype="multipart/form-data">
      <div class="item-registro" id="nombre-reg">        
        <label for="usuario">Nombre u alias <span>*</span></label>  
        <input type="text" name="usuario" id="usuario">
      </div>
      <div class="item-registro area">
        <label for="descripcion">Has una descripción tuya de manera breve</label>
        <textarea name="descripcion" id="descripcion" style="padding:20px"></textarea>
      </div>
      <div class="item-registro">
        <?php if(isset($_SESSION['error']['edad'])) :?>
            <strong class="alert_red"><?=$_SESSION['error']['edad'] ?></strong>
        <?php endif; ?>        
        <label for="edad">Edad (mayor de 8 años)<span>*</span></label>
        <div class="aparte">
            <input type="number" name="edad" id="edad">
            <?php if(isset($_SESSION['error']['sexo'])) :?>
                <strong class="alert_red"><?=$_SESSION['error']['sexo'] ?></strong>
            <?php endif; ?>
            <select name="sexo" id="sexo">
                <option selected disabled>Selecciona Sexo <span>*</span></option>
                <option value=1>Masculino</option>
                <option value=2>Femenino</option>
                <option value=3>Otro</option>
            </select>
        </div>
      </div>      
      <div class="item-registro">
        <?php if(isset($_SESSION['error']['correo'])) :?>
            <strong class="alert_red"><?=$_SESSION['error']['correo'] ?></strong>
        <?php endif; ?>
        <label for="correo">Correo <span>*</span></label>
        <input type="text" name="correo" id="correo">
      </div>
      <div class="item-registro">
        <?php if(isset($_SESSION['error']['password'])) :?>
            <strong class="alert_red"><?=$_SESSION['error']['password'] ?></strong>
        <?php endif; ?>
        <label for="password">Password <span>*</span></label>
        <input type="password" name="password" id="password" placeholder="Máximo 8 caracteres alfanumericos..." maxlength="8">
      </div>
      <div class="item-registro aparte">
        <label for="foto">Foto de perfil</label>
        <input type="file" name="foto" id="foto">
      </div>
        <input type="submit" class="btn" value="Guardar">
    </form>
</div>
<?php Utils::deleteSession('error'); ?>
