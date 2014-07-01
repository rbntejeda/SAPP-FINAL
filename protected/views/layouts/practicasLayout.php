<!--

/************************************************************************/
/*  Nombre del archivo:   practicasLayout.php                           */
/* Descripción:  Vista correspondiente a la distribucion de los         */
/*					elemento en la pantalla	de practicas profesionales  */
/***********************************************************************/
-->

	

	<?php $this->beginContent('//layouts/sappLayout'); ?>

	<div class="row">
		<div class="col-xs-12 col-sm-2 col-md-2">
			<ul class="nav nav-pills nav-stacked" style="max-width: 300px;">
				<!--Redirecciona a páginas.. (controlador/acccion)-->
				<li><a href="<?php echo Yii::app()->createUrl('Practicas/CrearPractica'); ?>">Crear Prácticas</a></li> 
				
			</ul>
		</div>
		<div class="col-xs-12 col-sm-10 col-md-10">
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