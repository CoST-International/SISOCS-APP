<?php
/* @var $this ProgramaFuenteController */
/* @var $model ProgramaFuente */
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

	<p class="note">Campos con<span class="required">*</span> son obligatorios.</p>
        <h1><?php 
        
        echo $idContratos; 
                $modelF=$modelG;
                
                
                ?></h1>
        
        
	
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


