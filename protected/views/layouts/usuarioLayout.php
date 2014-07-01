
	<?php $this->beginContent('//layouts/sappLayout'); ?>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-2">
			<ul class="nav nav-pills nav-stacked">
				
				<li><a href="<?php echo Yii::app()->createUrl('Usuario/Administrar'); ?>">Administrar Usuario</a></li>
				<li><a href="<?php echo Yii::app()->createUrl('Usuario/Crear'); ?>">Ingresar Usuario</a></li>
			</ul>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-10">
			<?php 
			if(isset($content)) 
				echo $content;
			else 
				echo '
			<div class="alert alert-danger">
				<strong>No se a cargado la Pagina</strong> No tiene los permisos para acceder a la pagina.
			</div>'
			;?>
		</div>
	</div>
	<?php $this->endContent(); ?>