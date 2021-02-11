<?php
/* @var $this ShareholdersController */
/* @var $model Shareholders */
/* @var $form CActiveForm */
?>

<div class="">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contratacion-dialog-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->hiddenField($model,'idContratacion',array('value'=>$idContratacion)); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'shareholder_id'); ?>
		<?php echo $form->textField($model,'shareholder_id',array('size'=>60)); ?>
		<?php echo $form->error($model,'shareholder_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'shareholder_name'); ?>
		<?php echo $form->textField($model,'shareholder_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'shareholder_name'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'votingRights'); ?>
		<?php echo $form->textField($model,'votingRights',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'votingRights'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'votingRightsDetails'); ?>
		<?php echo $form->textField($model,'votingRightsDetails',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'votingRightsDetails'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'shareholding'); ?>
		<?php echo $form->textField($model,'shareholding',array('size'=>60)); ?>
		<?php echo $form->error($model,'shareholding'); ?>
	</div>

	<div class="form-group buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Save'); ?>
            <?php  //echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_desembolsos(); dialogoDeUpdate.dialog("close"); return false;'));  ?>

			<?php if ($model->isNewRecord==false) {


			     echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'update_documents(\'shareholders\','.$model->id.');','class'=>'btn btn-success'));
				 echo CHtml::button('Cerrar', array('onclick' => 'dialogoDeUpdate.dialog("close"); return false;','class'=>'btn btn-info'));
			}else{
			      echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_documents(\'shareholders\');','class'=>'btn btn-success'));
		    }

			?>

	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
