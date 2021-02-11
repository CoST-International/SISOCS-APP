<?php
/* @var $this AwardDocumentsController */
/* @var $model AwardDocuments */
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
		<?php echo $form->label($model,'idAdjudicacion'); ?>
		<?php echo $form->textField($model,'idAdjudicacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'documentType'); ?>
		<?php echo $form->textField($model,'documentType',array('size'=>60,'maxlength'=>255)); ?>
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
		<?php echo $form->label($model,'pageStart'); ?>
		<?php echo $form->textField($model,'pageStart'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pageEnd'); ?>
		<?php echo $form->textField($model,'pageEnd'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datePublished'); ?>
		<?php echo $form->textField($model,'datePublished'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dateModified'); ?>
		<?php echo $form->textField($model,'dateModified'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'accessDetails'); ?>
		<?php echo $form->textField($model,'accessDetails',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->