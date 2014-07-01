<?php
/* @var $this NoticiasController */
/* @var $model Noticias */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'noticias-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>true,
        'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>

    <p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'NOT_TITULO',array('maxlength'=>100)); ?>
    <?php echo $form->textAreaControlGroup($model,'NOT_CONTENIDO',array('rows'=>6)); ?>

    <?php echo BsHtml::formActions(array(BsHtml::submitButton('Ingresar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>

<?php $this->endWidget(); ?>

        <?php $this->widget('bootstrap.widgets.BsGridView',array(
            'id'=>'presupuesto-grid',
            'dataProvider'=>$lista->search(),
            'filter'=>$lista,
            'columns'=>array(
                array(
                    'name'=>'ITE_CORREL',
                    'value'=>'Item::model()->findByPk($data->ITE_CORREL)->ITE_NOMBRE',
                ),
                'PRE_DESCRIPCION',
                'PRE_MONTO',
                array(
                    'class'=>'bootstrap.widgets.BsButtonColumn',
                ),

            ),
            'type' => BsHtml::GRID_TYPE_RESPONSIVE,

        )); ?>