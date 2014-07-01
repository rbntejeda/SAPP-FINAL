<?php
/* @var $this NoticiasController */
/* @var $model Noticias */
?>

<?php
$this->breadcrumbs=array(
	'Noticiases'=>array('index'),
	$model->NOT_ID,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Noticias', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Noticias', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Noticias', 'url'=>array('update', 'id'=>$model->NOT_ID)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Noticias', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->NOT_ID),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Noticias', 'url'=>array('admin')),
);
?>

<?php
$this->beginWidget('bootstrap.widgets.BsPanel', array(
    'title' => 'Ver Noticia '.$model->NOT_TITULO,
    'type' => BsHtml::PANEL_TYPE_PRIMARY
));
?>
<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'NOT_TITULO',
		'NOT_CONTENIDO',
	),
)); ?>
<?php echo BsHtml::formActions(array(BsHtml::button('Administrar Publicaciones',array('onclick'=>"window.location = '".Yii::app()->createUrl("Noticias/ofrecerNoticia/$model->NOT_ID")."'",'color' => BsHtml
        ::BUTTON_COLOR_PRIMARY))));?>
<?php
$this->endWidget();
?>