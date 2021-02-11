
<br><br>

<div class="container">

		<div class="tab-content">
      <ul class="nav nav-pills nav-fill" role="tablist">
        <li class="nav-item "><a class="nav-link active" data-toggle="tab" href="#home">Proyecto</a></li>
        <li class="nav-item "><a class="nav-link" data-toggle="tab" href="#menu1">Presupuesto de Inversión</a></li>
        <li class="nav-item "><a class="nav-link" data-toggle="tab" href="#menu2">Pre-Calificación</a></li>
        <li class="nav-item "><a class="nav-link" data-toggle="tab" href="#menu3">Fuentes de Financiamiento</a></li>
        <li class="nav-item "><a class="nav-link" data-toggle="tab" href="#menu4">beneficiarios</a></li>
        <li class="nav-item "><a class="nav-link" data-toggle="tab" href="#menu5">Planificación de Hitos</a></li>
		<li class="nav-item "><a class="nav-link" data-toggle="tab" href="#menu6">Pronóstico de la Demanda</a></li>

      </ul>
		  <div id="home" class="tab-pane fade in active">
		    <h3>Proyecto</h3>



					<div class="form-group" style="overflow: hidden;">
						<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'proyecto-form',
							// Please note: When you enable ajax validation, make sure the corresponding
							// controller action is handling ajax validation correctly.
							// There is a call to performAjaxValidation() commented in generated controller code.
							// See class documentation of CActiveForm for details on this.
							'enableAjaxValidation' => true,
						        'htmlOptions' => array('enctype' => 'multipart/form-data'),
						)); ?>

						<?php
						    if(is_null($model->idProyecto)){

						    }else{

						?>
						<table width="50%" border="0" align="right">
							  <tr>
							    <td width="9%">&nbsp;</td>
						            <td width="51%"><b>Proyectos</b></td>
							    <td width="40%"></td>
						      </tr>
							  <tr>
							    <td>&nbsp;</td>
							    <td align="right">

						                <style type="text/css">
						                    .button {
						                            background-color: #4CAF50; /* Green */
						                            border: none;
						                            color: white;
						                            padding: 0px 24px;
						                            text-align: center;
						                            text-decoration: none;
						                            display: inline-block;
						                            font-size: 16px;
						                            margin: 2px 1px;
						                            -webkit-transition-duration: 0.4s; /* Safari */
						                            transition-duration: 0.4s;
						                            cursor: pointer;
																}
						                    .button5 {
						                        background-color: white;
						                        color: black;
						                        border: 2px solid #555555;
						                    }

						                    .button5:hover {
						                        background-color: #555555;
						                        color: white;
						                    }
						                </style>
						                <script type="text/javascript">
						            function myFunction() {
						                var x = document.getElementById("mySelect").value;
						                //document.getElementById("demo").innerHTML = "You selected: " + x;
						                 if(x=="create3"){
						                     document.getElementById("demo").href="index.php?r=calificacion/create3&idCreate="+<?php echo $model->idProyecto; ?>;

						                }
						                else if(x=="opcion"){
						                    document.getElementById("demo").href="#";
						                }
						                else{
						                    //alert(x);
						                 document.getElementById("demo").href="index.php?r=calificacion/view&id="+x;

						                }
						                //
						                ////else{
						                    //document.getElementById("demo").href="index.php?r=calificacion/"+x;
						                //}

						            }
						            </script>
						             <select id="mySelect" onchange="myFunction()">
						            <?php
						            $calicicacionCrear="create3";

						            $listaCali=$model->listaCalificaciones($model->idProyecto);
						            echo '<option value="opcion">Seleccione una Opcion</option>';
						            echo '<option value="'.$calicicacionCrear.'">Nuevo</option>';
						            foreach($listaCali as $ids=>$nameCali){
						                echo "<option value=".$ids.">".$nameCali."</option>";
						            }

						            ?>
								<!--<option value="TH">Thailand</option>
								<option value="EN">English</option>
								<option value="US">United States</option>-->
							</select>
						        <a st="st" id="demo" class="button button5" href="#">Ir</a> <br></td>
							    <td align="left">&nbsp;</td>
						      </tr>
						  </table><?php }  //$id = 212; echo '<h1>'; echo Yii::app()->Controller->GetPath('webroot.adjuntos', 1, $id); echo '</h1>'; ?>
							<br>
							<p class="note">Campos con<span class="required" style="color:red;font-size:18px;">*</span> son obligatorios.</p>

						  <p><?php echo $form->errorSummary($model); ?></p>
						  <p><span class="row"><?php echo $form->hiddenField($model,'idProyecto',array('size'=>20,'maxlength'=>20,'class'=>'idcod')); ?></span></p>
							<div class="container" style="margin-top:-39px;">
								<div class="form-group">
									<?php echo $form->labelEx($model,'codigo'); ?>
								</div>
								<div class="form-group">
									<?php echo $form->textField($model,'codigo',array('size'=>30,'maxlength'=>30,'style'=>'width: 100%;')); ?><?php echo $form->error($model,'codigo'); ?>
								</div>


                <div class="form-group">
									<?php echo $form->labelEx($model,'codsefin'); ?>
								</div>

								<div class="form-group">
									<?php echo $form->textField($model,'codsefin',array('size'=>20,'maxlength'=>20)); ?> <?php echo $form->error($model,'codsefin'); ?>
								</div>

								<div class="form-group">
									<?php echo $form->labelEx($model,'nombre_proyecto'); ?>
								</div>

								<div class="form-group">
									<?php echo $form->textArea($model,'nombre_proyecto',array('size'=>60,'maxlength'=>2000,'rows'=>5,'cols'=>60)); ?><?php echo $form->error($model,'nombre_proyecto'); ?>
								</div>

								<div class="form-group">
									<?php echo $form->labelEx($model,'descrip'); ?>
								</div>

								<div class="form-group">
									<?php echo $form->textArea($model,'descrip',array('rows'=>5, 'cols'=>60)); ?> <?php echo $form->error($model,'descrip'); ?>
								</div>

								<div class="form-group">
									<?php echo $form->labelEx($model,'Proposito'); ?>
								</div>
                				<div class="form-group">
									<?php echo $form->textArea($model,'Proposito',array('size'=>60,'rows'=>5,'cols'=>60)); ?>
								</div>
								<div class="form-group">
									<?php echo $form->error($model,'Proposito'); ?>
								</div>
								<div class="form-group form-group">
															<?php
																if ($model->isNewRecord) {
																		echo '<p style="color:Red;">Guarde para poder agregar documentos</p>';
																} else {
																		echo CHtml::ajaxLink(Yii::t('job', 'Agregar Documento'),
																												$this->createUrl('planningDocuments/create', array('id'=>$model->idProyecto)),
																												array(    'success'=>'js:function(data) {
																																							dialogoDeUpdate.dialog("open");
																																							document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
																																							initDateInputs()
																																		}',
																																'update' => '#filas_documents'
																												)
																								);


																} ?>
								</div>
									<div class="form-group form-group">
											<div id="filas_documents"></div>
									</div>



                <div class="form-group">

  								<div class="form-group">
  									<?php echo $form->labelEx($model,'idSector'); ?>
  								</div>

  								<div class="form-group">
  									<?php echo $form->dropDownList($model,'idSector',
  				                        CHtml::listData(Sector::model()->findAll(),'idSector','sector'),
  				                        array(
  				                            'ajax'=>array(
  				                                'type'=>'POST',
  				                                'url'=>CController::createUrl('Proyecto/Selectdos'),
  				                                'update'=>'#'.CHtml::activeId($model,'idSubSector'),
  				                            ),'prompt'=>'--Seleccione un valor--'

  				                        )
  				                        ); ?> <?php echo $form->error($model,'idSector'); ?>
  								</div>
                </div>

                <div class="form-group">
                  <div class="form-group">
  									<?php echo $form->labelEx($model,'idSubSector'); ?>
  								</div>
  								<div class="form-group">
  									<?php if($model->isNewRecord){
  										echo $form->dropDownList($model,'idSubSector',array(),array('prompt'=>'--Seleccione un valor--'));
  									}else{
  										echo $form->dropDownList($model,'idSubSector',$model->listaSubSector(),array('prompt'=>'--Seleccione un valor--'));
  									}

  									?> <?php echo $form->error($model,'idSubSector'); ?>
  								</div>
                </div>

                <div class="form-group" >

  								<div class="form-group">
  									<?php echo $form->labelEx($model,'idEnte'); ?>
  								</div>

  								<div class="form-group">
                    <?php echo  $form->dropDownList($model,'idEnte',
                          CHtml::listData(Entes::model()->findAll(array("order"=>"descripcion asc")),'idEnte','descripcion'),array(
                                      'ajax'=>array(
                                          'type'=>'POST',
                                          'url'=>CController::createUrl('Proyecto/Selectunidad'),
                                          'update'=>'#'.CHtml::activeId($model,'idUnidad'),
                                      ),'prompt'=>'--Seleccione un valor--',

                                  )
                                  ); ?> <?php echo $form->error($model,'idEnte'); ?>
  								</div>

                </div>

                <div class="form-group" >

  								<div class="form-group">
  									<?php echo $form->labelEx($model,'idUnidad'); ?>
  								</div>

  								<div class="form-group">
                    <?php
              			if($model->isNewRecord){
              			echo  $form->dropDownList($model,'idUnidad',array(),array('prompt'=>'--Seleccione un valor--'));
              			}else{
              				echo  $form->dropDownList($model,'idUnidad',$model->listaUnidad(),array('prompt'=>'--Seleccione un valor--'));
              				//echo $form->dropDownList($model,'idSubSector',$model->listaSectores(),array('prompt'=>'--Seleccione un valor--'));
              			}
              			//echo  $form->dropDownList($model,'idUnidad',array(),array('prompt'=>'--Seleccione un valor--'));?>
              			<?php echo $form->error($model,'idUnidad'); ?>
  								</div>

                </div>

                <div class="form-group" >

  								<div class="form-group">
  									<?php echo $form->labelEx($model,'idFuncionario'); ?>
  								</div>

  								<div class="form-group">
                    <?php echo  $form->dropDownList($model,'idFuncionario',$model->listaFuncionarios($model->idEnte),array('prompt'=>'--Seleccione un valor--'));?> <?php echo $form->error($model,'idFuncionario'); ?>
  								</div>

                </div>

                <div class="form-group" >

  								<div class="form-group">
  									<?php echo $form->labelEx($model,'idRol'); ?>
  								</div>

  								<div class="form-group">
                    <?php echo  $form->dropDownList($model,'idRol',$model->listaRoles($model->idRol),array('prompt'=>'--Seleccione un valor--'));//echo $form->textArea($model,'idRol',array('size'=>20,'maxlength'=>20)); ?><?php echo $form->error($model,'idRol'); ?>
  								</div>

                </div>

                <div class="form-group" >

  								<div class="form-group">
  									<?php echo $form->labelEx($model,'presupuesto'); ?>
  								</div>

  								<div class="form-group">
                    <?php echo $form->textField($model,'presupuesto'); ?> <?php echo $form->error($model,'presupuesto'); ?>
  								</div>

                </div>

                <div class="form-group" >

  								<div class="form-group">
  									<?php echo $form->labelEx($model,'fechaaprob'); ?>
  								</div>

  								<div class="form-group">
                    <?php

        			  //echo $form->textField($model,'fechaaprob');
        			  if ($model->fechaaprob!='') {
                                        $model->fechaaprob=date('Y-m-d',strtotime($model->fechaaprob));
                        }
                                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'model'=>$model,
                                    'attribute'=>'fechaaprob',
                                    'value'=>$model->fechaaprob,
                                    'language' => 'es',
                                    'htmlOptions' => array('readonly'=>"readonly"),
                                    'options'=>array(
                                    'autoSize'=>true,
                                    'defaultDate'=>$model->fechaaprob,
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
        														'yearRange' => '-50:+50',
                                    ),
                                ));
        						/*
        			  		 $this->widget('zii.widgets.jui.CJuiDatePicker',
        							array('language' => 'es',
        								'model' => $model,
        								'attribute' => 'fechaaprob',
        								'options' => array( 'firstDay'=>1,'buttonImage'=>"images/calendar.gif",'buttonImageOnly' => true,'constrainInput' => true,'currentText' => 'Now',
        													'dateFormat' => 'dd/mm/yy','changeMonth' => 'true','changeYear' => 'true','duration' => 'fast','showAnim' => 'fold',),
        								'htmlOptions' => array('class' => 'shadowdatepicker')
        							)
        			  );*/
        		?>

                    <?php echo $form->error($model,'fechaaprob'); ?>
  								</div>

                </div>

                <div class="form-group">
									<?php echo $form->labelEx($model,'descambiental'); ?>
								</div>
								<div class="form-group">
									<?php echo $form->textArea($model,'descambiental',array('rows'=>5,'cols'=>60)); ?> <?php echo $form->error($model,'descambiental'); ?>
								</div>

                <div class="form-group" >
									<?php echo $form->labelEx($model,'descreasentamiento'); ?>
								</div>
								<div class="form-group">
									<?php echo $form->textArea($model,'descreasentamiento',array('rows'=>5,'cols'=>60)); ?> <?php echo $form->error($model,'descreasentamiento'); ?>
								</div>

                <div class="form-group" >

  								<div class="form-group">
  									<?php echo $form->labelEx($model,'lat1'); ?>
  								</div>

  								<div class="form-group">
                    <?php if (!is_numeric($model->lat1)){$model->lat1='0';} echo $form->textField($model,'lat1',array('size'=>20,'maxlength'=>20)); ?> <?php echo $form->error($model,'lat1'); ?>
  								</div>

                </div>
                <div class="form-group" >

  								<div class="form-group">
  									<?php echo $form->labelEx($model,'lon1'); ?>
  								</div>

  								<div class="form-group">
                    <?php if (!is_numeric($model->lon1)){$model->lon1='0';} echo $form->textField($model,'lon1',array('size'=>20,'maxlength'=>20)); ?> <?php echo $form->error($model,'lon1'); ?>
  								</div>

                </div>

                <div class="form-group" >

  								<div class="form-group">
  									<?php echo $form->labelEx($model,'lat2'); ?>
  								</div>

  								<div class="form-group">
                    <?php if (!is_numeric($model->lat2)){$model->lat2='0';} echo $form->textField($model,'lat2',array('size'=>20,'maxlength'=>20)); ?> <?php echo $form->error($model,'lat2'); ?>
  								</div>

                </div>
                <div class="form-group" >

  								<div class="form-group">
  									<?php echo $form->labelEx($model,'lon2'); ?>
  								</div>

  								<div class="form-group">
                    <?php if (!is_numeric($model->lon2)){$model->lon2='0';} echo $form->textField($model,'lon2',array('size'=>20,'maxlength'=>20)); ?> <?php echo $form->error($model,'lon2'); ?>
  								</div>

                </div>

                <div class="form-group" >
                  <?php echo $form->labelEx($model,'estado'); ?>
                </div>
                <div class="form-group">
                  <?php echo  $form->dropDownList($model,'estado',$model->listaEstados(),array('prompt'=>'--Seleccione un valor--'))?> <?php echo $form->error($model,'estado'); ?>
                </div>

                <div class="form-group" style="margin-top: 5em; margin-left:-2em;">
                  <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks'));   ?>
                </div>

							</div>

						<?php $this->endWidget(); ?>
					</div>

		    </div>

      <div id="menu1" class="tab-pane fade" style="overflow:hidden;">
          <?php
            if ($model->isNewRecord) {
                echo '<p style="color:Red;">Guarde para poder agregar esta sección</p>';
            } else {
                echo CHtml::ajaxLink(Yii::t('job', 'Agregar Presupuesto de Inversión'),
                    $this->createUrl('budgetBreakdown/create', array('id'=>$model->idProyecto)),
                    array(    'success'=>'js:function(data) {
                                    dialogoDeUpdate.dialog("open");
                                    document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                    initDateInputs()
                                }',
                            'update' => '#filas_budget'
                    ),
                    array('class'=>'specialLinks')
                );
            } ?>
            <div class="row" style="margin: 0 auto;">
                <div id="filas_budget"></div>
            </div>
		  </div>

		  <div id="menu2" class="tab-pane fade" style="overflow:hidden;">
          <?php
            if ($model->isNewRecord) {
                echo '<p style="color:Red;">Guarde para poder agregar sección</p>';
            } else {
                echo CHtml::ajaxLink(Yii::t('job', 'Agregar Pre-Calificación'),
                    $this->createUrl('prequalification/create', array('id'=>$model->idProyecto)),
                    array(    'success'=>'js:function(data) {
                                    dialogoDeUpdate.dialog("open");
                                    document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
																		initDateInputs();
																		CalculaDuracionEnDias();
                                }',
                            'update' => '#filas_prequalification'
                    ),
                    array('class'=>'specialLinks')
                );
            } ?>
            <div class="row" style="margin: 0 auto;">
                <div id="filas_prequalification"></div>
            </div>
			</div>


      <div id="menu3" class="tab-pane fade">
          <?php
            if ($model->isNewRecord) {
                echo '<p style="color:Red;">Guarde para poder agregar sección</p>';
            } else {
                echo CHtml::ajaxLink(Yii::t('job', 'Agregar Fuente de Financiamiento'),
                    $this->createUrl('proyectoFuente/create', array('id'=>$model->idProyecto)),
                    array(    'success'=>'js:function(data) {
                                    dialogoDeUpdate.dialog("open");
                                    document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                }',
                            'update' => '#filas_proyectoFuente'
                    ),
                    array('class'=>'specialLinks')
                );
            } ?>
            <div class="row">
                <div id="filas_proyectoFuente"></div>
            </div>
			</div>

      <div id="menu4" class="tab-pane fade">
          <?php
            if ($model->isNewRecord) {
                echo '<p style="color:Red;">Guarde para poder agregar sección</p>';
            } else {
                echo CHtml::ajaxLink(Yii::t('job', 'Agregar Beneficiario'),
                    $this->createUrl('proyectoMunicipio/create', array('id'=>$model->idProyecto)),
                    array(    'success'=>'js:function(data) {
                                    dialogoDeUpdate.dialog("open");
                                    document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                }',
                            'update' => '#filas_beneficiaries'
                    ),
                    array('class'=>'specialLinks')
                );
            } ?>
            <div class="row">
                <div id="filas_beneficiaries"></div>
            </div>
		  </div>
      <div id="menu5" class="tab-pane fade">
          <?php
            if ($model->isNewRecord) {
                echo '<p style="color:Red;">Guarde para poder agregar sección</p>';
            } else {
                echo CHtml::ajaxLink(Yii::t('job', 'Agregar Hito'),
                    $this->createUrl('planningMilestone/create', array('id'=>$model->idProyecto)),
                    array(    'success'=>'js:function(data) {
                                    dialogoDeUpdate.dialog("open");
                                    document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
																		initDateInputs()
                                }',
                            'update' => '#filas_milestone'
                    ),
                    array('class'=>'specialLinks')
                );
            } ?>
            <div class="row">
                <div id="filas_milestone"></div>
            </div>
		  </div>

			<div id="menu6" class="tab-pane fade">
          <?php
            if ($model->isNewRecord) {
                echo '<p style="color:Red;">Guarde para poder agregar sección</p>';
            } else {
                echo CHtml::ajaxLink(Yii::t('job', 'Pronóstico de la Demanda'),
                    $this->createUrl('forecast/create', array('id'=>$model->idProyecto)),
                    array(    'success'=>'js:function(data) {
                                    dialogoDeUpdate.dialog("open");
                                    document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
																		initDateInputs()
                                }',
                            'update' => '#filas_forecast'
                    ),
                    array('class'=>'specialLinks')
                );?>
				<div class="row">
	                <div id="filas_forecast"></div>
	            </div>

			<?php
			echo CHtml::ajaxLink(Yii::t('job', 'Agregar Observaciones del Pronóstico de la Demanda'),
				$this->createUrl('forecastObservations/create', array('idProyecto'=>$model->idProyecto)),
				array(    'success'=>'js:function(data) {
								dialogoDeUpdate.dialog("open");
								document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
																	initDateInputs()
							}',
						'update' => '#filas_forecastObs'
				),
                array('class'=>'specialLinks')
			);
		} ?>
		<div class="row">
			<div id="filas_forecastObs"></div>
		</div>


		  </div>
		</div>
