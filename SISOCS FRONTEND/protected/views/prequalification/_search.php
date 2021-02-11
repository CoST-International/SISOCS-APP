<?php
/* @var $this PrequalificationController */
/* @var $model Prequalification */
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
		<?php echo $form->label($model,'idProyecto'); ?>
		<?php echo $form->textField($model,'idProyecto'); ?>
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
		<?php echo $form->label($model,'durationInDays'); ?>
		<?php echo $form->textField($model,'durationInDays'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'enquiryPeriod_startDate'); ?>
		<?php echo $form->textField($model,'enquiryPeriod_startDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'enquiryPeriod_endDate'); ?>
		<?php echo $form->textField($model,'enquiryPeriod_endDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'qualificationPeriod_startDate'); ?>
		<?php echo $form->textField($model,'qualificationPeriod_startDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'qualificationPeriod_endDate'); ?>
		<?php echo $form->textField($model,'qualificationPeriod_endDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'eligibilityCriteria'); ?>
		<?php echo $form->textField($model,'eligibilityCriteria'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->