<?php
/* @var $this TipoModContratoController */
/* @var $model TipoModContrato */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tipo-mod-contrato-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'idTipoModificacion'); ?>
		<?php //echo $form->textField($model,'idTipoModificacion'); ?>
		<?php //echo $form->error($model,'idTipoModificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_modificacion'); ?>
		<?php echo $form->textField($model,'tipo_modificacion',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'tipo_modificacion'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
