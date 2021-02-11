<?php
/* @var $this ImplementationMilestoneController */
/* @var $model ImplementationMilestone */
/* @var $form CActiveForm */
?>

<div class="">

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
		<?php echo $form->hiddenField($model,'idInicioEjecucion',array('value'=>$idInicioEjecucion)); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'dueDate'); ?>
		<?php echo $form->textField($model,'dueDate',array('size'=>20,'maxlength'=>20,'placeholder'=>'AAAA-MM-DD','readonly'=>false,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'dueDate'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'dateMet'); ?>
		<?php echo $form->textField($model,'dateMet',array('size'=>20,'maxlength'=>20,'placeholder'=>'AAAA-MM-DD','readonly'=>false,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'dateMet'); ?>
	</div>

	<div class="form-group buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Save'); ?>
            <?php  //echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_desembolsos(); dialogoDeUpdate.dialog("close"); return false;'));  ?>

			<?php if ($model->isNewRecord==false) {


			     echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'update_documents(\'milestone\','.$model->id.');'));
				 echo CHtml::button('Cerrar', array('onclick' => 'dialogoDeUpdate.dialog("close"); return false;'));
			}else{
			      echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_documents(\'milestone\');'));
		    }

			?>

	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
