<?php
	$sql = $con->prepare("SELECT * FROM posts ORDER BY id DESC");
	$sql->execute();
	$get = $sql->get_result();
	$total = $get->num_rows;

	if($total <= 0) {
		echo "<div class='alert alert-danger'>Nenhuma publicação encontrada!</div>";
	} else {
		while($dados = $get->fetch_array()) {
		$id_autor = $dados['id_autor'];
		$query = $con->prepare("SELECT * FROM usuarios WHERE id = ?");
		$query->bind_param("s", $id_autor);
		$query->execute();
        $dadosU = $query->get_result()->fetch_assoc();
?>

<div class="post-content">
	<h4><?php echo $dados['titulo'];?></h4>
	<span class="text-muted small"><i class="fas fa-user"></i> <?php echo $dados['id_autor'];?> - <i class="far fa-clock"></i> <?php echo $dados['data'];?></span>
	<div class="media">
	 <!-- <img class="mr-3 img-fluid" src="<?php echo $dados['imagem'];?>" class> -->
	  <div class="media-body">
	    <?php echo substr_replace($dados['descricao'], (strlen($dados['descricao']) > 400 ? '...' : ''), 400);?>
	    <p class="button"><a href="p/<?php echo $dados['id'];?>" class="btn btn-info">Leia Mais</a></p>
	  </div>
	</div>
	</div>
<?php } }?>