</div>



</script>
<script type="text/javascript" >

		function CalculaDuracionEnDias(){

			$("#Prequalification_durationInDays")
	    .focus(
	    function(){
	        var start = $('#Prequalification_startDate').datepicker('getDate');
	        var end   = $('#Prequalification_endDate').datepicker('getDate');
	        var days   = (end - start)/1000/60/60/24;
	        if (start!=null)
	            {
	            $('#Prequalification_durationInDays').val(days);
	            }
	        });
		}

    function initDateInputs(){
      $("#BudgetBreakdown_startDate").datepicker({
          uiLibrary: "bootstrap4",
					dateFormat: 'yy-mm-dd'
      });

			$("#BudgetBreakdown_endDate").datepicker({
          uiLibrary: "bootstrap4",
					dateFormat: 'yy-mm-dd'
      });

			$("#Prequalification_startDate").datepicker({
          uiLibrary: "bootstrap4",
					dateFormat: 'yy-mm-dd'
      });

			$("#Prequalification_endDate").datepicker({
          uiLibrary: "bootstrap4",
					dateFormat: 'yy-mm-dd'
      });

			$("#Prequalification_enquiryPeriod_startDate").datepicker({
          uiLibrary: "bootstrap4",
					dateFormat: 'yy-mm-dd'
      });

			$("#Prequalification_enquiryPeriod_endDate").datepicker({
          uiLibrary: "bootstrap4",
					dateFormat: 'yy-mm-dd'
      });

			$("#Prequalification_qualificationPeriod_startDate").datepicker({
          uiLibrary: "bootstrap4",
					dateFormat: 'yy-mm-dd'
      });

			$("#Prequalification_qualificationPeriod_endDate").datepicker({
          uiLibrary: "bootstrap4",
					dateFormat: 'yy-mm-dd'
      });

			$("#PlanningMilestone_dueDate").datepicker({
          uiLibrary: "bootstrap4",
					dateFormat: 'yy-mm-dd'
      });

			$("#PlanningMilestone_dateMet").datepicker({
          uiLibrary: "bootstrap4",
					dateFormat: 'yy-mm-dd'
      });

			$("#PlanningDocuments_datePublished").datepicker({
          uiLibrary: "bootstrap4",
					dateFormat: 'yy-mm-dd'
      });

			$("#PlanningDocuments_dateModified").datepicker({
          uiLibrary: "bootstrap4",
					dateFormat: 'yy-mm-dd'
      });
    }
    function loadEverything(){
      $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("/Proyecto/ViewDetFuentesFinanciamiento", array("id"=>$model->idProyecto, "event"=>"Update")); ?>',

            success:function(data){
              $('#filas_proyectoFuente').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });
        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("/Proyecto/ViewDetBudgetBreakdown", array("id"=>$model->idProyecto, "event"=>"Update")); ?>',

            success:function(data){
              $('#filas_budget').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });
        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("/Proyecto/ViewDetPrequalification", array("id"=>$model->idProyecto, "event"=>"Update")); ?>',

            success:function(data){
              $('#filas_prequalification').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });
        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("/Proyecto/ViewBeneficiaries", array("id"=>$model->idProyecto, "event"=>"Update")); ?>',

            success:function(data){
              $('#filas_beneficiaries').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });

        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("/Proyecto/ViewMilestone", array("id"=>$model->idProyecto, "event"=>"Update")); ?>',

            success:function(data){
              $('#filas_milestone').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });

				$.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("/Proyecto/ViewDocuments", array("id"=>$model->idProyecto, "event"=>"Update")); ?>',

            success:function(data){
              $('#filas_documents').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });

		$.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("/Proyecto/ViewForecast", array("id"=>$model->idProyecto, "event"=>"Update")); ?>',

            success:function(data){
              $('#filas_forecast').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });

		loadFORECASTOBS();


    }

	function loadFORECASTOBS(value){
        if (value === undefined)
            value = this.lastKPI;

        this.lastKPI = value;

        if (this.lastKPI === undefined)
            return;

        $.ajax({
            type: 'GET',
            url: '<?php echo CController::createUrl("Proyecto/ViewForecastObservations",array("event"=>"Update"));?>&idForecast='+value,
            success:function(data){
               $('#filas_forecastObs').html(data);
            },
            error: function(data) { // if error occured

            },
            dataType:'html'
        });
    }
      <?php if (!$model->isNewRecord) {
              echo 'loadEverything();';
          }
    ?>

    function send_documents(type,preventClose)
    {
        var controller = "";
        if (type == 'budget'){
            controller = '<?php echo CController::createUrl("budgetBreakdown/create", array("id"=>$model->idProyecto)); ?>';
        }else if (type == "prequalification"){
            controller = '<?php echo CController::createUrl("prequalification/create", array("id"=>$model->idProyecto)); ?>';
        } else if (type == "fuente"){
            controller='<?php echo CController::createUrl("proyectoFuente/create", array("id"=>$model->idProyecto)); ?>';
        } else if (type == "beneficiaries"){
            controller='<?php echo CController::createUrl("proyectoMunicipio/create", array("id"=>$model->idProyecto)); ?>';
        }else if (type == "milestone"){
            controller='<?php echo CController::createUrl("planningMilestone/create", array("id"=>$model->idProyecto)); ?>';
        }else if (type == "documents"){
            controller='<?php echo CController::createUrl("planningDocuments/create", array("id"=>$model->idProyecto)); ?>';
        }else if (type == "forecast"){
            controller='<?php echo CController::createUrl("forecast/create", array("id"=>$model->idProyecto)); ?>';
        }else if (type == "forecastObs"){
            controller='<?php echo CController::createUrl("forecastObservations/create&idProyecto=".$model->idProyecto); ?>';
        }

		$("input[id$='url']").each(function (i, el) {
			if ($(el).val().length == 0){
				//field cant be empty
				$(el).val("0");
			}
		});
        var data=$("#proyecto-dialog-form")[0];
        data = new FormData(data);
        setTimeout(function(){
            $.ajax({
                type: 'POST',
                url: controller,
                data:data,
                processData: false,  // Important!
                contentType: false,
                cache: false,
                success:function(data){
                    //alert("Datos agregados correctamente!");
                    loadEverything();
					if (type==="forecastObs") {

					}

					if (!preventClose){
                    	//dialogoDeUpdate.dialog("close");
                	}else{
                		 swal({
			                title: 'Exito',
			                text: "Elemento guardado",
			                type: 'success',
			             })
                	}
                },
                error: function(data) { // if error occured
                    alert("Error el documento ya existe!");
                    alert("Error: " + JSON.stringify(data));
                },
                dataType:'html'
            });
        },200);
    }

    function update_documents(type,...id)
    {
        var controller = "";
        if (type == 'budget'){
            controller = '<?php echo CController::createUrl("budgetBreakdown/update"); ?>';
        }else if (type == "prequalification"){
            controller = '<?php echo CController::createUrl("prequalification/update"); ?>';
        } else if (type == "fuente"){
            controller='<?php echo CController::createUrl("proyectoFuente/update"); ?>';
        } else if (type == "beneficiaries"){
            controller='<?php echo CController::createUrl("proyectoMunicipio/update"); ?>';
        }else if (type == "milestone"){
            controller='<?php echo CController::createUrl("planningMilestone/update"); ?>';
        }else if (type == "documents"){
            controller='<?php echo CController::createUrl("planningDocuments/update"); ?>';
        }else if (type == "forecast"){
            controller='<?php echo CController::createUrl("forecast/update"); ?>';
        }else if (type == "forecastObs"){
            controller='<?php echo CController::createUrl("forecastObservations/update"); ?>';
        }
		$("input[id$='url']").each(function (i, el) {
			if ($(el).val().length == 0){
				//field cant be empty
				$(el).val("0");
			}
		});
        var data=$("#proyecto-dialog-form")[0];
        data = new FormData(data);
        var additionalParam = "";
        if (id.length === 1){
          additionalParam = "&id="+id[0];
				}else if(type == "fuente") {
					additionalParam = "&idProyecto="+id[0]+"&idFuente="+id[1];
        }else{
          //This is special for proyectoMunicipio
          //ignore this if applying to another controller
          additionalParam = "&idMunicipio="+id[0]+"&idDepartamento="+id[1]+"&idProyecto="+id[2];
        }
        $.ajax({
                type: 'POST',
                url: controller+additionalParam,
                data:data,
                processData: false,  // Important!
                contentType: false,
                cache: false,
                success:function(data){
                    alert("Datos Actualizados correctamente!");
                    loadEverything();
					if (type==="forecastObs") {

					}
                    dialogoDeUpdate.dialog("close");
                },
                error: function(data) { // if error occured
                    alert("Error al actulizar documento!");
                    alert("Error: " + JSON.stringify(data));
                },
                dataType:'html'
            }
        );
    }

    deleteObject = function (type,...id) {
            var controller = "";
            if (type == 'budget'){
                controller = '<?php echo CController::createUrl("budgetBreakdown/delete"); ?>';
            }else if (type == "prequalification"){
                controller = '<?php echo CController::createUrl("prequalification/delete"); ?>';
            } else if (type == "fuente"){
                controller='<?php echo CController::createUrl("proyectoFuente/delete"); ?>';
            } else if (type == "beneficiaries"){
                controller='<?php echo CController::createUrl("proyectoMunicipio/delete"); ?>';
            }else if (type == "milestone"){
                controller='<?php echo CController::createUrl("planningMilestone/delete"); ?>';
            }else if (type == "documents"){
                controller='<?php echo CController::createUrl("planningDocuments/delete"); ?>';
            }else if (type == "forecast"){
                controller='<?php echo CController::createUrl("forecast/delete"); ?>';
            }
           var additionalParam = "";
          if (id.length === 1){
            additionalParam = "&id="+id[0];
					}else if(type == "fuente") {
						additionalParam = "&idProyecto="+id[0]+"&idFuente="+id[1];
					}else{
            //This is special for proyectoMunicipio
            //ignore this if applying to another controller
            additionalParam = "&idMunicipio="+id[0]+"&idDepartamento="+id[1]+"&idProyecto="+id[2];
          }
            const url =controller+additionalParam;

            swal({
                title: '¿Desea eliminar el registro con código : ' + id + ' ?',
                text: "No se podrá recuperar en un futuro",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, ¡Borrar!',
                cancelButtonText: 'No, ¡Mantener!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {

                if (result) {

                    jQuery.ajax({
                        'type': 'POST',
                        'data': {
                            'id': id
                        },
                        'url': url,
                        'cache': false,
                        'success': function (data) {
                          //  console.log(data);
                            loadEverything();
                            table.row('.selected').remove().draw(false);
                            swal(
                                '¡Borrado!',
                                'El registro ha sido eliminado',
                                'success'
                            )
                        },
                        'error:':function(error){

                            swal(
                                'Error!',
                                'El registro NO ha sido eliminado',
                                'error'
                            )
                        }
                    });
                } else if (result.dismiss === 'cancel') {
                    swal(
                        '¡Cancelado!',
                        'El registro está seguro',
                        'error'
                    )
                }
            }).catch(swal.noop)
    }

    function get_data_update(type,...id){
        var controller = "";
        if (type == 'budget'){
            controller = '<?php echo CController::createUrl("budgetBreakdown/update"); ?>';
        }else if (type == "prequalification"){
            controller = '<?php echo CController::createUrl("prequalification/update"); ?>';
        } else if (type == "fuente"){
            controller='<?php echo CController::createUrl("proyectoFuente/update"); ?>';
        } else if (type == "beneficiaries"){
            controller='<?php echo CController::createUrl("proyectoMunicipio/update"); ?>';
        }else if (type == "milestone"){
            controller='<?php echo CController::createUrl("planningMilestone/update"); ?>';
        }else if (type == "documents"){
            controller='<?php echo CController::createUrl("planningDocuments/update"); ?>';
        }else if (type == "forecast"){
            controller='<?php echo CController::createUrl("forecast/update"); ?>';
        }else if (type == "forecastObs"){
            controller='<?php echo CController::createUrl("forecastObservations/update"); ?>';
        }
        var additionalParam = "";
        if (id.length === 1){
          additionalParam = "&id="+id[0];
				}else if (type == "fuente") {
					additionalParam = "&idProyecto="+id[0]+"&idFuente="+id[1];

				}else{
          //This is special for proyectoMunicipio
          //ignore this if applying to another controller
          additionalParam = "&idMunicipio="+id[0]+"&idDepartamento="+id[1]+"&idProyecto="+id[2];
        }
        $.ajax({
                type: 'GET',
                url: controller+additionalParam,
                success:function(data){
                  dialogoDeUpdate.dialog("open");
                  document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                  initDateInputs()
                },
                error: function(data) { // if error occured
                    alert("Error al actulizar documento!");
                    alert("Error: " + JSON.stringify(data));
                },
                dataType:'html'
            }
        );
    }
    var dialogoDeUpdate;
    $(document).ready(function(){
        dialogoDeUpdate = $("#proyecto-form-dialog").dialog({
        autoOpen: false,
        modal: true,
        width: 550,
        height:650,
        title: 'Details'
    });
        console.log(dialogoDeUpdate)
    })
  $(document).ready(function(){
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
        .columns.adjust()
        .responsive.recalc();
    });
  })
