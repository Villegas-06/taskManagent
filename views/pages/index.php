<?php

require_once __DIR__ . '/../../controllers/TaskController.php';

$object = new TaskController();
$tasks = $object->getTasks();

?>

<main role="main" class="container py-5 my-5">

	<div class="starter-template">
		<div class="row">
			<div class="col-md-6 offset-3">
				<?php
				if (isset($_GET['mensaje'])) {
					echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
									" . $_GET['mensaje'] . "
									<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
		    							<span aria-hidden='true'>&times;</span>
									</button>
								</div>";
				}
				?>
			</div>
		</div>
		<hr>
		<table class="table table-bordered" id="tablaCliente">
			<thead class="thead-dark">
				<tr>
					<th scope="col">id</th>
					<th scope="col">nombre</th>
					<th scope="col">descripci&oacute;n</th>
					<th scope="col">estado</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (!empty($tasks)) {
					foreach ($tasks as $r) {
						?>
						<tr>
							<th scope="row"><?= $r['id']; ?></th>
							<td><?= $r['name']; ?></td>
							<td><?= $r['description']; ?></td>
							<td><?= $r['status']; ?></td>
							<td>
								<a href="?page=editar&id=<?= $r['id']; ?>" type="a" class="btn btn-info">Editar</a>
							</td>
						</tr>
					<?php }
				} ?>
			</tbody>
		</table>
		<div class="text-left">
			<button type="button" class="btn btn-primary text-left" data-bs-toggle="modal"
				data-bs-target="#insertarRegistroModal">Insertar registro</button>
		</div>
	</div>

</main><!-- /.container -->


<!-- Modal Agregar -->
<div class="modal fade" id="insertarRegistroModal" tabindex="-1" role="dialog" aria-labelledby="agregarDatosModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="agregarDatosModalLabel">Insertar nuevos registros</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="index.php?page=insertar" method="POST" name="registroForm" id="registroForm"
				class="text-left">
				<div class="modal-body">
					<div class="form-group">
						<label for="nombre">Nombre</label>
						<input type="text" id="nombre" name="nombre" class="form-control" aria-describedby="nombreHelp">
						<small id="nombreHelp" class="form-text text-muted">Ingrese el nombre completo del
							cliente.</small>
					</div>
					<div class="form-group">
						<label for="email">E-mail</label>
						<input type="email" id="email" name="email" class="form-control" aria-describedby="emailHelp">
						<small id="emailHelp" class="form-text text-muted">Ingrese el correo electronico del
							cliente.</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
					<button type="button" id="btnInsertar" name="btnInsertar" class="btn btn-primary">Insertar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$('#tablaCliente').load();
	})


	$(document).ready(function () {
		$('#btnInsertar').click(function () {
			datos = $('#registroForm').serialize();

			$.ajax({
				type: "POST",
				data: datos,
				url: "insertar.php",
				success: function (r) {
					// if (r==1) {
					// 	$('#registroForm')[0].reset();
					// 	$('#tablaCliente').load();
					// 	alert ("Agregado Ok!");
					// } else {
					// 	alert("Fallo al agregar");
					// }
					alert(r);
				}
			});
		});
	});
</script>