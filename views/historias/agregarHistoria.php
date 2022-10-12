<?php if(isset($_SESSION['error']['campo'])) :?>
    <strong class="alert_red"><?=$_SESSION['error']['campo'] ?></strong>
<?php elseif(isset($_SESSION['error']['insertar'])) :?>
    <strong class="alert_red"><?=$_SESSION['error']['insertar'] ?></strong>
<?php elseif(isset($_SESSION['ejecucion']['guardar']) ): ?>
    <strong class="alert_green"><?=$_SESSION['ejecucion']['guardar']; ?></strong>
<?php endif; ?>
<?php Utils::deleteSession('ejecucion'); ?>
<?php Utils::deleteSession('error'); ?>

<h1>Nueva historia</h1>
<div class="form-registro">
    <form id="registroForm" action="<?=base_url?>historias/guardar" method="post">

        <div class="item-registro" id="nombre-reg">        
            <label for="titulo">Titulo <span>*</span></label>  
            <input type="text" name="titulo" id="idtitulo">
        </div>
        <div class="item-registro area">
            <label for="historia">Cuentanos tu historia... <span>*</span></label>
            <textarea name="historia" id="historia" style="padding:20px"></textarea>
        </div>

        <select class="categoria" id="categoria" name='categoria'>
        <option selected disabled>Categoria *</option>
        <?php $categorias = Utils::showCategories(); ?>                        
        <?php while($cat = $categorias->fetch_object()): ?>
            <option value="<?=$cat->id_cat?>"><?=$cat->_cat ?></option>
        <?php endwhile; ?> 
        </select>
        <div class="item-registro">
            <label for="Activar">Activar publicación</label>            
            <input type="radio" name="estado" id="estado" value="Activado">
        </div>
        <input type="submit" class="btn" value="Guardar">
    </form>
</div>