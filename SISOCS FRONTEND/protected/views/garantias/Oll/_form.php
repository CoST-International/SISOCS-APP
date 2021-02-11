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
		<?php echo $form->labelEx($model,'idInicioEjecucion'); ?>
		<?php echo $form->textField($model,'idInicioEjecucion',array('value'=>$idInicioEjecucion)); ?>
		<?php echo $form->error($model,'idInicioEjecucion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idTipoGarantia'); ?>
		<?php echo $form->textField($model,'idTipoGarantia'); ?>
		<?php echo $form->error($model,'idTipoGarantia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_vencimiento'); ?>
		<?php echo $form->textField($model,'fecha_vencimiento'); ?>
		<?php echo $form->error($model,'fecha_vencimiento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'monto'); ?>
		<?php echo $form->textField($model,'monto'); ?>
		<?php echo $form->error($model,'monto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->textField($model,'estado',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'usuario_creacion'); ?>
		<?php echo $form->textField($model,'usuario_creacion'); ?>
		<?php echo $form->error($model,'usuario_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_creacion'); ?>
		<?php echo $form->textField($model,'fecha_creacion'); ?>
		<?php echo $form->error($model,'fecha_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'usuario_publicacion'); ?>
		<?php echo $form->textField($model,'usuario_publicacion'); ?>
		<?php echo $form->error($model,'usuario_publicacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_publicacion'); ?>
		<?php echo $form->textField($model,'fecha_publicacion'); ?>
		<?php echo $form->error($model,'fecha_publicacion'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->