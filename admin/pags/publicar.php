<form method="POST" enctype="multipart/form-data" id="form-publicar">
    <label>Titulo</label>
    <input type="text" name="titulo" class="form-control"><br>

    <label>Autor</label>
    <input type="text" name="autor" class="form-control"><br>

    <label>Tema</label>
    <input type="text" name="tema" class="form-control"><br>

    <label>Subtema</label>
    <input type="text" name="subtema" class="form-control"><br>

    <label>Imagem</label>
    <input type="file" name="userfile" class="form-control"><br>

    <label>Descrição</label>
    <textarea class="form-control" name="descricao" rows="5"></textarea><br>

    <label>Publicação</label>
    <textarea class="form-control" name="conteudo" rows="5"></textarea><br>

    <label>Fontes</label>
    <textarea class="form-control" name="fontes" rows="5"></textarea><br>

    <input type="submit" value="Enviar Publicação" class="btn btn-outline-primary btn-lg btn-block">
    <input type="hidden" name="env" value="post">

</form>
<?php
if (isset($_POST['env']) && $_POST['env'] == "post") {
    $idUser = $_SESSION['usuarioID'];

    if (isset($_POST['titulo'], $_POST['autor'], $_POST['tema'], $_POST['subtema'], $_POST['descricao'], $_POST['conteudo'], $_POST['fontes'], $_FILES['userfile'])) {
        $titulo = $_POST['titulo'];
        $id_autor = $_POST['autor'];
        $tema = $_POST['tema'];
        $subtema = $_POST['subtema'];
        $descricao = $_POST['descricao'];
        $conteudo = $_POST['conteudo'];
        $fontes = $_POST['fontes'];

        $data = date('Y-m-d H:i:s');

        $uploaddir = '../images/uploads/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            $query = $con->prepare("INSERT INTO posts (id_autor, titulo, data, subtema, descricao, conteudo, fontes, imagem, tema) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $query->bind_param("sssssssss", $id_autor, $titulo, $data, $subtema, $descricao, $conteudo, $fontes, $uploadfile, $tema);


            if ($query->execute()) {
                echo "<div class='alert alert-success'>Publicação enviada com sucesso!</div>";
            } else {
                echo "<div class='alert alert-danger'>Erro ao enviar a publicação: " . mysqli_error($con) . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Erro ao fazer o upload da imagem.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Preencha todos os campos</div>";
    }
}

?>