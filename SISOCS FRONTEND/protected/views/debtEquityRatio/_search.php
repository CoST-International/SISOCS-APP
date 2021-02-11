<?php
/* @var $this DebtEquityRatioController */
/* @var $model DebtEquityRatio */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idContratacion'); ?>
		<?php echo $form->textField($model,'idContratacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shareCapitalDetails'); ?>
		<?php echo $form->textField($model,'shareCapitalDetails',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'debtEquityRatio'); ?>
		<?php echo $form->textField($model,'debtEquityRatio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shareCapital_amount'); ?>
		<?php echo $form->textField($model,'shareCapital_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shareCapital_currency'); ?>
		<?php echo $form->textField($model,'shareCapital_currency',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'debtEquityRatioDetails'); ?>
		<?php echo $form->textField($model,'debtEquityRatioDetails',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subsidyRatio'); ?>
		<?php echo $form->textField($model,'subsidyRatio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'projectIRR'); ?>
		<?php echo $form->textField($model,'projectIRR'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subsidyRatioDetails'); ?>
		<?php echo $form->textField($model,'subsidyRatioDetails',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->