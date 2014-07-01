<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'enableAjaxValidation' => true,
    'id' => uniqid('user_'),
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    'htmlOptions' => array(
        'class' => 'bs-example'
    )
));

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/validCampoFranz.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScript('validarCamposEspeciales', "
  $('#Bitacora_BIT_TITULO').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéíóú1234567890-_');
  $('#Bitacora_BIT_CONTENIDO').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéíóú1234567890-%;:,@().');

");

$this->breadcrumbs=array(
	'Bitacora'=>array('/bitacora'),
	'Agregar',
);
?>

<!-- Si es admin -->
<?php if (Yii::app()->user->name == 'admin') echo '
<h1>Página Bitácoras Admin</h1>'
?>

<!-- Si es Alumno puede agregar bitácoras-->

<?php if (Yii::app()->user->name == 'alumno')?>

<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Página Bitácoras Alumnos</h3>
      </div>

      <form method="post">
      <table>
      <div class="panel-body">
                <?php echo $form->textFieldControlGroup($model, 'BIT_TITULO', array('placeholder' => 'Se puede usar: letras y guiones. Ej: Bitácora_01'));?>
               
                <?php echo $form->textAreaControlGroup($model, 'BIT_CONTENIDO', array('placeholder' => 'Se puede usar: Números, letras, %, -, @, (). Ej: Hoy 02 de junio avance un 20% de mi práctica'));?> <!-- AREA DE TEXTO-->
                
                <?php 
                echo 
                    $form->dropDownListControlGroup(
                      $model,'BIT_ESTADO',
                      array('Enviada'=>'Enviada','No enviada'=>'No enviada'), 
                      array('options' => array($model->BIT_ESTADO=>array('selected'=>true)),'class'=>'form-control'));
              ?>
                
                <?php echo BsHtml::formActions(array(BsHtml::submitButton('Enviar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>
                
      
      </div>

      </table>
      </form> 
    </div>

    <?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="grabado_ok">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
    <?php endif; ?>
    <?php echo $form->errorSummary($model); ?>
    <?php $this->endWidget();?>


