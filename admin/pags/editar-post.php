<?php
$idPost = addslashes($explode['1']);
$query = $con->prepare("SELECT * FROM posts WHERE id = ?");
$query->bind_param("s", $idPost);
$query->execute();
$get = $query->get_result();
$dados = $get->fetch_assoc();
?>

<form method="POST" enctype="multipart/form-data" id="form-publicar">
    <label>Titulo</label>
    <input type="text" name="titulo" class="form-control" value="<?php echo $dados['titulo']; ?>"><br>

    <label>Autor</label>
    <input type="text" name="autor" class="form-control" value="<?php echo $dados['id_autor']; ?>"><br>

    <label>Tema</label>
    <input type="text" name="tema" class="form-control" value="<?php echo $dados['tema']; ?>"><br>

    <label>Subtema</label>
    <input type="text" name="subtema" class="form-control" value="<?php echo $dados['subtema']; ?>"><br>

    <label>Descrição</label>
    <textarea class="form-control" name="descricao" rows="5"><?php echo $dados['descricao']; ?></textarea><br>

    <label>Publicação</label>
    <textarea class="form-control" name="conteudo" rows="5"><?php echo $dados['conteudo']; ?></textarea><br>

    <label>Fontes</label>
    <textarea class="form-control" name="fontes" rows="5"><?php echo $dados['fontes']; ?></textarea><br>

    <input type="submit" value="Alterar Publicação" class="btn btn-outline-primary btn-lg btn-block">
    <input type="hidden" name="env" value="post">
</form>

<?php
if (isset($_POST['env']) && $_POST['env'] == "post") {
    if ($_POST['titulo'] && $_POST['conteudo']) {
        $titulo = $_POST['titulo'];
        $id_autor = $_POST['autor'];
        $tema = $_POST['tema'];
        $subtema = $_POST['subtema'];
        $descricao = $_POST['descricao'];
        $conteudo = $_POST['conteudo'];
        $fontes = $_POST['fontes'];

        $sql = $con->prepare("UPDATE posts SET titulo = ?, id_autor = ?, tema = ?, subtema = ?, descricao = ?, conteudo = ?, fontes = ? WHERE id = ?");
        $sql->bind_param("ssssssss", $titulo, $id_autor, $tema, $subtema, $descricao, $conteudo, $fontes, $idPost);
        $sql->execute();

        if ($sql->affected_rows > 0) {
            echo "<div class='alert alert-success'>Publicação alterada com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao alterar a publicação!</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Preencha todos os campos</div>";
    }
}

?>