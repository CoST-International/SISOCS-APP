<?php
/* @var $this ContratosController */
/* @var $model Contratos */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idContratos'); ?>
		<?php echo $form->textField($model,'idContratos',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idContratacion'); ?>
		<?php echo $form->textField($model,'idContratacion',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estatuscontrato'); ?>
		<?php echo $form->textField($model,'estatuscontrato',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nmodifica'); ?>
		<?php echo $form->textField($model,'nmodifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipomodifica'); ?>
		<?php echo $form->textField($model,'tipomodifica',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'justimodcontrato'); ?>
		<?php echo $form->textArea($model,'justimodcontrato',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'precioactual'); ?>
		<?php echo $form->textField($model,'precioactual'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechatercontra'); ?>
		<?php echo $form->textField($model,'fechatercontra'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'alcanceactucontrato'); ?>
		<?php echo $form->textArea($model,'alcanceactucontrato',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'detallesreadju'); ?>
		<?php echo $form->textArea($model,'detallesreadju',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prograini'); ?>
		<?php echo $form->textField($model,'prograini',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adendas'); ?>
		<?php echo $form->textField($model,'adendas',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prograactu'); ?>
		<?php echo $form->textField($model,'prograactu',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado'); ?>
		<?php echo $form->textField($model,'estado',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'otro'); ?>
		<?php echo $form->textField($model,'otro',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->