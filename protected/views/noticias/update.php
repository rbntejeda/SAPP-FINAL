<?php
/* @var $this NoticiasController */
/* @var $model Noticias */
?>

<?php
$panel=$this->beginWidget('bootstrap.widgets.BsPanel', array(
    'title' => 'Modificar Noticia',
    'type' => BsHtml::PANEL_TYPE_PRIMARY
));
?>
<?php $this->renderPartial('_form', array('model'=>$model)); 
$this->endWidget();?>