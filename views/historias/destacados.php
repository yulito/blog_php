<h2>Historias destacadas</h2>

<?php while($stories = $historias->fetch_object()): ?>   
    <!-- Al usar fetch_object utilizamos $var->nombre_atributo_db  -->
    <div class="publicacion">
        <a href="#">
            <label for="titulo" id="titulo"><strong><?= $stories->titulo?></strong></label>
            
            <div id="texto">
                <ol>
                    <li>Categoria: <strong>Comedia</strong></li>
                    <li>Publicado por: <strong>yulito</strong> | fecha <strong>03/06/2022</strong></li>                
                </ol>
                <br>
                <p>
                   <?=$stories->_publicacion ?> 
                </p>    
            </div>
        </a>
    </div>
<?php endwhile; ?>