<div class="panel panel-primary">
 <div class="panel-heading">
  <h3 class="panel-title">Convenios con la empresa</h3>
 </div>
 <div class="panel-body">
  <table class="table">
   <thead>
    <tr>
     <th>Nombre de la empresa</th>
     <th>Rut</th>
     <th>Estado</th>
     <th>Descripción</th>
     <th>Ingreso</th>
     <th>Término</th>
     <th>Opciones</th>
    </tr>
   </thead>

   <tbody>
    <?php foreach ($convEmpresa as $conv):?>
    <tr>
      <td><?php echo $conv->EMP_NOMBRE;?></td>
      <td><?php echo $conv->EMP_RUT;?></td>
      <td><?php echo $conv->CON_ESTADO;?></td>
      <td><?php echo $conv->CON_DESCRIPCION;?></td>
      <td><?php echo $conv->CON_INGRESO;?></td>
      <td><?php echo $conv->CON_TERMINO;?></td>
      <td>
      <div class="btn-group">
       <div class="input-group">
        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
         <span class="glyphicon glyphicon-cog"></span>
        </button>
        <ul class="dropdown-menu pull-right">
          <li> 
            <a href="<?php echo Yii::app()->createUrl("Empresa/editarConvenio/$conv->CON_ID"); ?>">Editar</a> 
               <!--trigger Modal-->
              <li data-toggle="modal" data-target="#questionDelete<?php echo $conv->CON_ID?>"><a>Eliminar convenio</a></li>
          </li>
        </ul>
      </td>

    

        <!-- Modal -->
    <div class="modal fade" id="questionDelete<?php echo $conv->CON_ID?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Eliminar convenio</h4>
          </div>
          <div class="modal-body">
           ¿Desea realmente eliminar el convenio?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" onclick="location.href='<?php echo Yii::app()->createUrl("Empresa/borrarConvenio/$conv->CON_ID"); ?>'">Eliminar de todas Formas</button>
          </div>
        </div>
      </div>
    </div>
    <!--Fin de Modal-->
    </tr>
    
     <?php endforeach; ?>
 </tbody>
</table>
</div>
</div>
