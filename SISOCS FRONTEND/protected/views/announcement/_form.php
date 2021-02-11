<?php
/* @var $this AnnouncementController */
/* @var $model Anuncio */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'announcement-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('size'=>60,'maxlength'=>256,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date',array('class'=>'form-control','placeholder'=>'aaaa-mm-dd')); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="form-group">
			<?php echo $form->labelEx($model,'idProyecto'); ?>
			<?php echo $form->dropDownList($model,'idProyecto',$model->listaProyectos(),array('prompt'=>'--Seleccione un valor--'	)); ?>
			<?php echo $form->error($model,'idProyecto'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>
	<script>
		$(document).ready(function(){
			$("#Announcement_date").datepicker({
				uiLibrary: "bootstrap4",
				dateFormat: 'yy-mm-dd'
			});
		})

	</script>

<?php $this->endWidget(); ?>

</div><!-- form -->
