<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>true,
	    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>
	<?php //Se vacia el Password para no entregar la contraseña al usuario
	$user->USU_PASSWORD='';
	echo $form->errorSummary($user);
	echo $form->errorSummary($persona); ?>

	<!--Inicio Fomrulario Editar Usuario-->
	<div>
	<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Editar información de <?php echo $persona->PER_NOMBRE; ?></h3>
      </div>
      <div class="panel-body">
		<?php echo $form->passwordFieldControlGroup($user,'USU_PASSWORD',array('maxlength'=>32,'class'=>"form-control",'placeholder'=>'Solo si desea Cambiar su Contraseña, rellene este campo','required'=>'')); ?>
		<?php echo $form->textFieldControlGroup($persona,'PER_TELEFONO',array('maxlength'=>20,'class'=>"form-control",'placeholder'=>'Telefono de Contacto','required'=>'')); ?>
		<?php if (Yii::app()->user->name == 'admin'||(Yii::app()->user->name == 'profesor'&&Yii::app()->user->ID !=$persona->PER_ID) )
 			echo  $form->dropDownListControlGroup($user,'USU_ESTADO',array('H'=>'Habilitado','N'=>'No Habilitado'),array('options' => array($user->PER_ID=>array('selected'=>true)))); ?> 
	<?php echo BsHtml::submitButton('Ingresar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
	</div>
      </div>
    </div>
	
	<!--Fin Fomrulario Editar Usuario-->
<?php $this->endWidget(); ?>