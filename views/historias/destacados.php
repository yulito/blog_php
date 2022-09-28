<h2>Historias destacadas</h2>
<br>
<?php while($htrs = $historias->fetch_object()): ?>   
    <!-- Al usar fetch_object utilizamos $var->nombre_atributo_db  -->
    <div class="publicacion">
        <a href="<?=base_url?>historias/ver&id=<?=$htrs->id_publicacion ?>">
            <label for="titulo" id="titulo"><strong><?=$htrs->titulo ?></strong></label>
            
            <div id="texto">
                <p>
                   <?=substr($htrs->_publicacion,0,60) ?>...
                </p> 
                <br>
                <ol>
                    <li>Categoria: <strong><?= $htrs->_cat ?></strong></li>
                    <li>Publicado por: <strong><?= $htrs->_usuario ?></strong> | fecha <strong><?= $htrs->fecha ?></strong></li>                
                </ol>
                <br>
                   
            </div>
        </a>
    </div>
    <hr><br>
<?php endwhile; ?>