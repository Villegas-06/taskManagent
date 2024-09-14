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
		<table class="table table-bordered" id="tableTask">
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
								<button type="button" data-bs-toggle="modal" data-bs-target="#editModal" class="btn btn-info"
									onclick="loadTaskData(<?= $r['id']; ?>)">Editar</button>
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
				<h5 class="modal-title" id="agregarDatosModalLabel">Insertar nueva tarea</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="index.php?page=insert" method="POST" name="registroForm" id="registroForm" class="text-left">
				<div class="modal-body">
					<div class="form-group">
						<label for="name">Nombre *</label> <small id="nameHelp" class="form-text text-muted">Ingrese el
							nombre de la tarea</small>
						<input type="text" id="name" name="name" class="form-control" aria-describedby="nameHelp"
							required>

					</div>
					<div class="form-group">
						<label for="description">Descripción *</label>
						<small id="descriptionHelp" class="form-text text-muted">Ingrese la descripción de la
							tarea.</small>
						<textarea type="text" id="description" name="description" class="form-control"
							aria-describedby="descriptionHelp" required></textarea>

					</div>

					<div class="form-group">
						<label for="status">Estado *</label>
						<small id="statusHelp" class="form-text text-muted">Selecciona el estado actual de la
							tarea.</small>
					</div>
					<select id="status" name="status" class="form-control" aria-describedby="statusHelp" required>
						<option value="">Selecciona un estado</option>
						<option value="pending">Pendiente</option>
						<option value="in-progress">En progreso</option>
						<option value="completed">Completada</option>
					</select>



				</div>
				<div class="modal-footer">
					<button type="button" id="btnCerrar" class="btn btn-secondary"
						data-bs-dismiss="modal">Cerrar</button>
					<button type="button" id="btnInsertar" name="btnInsertar" class="btn btn-primary">Insertar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal para Editar -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editModalLabel">Editar Tarea</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="editForm">
					<div class="modal-body">
						<input type="hidden" id="editTaskId" name="id" />
						<div class="form-group">
							<label for="editName">Nombre</label>
							<input type="text" class="form-control" id="editName" name="name" required />
						</div>
						<div class="form-group">
							<label for="editDescription">Descripción</label>
							<textarea class="form-control" id="editDescription" name="description" required></textarea>
						</div>
						<div class="form-group">
							<label for="editStatus">Estado</label>
							<select class="form-control" id="editStatus" name="status" required>
								<option value="pending">Pendiente</option>
								<option value="in-progress">En Progreso</option>
								<option value="completed">Completado</option>
							</select>
						</div>

					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Guardar Cambios</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$('#tableTask').load();
	})


	$(document).ready(function () {
		$('#btnInsertar').click(function () {
			var valid = true;
			var name = $('#name').val();
			var description = $('#description').val();
			var status = $('#status').val();

			// Limpiar mensajes de error
			$('.form-text.text-danger').remove();

			if (name === '') {
				$('#name').after('<small class="form-text text-danger">El nombre es obligatorio.</small>');
				valid = false;
			}

			if (description === '') {
				$('#description').after('<small class="form-text text-danger">La descripción es obligatoria.</small>');
				valid = false;
			}

			if (status === '') {
				$('#status').after('<small class="form-text text-danger">El estado es obligatorio.</small>');
				valid = false;
			}

			if (valid) {
				// Serializar datos y hacer solicitud AJAX
				var data = $('#registroForm').serialize();

				$.ajax({
					type: "POST",
					data: data,
					url: "index.php?page=insert",
					dataType: "json",
					success: function (response) {
						console.log(response);
						if (response.status === 'success') {
							$('#registroForm')[0].reset();
							$('#tableTask').load('index.php?page=index #tableTask'); // Recargar la tabla
							alert(response.message);
							$('#insertarRegistroModal').modal('hide');
						} else {
							alert(response.message);
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.error("Error en la solicitud:", textStatus, errorThrown);
						alert("Hubo un problema con la solicitud.");
					}
				});
			}
		});
	});

	// Cargar los datos en el modal
	function loadTaskData(taskId) {
		$.ajax({
			type: "GET",
			url: "index.php?page=getTaskByid", // Verifica esta URL
			data: { id: taskId },
			dataType: "json",
			success: function (response) {
				if (response.status === 'success') {
					var task = response.data;
					$('#editTaskId').val(task.id);
					$('#editName').val(task.name);
					$('#editDescription').val(task.description);
					$('#editStatus').val(task.status);
					$('#editModal').modal('show');
				} else {
					alert(response.message);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log("Error details:", textStatus, errorThrown);
				alert("Hubo un problema con la solicitud.");
			}
		});

	}


	// Manejar el envío del formulario de edición
	$('#editForm').on('submit', function (event) {
		event.preventDefault();

		var data = $(this).serialize();

		$.ajax({
			type: "POST",
			url: "index.php?page=update",
			data: data,
			dataType: "json",
			success: function (response) {
				if (response.status === 'success') {
					$('#editModal').modal('hide');
					$('#tableTask').load('index.php?page=index #tableTask'); // Recargar la tabla
					alert(response.message);
				} else {
					alert(response.message);
				}
			},
			error: function () {
				alert("Hubo un problema con la solicitud.");
			}
		});
	});


</script>