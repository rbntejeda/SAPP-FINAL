<?php
/* @var $this NoticiasController */
/* @var $model Noticias */


$this->breadcrumbs=array(
	'Noticiases'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-list','label'=>'List Noticias', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Noticias', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
");
?>

<?php
$this->beginWidget('bootstrap.widgets.BsPanel', array(
    'title' => 'Administrar Noticias',
    'type' => BsHtml::PANEL_TYPE_PRIMARY
));
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo BsHtml::button('Búsqueda Avanzada',array('class' =>'search-button', 'icon' => BsHtml::GLYPHICON_SEARCH,'color' => BsHtml::BUTTON_COLOR_PRIMARY), '#'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="search-form" style="display:none">
            <?php $this->renderPartial('_search',array(
                'model'=>$model,
            )); ?>
        </div>
        <!-- search-form -->
<table class="table">
  <thead>
    <tr>
      <th>Titulo</th>
      <th style="width:20px">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($buscar as $user):?>
      <tr>
        <td><a href="<?php echo Yii::app()->createUrl("Noticias/view/$user->NOT_ID"); ?>"> <?php echo $user->NOT_TITULO;?></a></td>
        <td>
          <center>
            <div class="btn-group">
              <div class="input-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                  <span class="glyphicon glyphicon-cog"></span>
                </button>
                <ul class="dropdown-menu pull-right">
                <li><a href="<?php echo Yii::app()->createUrl("Noticias/update/$user->NOT_ID"); ?>">Editar Noticia</a></li>
                  <!--trigger Modal-->
                  <li data-toggle="modal" data-target="#questionDelete<?php echo $user->NOT_ID?>"><a>Eliminar Noticia</a></li>
                </ul>
              </div> 
            </div>
          </center>
        </td>
      </tr>
                <!-- Modal -->
    <div class="modal fade" id="questionDelete<?php echo $user->NOT_ID?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Eliminar Noticia</h4>
          </div>
          <div class="modal-body">
            Desea realmente eliminar a <?php echo $user->NOT_TITULO;?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" onclick="location.href='<?php echo Yii::app()->createUrl("Noticias/eliminar/$user->NOT_ID"); ?>'">Eliminar de todas Formas</button>
          </div>
        </div>
      </div>
    </div>
    <!--Fin de Modal-->
              <!-- Modal -->
    <!--Fin de Modal-->
    <?php endforeach; ?>
  </tbody>
</table>
    </div>
</div>
<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo $message;
    }
$this->endWidget();
?>


