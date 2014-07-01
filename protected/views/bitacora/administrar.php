<?php 
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'layout' => BsHtml::FORM_LAYOUT_INLINE,
    'enableAjaxValidation' => true,
    'id' => 'user_form_inline',
    'method'=>'get',
    'htmlOptions' => array(
        'class' => 'bs-example'
    )
));

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
  $('.search-form').toggle();
  return false;
});");


Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/validCampoFranz.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScript('validarCamposEspeciales', "
  $('#BitAdmin_BIT_TITULO').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéíóú1234567890');

");?>

<?php if (Yii::app()->user->name == 'admin'){?>

<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Página Bitácoras Administrador</h3>
      </div>
      <div class="panel-body">

        <?php //echo $form->textField($bitacora2, 'PER_NOMBRE', array('placeholder' => 'Pablo Morales Alarcón'));?>
        <?php //echo BsHtml::submitButton('', array('color' => BsHtml::BUTTON_COLOR_PRIMARY, 'icon' =>BsHtml::GLYPHICON_PLUS));?>
        <h3 class="panel-title"><?php echo BsHtml::button('Busqueda Avanzada',array('class' =>'search-button', 'icon' => BsHtml::GLYPHICON_SEARCH,'color' => BsHtml::BUTTON_COLOR_PRIMARY), '#'); ?></h3><br>
        <div class="search-form" style="display:none">
            <?php $this->renderPartial('_search',array(
                'bitacora'=>$bitacora,
            )); ?>
        </div>
        <?php //echo $form->textField($bitacora, 'PER_NOMBRE', array('placeholder' => 'Pablo Morales Alarcón'));?>
        <?php //echo BsHtml::submitButton('', array('color' => BsHtml::BUTTON_COLOR_PRIMARY, 'icon' =>BsHtml::GLYPHICON_PLUS));?>
        
        <table class="table">
          <thead>
            <tr>
              <th>Título</th>
              <th>Contenido</th>
              <th>Fecha de Ingreso</th>
              <th>Tipo de Práctica</th>
              <th>Empresa</th>
              <th>Seleccionar</th>
            </tr>
          </thead>
          <tbody>
              <?php foreach ($buscar as $bit):?>
              <?php  if($bit->BIT_ESTADO == 'Enviada'){?>
              <tr>
                <td><?php echo $bit->BIT_TITULO;?></td>
                <td><?php echo $bit->BIT_CONTENIDO;?></td>
                <td><?php echo $bit->BIT_INGRESO;?></td>
                <td><?php echo $bit->PRA_TIPO;?></td>
                <td><?php echo $bit->EMP_NOMBRE;?></td>                
                <td>
                    <div class="btn-group">
                        <div class="input-group">
                          <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-cog"></span>
                          </button>

                          <ul class="dropdown-menu pull-right">
                            <li> 
                              <a href="<?php echo Yii::app()->createUrl("Bitacora/ver/$bit->BIT_ID"); ?>">Ver Bitácora</a>
                            </li>

                            <li> 
                              <a href="<?php echo Yii::app()->createUrl("Bitacora/Editar/$bit->BIT_ID"); ?>">Editar Bitácora</a>
                            </li>

                             <li data-toggle="modal" data-target="#questionDelete<?php echo $bit->BIT_ID?>"><a>Eliminar Bitácora</a></li>
                          </ul>
                         
                        </div> 
                    </div>
                </td>
               
              </tr>
                <!--modal-->

                <div class="modal fade" id="questionDelete<?php echo $bit->BIT_ID?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Eliminar Bitácora</h4>
                  </div>
                  <div class="modal-body">
                    Desea realmente eliminar La Bitácora 
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="location.href='<?php echo Yii::app()->createUrl("Bitacora/Eliminar/$bit->BIT_ID"); ?>'">Eliminar de todas Formas</button>
                  </div>
                </div>
              </div>
            </div>
            <!--Fin de Modal-->
               
              </tr>
              <?php } ?>
              <?php endforeach; ?>
          </tbody>
        </table>
<?php } ?>


<?php if (Yii::app()->user->name == 'alumno'){?>    
	  <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Página Bitácoras Alumno</h3>
      </div>
      <div class="panel-body">
        
        <!-- Mostrar las bitácoras del alumno en particular-->
        <?php //var_dump($bitacora->PER_ID) //tiene el ID de la persona?> 
        <?php //foreach ($nuevo as $bit):?> <!--Recorro el arreglo nuevo-->
                <?php //echo $bit->PER_ID?>
        <?php //endforeach; ?>
        
          <table class="table">
          <thead>
            <tr>
              <th>Título</th>
              <th>Contenido</th>
              <th>Estado</th>
              <th>Práctica</th>
              <th>Editar</th>
            </tr>
          </thead>
          <tbody>
                <?php foreach ($buscar as $bit):?> <!--Recorro el arreglo nuevo-->
                <?php //if($bit->PER_ID == null) $bit->PER_ID = $bitacora->PER_ID; ?> <!--si es la primera Bitácora-->
                    
                <?php //if($bit->PER_ID == $bitacora->PER_ID) {?> <!-- si los id de persona que hay en nuevo = id bitacora-->
                <tr>                  
                  <td><?php echo $bit->BIT_TITULO;?></td>
                  <td><?php echo $bit->BIT_CONTENIDO;?></td>
                  <td><?php echo $bit->BIT_ESTADO;?></td>
                  <td><?php echo $bit->PRA_ID; ?></td>
                  <td>
                    <?php if($bit->BIT_ESTADO == 'No enviada') {?>
                    <div class="btn-group">
                        <div class="input-group">
                          <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-cog"></span>
                          </button>

                          <ul class="dropdown-menu pull-right">
                            <li> 
                              <a href="<?php echo Yii::app()->createUrl("Bitacora/Editar/$bit->BIT_ID"); ?>">Editar Bitácora</a>
                            </li>
                          </ul>
                         
                        </div> 
                    </div>
                    <?php } ?>
                </td>
                </tr>
                <?php //} ?>
                <?php endforeach; ?>

          </tbody>
          </table> 
        </div>
<?php } ?>
<?php //echo $form->errorSummary($bit); ?>
<?php $this->endWidget();?>
