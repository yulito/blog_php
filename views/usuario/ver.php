<h2>perfil de <?=$datos->_usuario ?></h2>
<hr><br>

<?php if($datos->foto_perfil != null): ?>
    <img src="<?=base_url?>media/images/<?= $datos->foto_perfil?>" alt="foto-perfil" id="img">
<?php else :?>
    <img src="<?=base_url?>assets/image/silueta.png" alt="foto-perfil" id="img">
<?php endif; ?>
<br>
<ul>
    <li><strong>Descripción: </strong>
        <p>
            <?= $datos->descripcion?>
        </p>
    </li>
    <li><strong>Sexo: </strong><?= $datos->sexo?></li>
    <li><strong>Edad: </strong><?= $datos->edad?></li>    
    <?php if(isset($_SESSION['admin'])):?>
    <li><strong>Estado: </strong><span class="alterna"><?= $datos->estado?></span></li> 
    <?php endif; ?>
</ul>
<br><hr><br>
<h2>Publicaciones</h2>
<br>

<div class="listaHistorias">
    <table>
        <tr>
            <th>Titulo</th>
            <th>Fecha</th>
            <th>Categoria</th>
            <th>Acción</th>
        </tr>
        <?php while($h = $htr->fetch_object()): ?>
        <tr>
            <td><?=$h->titulo ?></td>
            <td><?=$h->fecha?></td>
            <td><?=$h->_cat ?></td>
            <td><a href="<?=base_url?>historias/ver&id=<?=$h->id_publicacion ?>">Ver</a></td>
        </tr>
        <?php endwhile; ?>
    </table>    
</div>
