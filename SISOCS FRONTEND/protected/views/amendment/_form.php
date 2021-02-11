<?php
/* @var $this AmendmentController */
/* @var $model Amendment */
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

	<div class="form-group ">
		<?php echo $form->labelEx($model,'date'); ?><br>
		<?php echo $form->textField($model,'date',array('size'=>60,'placeholder'=>'aaaa-mm-dd')); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="form-group ">
		<?php echo $form->labelEx($model,'rationale'); ?>
		<?php echo $form->textField($model,'rationale',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'rationale'); ?>
	</div>

	<div class="form-group ">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="form-group ">
		<?php echo $form->labelEx($model,'amendsReleaseID'); ?>
		<?php echo $form->textField($model,'amendsReleaseID',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'amendsReleaseID'); ?>
	</div>



	<div class="form-group buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Save'); ?>
            <?php  //echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_desembolsos(); dialogoDeUpdate.dialog("close"); return false;'));  ?>

			<?php if ($model->isNewRecord==false) {


			     echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'update_documents(\'amendment\','.$model->id.');','class'=>'btn btn-success'));
				 echo CHtml::button('Cerrar', array('onclick' => 'dialogoDeUpdate.dialog("close"); return false;','class'=>'btn btn-info'));
			}else{
			      echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_documents(\'amendment\');','class'=>'btn btn-success'));
		    }

			?>

	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
