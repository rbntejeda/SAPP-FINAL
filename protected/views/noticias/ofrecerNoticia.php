<?php
$panel=$this->beginWidget('bootstrap.widgets.BsPanel', array(
		'title' => 'Agregar Noticia',
		'type' => BsHtml::PANEL_TYPE_PRIMARY
));
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id'=>'ofrece-form',
		'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
		'enableAjaxValidation'=>true,

)); ?>
		<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>
				<?php echo $form->errorSummary($model); ?>
				<?php echo $form->textFieldControlGroup(Noticias::model()->findByPk($model->NOT_ID), 'NOT_TITULO', array('disabled' => true));?>
				<?php echo $form->dropDownListControlGroup($model,'CAR_CODIGO',CHtml::listData(Carrera::model()->findAll(),'CAR_CODIGO','CAR_NOMBRE'), array('empty' => 'Elija la Carrera')); ?>
				<?php echo $form->textFieldControlGroup($model,'OFR_INICIO'); ?>
				<?php echo $form->textFieldControlGroup($model,'OFR_TERMINO'); ?>

				<!--<div class="form-group">
					<label class="control-label col-lg-2 required" for="Ofrece_OFR_INICIO">
					 Fecha Inicio <span class="required">*</span>
					</label><div class="col-lg-10">
					<input type="text" name="Ofrece[OFR_INICIO]" id="Ofrece_OFR_INICIO" class="form-control" placeholder="Fecha Inicio"><p id="Ofrece_OFR_INICIO_em_" style="display:none" class="help-block"></p>
					</div>
					</div>-->



			 <!-- <label>Fecha Inicio*</label>
				<?php 
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				 'model'=>$model,
				 'attribute'=>'OFR_INICIO',
				 'value'=>$model->OFR_INICIO,
				 'language' => 'es',
				 'htmlOptions' => array('class'=>'form-control','type'=>'date'),     
				 'options'=>array(
					 'autoSize'=>true,
					 'defaultDate'=>$model->OFR_INICIO,
					 'dateFormat'=>'yy-mm-dd',

					 'selectOtherMonths'=>true,
					 'showAnim'=>'slide',
					 'showButtonPanel'=>true,

					 'showOtherMonths'=>true,
					 'changeMonth' => 'true',
					 'changeYear' => 'true',
				 )
			 )); 
		?>
				<br>
				<label>Fecha Termino*</label>        <?php 
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				 'model'=>$model,
				 'attribute'=>'OFR_TERMINO',
				 'value'=>$model->OFR_TERMINO,
				 'language' => 'es',
				 'htmlOptions' => array('class'=>'form-control','type'=>'date'),     
				 'options'=>array(
					 'autoSize'=>true,
					 'defaultDate'=>$model->OFR_TERMINO,
					 'dateFormat'=>'yy-mm-dd',
					 'max'=>'0000-00-00',
					 'selectOtherMonths'=>true,
					 'showAnim'=>'slide',
					 'showButtonPanel'=>true,

					 'showOtherMonths'=>true,
					 'changeMonth' => 'true',
					 'changeYear' => 'true',
				 )
			 )); 
		?>-->
				<?php //echo $form->dropDownListControlGroup($model,'OFR_ESTADO',array('Activo'=>'Activo','Inactivo'=>'Inactivo')); ?>
				<?php echo BsHtml::formActions(array(BsHtml::submitButton('Ingresar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>
<?php $this->endWidget(); ?>
				<table class="table">
					<thead>
						<tr>
							<th>Carrera</th>
							<th>Fecha Inicio</th>
							<th>Fecha Término</th>
							<th>Estado</th>
							<th>Opciones</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						 $data=Ofrece::model()->findAllByAttributes(array('NOT_ID'=>$model->NOT_ID));
						 foreach ($data as $datos):?>
							<tr>
								<td><?php echo Carrera::model()->findByPk($datos->CAR_CODIGO)->CAR_NOMBRE?></td>
								<td><?php echo $datos->OFR_INICIO;?></td>
								<td><?php echo $datos->OFR_TERMINO;?></td>
								<td><?php echo $datos->OFR_ESTADO;?></td>
								<td>
									<center>
										<div class="btn-group">
											<div class="input-group">
												<button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">
													<span class="glyphicon glyphicon-remove"></span>
												</button>
												<ul class="dropdown-menu pull-right">
													<!--trigger Modal-->
													<li data-toggle="modal" data-target="#questionDelete<?php echo $datos->OFR_ID?>"><a>Eliminar Publicación</a></li>
												</ul>
											</div> 
										</div>
									</center>
								</td>
							</tr>
											<!-- Modal -->
						<div class="modal fade" id="questionDelete<?php echo $datos->OFR_ID?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title">Eliminar Publicación</h4>
									</div>
									<div class="modal-body">
										Desea realmente eliminar La publicación <?php echo Noticias::model()->findByPk($datos->NOT_ID)->NOT_TITULO;?> para <?php echo Carrera::model()->findByPk($datos->CAR_CODIGO)->CAR_NOMBRE;?>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
										<button type="button" class="btn btn-danger" onclick="location.href='<?php echo Yii::app()->createUrl("noticias/eliminarOfrecimiento/$datos->OFR_ID"); ?>'">Eliminar de todas Formas</button>
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
						<?php
$this->endWidget();
?>
