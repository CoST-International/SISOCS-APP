<?php
/* @var $this FuentesfinanController */
/* @var $model Fuentesfinan */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'fuentesfinan-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fuente'); ?>
		<?php echo $form->textField($model,'fuente',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'fuente'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class'=>'specialLinks')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
