<?php
/* @var $this FinalEjecucionController */
/* @var $model FinalEjecucion */
/* @var $form CActiveForm */
//$model = new FinalEjecucion();
?>

<div class="">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'final-ejecucion-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
));

//$dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 8, 51);

//echo $dir;


?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php //echo //$form->errorSummary($model); ?>


	<div class="form-group">
		<?php echo $form->labelEx($model,'costoFinalizacion'); ?>
		<?php echo $form->textField($model,'costoFinalizacion'); ?>
		<?php echo $form->error($model,'costoFinalizacion'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'alcanceFinalizacion'); ?>
		<?php echo $form->textArea($model,'alcanceFinalizacion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'alcanceFinalizacion'); ?>
	</div>

	<div class="form-group">
		<?php //echo $form->labelEx($model,'fechaFinalizacion'); ?>
		<?php //echo $form->textField($model,'fechaFinalizacion'); ?>
		<?php //echo $form->error($model,'fechaFinalizacion'); ?>
		<?php echo $form->labelEx($model,'fechaFinalizacion'); ?>
		<?php //$model->fechaFinalizacion=date('Y-m-d',strtotime($model->fechaFinalizacion));

$this->widget('zii.widgets.jui.CJuiDatePicker', array(
'model'=>$model,
'attribute'=>'fechaFinalizacion',
'value'=>$model->fechaFinalizacion,
'language' => 'es',
'htmlOptions' => array('readonly'=>"readonly"),
'options'=>array(
'autoSize'=>true,
'defaultDate'=>$model->fechaFinalizacion,
'dateFormat'=>'yy-mm-dd',
'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.gif',
'buttonImageOnly'=>true,
'buttonText'=>' Click aqui',
'selectOtherMonths'=>true,
'showAnim'=>'slide',
'showButtonPanel'=>true,
'showOn'=>'button',
'yearRange'=>'1980:2099',
'showOtherMonths'=>true,
'changeMonth' => 'true',
'changeYear' => 'true',
'yearRange' => '-20:+20',
),
)); ?>
	</div>

	<?php
		if ($model->isNewRecord) {
				echo '<p style="color:Red;">Guarde para poder agregar documentos</p>';
		} else {
				echo CHtml::ajaxLink(Yii::t('job', 'Agregar Documentos'),
									$this->createUrl('FinalizacionDocuments/create', array('id'=>$model->idFinalizacion)),
									array(    'success'=>'js:function(data) {
													updateDialog.dialog("open");
													document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
													initDateInputs();
												}',
											'update' => '#filas_desembolsos'
									)
							);


	}
	$this->beginWidget('zii.widgets.jui.CJuiDialog',
			array(
				'id'=>'tender-documents-form-dialog',
					'options'=>array(
						'title'=>Yii::t('job', 'Agregar Documento'),
										'autoOpen'=>false,
										'modal'=>'true',
										'resizeable'=>true,
										'show' => 'fold',
										'hide' => 'drop',
										'width'=>600,
										'height'=>650,
										'overlay'=>array('backgroundColor'=>'#000','opacity'=>'3.5'),
					),
			)
			);

	echo "<div id='ContenidoAgregarDocuments'></div>";

	if (Yii::app()->user->hasFlash('Error')) {
		echo '<div class="flash-success">';
		echo Yii::app()->user->getFlash('Error');
		echo '</div>';
	}

	$this->endWidget('zii.widgets.jui.CJuiDialog');

