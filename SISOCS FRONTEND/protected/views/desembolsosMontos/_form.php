<?php
/* @var $this DesembolsosMontosController */
/* @var $model DesembolsosMontos */
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
		<?php echo $form->labelEx($model,'desembolso'); ?>
		<?php echo $form->textField($model,'desembolso',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'desembolso'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'monto'); ?>
		<?php echo $form->textField($model,'monto',array('size'=>16,'maxlength'=>16,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'monto'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>150,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'fecha_desembolso'); ?>
		<?php echo $form->textField($model,'fecha_desembolso',array('size'=>20,'maxlength'=>20, 'placeholder'=>'YYYY-MM-DD','class'=>'form-control')); ?>
		<?php echo $form->error($model,'fecha_desembolso'); ?>
	</div>


	<div class="form-group buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Save'); ?>
            <?php  //echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_desembolsos(); dialogoDeUpdate.dialog("close"); return false;'));  ?>

			<?php if ($model->isNewRecord==false) {


			     echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'update_documents(\'desembolso\','.$model->idDesembolso.');','class'=>'btn btn-success'));
				 echo CHtml::button('Cerrar', array('onclick' => 'dialogoDeUpdate.dialog("close"); return false;','class'=>'btn btn-info'));
			}else{
			      echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_documents(\'desembolso\');','class'=>'btn btn-success'));
		    }

			?>

	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
