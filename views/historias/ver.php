
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
        <!------------------------------- para el like ----------------------------------------->
        <?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']->id_usuario != $htr->id_usuario): ?>
            <?php  $like = Utils::favorito($_SESSION['usuario']->id_usuario, $htr->id_publicacion); 
                    $gusta = $like->fetch_object();
            ?>
            <label for=""><strong>Favorito:</strong> <span class="alterna"><?= isset($gusta->id_like) ? 'Guardado' : '--'?></span></label>
            <div>
                <?php if(!isset($gusta->id_like)): ?>
                    <a href="<?=base_url ?>historias/likes&id=<?= $htr->id_publicacion?>&usuario=<?= $_SESSION['usuario']->id_usuario?>"> Like </a>
                <?php else: ?>
                    <a href="<?=base_url ?>historias/dislike&id=<?= $gusta->id_like?>"> Quitar </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <!-------------------------------------------------------------------------------------->
        <br>
        <?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']->id_usuario == $htr->id_usuario || isset($_SESSION['admin'])): ?>

            <label for=""><strong>Estado:</strong> <span class="alterna"><?= $htr->estado_p?></span></label>
            <div>
                <a href="<?=base_url ?>historias/cambiarEstado&id=<?= $htr->id_publicacion?>&estado=<?= $htr->estado_p?>">Cambiar Estado</a>
            </div>
            <label for=""><strong>Eliminar Historia:</strong> </label>
            <div>
                <a href="<?=base_url ?>historias/eliminarHistoria&id=<?= $htr->id_publicacion?>">Eliminar</a>
            </div>
        <?php endif; ?>
    
<?php else: ?>
    <h1>La historia que busca no existe :( penita u.u</h1>
<?php endif; ?>