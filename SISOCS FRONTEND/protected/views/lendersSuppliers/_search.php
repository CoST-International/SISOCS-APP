<?php
/* @var $this LendersSuppliersController */
/* @var $model LendersSuppliers */
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
		<?php echo $form->label($model,'shareholder_id'); ?>
		<?php echo $form->textField($model,'shareholder_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shareholder_name'); ?>
		<?php echo $form->textField($model,'shareholder_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'votingRights'); ?>
		<?php echo $form->textField($model,'votingRights',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'votingRightsDetails'); ?>
		<?php echo $form->textField($model,'votingRightsDetails',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shareholding'); ?>
		<?php echo $form->textField($model,'shareholding'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->