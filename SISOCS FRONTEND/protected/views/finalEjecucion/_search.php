<?php
/* @var $this FinalEjecucionController */
/* @var $model FinalEjecucion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idFinalizacion'); ?>
		<?php echo $form->textField($model,'idFinalizacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'costoFinalizacion'); ?>
		<?php echo $form->textField($model,'costoFinalizacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'alcanceFinalizacion'); ?>
		<?php echo $form->textArea($model,'alcanceFinalizacion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechaFinalizacion'); ?>
		<?php echo $form->textField($model,'fechaFinalizacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adj_documentoGarantia'); ?>
		<?php echo $form->textField($model,'adj_documentoGarantia',array('size'=>60,'maxlength'=>252)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adj_actaRecepcion'); ?>
		<?php echo $form->textField($model,'adj_actaRecepcion',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adj_informesEvaluacion'); ?>
		<?php echo $form->textField($model,'adj_informesEvaluacion',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adj_informeDisconformidad'); ?>
		<?php echo $form->textField($model,'adj_informeDisconformidad',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adj_informeAseguramientoCalidad'); ?>
		<?php echo $form->textField($model,'adj_informeAseguramientoCalidad',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'razonesCambios'); ?>
		<?php echo $form->textField($model,'razonesCambios',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'indicador1'); ?>
		<?php echo $form->textField($model,'indicador1',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'indicador2'); ?>
		<?php echo $form->textField($model,'indicador2',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'indicador3'); ?>
		<?php echo $form->textField($model,'indicador3',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'indicador4'); ?>
		<?php echo $form->textField($model,'indicador4',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'indicador5'); ?>
		<?php echo $form->textField($model,'indicador5',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'indicador6'); ?>
		<?php echo $form->textField($model,'indicador6',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'indicador7'); ?>
		<?php echo $form->textField($model,'indicador7',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'indicador8'); ?>
		<?php echo $form->textField($model,'indicador8',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idInicioEjecucion'); ?>
		<?php echo $form->textField($model,'idInicioEjecucion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estadoContratoActual'); ?>
		<?php echo $form->textField($model,'estadoContratoActual',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usuario_creacion'); ?>
		<?php echo $form->textField($model,'usuario_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_creacion'); ?>
		<?php echo $form->textField($model,'fecha_creacion'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->