<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>true,

    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>
	<?php echo $form->errorSummary($user); ?>
	<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Ingresar Usuario</h3>
      </div>
      <div class="panel-body">

	<?php echo $form->dropDownListControlGroup($user,'PER_ID',CHtml::listData($personas,'PER_ID','Nombre'), array('empty' => 'Elija al Usuario Carrera')); ?>
 	<?php echo $form->passwordFieldControlGroup($user,'USU_PASSWORD',array('maxlength'=>32,'placeholder'=>'Si no le asigna una contraseña, Se le asignaran los primeros 5 digitos del RUT')); ?>
	<?php echo  $form->dropDownListControlGroup($user,'USU_ESTADO',array('H'=>'Habilitado','N'=>'No Habilitado')); ?> 
	<?php echo BsHtml::formActions(array(BsHtml::submitButton('Ingresar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>
      </div>
    </div>

<?php $this->endWidget(); ?>
