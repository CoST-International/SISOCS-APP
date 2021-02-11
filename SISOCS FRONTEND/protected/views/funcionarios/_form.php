<?php
/* @var $this FuncionariosController */
/* @var $model Funcionarios */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'funcionarios-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con<span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'idFuncionario'); ?>
		<?php //echo $form->textField($model,'idFuncionario'); ?>
		<?php //echo $form->error($model,'idFuncionario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idEnte'); ?>
		<?php echo $form->dropDownList($model,'idEnte',$model->listaEntes(),array('prompt'=>'--Seleccione un valor--')); ?>
		<?php echo $form->error($model,'idEnte'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>85)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'puesto'); ?>
		<?php echo $form->textField($model,'puesto',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'puesto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'telefono'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'correo'); ?>
		<?php echo $form->textField($model,'correo',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'correo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idUnidad'); ?>
		<?php //echo $form->textField($model,'idUnidad'); ?>
		<?php echo $form->dropDownList($model,'idUnidad',$model->listaUnidades($model->idUnidad),array('prompt'=>'--Seleccione un valor--')); ?>
		<?php echo $form->error($model,'idUnidad'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class'=>'specialLinks')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
