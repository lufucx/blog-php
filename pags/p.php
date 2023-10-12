<?php
$idPost = addslashes($explode['1']);
$sql = $con->prepare("SELECT * FROM posts WHERE id = ?");
$sql->bind_param("s", $idPost);
$sql->execute();
$get = $sql->get_result();
$total = $get->num_rows;


if ($total <= 0) {
	echo "<div class='alert alert-danger'>Nenhuma publicação encontrada!</div>";
} else {
	while ($dados = $get->fetch_array()) {
		$id_autor = $dados['id_autor'];
		$query = $con->prepare("SELECT * FROM usuarios WHERE id = ?");
		$query->bind_param("s", $id_autor);
		$query->execute();
		$dadosU = $query->get_result()->fetch_assoc();
?>

		<div id="fullpost-content">
			<h4><?php echo $dados['titulo']; ?></h4>
			<!-- <img class="mr-3 img-fluid" src="<?php echo $dados['imagem']; ?>" class> -->
			<div class="body">
				<?php echo $dados['conteudo']; ?><br>
				<br>
				<?php echo "Fontes:"; ?>
				<?php echo $dados['fontes']; ?>
				<hr>
				<span class="text-muted small"><i class="fas fa-user"></i> <?php echo $dados['id_autor']; ?> - <i class="far fa-clock"></i> <?php echo $dados['data']; ?>
			</div>
		</div>


<?php }
} ?>