?>

  <div class="form-group container">
	  <div id="filas_desembolsos"></div>
  </div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'razonesCambios'); ?>
		<?php echo $form->textArea($model,'razonesCambios',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'razonesCambios'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'razonesCambiosPresupuesto'); ?>
		<?php echo $form->textArea($model,'razonesCambiosPresupuesto',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'razonesCambiosPresupuesto'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->dropDownList($model,'estado',$model->listaEstados(),array('prompt'=>'--Seleccione un valor--'));?>
		<?php echo $form->error($model,'estado'); ?>
	</div>



	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php

$cod_avances = $model->idFinalizacion;

 ?>
<?php if ($model->isNewRecord) {
         echo '<p style="color:Red;"></p>';
      } else { ?>
	<table>
	<tr>
		<td hidden="hidden">
			<div class="form3">
			 <label>---  Adjuntar Imágenes  ---</label>
			<?php
				$form = $this->beginWidget('CActiveForm', array(
				    'id' => 'Final-Ejecucio-Imagenes-form',
				    'enableAjaxValidation' => false,
				    'htmlOptions' => array('enctype' => 'multipart/form-data')
					));
				?>

				    <?php echo $form->errorSummary($model3); ?>

					<div class="form-group" style="display:none">

						<?php echo $form->textField($model3,'idFinalizacion',array('size'=>25,'maxlength'=>25,'readonly'=>'true', 'value'=>$model->idFinalizacion)); ?>
					</div>

					<div class="form-group" style="display:none">
						<?php echo $form->textField($model3,'ubicacion_imagen',array('size'=>60,'maxlength'=>100)); ?>
					</div>

					<div class="form-group">
						<?php echo $form->fileField($model3,'nombre_imagen',array('size'=>200,'maxlength'=>200)); ?>
					</div>

				<?php
					if($cod_avances!='') {

						echo CHtml::submitButton($model3->isNewRecord ? 'Adjuntar imagen' : 'Adjuntar imagen');

			    $filtro_grid_img = $cod_avances;

			    if($filtro_grid_img==''){$filtro_grid_img='0';}

						$dataProImg=new CActiveDataProvider('FinalEjecucionImagenes',array(
											'criteria'=>array(
											    'condition'=>'idFinalizacion='.$filtro_grid_img,
											    'order'=>'idFinalizacion ASC',
											),
											'countCriteria'=>array(
											    'condition'=>'idFinalizacion='.$filtro_grid_img,
											),
											'pagination'=>array(
											    'pageSize'=>20,
											),));


						$this->widget('zii.widgets.grid.CGridView', array(
							'id'=>'imagenes-grid',
							'dataProvider'=>$dataProImg,
							'columns'=>array(
								 array('name'=>'nombre_imagen',
								       'headerHtmlOptions' => array('style' => 'display:none'),
								       'htmlOptions'=>array('width'=>'0px', 'style' => 'display:none')),
								 array(
								'class'=>'CLinkColumn',
								'header'=>'Imagenes',
								'labelExpression'=>'$data->nombre_fisico',
								'urlExpression'=>'$data->nombre_imagen',
							      ),

							),

						));
					};
				?>

				<?php $this->endWidget(); ?>

			</div>

		</td>
	</tr>
	</table>
<?php } ?>

<script type="text/javascript">
    function initDateInputs(){
      $("#FinalizacionDocuments_datePublished").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });
      $("#FinalizacionDocuments_dateModified").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });
    }

    function loadDocuments(){
      console.log("Calling this");
        $('#filas_desembolsos').load('<?php echo CController::createUrl("/FinalEjecucion/ViewDocumentsDetails", array("id"=>$model->idFinalizacion, "event"=>"Update")); ?>');

    }
      <?php if (!$model->isNewRecord) {
              echo 'loadDocuments();';
          }
    ?>

    function send_documents()
    {
    $("input[id$='url']").each(function (i, el) {
      if ($(el).val().length == 0){
        //field cant be empty
        $(el).val("0");
      }
    });
        var data=$("#tender-documents-form")[0];
        data = new FormData(data);

        $.ajax({
            type: 'POST',
            url: '<?php echo CController::createUrl("FinalizacionDocuments/create", array("id"=>$model->idFinalizacion)); ?>',
            data:data,
            processData: false,  // Important!
            contentType: false,
            cache: false,
            success:function(data){
                alert("Datos agregados correctamente!");
                loadDocuments();
                updateDialog.dialog("close");
            },
            error: function(data) { // if error occured
                alert("Error el documento ya existe!");
                alert("Error: " + JSON.stringify(data));
            },
            dataType:'html'
        }
        );
    }

    function update_documents(idTenderDocuments)
    {
    $("input[id$='url']").each(function (i, el) {
      if ($(el).val().length == 0){
        //field cant be empty
        $(el).val("0");
      }
    });
        var data=$("#tender-documents-form")[0];
        data = new FormData(data);

        $.ajax({
                type: 'POST',
                url: '<?php echo CController::createUrl("FinalizacionDocuments/update"); ?>'+'&id='+idTenderDocuments,
                data:data,
                processData: false,  // Important!
                contentType: false,
                cache: false,
                success:function(data){
                    alert("Datos Actualizados correctamente!");
                    loadDocuments();
                    $("#update-dialog").dialog("close");
					updateDialog.dialog("close");
                },
                error: function(data) { // if error occured
                    alert("Error al actulizar documento!");
                    alert("Error: " + JSON.stringify(data));
                },
                dataType:'html'
            }
        );
    }

    function get_data_update(idTenderDocuments){
       updateDialog.dialog("open");
        $.ajax({
                type: 'GET',
                url: '<?php echo CController::createUrl("FinalizacionDocuments/update"); ?>'+'&id='+idTenderDocuments,
                success:function(data){
                  document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                  initDateInputs();

                },
                error: function(data) { // if error occured
                    alert("Error al actulizar documento!");
                    alert("Error: " + JSON.stringify(data));
                },
                dataType:'html'
            }
        );
    }

    var updateDialog;
    $(document).ready(function(){
        updateDialog = $('#tender-documents-form-dialog').dialog({
        autoOpen: false,
        modal: true,
        width: 550,
        height:650,
        title: 'Details'
    });
        console.log(updateDialog)
    })
  $(document).ready(function(){
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
        .columns.adjust()
        .responsive.recalc();
    });
  })
</script>
