<?php
/* @var $this ForecastObservationsController */
/* @var $model ForecastObservations */
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
		<?php echo $form->labelEx($model,'forecast_id'); ?>
		<?php echo  $form->dropDownList($model,'forecast_id',Yii::app()->Controller->listaForecast($idProyecto),array('prompt'=>'--Seleccione un Valor--','class'=>'form-control'));?>
		<?php echo $form->error($model,'forecast_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'obs_notes'); ?>
		<?php echo $form->textField($model,'obs_notes',array('size'=>68,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'obs_notes'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'obs_amount'); ?><br>
		<?php echo $form->textField($model,'obs_amount',array('size'=>68)); ?>
		<?php echo $form->error($model,'obs_amount'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'obs_currency'); ?><br>
		<?php echo  $form->dropDownList($model,'obs_currency',Yii::app()->Controller->listaMonedas(),array('prompt'=>'--Seleccione un Valor--','class'=>'form-control'));?>
		<?php echo $form->error($model,'obs_currency'); ?>
	</div>

	<div class="buttons">
		<?php if ($model->isNewRecord==false) {


				 echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'update_documents(\'forecastObs\','.$model->id.');','class'=>'btn btn-success'));
			 echo CHtml::button('Cerrar', array('onclick' => 'dialogoDeUpdate.dialog("close"); return false;','class'=>'btn btn-info'));
		}else{
					echo CHtml::Button('Guardar',array('id'=>'enviar','onclick'=>'send_documents(\'forecastObs\');','class'=>'btn btn-success'));
			}

		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
