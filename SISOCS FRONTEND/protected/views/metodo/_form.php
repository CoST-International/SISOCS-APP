<?php
/* @var $this MetodoController */
/* @var $model Metodo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'metodo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'adquisicion'); ?>
		<?php echo $form->textField($model,'adquisicion',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'adquisicion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'siglas'); ?>
		<?php echo $form->textField($model,'siglas',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'siglas'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->