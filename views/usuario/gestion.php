<h2>Lista de usuarios</h2>
<hr><br>

<div class="formLista">
    <table>
        <tr>
            <th>Nro</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Estado | Acción</th>
            <th>Perfil</th>
        </tr>

        <?php while($usu = $usuario->fetch_object()): ?>
            <?php if($_SESSION['usuario']->id_usuario != $usu->id_usuario): ?>
        <tr>
            <td><?=$usu->id_usuario ?></td>
            <td><?=$usu->_usuario ?></td>
            <td><?=$usu->correo ?></td>
            <td><strong><?=$usu->estado ?></strong> | <a href="<?=base_url ?>usuario/cambiarEstado&id=<?= $usu->id_usuario?>&estado=<?= $usu->estado?>">Cambiar</a></td>
            <td><a href="<?=base_url?>usuario/ver&id=<?=$usu->id_usuario ?>">Ver</a></td>
        </tr>
            <?php endif; ?>
        <?php endwhile; ?> 
    </table>
</div>
