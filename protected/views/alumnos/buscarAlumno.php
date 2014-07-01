<?php 
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'layout' => BsHtml::FORM_LAYOUT_INLINE,
    'enableAjaxValidation' => true,
    'id' => 'user_form_inline',
    'method'=>'get',
    'htmlOptions' => array(
        'class' => 'bs-example'
    )
));?>


<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Administración de Alumnos</h3>
      </div>
      <div class="panel-body">
        <table class="table">
  <thead>
    <tr>
      <th>RUT</th>
      <th>Nombre</th>
      <th>Correo</th>
      <th>Telefono</th>
      
    </tr>
  </thead>
  <tbody>
    <?php foreach ($alumnos as $alumno):?>
      
        <td><?php echo $alumno->PER_RUT;?></td>
        <td><?php echo $alumno->PER_NOMBRE;?></td>
        <td><?php echo $alumno->PER_CORREO;?></td>
        <td><?php echo $alumno->PER_TELEFONO;?></td>
        
        
        <td>
          <center>
            <div class="btn-group">
              <div class="input-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                  <span class="glyphicon glyphicon-cog"></span>
                </button>
                <ul class="dropdown-menu pull-right">
                <li><a href="<?php echo Yii::app()->createUrl("Alumnos/editarAlumno/$alumno->PER_ID"); ?>">Editar Alumno</a></li>
                  <!--trigger Modal-->
                  <li data-toggle="modal" data-target="#questionDelete<?php echo $alumno->PER_ID?>"><a>Eliminar Aumno</a></li>
                </ul>
              </div> 
            </div>
          </center>
        </td>
      </tr>
              <!-- Modal -->
    <div class="modal fade" id="questionDelete<?php echo $alumno->PER_ID?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Eliminar Ususario</h4>
          </div>
          <div class="modal-body">
            Desea realmente eliminar a <?php echo $alumno->PER_NOMBRE;?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" onclick="location.href='<?php echo Yii::app()->createUrl("Alumnos/Eliminar/$alumno->PER_ID"); ?>'">Eliminar de todas Formas</button>
          </div>                                                                                                                                                                                                                                                                                                                                                                                     u);
        </div>
      </div>
    </div>
    <!--Fin de Modal-->
    <?php endforeach; ?>
  </tbody>
</table>
      </div>
    </div>
  <?php $this->endWidget();?>