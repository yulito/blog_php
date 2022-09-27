<?php if(isset($htr)): ?>
   
        <label for="titulo" id="titulo"><strong><?=$htr->titulo ?></strong></label>
        
        <div id="texto">                
            <p>
                <?=$htr->_publicacion ?> 
            </p> 
            <br>
            <ol>
                <li>Categoria: <strong><?= $htr->_cat ?></strong></li>
                <li>Publicado por: <strong><?= $htr->_usuario ?></strong> | fecha <strong><?= $htr->fecha ?></strong></li>                
            </ol>
            <br>   
        </div>

    
<?php else: ?>
    <h1>La historia que busca no existe :( penita u.u</h1>
<?php endif; ?>