<?php
/* @var $this NoticiasController */
/* @var $model Noticias */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>
    <?php echo $form->textFieldControlGroup($bitacora,'BIT_TITULO',array('maxlength'=>100)); ?>

    <div class="form-actions">
        <br>
        <?php echo BsHtml::submitButton('Buscar',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
        <br>
    </div>

<?php $this->endWidget(); ?>