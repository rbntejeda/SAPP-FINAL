<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Administración de Usuarios</h3>
			</div>
			<div class="panel-body">
				<table class="table">
	<thead>
		<tr>
			<th>RUT</th>
			<th>Nombre</th>
			<th>Creación</th>
			<th>Modificación</th>
			<th>Estado</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $user):?>
			<tr <?php if ($user->USU_ESTADO=='N') echo 'class="danger"'; ?>>
				<td><?php echo $user->PER_RUT;?></td>
				<td><?php echo $user->PER_NOMBRE;?></td>
				<td><?php echo $user->USU_CREATE;?></td>
				<td><?php echo $user->USU_MODIFIED;?></td>
				<td><?php 
					if ($user->USU_ESTADO=='H') echo 'Habilitado';
					else echo 'No Habilitado';
					?></td>
				<td>
					<center>
						<div class="btn-group">
							<div class="input-group">
								<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
									<span class="glyphicon glyphicon-cog"></span>
								</button>
								<ul class="dropdown-menu pull-right">
								<li><a href="<?php echo Yii::app()->createUrl("Usuario/editar/$user->PER_ID"); ?>">Editar Usuario</a></li>
									<!--trigger Modal-->
									<li data-toggle="modal" data-target="#questionDelete<?php echo $user->PER_ID?>"><a>Eliminar Usuario</a></li>
								</ul>
							</div> 
						</div>
					</center>
				</td>
			</tr>
							<!-- Modal -->
		<div class="modal fade" id="questionDelete<?php echo $user->PER_ID?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Eliminar Ususario</h4>
					</div>
					<div class="modal-body">
						Desea realmente eliminar a <?php echo $user->PER_NOMBRE;?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<button type="button" class="btn btn-danger" onclick="location.href='<?php echo Yii::app()->createUrl("Usuario/eliminar/$user->PER_ID"); ?>'">Eliminar de todas Formas</button>
					</div>
				</div>
			</div>
		</div>
		<!--Fin de Modal-->
		<?php endforeach; ?>
	</tbody>
</table>
			</div>
		</div>