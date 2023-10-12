<div id="form-publicar">
    <table class="table">
        <tr>
            <th>Id</th>
            <th>Autor</th>
            <th>Titulo</th>
            <th>Data</th>
            <th>Gerenciar</th>
        </tr>

        <?php
        $query = $con->prepare("SELECT * FROM posts ORDER BY id DESC");
        $query->execute();
        $get = $query->get_result();
        $total = $get->num_rows;
        if ($total > 0) {
            while ($dados = $get->fetch_array()) {
        ?>
                <tr>
                    <td><?php echo $dados['id']; ?></td>
                    <td><?php echo $dados['id_autor']; ?></td>
                    <td><?php echo $dados['titulo']; ?></td>
                    <td class="small"><?php echo $dados['data']; ?></td>
                    <td>
                        <button type="button" class="btn btn-sm"><a href="p/<?php echo $dados['id']; ?>">Ver Publicação</a></button>
                        <button type="button" class="btn btn-sm"><a href="editar-post/<?php echo $dados['id']; ?>">Editar Publicação</a></button>
                        <button type="button" class="btn btn-sm"><a href="deletar-post/<?php echo $dados['id']; ?>">Deletar Publicação</a></button>
                    </td>
                </tr>
        <?php }
        } ?>

    </table>
</div>