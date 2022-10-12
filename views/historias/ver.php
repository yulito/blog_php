<?php if(isset($_SESSION['error']['delete'])): ?>
    <strong class="alert_red"><?=$_SESSION['error']['delete']; ?></strong>
<?php endif; ?>
<?php Utils::deleteSession('error'); ?>

<?php if(isset($htr)): ?>
   
        <label for="titulo" id="titulo"><strong><?=$htr->titulo ?></strong></label>
        
        <div id="texto">                
            <p>
                <?=$htr->_publicacion ?> 
            </p> 
            <br>
            <ol>
                <li>Categoria: <a href="<?=base_url?>historias/porCategoria&id=<?=$htr->id_cat ?>"><?= $htr->_cat ?></a></li>
                <li>Publicado por: <a href="<?=base_url?>usuario/ver&id=<?=$htr->id_usuario ?>"><?= $htr->_usuario ?></a> | fecha <strong><?= $htr->fecha ?></strong></li>                
            </ol>
            <br>   
        </div>
        <br><hr>
        <?php if(isset($_SESSION['usuario'])): ?>

            <?php if($_SESSION['usuario']->id_usuario == $htr->id_usuario || isset($_SESSION['admin'])): ?>
                <label for="">Estado: <strong><?= $htr->estado_p?></strong></label>
                <div>
                    <a href="<?=base_url ?>historias/cambiarEstado&id=<?= $htr->id_publicacion?>&estado=<?= $htr->estado_p?>">Cambiar Estado</a>
                </div>
                <label for="">Eliminar Historia: </label>
                <div>
                    <a href="<?=base_url ?>historias/eliminarHistoria&id=<?= $htr->id_publicacion?>">Eliminar</a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    
<?php else: ?>
    <h1>La historia que busca no existe :( penita u.u</h1>
<?php endif; ?>