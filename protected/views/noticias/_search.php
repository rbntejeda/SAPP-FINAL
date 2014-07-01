<?php
/* @var $this NoticiasController */
/* @var $model Noticias */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>
    <?php echo $form->textFieldControlGroup($model,'NOT_TITULO',array('maxlength'=>100,'placeholder'=>'Introdusca palabra clave, por ejemplo "Noticia"')); ?>

    <div class="form-actions">
        <?php echo BsHtml::formActions(array(BsHtml::submitButton('Buscar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>
    </div>

<?php $this->endWidget(); ?>
