<?php
/* @var $this SubsectorController */
/* @var $model Subsector */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'subsector-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con<span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'idSubSector'); ?>
		<?php //echo $form->textField($model,'idSubSector'); ?>
		<?php //echo $form->error($model,'idSubSector'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idSector'); ?>
		<?php //echo $form->textField($model,'idSector'); ?>
                    <?php echo $form->dropDownList($model,'idSector',$model->listaSector($model->idSector),array('prompt'=>'--Seleccione un valor--')); ?>		
		<?php echo $form->error($model,'idSector'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subsector'); ?>
		<?php echo $form->textField($model,'subsector',array('size'=>60,'maxlength'=>65)); ?>
		<?php echo $form->error($model,'subsector'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class'=>'specialLinks')); ?>
	</div>
        

<?php $this->endWidget(); ?>

</div><!-- form -->