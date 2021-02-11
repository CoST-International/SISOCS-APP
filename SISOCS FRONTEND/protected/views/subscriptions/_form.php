<?php
/* @var $this SubscriptionsController */
/* @var $model Subscriptions */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'subscriptions-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<?php
		if ($model->isNewRecord) {
	?>
			<p class="note">Fields with <span class="required">*</span> are required.</p>

			<?php echo $form->errorSummary($model); ?>

			<div class="row">
				<?php echo $form->labelEx($model,'name'); ?>
				<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
				<?php echo $form->error($model,'name'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'email'); ?>
				<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
				<?php echo $form->error($model,'email'); ?>
			</div>
	<?php
		}
	?>
	<?php
		if (!$model->isNewRecord) {
	?>
			<div class="container">
				<div class="row col-md-12">
					<?php echo $form->labelEx($model,"estado"); ?>
					<?php echo  $form->dropDownList($model,"estado",array("1"=>"Confirmar","0"=>"No Confirmar"),array("prompt"=>"--Seleccione un valor--")); ?>
					<?php echo $form->error($model,"estado"); ?>
				</div> <br>
			</div>


	<?php
		}
	?>


	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