</script>

<?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog',
                        array(
                            'id'=>'proyecto-form-dialog',
                                'options'=>array(
                                    'title'=>Yii::t('job', 'Gestionar Elemento'),
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
<script type="text/javascript">



function updateMunicipio(departamentoValue) {
    <?php
        $data = Municipio::model()->findAll(array('order'=>'idDepartamento ASC, idMunicipio ASC'));
        // print_r($data);
        $flag = '';
        $str_arr = '';
        foreach ($data as $row) {
            if ($flag != $row->idDepartamento) {
                $str_arr .= ' ], "'.$row->idDepartamento.'": [';
                $flag = $row->idDepartamento;
                $str_arr .= ' {"idMunicipio":"'.$row->idMunicipio.'", "Municipio":"'.$row->municipio.'"}, ';
            } else {
                $str_arr .= ' {"idMunicipio":"'.$row->idMunicipio.'", "Municipio":"'.$row->municipio.'"}, ';
            }
        }
        $str_arr = substr($str_arr,3, strlen($str_arr)-5);
        $str_arr .= ']';
    ?>
    var selMuni = document.getElementById("ProyectoMunicipio_idMunicipio");
    var munis = {
			<?php echo $str_arr; ?>
		};

    selMuni.options.length = 0;

    if (departamentoValue == "") {
      selMuni.options[selMuni.options.length] = new Option('Por favor seleccione un Departamento primero','');
    }

    var listItems= "";
    for (var i = 0; i < munis[departamentoValue].length; i++){
        selMuni.options[selMuni.options.length] = new Option(munis[departamentoValue][i].Municipio,munis[departamentoValue][i].idMunicipio);
    }
}


</script>
