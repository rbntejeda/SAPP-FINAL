<?php
/* @var $this NoticiasController */
/* @var $data Noticias */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOT_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->NOT_ID),array('view','id'=>$data->NOT_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOT_TITULO')); ?>:</b>
	<?php echo CHtml::encode($data->NOT_TITULO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOT_CONTENIDO')); ?>:</b>
	<?php echo CHtml::encode($data->NOT_CONTENIDO); ?>
	<br />

    <?php echo BsHtml::submitButton('Ingresar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
    <?php echo BsHtml::submitButton('Ingresar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
               <?phpecho BsHtml::button('Default');
?>
</div>