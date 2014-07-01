<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    'enableAjaxValidation' => true,
    'id' => 'user_form_horizontal',
    'htmlOptions' => array(
        'class' => 'bs-example'
        )
    ));


Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/validCampoFranz.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScript('validarCamposEspeciales', "
    $('#Convenio_CON_DESCRIPCION').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéíóú1234567890-%;:,@().');");
    ?>


    <div class="panel panel-primary">
       <div class="panel-heading">
          <h3 class="panel-title">Editar convenio</h3>
      </div>
      <form method="post">
        <div class="panel-body">


            <?php
            echo $form->textFieldControlGroup($nombre, 'EMP_NOMBRE', array('readonly'=>'false'));
            echo $form->textFieldControlGroup($convenio,'CON_INGRESO', array('placeholder'=>'Mínimo 6 meses antes y máximo 6 meses después de la fecha actual.')); 
            echo $form->textFieldControlGroup($convenio,'CON_TERMINO', array('placeholder'=>'Máximo 10 años a partir de la fecha actual'));?>

             <!--
            <br>
            <label>Fecha inicio</label> <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
               'model'=>$convenio,
               'attribute'=>'CON_INGRESO',
               'value'=>$convenio->CON_INGRESO,
               'language' => 'es',
               'htmlOptions' => array('class'=>'form-control','type'=>'date'),
               'options'=>array(
                 'autoSize'=>true,
                 'defaultDate'=>$convenio->CON_INGRESO,
                 'dateFormat'=>'yy-mm-dd',
                 'minDate'=>"-6M",
                 'maxDate'=>"+10Y",
                 //'max'=>'0000-00-00',
                 'selectOtherMonths'=>true,
                 'showAnim'=>'slide',
                 'showButtonPanel'=>true,

                 'showOtherMonths'=>true,
                 'changeMonth' => 'true',
                 'changeYear' => 'true',
                 )
               ));
               ?>-->
            <!--
            <br>
            <label>Fecha Termino</label> <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
               'model'=>$convenio,
               'attribute'=>'CON_TERMINO',
               'value'=>$convenio->CON_TERMINO,
               'language' => 'es',
               'htmlOptions' => array('class'=>'form-control','type'=>'date'),
               'options'=>array(
                 'autoSize'=>true,
                 'defaultDate'=>$convenio->CON_TERMINO,
                 'dateFormat'=>'yy-mm-dd',
                 'minDate'=>"-6M",
                 'maxDate'=>"+10Y",
                 //'max'=>'0000-00-00',
                 'selectOtherMonths'=>true,
                 'showAnim'=>'slide',
                 'showButtonPanel'=>true,

                 'showOtherMonths'=>true,
                 'changeMonth' => 'true',
                 'changeYear' => 'true',
                 )
               ));
               ?>-->

            <?php
            echo $form->dropDownListControlGroup($convenio, 'CON_ESTADO', array('VIGENTE'=>'VIGENTE','NO VIGENTE'=>'NO VIGENTE'));
            ?>

            <?php echo $form->textAreaControlGroup($convenio,'CON_DESCRIPCION', array('rows'=>'3', 'cols'=>'3', 'style' => 'resize:none', 'placeholder'=>'Descripción del convenio')); ?>

            <br><br>

            <?php if(Yii::app()->user->hasFlash('success')):?>
            <div class="grabado_ok">
                <?php echo Yii::app()->user->getFlash('success'); ?>
            </div>
        <?php endif; ?>
        <div align='center'><?php echo BsHtml::submitButton('Actualizar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?></div>


    </div>
</form>
</div>

<?php echo $form->errorSummary($convenio); ?>
<?php $this->endWidget(); ?>