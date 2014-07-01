<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    'enableAjaxValidation' => true,
    'id' => 'user_form_horizontal',
    'htmlOptions' => array(
        'class' => 'bs-example'
    )
));
?>


<?php
/* @var $this BitacoraController */

$this->breadcrumbs=array(
	'Bitacora'=>array('/bitacora'),
	'Ver',
);
?>
<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Bitácora del Alumno <?php echo $alumno->PER_NOMBRE ?></h3>
      </div>

      	<div class="panel-body"> <!-- Mostrar la bitácora del alumno..-->
      		<?php echo $form->textFieldControlGroup($alumno, 'BIT_TITULO', array('readonly'=>'false')) ?>
      		<?php echo $form->textAreaControlGroup($alumno, 'BIT_CONTENIDO', array('readonly'=>'false')) ?>
      		<?php echo $form->textFieldControlGroup($alumno, 'BIT_INGRESO', array('readonly'=>'false')) ?>
      		<?php //echo $form->$textFieldControlGroup($alumno, 'BIT_ESTADO', array('readonly'=>'false')) ?>
      		<?php //echo $form->$dropDownListControlGroup($alumno, 'BIT_ESTADO', array('readonly'=>'false')) ?>
        </div>
</div>


<?php echo $form->errorSummary($alumno); ?>
<?php $this->endWidget();?>