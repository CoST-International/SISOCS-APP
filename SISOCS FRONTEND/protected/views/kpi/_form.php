<?php
/* @var $this KpiController */
/* @var $model Kpi */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'implementation-dialog-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tittle'); ?><br>
		<?php echo $form->textField($model,'tittle',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'tittle'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="buttons">
		<?php if ($model->isNewRecord==false) {


				 echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'update_documents(\'kpi\','.$model->id.');','class'=>'btn btn-success'));
			 echo CHtml::button('Cerrar', array('onclick' => 'dialogoDeUpdate.dialog("close"); return false;','class'=>'btn btn-info'));
		}else{
					echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_documents(\'kpi\');','class'=>'btn btn-success'));
			}

		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
