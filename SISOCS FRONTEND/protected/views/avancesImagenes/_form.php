<?php
/* @var $this AvancesImagenesController */
/* @var $model AvancesImagenes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'avances-imagenes-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idAvances'); ?>
		<?php echo $form->textField($model,'idAvances'); ?>
		<?php echo $form->error($model,'idAvances'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_imagen'); ?>
		<?php echo $form->textField($model,'nombre_imagen',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'nombre_imagen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_fisico'); ?>
		<?php echo $form->textField($model,'nombre_fisico',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'nombre_fisico'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ubicacion_imagen'); ?>
		<?php echo $form->textField($model,'ubicacion_imagen',array('size'=>60,'maxlength'=>3000)); ?>
		<?php echo $form->error($model,'ubicacion_imagen'); ?>
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