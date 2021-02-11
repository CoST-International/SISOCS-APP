<?php
/* @var $this GarantiasController */
/* @var $model Garantias */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'garantias-form',
	'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'afterValidate'=>'js:$.yii.fix.ajaxSubmit.afterValidate'
        ),
)); ?>

	<p class="note">Campos con<span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php //echo $form->labelEx($model,'idInicioEjecucion'); ?>
		<?php
                    if(isset($idInicioEjecucion)){
                         echo $form->hiddenField($model,'idInicioEjecucion',array('value'=>$idInicioEjecucion));
                        //'value'=>$idInicioEjecucion
                    }else{
                         echo $form->hiddenField($model,'idInicioEjecucion');
                    }
                //echo $form->hiddenField($model,'idInicioEjecucion');

                ?>
		<?php echo $form->error($model,'idInicioEjecucion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idTipoGarantia'); ?>
		<?php echo $form->dropDownList($model,'idTipoGarantia',$model->listaTipoGarantias(),array('prompt'=>'--Seleccione un valor--')); ?>
		<?php echo $form->error($model,'idTipoGarantia'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'fecha_vencimiento'); ?>
		<?php //echo $form->textField($model,'fecha_vencimiento'); ?>
		<?php //echo $form->error($model,'fecha_vencimiento'); ?>
		<?php echo $form->labelEx($model,'fecha_vencimiento'); ?>
				<?php
				if ($model->fecha_vencimiento!='') {
				$model->fecha_vencimiento=date('Y-m-d h:m:s',strtotime($model->fecha_vencimiento));
				}
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'attribute'=>'fecha_vencimiento',
				'value'=>$model->fecha_vencimiento,
				'language' => 'es',
				'htmlOptions' => array('readonly'=>"readonly",),
				'options'=>array(
				'autoSize'=>true,
				'defaultDate'=>$model->fecha_vencimiento,
				'dateFormat'=>'dd-mm-yy',
				'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.gif',
				'buttonImageOnly'=>true,
				'buttonText'=>' Click aqui',
				'selectOtherMonths'=>true,
				'showAnim'=>'slide',
				'showButtonPanel'=>true,
				'showOn'=>'button',
				'showOtherMonths'=>true,
				'changeMonth' => 'true',
				'changeYear' => 'true',
				'yearRange' => '1990:2020',
				),
				)); ?>
				<?php echo $form->error($model,'fecha_vencimiento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'monto'); ?>
		<?php echo $form->textField($model,'monto'); ?>
		<?php echo $form->error($model,'monto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->dropDownList($model,'estado',$model->listaEstados()); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'usuario_creacion'); ?>
            <?php
                $usuarioActual=Yii::app()->user->id;
                if ($model->isNewRecord) {
                echo $form->hiddenField($model,'usuario_creacion',array('value'=>$usuarioActual));
            }
            else {
                //echo $usuarioActual;
            ?>
		<?php echo $form->hiddenField($model,'usuario_creacion',array('value'=>$model->usuario_creacion)); ?>
            <?php } ?>
                <?php echo $form->error($model,'usuario_creacion'); ?>
	</div>

	<div class="row">
        <?php

                if ($model->isNewRecord) {
                    $fechaCreacion=date("Y-m-d H:i:s");
                echo $form->hiddenField($model,'fecha_creacion',array('value'=>$fechaCreacion));
            }
            else {
                //echo $usuarioActual;
                echo $form->labelEx($model,'fecha_creacion');
            ?>
          <?php echo $form->textField($model,'fecha_creacion',array('value'=>$model->fecha_creacion,'disabled'=>'true')); ?>
          <?php } ?>
        <?php echo $form->error($model,'fecha_creacion'); ?></div>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear Garantia' : 'Guardar',array('class'=>'specialLinks')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
