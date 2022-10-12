<?php if(isset($_SESSION['operacion']['exito'])): ?>
    <strong class="alert_green"><?=$_SESSION['operacion']['exito']; ?></strong>
<?php elseif(isset($_SESSION['operacion']['fallo'])): ?>
    <strong class="alert_red"><?=$_SESSION['operacion']['fallo']; ?></strong>
<?php elseif(isset($_SESSION['operacion']['guardar'])): ?>
    <strong class="alert_green"><?=$_SESSION['operacion']['guardar']; ?></strong>
<?php elseif(isset($_SESSION['operacion']['error'])): ?>
    <strong class="alert_red"><?=$_SESSION['operacion']['error']; ?></strong>
<?php endif; ?>
<?php Utils::deleteSession('operacion'); ?>


<h2>Estas en gestion de categorias</h2>
<hr>
<div class="bloque agregarCat">
    <form action="<?=base_url ?>categoria/agregarCat" method="POST">
        <input type="text" name="cat" id="cat" placeholder="Agregar categoria...">
        <input type="submit" value="Guardar">
    </form>
</div>
<hr><br>
<div class="bloque tableCat">
    <table>
        <p class="alert_red">
            *** Recuerda que si eliminas una categoria, también se eliminarán todas las historias pertenecientes
            a dicha categoria. ***
        </p>
        <br>
        <tr>
            <th>Categorias</th>
            <th>Eliminar</th>
        </tr>  
        <?php $categorias = Utils::showCategories(); ?>      
        <?php while($cat = $categorias->fetch_object()): ?>
        <tr>
            <td><?=$cat->_cat ?></td>
            <td><a href="<?=base_url ?>categoria/eliminarCat&id=<?= $cat->id_cat?>"><img class="basura" src="<?=base_url ?>assets/image/basurero.png" alt="Eliminar"></a></td>
        </tr>
        <?php endwhile; ?>        
    </table>
</div>