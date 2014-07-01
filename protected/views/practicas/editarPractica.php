<?php $form=$this->beginWidget('CActiveForm', array(
  'id'=>'users-form',
  'enableAjaxValidation'=>true,

)); ?>

<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Editar Datos de la Práctica</h3>
      </div>
      <div class="panel-body">
        <div>
<!--Campos del Formulario-->
<table class="table">
      <thead>
        <tr>
          <th>Rut</th>
          <th>Nombre</th>
          <th>Formulario 1</th>
          <th>Formulario 2</th>
          <th>Informe</th>
          <th>Estado de Práctica</th>
          <th>Opcion</th>
        </tr>
      </thead>
      <tbody>
          <!--primer pra es de controlador y el segundo para la vista-->
        <tr>
              <td><?php echo $pra->PER_RUT;?></td>
              <td><?php echo $pra->PER_NOMBRE;?></td>
              <td><?php echo CHtml::activeCheckBox($pra,'PRA_ESTF1',array('Value'=>1)); ?></td>   <!-- modifico en PRA_ESTF1-->
              <td><?php echo CHtml::activeCheckBox($pra,'PRA_ESTF3'); ?></td>  <!-- modifico en PRA_ESTF3-->
              <td><?php echo CHtml::activeCheckBox($pra,'PRA_ESTINFORME'); ?></td>  <!-- modifico en PRA_ESTINFORME-->
              <td>
              <?php if (Yii::app()->user->name == 'admin') 
              {
                echo 
                    $form->dropDownList(
                      $pra,'PRA_ESTPRACTICA',
                      array('Aprobado'=>'Aprobado','Rechazado'=>'Rechazado', 
                          'Pendiente'=>'Pendiente','NCR'=>'NCR'), 
                      array('options' => array($pra->PRA_ESTPRACTICA=>array('selected'=>true)),'class'=>'form-control'))
                  ;
              }?>
              </td>
              <td>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Guardar</button>
                </div>
              </td>
              
        </tr>
            
  
       
      </tbody>
    </table>
    <?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="grabado_ok">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
            <?php echo $form->error($pra,'PRA_ESTPRACTICA'); ?>
            <?php echo $form->errorSummary($prac); ?>
    </div>
      </div>
    </div>



    <?php $this->endWidget();?>