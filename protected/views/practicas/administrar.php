<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Alumnos en Práctica</h3>
      </div>
      <div class="panel-body">
        <table class="table">
  <thead>
    <tr>
      <th>Código de carrera</th>
      <th>Rut</th>
      <th>Nombre</th>
      <th>Estado de práctica</th>
      <th>Tipo de prática</th>
      <th> Seleccionar </th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($practicas as $practica):?>
      <tr>
        <td><?php echo $practica->CAR_CODIGO;?></td>
        <td><?php echo $practica->PER_RUT;?></td>
        <td><?php echo $practica->PER_NOMBRE;?></td>
        <td><?php echo $practica->PRA_ESTPRACTICA;?></td>
        <td><?php echo $practica->PRA_TIPO;?></td>
        <td>
          <div class="btn-group">
              <div class="input-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                  <span class="glyphicon glyphicon-cog"></span>
                </button>

                <ul class="dropdown-menu pull-right">
                  <li> 
                    <a href="<?php echo Yii::app()->createUrl("Practicas/editarPractica/$practica->PRA_ID"); ?>">Editar datos de la práctica</a>
                  </li>

                  <li> 
                    <a href="<?php echo Yii::app()->createUrl("Practicas/editarNotasInf/$practica->PRA_ID"); ?>">Editar nota informe</a>
                  </li>

                  <li> 
                    <a href="<?php echo Yii::app()->createUrl("Practicas/editarNotaEmp/$practica->PRA_ID"); ?>">Editar nota encargado empresa</a>
                  </li>
                </ul>
               
              </div> 
            </div>



          </td>
        <td><span></span></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
      </div>
    </div>
