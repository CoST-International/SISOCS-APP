<?php
/* @var $this ProgramaController */
/* @var $model Programa */
/* @var $form CActiveForm */
?>

<div class="">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'programa-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
'enableAjaxValidation' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Campos con  <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php
                echo $form->textField($model,'idPrograma',array('size'=>20,'maxlength'=>20,
                            'visibility' => 'none','id'=>'idcod'));
                echo $form->labelEx($model,'programa'); ?>
		<?php echo $form->textField($model,'programa',array('size'=>20,'maxlength'=>20,'disabled' => 'disabled')); ?>
		<?php echo $form->error($model,'programa'); ?>
	</div>

	<!--<div class="form-group">
		<?php echo $form->labelEx($model,'BIP'); ?>
		<?php echo $form->textField($model,'BIP',array('size'=>20,'maxlength'=>20,'autofocus' => 'autofocus')); ?>
		<?php echo $form->error($model,'BIP'); ?>
	</div>-->

	<div class="form-group">
		<?php echo $form->labelEx($model,'nombreprograma'); ?>
		<?php echo $form->textArea($model,'nombreprograma',array('size'=>60,'maxlength'=>250,'rows'=>5,'cols'=>60,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'nombreprograma'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'entes'); ?>
		<?php 
                echo $form->dropDownList($model, 'entes', $model->listaEntes(), array(
            'prompt' => '--Selecicone un valor--',
            'ajax' => array(
                'url' => CController::createUrl('/programa/ListaFuncionario'), //only if you want an action here
                'type' => 'POST',
                'data' => array('id' => 'js:$(this).val()'),
                'success' => ' function(html){
                                $("#Programa_idFuncionario").empty();
                                $("#Programa_idFuncionario").append("<option>--Seleccione un valor--</option>");
                                $("#Programa_idFuncionario").append(html);   
                                 }  //or any other jQuery selector
                                ',
                'error' => 'function(){
                              $("#Programa_idFuncionario").empty();
                              $("#Programa_idFuncionario").append("<option>--Seleccione un valor--</option>");
        f                    }')
        ,'class'=>'form-control'
        ));
                ?>
		<?php echo $form->error($model,'entes'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'idFuncionario'); ?>
		<?php 
                echo $form->dropDownList($model, 'idFuncionario', array($model->idFuncionario => $model->idFuncionario), array(
            'prompt' => '--Seleccione un valor--','class'=>'form-control'));
        ?>
		<?php echo $form->error($model,'idFuncionario'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'idRol'); ?>
		<?php 
                echo $form->dropDownList($model, 'idRol', $model->listaRol(), array(
            'prompt' => '--Seleccione un valor--','class'=>'form-control'));
                ?>
		<?php echo $form->error($model,'idRol'); ?>
	</div>
        <div class="form-group">
		<?php echo $form->labelEx($model,'idProposito'); ?>
		<?php 
    //echo $form->dropDownList($model, 'idProposito', $model->listaPropositos(), array('prompt' => '--Seleccione un valor--',));
              if ($model->isNewRecord) {
            echo '<p style="color:Red;">Guarde para poder agregar prop&oacutesito</p>';
        }  else {
                echo CHtml::ajaxLink(Yii::t('job', 'Agregar Prop&oacutesito'), array('programaProposito/create2'), array(
                        'success' => 'js:function(data){
                                        //utiliza dialog jquery
                                        //utiliza dialog fancybox
                                         var x=$("#idcod").val();//$("#Programa_idPrograma").val();//alert(x);
                                        $.fancybox({content:data,closeBtn:false,showNavArrows:false});
                                        $("#ProgramaProposito_idprograma").val(x);
                                }'));
                 
        }   
                ?>
		<?php echo $form->error($model,'idProposito'); ?>
	</div>
        <div class="form-group">
            <div id="filas_proposito"></div>
        </div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'idSector'); ?>
	<?php	echo $form->dropDownList($model, 'idSector', $model->listaSector(), array(
            'prompt' => '--Selecicone un valor--',
            'ajax' => array(
                'url' => CController::createUrl('/programa/ListaSubsector'), //only if you want an action here
                'type' => 'POST',
                'data' => array('id' => 'js:$(this).val()'),
                'success' => ' function(html){
                                $("#Programa_idSubSector").empty();
                                $("#Programa_idSubSector").append("<option>--Seleccione un valor--</option>");
                                $("#Programa_idSubSector").append(html);   
                                 }  //or any other jQuery selector
                                '),
            'error' => 'function(){
                               $("#Programa_idSubSector").append("<option>--Seleccione un valor--</option>");
                            }','class'=>'form-control'
        ));
        ?>
		<?php echo $form->error($model,'idSector'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'idSubSector'); ?>
		<?php echo $form->dropDownList($model, 'idSubSector', array($model->idSubSector => $model->idSubSector), array('prompt' => '--Seleccione un valor--','class'=>'form-control')); ?>
		<?php echo $form->error($model,'idSubSector'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion',array('size'=>60,'maxlength'=>250,'cols'=>60,'rows'=>5,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'costoesti'); ?>
		<?php echo $form->textField($model,'costoesti',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'costoesti'); ?>
	</div>
        <div class="form-group">
		<?php echo $form->labelEx($model,'moneda'); ?>
		<?php //echo $form->textField($model,'moneda'); 
                 echo $form->dropDownList($model, 'moneda',$model->listaMoneda(), array(
            'prompt' => '--Seleccione un valor--','class'=>'form-control'));
                ?>
		<?php echo $form->error($model,'moneda'); ?>
	</div>
        <?php
        if ($model->isNewRecord) {
            echo '<p style="color:Red;">Guarde para poder agregar fuentes</p>';
        }  else {
                echo CHtml::ajaxLink(Yii::t('job', 'Agregar Fuentes'), array('ProgramaFuente/create2'), array(
                        'success' => 'js:function(data){
                                        //utiliza dialog jquery
                                        //utiliza dialog fancybox
                                        var x=$("#idcod").val();//$("#Programa_idPrograma").val();
                                        $.fancybox({content:data,closeBtn:false,showNavArrows:false});
                                        $("#ProgramaFuente_idPrograma").val(x);
                                }'));
                 
        }
          $this->widget('application.extensions.fancybox.EFancyBox', array(
                        'target' => 'a[class=fancybox1]',
                        'config' => array(),
                            )
                    );
        ?>
	<div class="form-group">
            <div id="filas"></div>
        </div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'fechaapro'); ?>
		<?php
        
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'language' => 'es',
            'model' => $model,
            'attribute' => 'fechaapro',
            'language' => 'es',
            'options' => array(
                //'firstDay'=>1,
                //'showOn'=>"both",
                //'buttonImage'=>"images/calendar.gif",
                'buttonImageOnly' => true,
                //'minDate'=>-31,
                //'maxDate'=>0,
                'constrainInput' => true,
                'currentText' => 'Now',
                'dateFormat' => 'dd/mm/yy',
                'changeMonth' => 'true',
                'changeYear' => 'true',
                'duration' => 'fast',
                'showAnim' => 'fold',
            ),
            'htmlOptions' => array(
                'class' => 'shadowdatepicker'
            ),
        ));
        ?>
		<?php echo $form->error($model,'fechaapro'); ?>
	</div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cartaconvenio'); ?>
        <?php
        echo $form->textField($model, 'cartaconvenio', array('size' => 60, 'maxlength' => 150));
        echo $form->fileField($model, 'image1');
        echo $form->error($model, 'image1');
        ?>

        <?php echo $form->error($model, 'cartaconvenio'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'otro1'); ?>
        <?php
        echo $form->textField($model, 'otro1', array('size' => 60, 'maxlength' => 150));
        echo $form->fileField($model, 'image2');
        echo $form->error($model, 'image2');
        ?>
        <?php echo $form->error($model, 'otro1'); ?>
    </div>

    <div class="form-group">
