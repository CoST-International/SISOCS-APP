<?php
/* @var $this MunicipioController */
/* @var $model Municipio */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'municipio-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con<span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idMunicipio'); ?>
		<?php echo $form->textField($model,'idMunicipio',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'idMunicipio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idDepartamento'); ?>
		<?php echo  $form->dropDownList($model,'idDepartamento',$model->listaDepartamentos(),array('prompt'=>'--Seleccione un valor--'));?>
		<?php echo $form->error($model,'idDepartamento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'municipio'); ?>
		<?php echo $form->textField($model,'municipio',array('size'=>60,'maxlength'=>85)); ?>
		<?php echo $form->error($model,'municipio'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->