<?php
/* @var $this DocAdjuntadosController */
/* @var $model DocAdjuntados */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'doc-adjuntados-form',
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
		<?php echo $form->labelEx($model,'cod_avance'); ?>
		<?php echo $form->textField($model,'cod_avance',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'cod_avance'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'nombre_doc1'); ?>
		<?php echo $form->textField($model,'nombre_doc1',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nombre_doc1'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'nombre_doc2'); ?>
		<?php echo $form->textField($model,'nombre_doc2',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nombre_doc2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_doc3'); ?>
		<?php echo $form->textField($model,'nombre_doc3',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nombre_doc3'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'nombre_doc4'); ?>
		<?php echo $form->textField($model,'nombre_doc4',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nombre_doc4'); ?>
	</div>	

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_doc5'); ?>
		<?php echo $form->textField($model,'nombre_doc5',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nombre_doc5'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'nombre_doc6'); ?>
		<?php echo $form->textField($model,'nombre_doc6',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nombre_doc6'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_doc7'); ?>
		<?php echo $form->textField($model,'nombre_doc7',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nombre_doc7'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'nombre_doc8'); ?>
		<?php echo $form->textField($model,'nombre_doc8',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nombre_doc8'); ?>
	</div>	
	
	<div class="row">
		<?php echo $form->labelEx($model,'ubicacion_doc'); ?>
		<?php echo $form->textField($model,'ubicacion_doc',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'ubicacion_doc'); ?>
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