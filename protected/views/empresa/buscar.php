<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Mostrar Empresa</h3>
      </div>
      <div class="panel-body">
        <table class="table">
  <thead>
    <tr>
      <th>RUT</th>
      <th>Nombre</th>
      <th>Correo</th>
      <th>Telefono</th>
      <th>Direccion</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($empresas as $empresa):?>
      
        <td><?php echo $empresa->EMP_RUT;?></td>
        <td><?php echo $empresa->EMP_NOMBRE;?></td>
        <td><?php echo $empresa->EMP_CORREO;?></td>
        <td><?php echo $empresa->EMP_TELEFONO;?></td>
        <td><?php echo $empresa->EMP_DIRECCION;?></td>
        
        
        <td>
          <center>
            <div class="btn-group">
              <div class="input-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                  <span class="glyphicon glyphicon-cog"></span>
                </button>
                <ul class="dropdown-menu pull-right">
                <li><a href="<?php echo Yii::app()->createUrl("empresas/editar/$empresa->EMP_ID"); ?>">Editar empresa</a></li>
                  <!--trigger Modal-->
                  <li data-toggle="modal" data-target="#questionDelete<?php echo $empresa->EMP_ID?>"><a>Eliminar empresa</a></li>
                </ul>
              </div> 
            </div>
          </center>
        </td>
      </tr>
              <!-- Modal -->
    <div class="modal fade" id="questionDelete<?php echo $empresa->EMP_ID?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Eliminar Ususario</h4>
          </div>
          <div class="modal-body">
            Desea realmente eliminar a <?php echo $empresa->EMP_NOMBRE;?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" onclick="location.href='<?php echo Yii::app()->createUrl("empresas/Eliminar/$empresa->EMP_ID"); ?>'">Eliminar de todas Formas</button>
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