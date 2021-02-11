<?php
/* @var $this RiskAllocationController */
/* @var $model RiskAllocation */
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
		<?php echo $form->labelEx($model,'idRiskCategory'); ?>
		<?php echo  $form->dropDownList($model,'idRiskCategory',Yii::app()->controller->listaCategoriasDeRiegos(),array('prompt'=>'--Seleccione un valor--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'idRiskCategory'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'allocation_party_id'); ?>
		<?php echo  $form->dropDownList($model,'allocation_party_id',Yii::app()->controller->listaParties(),array('prompt'=>'--Seleccione un valor--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'allocation_party_id'); ?>
	</div>

	<div class="form-group buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Save'); ?>
            <?php  //echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_desembolsos(); dialogoDeUpdate.dialog("close"); return false;'));  ?>

			<?php if ($model->isNewRecord==false) {


			     echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'update_documents(\'RiskAllocation\','.$model->id.');','class'=>'btn btn-success'));
				 echo CHtml::button('Cerrar', array('onclick' => 'dialogoDeUpdate.dialog("close"); return false;','class'=>'btn btn-info'));
			}else{
			      echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_documents(\'RiskAllocation\');','class'=>'btn btn-success'));
		    }

		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
