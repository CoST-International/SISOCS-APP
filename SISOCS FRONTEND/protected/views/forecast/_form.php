<?php
/* @var $this ForecastController */
/* @var $model Forecast */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'proyecto-dialog-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>



	<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?><br>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'unidad'); ?><br>
		<?php echo $form->textField($model,'unidad',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'unidad'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'medida'); ?><br>
		<?php echo $form->textField($model,'medida',array('size'=>60)); ?>
		<?php echo $form->error($model,'medida'); ?>
	</div>

	<div class="buttons">
		<?php if ($model->isNewRecord==false) {


				 echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'update_documents(\'forecast\','.$model->id.');','class'=>'btn btn-success'));
			 echo CHtml::button('Cerrar', array('onclick' => 'dialogoDeUpdate.dialog("close"); return false;','class'=>'btn btn-info'));
		}else{
					echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_documents(\'forecast\');','class'=>'btn btn-success'));
			}

		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
