<?php
/* @var $this FinanceController */
/* @var $model Finance */
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
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'financingParty_id'); ?>
		<?php echo $form->textField($model,'financingParty_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'financingParty_name'); ?>
		<?php echo $form->textField($model,'financingParty_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'financeCategory'); ?>
		<?php echo $form->textField($model,'financeCategory',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'currency'); ?>
		<?php echo $form->textField($model,'currency',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'startDate'); ?>
		<?php echo $form->textField($model,'startDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'endDate'); ?>
		<?php echo $form->textField($model,'endDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'interestRate_base'); ?>
		<?php echo $form->textField($model,'interestRate_base',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'interestRate_margin'); ?>
		<?php echo $form->textField($model,'interestRate_margin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'interestRate_fixed'); ?>
		<?php echo $form->textField($model,'interestRate_fixed'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stepInRights'); ?>
		<?php echo $form->textField($model,'stepInRights'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exchangeRateGuarantee'); ?>
		<?php echo $form->textField($model,'exchangeRateGuarantee'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'repaymentFrequency'); ?>
		<?php echo $form->textField($model,'repaymentFrequency'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->