<?php
/* @var $this AlumnosController */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.Rut.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScript('Validar_rut', "
    $('#Persona_PER_RUT').Rut({
  on_error: function(){ alert('Rut incorrecto');}
});
");

$this->breadcrumbs=array(
    'Alumnos'=>array('/alumnos'),
    'IngresarAlumno',
);
?>

<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Ingresar Alumno</h3>
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
 
    <?php echo $form->errorSummary($alumno); ?> 
    <?php if(Yii::app()->user->name == 'admin')echo $form->dropDownListControlGroup($alumno,'CAR_CODIGO',CHtml::listData(Carrera::model()->findAll(),'CAR_CODIGO','CAR_NOMBRE'), array('empty' => 'Elija la Carrera')); ?>
    <?php echo $form->textFieldControlGroup($alumno, 'PER_RUT',array('maxlength'=>12,'placeholder'=>'Ej.1234567-0','required'=>''));?>
    <?php echo $form->textFieldControlGroup($alumno, 'PER_NOMBRE',array('maxlength'=>32,'placeholder'=>'Nombre','required'=>''));?>
    <?php echo $form->emailFieldControlGroup($alumno, 'PER_CORREO',array('maxlength'=>32,'placeholder'=>'Ej.correo@correo.cl'));?>
    <?php echo $form->textFieldControlGroup($alumno, 'PER_TELEFONO',array('maxlength'=>20,'placeholder'=>'Telefono'));?>
    <?php echo BsHtml::formActions(array(BsHtml::submitButton('Ingresar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>
 
<?php $this->endWidget(); ?>
</div><!-- form -->
      </div>
    </div>


