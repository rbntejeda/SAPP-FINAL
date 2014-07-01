<!--

/************************************************************************/
/*  Nombre del archivo:   editarNotasInf.php                               */
/* Descripción:  Vista correspondiente a la edicion de notas de alumno.  */
/*                Notas del informe.                                   */
/*Nota: La validación de notas se puede apreciar más en Google Chrome, */
 /*       la vista en Mozilla Firefox se encuentra aún en proceso         */
/***********************************************************************/
-->


<!--Cactive Form ayuda en la creacion de formularios yii -->

<?php $form=$this->beginWidget('CActiveForm', array(
  'id'=>'users-form',
  'enableAjaxValidation'=>true,
)); ?>


<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Editar notas de informe para <?php echo $nota->PER_NOMBRE.' - Practica '.$nota->PRA_TIPO?></h3>
      </div>
      <div class="panel-body">
        <div>
<!--Campos del Formulario-->

<!-- errorSummary() Muestra un resumen de los errores 
  de validación de uno o varios modelos.-->
<form method="post">
<table class="table">
      <thead>
        <tr>
          <th>Nota</th>
          <th>Nueva nota<th>
        </tr>
      </thead>
      <tbody>
          
        <tr>
             <td><?php echo $nota->PRA_EVAPROFESOR?></td>  
             <!-- NumberField() genera una entrada de campo de numero -->
              <td><?php echo $form->numberField($nota,'PRA_EVAPROFESOR',
              array('class'=>"form-control",'min'=>2.0,'max'=>7.0,'placeholder'=>'Nueva Nota','step'=>0.1)); ?></td>
              <td>                
                  <button type="submit" class="btn btn-default" name="guarda">Guardar</button>           
              </td>              
        </tr>      
  
      
      </tbody>
    </table></form> 
<?php echo $form->error($nota,'PRA_EVAPROFESOR'); ?>
    </div>
      </div>
    </div>




    <?php $this->endWidget();?>


