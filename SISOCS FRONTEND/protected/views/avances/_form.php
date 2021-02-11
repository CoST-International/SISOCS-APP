<?php
/* @var $this AvancesController */
/* @var $model Avances */
/* @var $form CActiveForm */
?>

<div class="">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'avances-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

<center>
	<table border="0" align="center">
	<tr>
		<td colspan="3">
			<div class="form-group">
				<?php echo $form->labelEx($model,'idInicioEjecucion'); ?>
				<?php echo $form->textField($model,'idInicioEjecucion',array('size'=>10,'maxlength'=>10,'readonly'=>'true', 'value'=>$idInicioEjecucion)); ?>
				<?php echo $form->error($model,'idInicioEjecucion'); ?>
			</div>
		</td>

	</tr>
	<tr>
		<td width="25%">
			<div class="form-group">
				<label>Avance Físico Obra Acumulado (%)</label>
			</div>
		</td>
		<td width="25%">
			<div class="form-group">
				<?php echo $form->labelEx($model,'porcent_programado'); ?>
				<?php echo $form->textField($model,'porcent_programado', array('size'=>15,'maxlength'=>15)); ?>
				<?php echo $form->error($model,'porcent_programado'); ?>
			</div>
		</td>
		<td>
			<div class="form-group">
				<?php echo $form->labelEx($model,'porcent_real'); ?>
				<?php echo $form->textField($model,'porcent_real', array('size'=>15,'maxlength'=>15)); ?>
				<?php echo $form->error($model,'porcent_real'); ?>
			</div>
		</td>
	</tr>
	<tr>
		<td width="25%">
			<div class="form-group">
				<label>Avance Financiero de la Obra Acumulado (Lempiras)</label>
			</div>
		</td>
		<td width="25%">
			<div class="form-group">
				<?php echo $form->labelEx($model,'finan_programado'); ?>
				<?php echo $form->textField($model,'finan_programado',array('size'=>15,'maxlength'=>15)); ?>
				<?php echo $form->error($model,'finan_programado'); ?>
			</div>
		</td>
		<td>
			<div class="form-group">
				<?php echo $form->labelEx($model,'finan_real'); ?>
				<?php echo $form->textField($model,'finan_real',array('size'=>15,'maxlength'=>15)); ?>
				<?php echo $form->error($model,'finan_real'); ?>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="form-group">
				<?php echo $form->labelEx($model,'fecha_avance'); ?>
				<?php
				if ($model->fecha_avance!='') {
				$model->fecha_avance=date('Y-m-d h:m:s',strtotime($model->fecha_avance));
				}
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'attribute'=>'fecha_avance',
				'value'=>$model->fecha_avance,
				'language' => 'es',
				'htmlOptions' => array('readonly'=>"readonly",),
				'options'=>array(
				'autoSize'=>true,
				'defaultDate'=>$model->fecha_avance,
				'dateFormat'=>'yy-mm-dd',
				'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
				'buttonImageOnly'=>true,
				'buttonText'=>' Click aqui',
				'selectOtherMonths'=>true,
				'showAnim'=>'fold',
				'showButtonPanel'=>true,
				'showOn'=>'button',
				'showOtherMonths'=>true,
				'changeMonth' => 'true',
				'changeYear' => 'true',
				'yearRange' => '1990:2020',
				),
				)); ?>
				<?php echo $form->error($model,'fecha_avance'); ?>
			</div>
		</td>
		<td>
			<div class="form-group">
				<?php echo $form->labelEx($model,'desc_problemas'); ?>
			        <?php echo $form->textArea($model, 'desc_problemas', array('maxlength' => 200, 'rows' => 6, 'cols' => 25)); ?>
				<?php echo $form->error($model,'desc_problemas'); ?>
			</div>
		</td>
		<td>
			<div class="form-group">
				<?php echo $form->labelEx($model,'desc_temas'); ?>
				<?php echo $form->textArea($model, 'desc_temas', array('maxlength' => 200, 'rows' => 6, 'cols' => 25)); ?>
				<?php echo $form->error($model,'desc_temas'); ?>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="form-group" style="display:none">
				<?php echo $form->labelEx($model,'fecha_avance'); ?>
				<?php echo $form->textField($model,'fecha_avance',array('disabled'=>true)); ?>
				<?php echo $form->error($model,'fecha_avance'); ?>
			</div>
		</td>
		<td>
			<div class="form-group" style="display:none">
				<?php echo $form->labelEx($model,'usuario_creacion'); ?>
				<?php echo $form->textField($model,'usuario_creacion',array('size'=>16,'maxlength'=>16,'disabled'=>true)); ?>
				<?php echo $form->error($model,'usuario_creacion'); ?>
			</div>
		</td>
		<td>
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<?php
			if ($model->isNewRecord) {
					echo '<p style="color:Red;">Guarde para poder agregar documentos</p>';
			} else {
					echo CHtml::ajaxLink(Yii::t('job', 'Agregar Documentos'),
										$this->createUrl('AdvanceDocuments/create', array('id'=>$model->idAvances)),
										array(    'success'=>'js:function(data) {
														updateDialog.dialog("open");
														document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
														initDateInputs();
													}',
												'update' => '#filas_desembolsos'
										),array('class'=>'specialLinks')
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

	</table>
	<div class="form-group">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo  $form->dropDownList($model,'estado',$model->listaEstados(),array('prompt'=>'--Seleccione un valor--'))?>
		<?php echo $form->error($model,'estado'); ?>
	</div>
</center>

<div class="container">
	<div class="form-group">
		<div id="filas_desembolsos"></div>
	</div>
	<div class="row">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar'); ?>
		<?php echo CHtml::button('Regresar a Gestion de Avances',array('submit'=>array('GestionAvances/admin'))); ?>
	</div>
</div>

<?php
    $codcontrato = $model->idInicioEjecucion;
    $cod_avances = $model->idAvances;
?>

<?php $this->endWidget(); ?>

</div><!-- form -->


<?php if ($model->isNewRecord) {
         echo '<p style="color:Red;">Guarde para poder agregar imagenes al avance</p>';
      } else { ?>
	<table>
	<tr>
		<td>
			<div class="form3">
			 <label>---  Adjuntar Imágenes  ---</label>
			<?php
				$form = $this->beginWidget('CActiveForm', array(
				    'id' => 'AvancesImagenes-form',
				    'enableAjaxValidation' => false,
				    'htmlOptions' => array('enctype' => 'multipart/form-data')
					));
				?>

				    <?php echo $form->errorSummary($model3); ?>

					<div class="form-group" style="display:none">

						<?php echo $form->textField($model3,'idAvances',array('size'=>25,'maxlength'=>25,'readonly'=>'true', 'value'=>$model->idAvances)); ?>
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

						$dataProImg=new CActiveDataProvider('AvancesImagenes',array(
											'criteria'=>array(
											    'condition'=>'idAvances='.$filtro_grid_img,
											    'order'=>'idAvances ASC',
											),
											'countCriteria'=>array(
											    'condition'=>'idAvances='.$filtro_grid_img,
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
      $("#AdvanceDocuments_datePublished").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });
      $("#AdvanceDocuments_dateModified").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });
    }

    function loadDocuments(){
      console.log("Calling this");
        $('#filas_desembolsos').load('<?php echo CController::createUrl("/Avances/ViewDocuments", array("id"=>$model->idAvances, "event"=>"Update")); ?>');

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
            url: '<?php echo CController::createUrl("AdvanceDocuments/create", array("id"=>$model->idAvances)); ?>',
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
                url: '<?php echo CController::createUrl("AdvanceDocuments/update"); ?>'+'&id='+idTenderDocuments,
                data:data,
                processData: false,  // Important!
                contentType: false,
                cache: false,
                success:function(data){
                    alert("Datos Actualizados correctamente!");
                    loadDocuments();
                    $("#update-dialog").dialog("close");
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
                url: '<?php echo CController::createUrl("AdvanceDocuments/update"); ?>'+'&id='+1,
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
