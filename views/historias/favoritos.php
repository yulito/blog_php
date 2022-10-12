<h2>Estas en favoritos</h2>
<hr><br>
<div class="listaHistorias">
    <table>
        <tr>
            <th>Titulo</th>
            <th>Autor</th>
            <th>Acción</th>
        </tr>
        <?php if(isset($likes)): ?>
            
            <?php while($like = $likes->fetch_object()): ?>
                <tr>
                    <td><?=$like->titulo ?></td>
                    <td><?=$like->autor ?></td>
                    <td><a href="<?=base_url?>historias/ver&id=<?=$like->id ?>">Ver</a></td>
                    <!-- descargar pdf --->
                </tr>
            <?php endwhile; ?>
        <?php endif; ?>     
    </table>
</div>