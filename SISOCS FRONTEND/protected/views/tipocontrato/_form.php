<?php
/* @var $this TipocontratoController */
/* @var $model Tipocontrato */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tipocontrato-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con<span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'idTipoContrato'); ?>
		<?php //echo $form->textField($model,'idTipoContrato'); ?>
		<?php //echo $form->error($model,'idTipoContrato'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contrato'); ?>
		<?php echo $form->textField($model,'contrato',array('size'=>50,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'contrato'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
