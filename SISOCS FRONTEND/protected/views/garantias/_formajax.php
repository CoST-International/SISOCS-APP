<?php
/* @var $this GarantiasController */
/* @var $model Garantias */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'garantias-form',
	'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'afterValidate'=>'js:$.yii.fix.ajaxSubmit.afterValidate'
        ),
)); ?>

	<p class="note">Campos con * <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>



	<div class="row">
		<?php //echo $form->labelEx($model,'idInicioEjecucion'); ?>
		<?php echo $form->hiddenField($model,'idInicioEjecucion',array('value'=>$idInicioEjecucion)); ?>
		<?php echo $form->error($model,'idInicioEjecucion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idTipoGarantia'); ?>
		<?php echo $form->dropDownList($model,'idTipoGarantia',$model->listaTipoGarantias(),array('prompt'=>'--Seleccione un valor--')); ?>
		<?php echo $form->error($model,'idTipoGarantia'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'fecha_vencimiento'); ?>
		<?php echo $form->textField($model,'fecha_vencimiento',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'fecha_vencimiento'); ?>
		
                        
                        
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'monto'); ?>
		<?php echo $form->textField($model,'monto'); ?>
		<?php echo $form->error($model,'monto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->dropDownList($model,'estado',$model->listaEstados()); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'usuario_creacion'); ?>
            <?php  
                $usuarioActual=Yii::app()->user->id;
                if ($model->isNewRecord) {
                echo $form->hiddenField($model,'usuario_creacion',array('value'=>$usuarioActual)); 
            }  
            else {
                //echo $usuarioActual;
            ?>
		<?php echo $form->hiddenField($model,'usuario_creacion',array('value'=>$model->usuario_creacion)); ?>
            <?php } ?>
                <?php echo $form->error($model,'usuario_creacion'); ?>
	</div>

	

	

	<!--<div class="buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Save'); ?>
	</div> -->
	<div class="buttons">
		<?php echo CHtml::Button('Enviar',array('id'=>'enviar','onclick'=>'send_Garantias();')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->