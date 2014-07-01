<?php
/* @var $this PracticasController */

$this->breadcrumbs=array(
	'Practicas'=>array('/practicas'),
	'CrearPractica',
);
?>
 
<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Crear Práctica</h3>
      </div>
      <div class="panel-body">
        
      </div>

     
      <div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'users-form',
    'enableAjaxValidation'=>true,
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>

    <?php echo $form->errorSummary($model); ?>
    <div class="form-grup">            
     

<?php echo $form->dropDownListControlGroup($model,'PER_ID',CHtml::listData(Persona::model()->findAll(array('order' => 'PER_RUT')), 'PER_ID', 'PER_RUT'),array ('update'=>'#'.CHtml::activeId($model,'PER_ID'),'prompt'=>'Seleccione...','class'=>'form-control'));?>
<?php echo $form->error($model,'PER_ID'); ?>
</div>



<div class = "form-grup">

    <?php if (Yii::app()->user->name == 'admin') 
              {
                echo 
                    $form->dropDownListControlGroup(
                      $model,'PRA_TIPO',
                      array('1'=>'Práctica 1','2'=>'Práctica 2'), 
                      array('options' => array($model->PRA_TIPO=>array('selected'=>true)),'prompt'=>'Seleccione...','class'=>'form-control'))
                  ;
              }?>
    
    </div>
    <div class="form-grup">
        
    
            
<?php echo $form->dropDownListControlGroup($model,'CAR_CODIGO',CHtml::listData(Carrera::model()->findAll(array('order' => 'CAR_CODIGO')), 'CAR_CODIGO', 'CAR_NOMBRE'),array ('prompt'=>'Seleccione...','class'=>'form-control'));?>
<?php echo $form->error($model,'CAR_CODIGO'); ?>
    </div>

    <div class="form-grup">
        
        <?php echo $form->textAreaControlGroup($model, 'PRA_DESCRIPCION', array('placeholder' => 'Se puede usar: Números, letras, %, -, @, (). Ej: Esta práctica es de programación en C#'));?> <!-- AREA DE TEXTO-->
    </div>

    <div class="form-grup">
        
        <?php $fecha=strftime( "%Y-%m-%d  %H:%M", time() );?>
        <?php echo $form->textFieldControlGroup($model,'PRA_INICIO',array('value'=>$fecha, 'readonly'=>'false','maxlength'=>32,'class'=>"form-control",'required'=>'')); ?>
        

    

    <?php echo BsHtml::formActions(array(BsHtml::submitButton('Ingresar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>
 
<?php $this->endWidget();?>
</div><!-- form -->
    </div>