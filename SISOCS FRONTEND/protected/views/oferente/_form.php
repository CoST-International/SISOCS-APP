<?php
/* @var $this oferenteController */
/* @var $model oferente */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'calificacion-oferente-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>
	<?php ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_oferente'); ?>
		<?php echo $form->textField($model,'nombre_oferente',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nombre_oferente'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
