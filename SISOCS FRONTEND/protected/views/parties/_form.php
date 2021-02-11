<?php
/* @var $this PartiesController */
/* @var $model Parties */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'parties-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'legalName'); ?><br>
		<?php echo $form->textField($model,'legalName',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'legalName'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'uri'); ?><br>
		<?php echo $form->textField($model,'uri',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'uri'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'streetAddress'); ?><br>
		<?php echo $form->textField($model,'streetAddress',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'streetAddress'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'locality'); ?>
		<?php echo  $form->dropDownList($model,'locality',Yii::app()->Controller->listaLocality(),array('prompt'=>'--Seleccione un Valor--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'locality'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'region'); ?>
		<?php echo  $form->dropDownList($model,'region',Yii::app()->Controller->listaDepartamento(),array('prompt'=>'--Seleccione un Valor--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'region'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'countryName'); ?><br>
		<?php echo  $form->dropDownList($model,'countryName',Yii::app()->Controller->listaCountry(),array('prompt'=>'--Seleccione un Valor--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'countryName'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'contactPoint_name'); ?><br>
		<?php echo $form->textField($model,'contactPoint_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'contactPoint_name'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'contactPoint_email'); ?><br>
		<?php echo $form->textField($model,'contactPoint_email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'contactPoint_email'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'contactPoint_telephone'); ?><br>
		<?php echo $form->textField($model,'contactPoint_telephone',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'contactPoint_telephone'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'roles'); ?>
		<?php echo  $form->dropDownList($model,'roles',Yii::app()->Controller->listaPartyRol(),array('prompt'=>'--Seleccione un Valor--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'roles'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Save', array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
