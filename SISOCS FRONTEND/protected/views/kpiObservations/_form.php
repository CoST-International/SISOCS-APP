<?php
/* @var $this KpiObservationsController */
/* @var $model KpiObservations */
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

	<div class="row">
		<?php echo $form->labelEx($model,'kpi_id'); ?>
		<?php echo  $form->dropDownList($model,'kpi_id',$model->listarKPI(),array('prompt'=>'--Seleccione un Valor--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'kpi_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tittle'); ?>
		<?php echo $form->textField($model,'tittle',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'tittle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'currency'); ?><br>
		<?php echo  $form->dropDownList($model,'currency',Yii::app()->Controller->listaMonedas(),array('prompt'=>'--Seleccione un Valor--','class'=>'form-control'));?>
		<?php echo $form->error($model,'currency'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'measure'); ?>
		<?php echo $form->textField($model,'measure',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'measure'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'relatedImplementationMilestone_id'); ?>
		<?php echo  $form->dropDownList($model,'relatedImplementationMilestone_id',$model->listarImplementationMilestone(),array('prompt'=>'--Seleccione un Valor--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'relatedImplementationMilestone_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'startDate'); ?>
		<?php echo $form->textField($model,'startDate',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'startDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'endDate'); ?>
		<?php echo $form->textField($model,'endDate',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'endDate'); ?>
	</div>


	<div class="buttons">
		<?php if ($model->isNewRecord==false) {


				 echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'update_documents(\'kpiObs\','.$model->id.');','class'=>'btn btn-success'));
			 echo CHtml::button('Cerrar', array('onclick' => 'dialogoDeUpdate.dialog("close"); return false;','class'=>'btn btn-info'));
		}else{
					echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_documents(\'kpiObs\');','class'=>'btn btn-success'));
			}

		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->