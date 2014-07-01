<?php
/* @var $this NoticiasController */
/* @var $model Noticias */
?>

<?php
$this->breadcrumbs=array(
	'Noticiases'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Noticias', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Noticias', 'url'=>array('admin')),
);
?>
<?php
$this->beginWidget('bootstrap.widgets.BsPanel', array(
    'title' => 'Agregar Noticia',
    'type' => BsHtml::PANEL_TYPE_PRIMARY
));
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->endWidget();
?>