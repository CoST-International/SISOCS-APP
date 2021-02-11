<?php
/* @var $this ImgAdjuntadasController */
/* @var $model ImgAdjuntadas */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'img-adjuntadas-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cod_contrato'); ?>
		<?php echo $form->textField($model,'cod_contrato',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'cod_contrato'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_img'); ?>
		<?php echo $form->textField($model,'nombre_img',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nombre_img'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ubicacion_img'); ?>
		<?php echo $form->textField($model,'ubicacion_img',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'ubicacion_img'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_registro'); ?>
		<?php echo $form->textField($model,'fecha_registro'); ?>
		<?php echo $form->error($model,'fecha_registro'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_registro'); ?>
		<?php echo $form->textField($model,'user_registro',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'user_registro'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->