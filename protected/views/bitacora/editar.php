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
  'Editar',
);

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/validCampoFranz.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScript('validarCamposEspeciales', "
  $('#BitAdmin_BIT_TITULO').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéíóú1234567890');
  $('#Bitacora_BIT_CONTENIDO').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéíóú1234567890-%;:,@().');

");?>

<?php if (Yii::app()->user->name == 'admin'){?>
<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Bitácora del Alumno <?php echo $alumno->PER_NOMBRE ?></h3>
      </div>

        
        <div class="panel-body"> <!-- Mostrar la bitácora del alumno..-->

          <?php echo $form->textFieldControlGroup($alumno, 'BIT_TITULO') ?>
          <?php echo $form->textAreaControlGroup($alumno, 'BIT_CONTENIDO') ?>
          <?php 
                echo 
                    $form->dropDownListControlGroup(
                      $alumno,'BIT_ESTADO',
                      array('Enviada'=>'Enviada','No enviada'=>'No enviada'), 
                      array('options' => array($alumno->BIT_ESTADO=>array('selected'=>true)),'class'=>'form-control'));
              ?>
                 <?php echo BsHtml::formActions(array(BsHtml::submitButton('Enviar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>
        </div>
</div>

<?php } ?>

<?php if (Yii::app()->user->name == 'alumno'){?> 

<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Bitácora del Alumno <?php echo $alumno->PER_NOMBRE ?></h3>
      </div>

        
        <div class="panel-body"> <!-- Mostrar la bitácora del alumno..-->
          <p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>
          <p class="help-block">Si el campo Estado de Bitácora, es Enviada, Usted no podrá editarla nuevamente. </p>

          <?php echo $form->textFieldControlGroup($alumno, 'BIT_TITULO') ?>
          <?php echo $form->textAreaControlGroup($alumno, 'BIT_CONTENIDO') ?>
          <?php 
                echo 
                    $form->dropDownListControlGroup(
                      $alumno,'BIT_ESTADO',
                      array('Enviada'=>'Enviada','No enviada'=>'No enviada'), 
                      array('options' => array($alumno->BIT_ESTADO=>array('selected'=>true)),'class'=>'form-control'));
              ?>
                 <?php echo BsHtml::formActions(array(BsHtml::submitButton('Enviar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>
        </div>
</div>  

<?php } ?>

<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="grabado_ok">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
    <?php endif; ?>
<?php echo $form->errorSummary($alumno); ?>
<?php //echo $form->errorSummary($nueva); ?>
<?php $this->endWidget();?>