<?php
/* @var $this EmpresaController */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.Rut.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScript('Validar_rut', "
    $('#Empresa_EMP_RUT').Rut({
  on_error: function(){ alert('Rut incorrecto'); }
});
");


$this->breadcrumbs=array(
	'Empresa'=>array('/empresa'),
	'Ingresar',
);
?>
<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Ingresar Empresa</h3>
      </div>
      <div class="panel-body">

        <?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="grabado_ok">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'users-form',
    'enableAjaxValidation'=>true,
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>
 
  
        <?php echo $form->textFieldControlGroup($model,'EMP_RUT',array('maxlength'=>32,'class'=>"form-control",'placeholder'=>'Ej.12345678-0','required'=>'')) ?>

        <?php echo $form->textFieldControlGroup($model,'EMP_NOMBRE',array('maxlength'=>32,'class'=>"form-control",'placeholder'=>'Nombre','required'=>'')) ?>
  
        <?php echo $form->emailFieldControlGroup($model,'EMP_CORREO',array('maxlength'=>32,'class'=>"form-control",'placeholder'=>'Ej.correo@correo.cl','required'=>'')) ?>
  
        <?php echo $form->textFieldControlGroup($model,'EMP_TELEFONO',array('maxlength'=>32,'class'=>"form-control",'placeholder'=>'Telefono','required'=>'')) ?>
  
        <?php echo $form->textFieldControlGroup($model,'EMP_DIRECCION',array('maxlength'=>32,'class'=>"form-control",'placeholder'=>'Direccion','required'=>'')) ?>

        <?php echo $form->textFieldControlGroup($model,'EMP_CONTACTO',array('maxlength'=>32,'class'=>"form-control",'placeholder'=>'Nombre Contacto','required'=>'')) ?>

        <?php $fecha=strftime( "%Y-%m-%d  %H:%M", time() );?>
        <?php echo $form->textFieldControlGroup($model,'EMP_INGRESO',array('value'=>$fecha, 'readonly'=>'false','maxlength'=>32,'class'=>"form-control",'required'=>'')); ?>
 
        <?php echo BsHtml::formActions(array(BsHtml::submitButton('Ingresar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>

 
<?php $this->endWidget(); ?>
</div><!-- form -->
      </div>
    </div>
