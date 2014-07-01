<?php

$this->breadcrumbs=array(
	'Usuario'=>array('/usuario'),
	'Login',
);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<center><h2 style="color:#000;">Bienvenido</h2></center>
  <div class="form-group">
		<?php echo $form->textField($model,'username',array('class'=>"form-control",'maxlength'=>12,'placeholder'=>'Rut','required'=>'','focused'=>'')); ?>
		<?php echo $form->error($model,'username'); ?>
  </div>
  <div class="form-group">
		<?php echo $form->passwordField($model,'password',array('class'=>"form-control",'maxlength'=>32,'placeholder'=>'Contraseña')); ?>
		<?php echo $form->error($model,'password'); ?>
 </div>
  <div class="form-group">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
	 <label >Recuerdame</label>
		<?php echo $form->error($model,'rememberMe'); ?>
  </div>
  <div class="form-group">
  	<button type="submit" class="btn btn-lg btn-warning btn-block">Ingresar</button>
  </div>

<?php $this->endWidget(); ?>