<?php echo $form->labelEx($model, 'planope'); ?>
<?php
echo $form->textField($model, 'planope', array('size' => 60, 'maxlength' => 150));
echo $form->fileField($model, 'image3');
echo $form->error($model, 'image3');
?>
        <?php echo $form->error($model, 'planope'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'presupuesto'); ?>
        <?php
        echo $form->textField($model, 'presupuesto', array('size' => 60, 'maxlength' => 150));
        echo $form->fileField($model, 'image4');
        echo $form->error($model, 'image4');
        ?>
<?php echo $form->error($model, 'presupuesto'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'perfildelprogra'); ?>
        <?php
        echo $form->textField($model, 'perfildelprogra', array('size' => 60, 'maxlength' => 150));
        echo $form->fileField($model, 'image5');
        echo $form->error($model, 'image5');
        ?>
        <?php echo $form->error($model, 'perfildelprogra'); ?>
    </div>

    <div class="form-group">
<?php echo $form->labelEx($model, 'otro2'); ?>
<?php
echo $form->textField($model, 'otro2', array('size' => 60, 'maxlength' => 150));
echo $form->fileField($model, 'image6');
echo $form->error($model, 'image6');
?>
        <?php echo $form->error($model, 'otro2'); ?>
    </div>

	<div class="form-group">
		<?php //echo $form->labelEx($model,'fechacreacion'); ?>
		<?php echo $form->textField($model,'fechacreacion',array('hidden' => 'hidden', 'value' => date('d/m/Y', time()))); ?>
		<?php //echo $form->error($model,'fechacreacion'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php  
                
                echo $form->dropDownList($model, 'estado', $this->ListaEstados(), array('prompt' => '--Seleccione un valor--'));
                
                ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>
       
	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks'));
                ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
    $(function(){
     cargaFuente();cargaProposito();        
    });
   
function cargaFuente(){
$('#filas').load('<?php echo CController::createUrl("/programa/Viewdet&idPrograma=".$model->idPrograma); ?>');}

function cargaProposito(){
$('#filas_proposito').load('<?php echo CController::createUrl("/programa/ViewDetpropositos&id=".$model->idPrograma); ?>');}

</script>
