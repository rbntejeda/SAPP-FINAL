<div class="panel panel-primary">
 <div class="panel-heading">
  <h3 class="panel-title">Empresas</h3>
 </div>
 <div class="panel-body">
  <table class="table">
   <thead>
    <tr>
     <th>Nombre de la empresa</th>
     <th>Rut</th>
     <th>Opciones</th>
    </tr>
   </thead>


   <tbody>
    <?php foreach ($empresas as $empresa):?>
    
    <tr>
     <td><?php echo $empresa->EMP_NOMBRE;?></td>
     <td><?php echo $empresa->EMP_RUT;?></td>
     <td>
      <div class="btn-group">
       <div class="input-group">
        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
         <span class="glyphicon glyphicon-cog"></span>
        </button>


        <ul class="dropdown-menu pull-right">
         <!-- ESTAS OPCIONES SÓLO DEBERÍAN SALIR SI EXISTE LA EMPRESA EN LA TABLA CONVENIO -->
         <?php 


         if(Convenios::model()->exists( "EMP_ID = $empresa->EMP_ID")){
          echo '<li><a href="'.Yii::app()->createUrl("Empresa/verConvenio/$empresa->EMP_ID").'">Ver convenios</a>
          </li>';
         }
         ?>

         <li> 
          <a href="<?php echo Yii::app()->createUrl("Empresa/crearConvenio/$empresa->EMP_ID"); ?>">Nuevo Convenio</a>
         </li>

        </ul>
       </div>
      </div>
     </td>
    </tr>
   
   </tr>
  <?php endforeach; ?>
 </tbody>
</table>
</div>
</div>
