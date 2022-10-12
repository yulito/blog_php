<h2>Mis historias</h2>
<hr><br>

<div class="listaHistorias">
    <table>
        <tr>
            <th>Titulo</th>
            <th>Fecha</th>
            <th>Acción</th>
        </tr>
        <?php while($htr = $historia->fetch_object()): ?>
        <tr>
            <td><?=$htr->titulo ?></td>
            <td><?=$htr->fecha ?></td>
            <td><a href="<?=base_url?>historias/ver&id=<?=$htr->id_publicacion ?>">Ver</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>