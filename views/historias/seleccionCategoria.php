<h2>Categoria <?= $nomCat->_cat ?></h2>
<br>
<?php while($htrs = $historias->fetch_object()): ?>
    <div class="publicacion">
        <a href="<?=base_url?>historias/ver&id=<?=$htrs->id_publicacion ?>">
            <label for="titulo" id="titulo"><strong><?=$htrs->titulo ?></strong></label>
            
            <div id="texto">
                <p>
                   <?=substr($htrs->_publicacion,0,60) ?>...
                </p> 
                <br>
                <ol>                    
                   <li>Publicado por: <strong><?= $htrs->_usuario ?></strong> | fecha <strong><?= $htrs->fecha ?></strong></li>
                </ol>                                   
            </div>
        </a>
    </div>
    <hr><br>
<?php endwhile; ?>
<!----------------------- Falta añadir una paginación -------------------->