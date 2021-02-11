<?php
    /* @var $this CalificacionController */
    /* @var $model Calificacion */
    /* @var $form CActiveForm */
?>
<style>
    #Calificacion_idProyecto{
        width:100%;
    }
</style>
<div class="">

    <?php $form=$this->beginWidget('CActiveForm',
                                    array( 'id'=>'calificacion-form',
                                           'enableAjaxValidation' => true,
                                           'htmlOptions' => array('enctype' => 'multipart/form-data'),
                                         )
                                  ); ?>
		<?php
    if(is_null($model->idCalificacion)){

    }else{
      $idCalificacion = $model->idCalificacion;
    }
?>
<div width="50%" border="0" align="right">
	  <div>
	    <div width="9%">&nbsp;</div>
            <div width="51%"><b>Adjudicaciones</b></div>
	    <div width="40%"></div>
      </div>
	  <div>
	    <div>&nbsp;</div>
	    <div align="right">

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
                     document.getElementById("demo").href="index.php?r=adjudicacion/create3&idCreate=<?php echo $model->idCalificacion; ?>";

                }
                else if(x=="opcion"){
                    document.getElementById("demo").href="#";
                }
                else{
                    //alert(x);
                 document.getElementById("demo").href="index.php?r=adjudicacion/view&id="+x;

                }
                //
                ////else{
                    //document.getElementById("demo").href="index.php?r=calificacion/"+x;
                //}

            }
            </script>
             <select id="mySelect" onchange="myFunction()">
            <?php
            $AdjudicacionCrear="create3";

            $listaAdju=$model->listaAdjudicaciones($model->idCalificacion);
            echo '<option value="opcion">Seleccione una Opcion</option>';
            echo '<option value="'.$AdjudicacionCrear.'">Nuevo</option>';
            foreach($listaAdju as $ids=>$nameCali){
                echo "<option value=".$ids.">".$nameCali."</option>";
            }

            ?>
		<!--<option value="TH">Thailand</option>
		<option value="EN">English</option>
		<option value="US">United States</option>-->
	</select>
        <a st="st" id="demo" class="button button5" href="#">Ir</a> <br></div>
	    <div align="left">&nbsp;</div>
      </div>
  </div>
        <p class="note">Campos con <span class="required">*</span> son requeridos.</p>

  <p><?php echo $form->errorSummary($model); ?>
        <?php //$model->arregloBusqueda(); ?>
            <?php echo $form->hiddenField($model,'idCalificacion',array('size'=>20,'maxlength'=>20,'class'=>'idcod')); ?>
        </p>
        <div width="100%" border="0">
          <div>
            <div><div width="100%" border="0">
              <div>
                <div width="11%"><span class="form-group"><?php echo $form->labelEx($model,'idProyecto'); ?></span></div>
                <div width="89%">&nbsp;</div>
              </div>
              <div>
                <div colspan="2"><span class="form-group" style="width:100%"><?php

				  if(isset($_GET['idCreate'])){
					  echo  $form->dropDownList($model,'idProyecto',$model->listaProyectosID($_GET['idCreate']));
                    //echo  $form->dropDownList($model,'idProyecto',$model->listaProyectos(),array('prompt'=>'--Seleccione un valor--'));
                }else if(isset($_GET['id'])){
					echo  $form->dropDownList($model,'idProyecto',$model->listaProyectos(),array('prompt'=>'--Seleccione un valor--','disabled'=>'disabled'));

                    //echo  $form->dropDownList($model,'idProyecto',$model->listaProyectosID($_GET['idCreate']));
                }else{
					echo  $form->dropDownList($model,'idProyecto',$model->listaProyectos(),array('prompt'=>'--Seleccione un valor--'));
				}

				//echo  $form->dropDownList($model,'idProyecto',$model->listaProyectos(),array('prompt'=>'--Seleccione un valor--'));
                       /* $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
                        'name'=>'idProyecto',
                        'source'=>$model->arregloBusqueda(),
                        // Opciones javascript adicionales para el plugin
                        'options'=>array(
                            //'minLength'=>'2',
                        ),
                        'htmlOptions'=>array(
                            //'style'=>'height:20px;',
                        ),
                    ));
             */
            ?>
                    <?php //echo  $form->dropDownList($model,'idProyecto',$model->listaProyectos(),array('prompt'=>'--Seleccione un valor--'));  ?>
                <?php echo $form->error($model,'idProyecto'); ?></span></div>
              </div>
            </div></div>
          </div>
          <div>
            <div>&nbsp;</div>
          </div>
          <div>
            <div><div width="100%" border="0">
              <div>
                <div width="35%"><?php echo $form->labelEx($model,'numproceso'); ?></div>
                <div width="65%">&nbsp;</div>
              </div>
              <div>
                <div><span class="form-group"><?php echo $form->textField($model,'numproceso',array('size'=>20,'maxlength'=>50)); ?> <?php echo $form->error($model,'numproceso'); ?></span></div>
                <div>&nbsp;</div>
              </div>
            </div></div>
          </div>
          <div>
            <div>&nbsp;</div>
          </div>
          <div>
            <div><span class="form-group"><?php echo $form->labelEx($model,'nomprocesoproyecto'); ?></span></div>
          </div>
          <div>
            <div><span class="form-group"><?php echo $form->textArea($model,'nomprocesoproyecto',array('size'=>60,'maxlength'=>2000,'rows'=>5,'cols'=>60)); ?> <?php echo $form->error($model,'nomprocesoproyecto'); ?></span></div>
          </div>
          <div>
            <div>&nbsp;</div>
          </div>
          <div>
            <div><div width="100%" border="0">
              <div>
                <div width="45%"><span class="form-group"><?php echo $form->labelEx($model,'idEnte'); ?></span></div>
                <div><span class="form-group"><?php echo  $form->dropDownList($model,'idEnte',$model->listaEntes(),
                    array('prompt'=>'--Seleccione un valor--',
                            'ajax'=>array(
                                'type'=>'POST',
                                'url'=>CController::createUrl('Calificacion/SelectUnidad'),
                                'update'=>'#'.CHtml::activeId($model,'idUnidad'),
                            ),

                        )
                        ); ?> <?php echo $form->error($model,'idEnte'); ?></span>
                </div>
                <div width="36%"><span class="form-group"><?php echo $form->labelEx($model,'idUnidad'); ?></span></div>
                <div><span class="form-group">
				<?php
					if($model->isNewRecord){
						echo $form->dropDownList($model,'idUnidad',array(),array('prompt'=>'--Seleccione un valor--'));
					}else{
						echo $form->dropDownList($model,'idUnidad',$model->listaUnidad(),array('prompt'=>'--Seleccione un valor--'));
					}
				?>
				<?php echo $form->error($model,'idUnidad'); ?></span></div>
                <div width="19%">&nbsp;</div>
              </div>
            </div></div>
          </div>
          <div>
            <div>&nbsp;</div>
          </div>
          <div>
            <div><div width="100%" border="0">
              <div>
                <div width="45%"><span class="form-group"><?php echo $form->labelEx($model,'idFuncionario'); ?></span></div>
                <div><span class="form-group"><?php echo $form->dropDownList($model,'idFuncionario',
                                            $model->listaFuncionarios(),
                                            array(  'prompt'=>'--Seleccione un valor--',
                                                    'ajax' => array(
                                                                'type'=>'GET',
                                                                'url'=>Yii::app()->createUrl('/calificacion/FuncionarioDetalle'),
                                                                'update'=>'#DIV_InfoFuncionario',
                                                                'data'=>array('id'=>'js:this.value')
                                                              )
                                                 )
                                           ); ?> <?php echo $form->error($model,'idFuncionario'); ?></span></div>
                <div width="36%"><span class="form-group"><?php echo $form->labelEx($model,'idRol'); ?></span></div>
                <div width="36%"><span class="form-group"><?php echo $form->dropDownList($model,'idRol',$model->listaRol(),array('empty'=>'--Seleccione un valor--')); ?> <?php echo $form->error($model,'idRol'); ?></span></div>
              </div>
            </div></div>
          </div>
          <div>
            <div>&nbsp;</div>
          </div>
          <div>
            <div><div width="100%" border="0">
              <div>
                <div width="45%"><span class="form-group"><?php echo $form->labelEx($model,'idTipoContrato'); ?></span></div>
                <div><span class="form-group"><?php echo $form->dropDownList($model,'idTipoContrato',$model->listaTipocontrato(),array('empty'=>'--Seleccione un valor--')); ?> <?php echo $form->error($model,'idTipoContrato'); ?></span></div>
                <div width="36%"><span class="form-group">
                  <?php  echo $form->labelEx($model,'idMetodo'); ?>
                </span></div>
                <div width="36%"><span class="form-group">
                  <?php  echo $form->dropDownList($model,'idMetodo',$model->listaMetodo(),array('empty'=>'--Seleccione un valor--')); ?>
                  <?php  echo $form->error($model,'idMetodo'); ?>
                </span></div>
                <div width="19%">&nbsp;</div>
              </div>
            </div></div>
          </div>
          <div>
            <div>&nbsp;</div>
          </div>
          <div>
            <div><span class="form-group">
              <?php
                if ($model->isNewRecord) {
                    echo '</br>';
                    echo '</br>';
                    echo '<p style="color:Red;" >Guarde para poder agregar Oferentes</p>';

                }  else {
                    echo '</br>';
                    echo '</br>';
                    echo CHtml::ajaxLink(Yii::t('job','Agregar Oferentes'),
                                                $this->createUrl('calificacionOferente/create2', array("id"=>$model->idCalificacion)),
                                                array( 'success'=>'js:function(data){
                                                       $("#oferentes-dialog-form").dialog("open");
                                                       document.getElementById("ContenidoAgregarOferentes").innerHTML=data;}',
                                                       'update' => '#filas_firmas'
                                                )
                                        );
                    $this->beginWidget( 'zii.widgets.jui.CJuiDialog',
                                        array( 'id'=>'oferentes-dialog-form',
                                               'options'=>array( 'title'=>Yii::t('job','Agregar oferentes'),
                                                                 'autoOpen'=>false,
                                                                 'model'=>'true',
																 'resizeable'=>true,
																 'show' => 'fold',
																 'hide' => 'drop',
																 'width'=>350,
																 'height'=>300,
                                                               ),
                                             )
                                      );
                        echo "<div id='ContenidoAgregarOferentes'></div>";
                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                }
            ?>
            <div id="filas_oferentes"></div>
            </span></div>
          </div>
          <div>
            <div>&nbsp;</div>
          </div>
          <div>
            <div>
                  <div class="form-group">
                                <?php
                                  if ($model->isNewRecord) {
                                      echo '<p style="color:Red;">Guarde para poder agregar documentos</p>';
                                  } else {
                                      echo CHtml::ajaxLink(Yii::t('job', 'Agregar Documento'),
                                                          $this->createUrl('tenderDocuments/create', array('id'=>$model->idCalificacion)),
                                                          array(    'success'=>'js:function(data) {
                                                                          updateDialog.dialog("open");
                                                                          document.getElementById("ContenidoAgregarDocuments").innerHTML=data;
                                                                          initDateInputs();
                                                                      }',
                                                                  'update' => '#filas_desembolsos'
                                                          )
                                                  );

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

                                  } ?>
                  </div>
                    <div class="form-group">
                        <div id="filas_desembolsos"></div>
                    </div>
            </div>
          </div>
          <div>
            <div>&nbsp;</div>
          </div>
          <div>
            <div></div>
          </div>
          <div>
            <div></div>
          </div>
          <div>
            <div><span class="form-group">
              <?php //echo $form->labelEx($model,'usuario_creacion'); ?>

          </div>
        </div>
		<div class="container"><div class="row" align="center"><p>#-------------------------------- Fechas --------------------------------#<p></div></div>
		<div style="max-width: 100%; border: 1px; border-style: solid; height:100%; border-color:#07aafc; margin: 0;" class="container" width="100px">
			<div class="row form-group" style="padding: 10px" >
				<div class="col-md-6">
					<?php echo $form->labelEx($model,'contract_startDate'); ?>
					<?php
					if ($model->contract_startDate!='') {
					    $model->contract_startDate=date('Y-m-d',strtotime($model->contract_startDate));
				    }
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						  'model'=>$model,
						  'attribute'=>'contract_startDate',
						  'value'=>$model->contract_startDate,
						  'language' => 'es',
						  'htmlOptions' => array('readonly'=>"readonly"),
						  'options'=>array(
						  'autoSize'=>true,
						  'defaultDate'=>$model->contract_startDate,
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
			 		?>
					<?php echo $form->error($model,'contract_startDate'); ?>
			 	</div>
				<div class="col-md-6">
			 		<?php echo $form->labelEx($model,'contract_endDate'); ?>
					<?php
					 	if ($model->contract_endDate!='') {
						    $model->contract_endDate=date('Y-m-d',strtotime($model->contract_endDate));
					    }
						   $this->widget('zii.widgets.jui.CJuiDatePicker',
								array(
									'model'=>$model,
									'attribute'=>'contract_endDate',
									'value'=>$model->contract_endDate,
									'language' => 'es',
									'htmlOptions' => array('readonly'=>"readonly"),
									'options'=>array(
										'autoSize'=>true,
										'defaultDate'=>$model->contract_endDate,
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
						   		)
							);
		  	    	?>
				<?php echo $form->error($model,'contract_endDate'); ?>
		  		</div>
			</div>
			<div class="row form-group" style="padding: 10px" >
				<div class="col-md-6">
					<?php echo $form->labelEx($model,'contract_maxExtentDate'); ?>
					<?php
					if ($model->contract_maxExtentDate!='') {
					    $model->contract_maxExtentDate=date('Y-m-d',strtotime($model->contract_maxExtentDate));
				    }
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						  'model'=>$model,
						  'attribute'=>'contract_maxExtentDate',
						  'value'=>$model->contract_maxExtentDate,
						  'language' => 'es',
						  'htmlOptions' => array('readonly'=>"readonly"),
						  'options'=>array(
						  'autoSize'=>true,
						  'defaultDate'=>$model->contract_maxExtentDate,
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
			 		?>
					<?php echo $form->error($model,'contract_maxExtentDate'); ?>
			 	</div>
				<div class="col-md-6">
			 		<?php echo $form->labelEx($model,'contract_durationInDays'); ?>
					<?php echo $form->textField($model,'contract_durationInDays', array('readonly'=>true)); ?>
				<?php echo $form->error($model,'contract_durationInDays'); ?>
		  		</div>
			</div>
			<br><br>
		<div class="row form-group" style="padding: 10px" >
			<div class="col-md-6">
				<?php echo $form->labelEx($model,'award_startDate'); ?>
				<?php
					if ($model->award_startDate!='') {
									  $model->award_startDate=date('Y-m-d',strtotime($model->award_startDate));
					  }
								  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
								  'model'=>$model,
								  'attribute'=>'award_startDate',
								  'value'=>$model->award_startDate,
								  'language' => 'es',
								  'htmlOptions' => array('readonly'=>"readonly"),
								  'options'=>array(
								  'autoSize'=>true,
								  'defaultDate'=>$model->award_startDate,
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
				?>
				<?php echo $form->error($model,'award_startDate'); ?>
	 			</div>
					<div class="col-md-6">
					 	<?php echo $form->labelEx($model,'award_endDate'); ?>
					 	<?php
						 if ($model->award_endDate!='') {
										   $model->award_endDate=date('Y-m-d',strtotime($model->award_endDate));
						   }
									   $this->widget('zii.widgets.jui.CJuiDatePicker', array(
									   'model'=>$model,
									   'attribute'=>'award_endDate',
									   'value'=>$model->award_endDate,
									   'language' => 'es',
									   'htmlOptions' => array('readonly'=>"readonly"),
									   'options'=>array(
									   'autoSize'=>true,
									   'defaultDate'=>$model->award_endDate,
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
					  	   			?><?php echo $form->error($model,'award_endDate'); ?>
			  		</div>
		</div>
		<div class="row form-group" style="padding: 10px" >
			<div class="col-md-6">
				<?php echo $form->labelEx($model,'award_maxExtentDate'); ?>
				<?php
				if ($model->award_maxExtentDate!='') {
					$model->award_maxExtentDate=date('Y-m-d',strtotime($model->award_maxExtentDate));
				}
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					  'model'=>$model,
					  'attribute'=>'award_maxExtentDate',
					  'value'=>$model->award_maxExtentDate,
					  'language' => 'es',
					  'htmlOptions' => array('readonly'=>"readonly"),
					  'options'=>array(
					  'autoSize'=>true,
					  'defaultDate'=>$model->award_maxExtentDate,
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
				?>
				<?php echo $form->error($model,'award_maxExtentDate'); ?>
			</div>
			<div class="col-md-6">
				<?php echo $form->labelEx($model,'award_durationInDays'); ?>
				<?php echo $form->textField($model,'award_durationInDays', array('readonly'=>true, 'style'=>'width:100px;')); ?>
			<?php echo $form->error($model,'award_durationInDays'); ?>
			</div>
		</div>
		<br><br>
		<div class="row form-group" style="padding: 10px" >
			<div class="col-md-6">
				<?php echo $form->labelEx($model,'enquiry_startDate'); ?>
				<?php
					if ($model->enquiry_startDate!='') {
									  $model->enquiry_startDate=date('Y-m-d',strtotime($model->enquiry_startDate));
					  }
								  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
								  'model'=>$model,
								  'attribute'=>'enquiry_startDate',
								  'value'=>$model->enquiry_startDate,
								  'language' => 'es',
								  'htmlOptions' => array('readonly'=>"readonly"),
								  'options'=>array(
								  'autoSize'=>true,
								  'defaultDate'=>$model->enquiry_startDate,
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
				?>
				<?php echo $form->error($model,'enquiry_startDate'); ?>
	 			</div>
					<div class="col-md-6">
					 	<?php echo $form->labelEx($model,'enquiry_endDate'); ?>
					 	<?php
						 if ($model->enquiry_endDate!='') {
										   $model->enquiry_endDate=date('Y-m-d',strtotime($model->enquiry_endDate));
						   }
									   $this->widget('zii.widgets.jui.CJuiDatePicker', array(
									   'model'=>$model,
									   'attribute'=>'enquiry_endDate',
									   'value'=>$model->enquiry_endDate,
									   'language' => 'es',
									   'htmlOptions' => array('readonly'=>"readonly"),
									   'options'=>array(
									   'autoSize'=>true,
									   'defaultDate'=>$model->enquiry_endDate,
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
					  	   			?><?php echo $form->error($model,'enquiry_endDate'); ?>
			  		</div>
			</div>
			<div class="row form-group" style="padding: 10px" >
				<div class="col-md-6">
					<?php echo $form->labelEx($model,'enquiry_maxExtentDate'); ?>
					<?php
					if ($model->enquiry_maxExtentDate!='') {
						$model->enquiry_maxExtentDate=date('Y-m-d',strtotime($model->enquiry_maxExtentDate));
					}
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						  'model'=>$model,
						  'attribute'=>'enquiry_maxExtentDate',
						  'value'=>$model->enquiry_maxExtentDate,
						  'language' => 'es',
						  'htmlOptions' => array('readonly'=>"readonly"),
						  'options'=>array(
						  'autoSize'=>true,
						  'defaultDate'=>$model->enquiry_maxExtentDate,
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
					?>
					<?php echo $form->error($model,'enquiry_maxExtentDate'); ?>
				</div>
				<div class="col-md-6">
					<?php echo $form->labelEx($model,'enquiry_durationInDays'); ?>
					<?php echo $form->textField($model,'enquiry_durationInDays', array('readonly'=>true, 'style'=>'width:100px;')); ?>
				<?php echo $form->error($model,'enquiry_durationInDays'); ?>
				</div>
			</div>
			<br><br>
			<div class="row form-group" style="padding: 10px" >
				<div class="col-md-6">
					<?php echo $form->labelEx($model,'tender_startDate'); ?>
					<?php
					if ($model->tender_startDate!='') {
					    $model->tender_startDate=date('Y-m-d',strtotime($model->tender_startDate));
				    }
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						  'model'=>$model,
						  'attribute'=>'tender_startDate',
						  'value'=>$model->tender_startDate,
						  'language' => 'es',
						  'htmlOptions' => array('readonly'=>"readonly"),
						  'options'=>array(
						  'autoSize'=>true,
						  'defaultDate'=>$model->tender_startDate,
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
			 		?>
					<?php echo $form->error($model,'tender_startDate'); ?>
			 	</div>
				<div class="col-md-6">
			 		<?php echo $form->labelEx($model,'tender_endDate'); ?>
					<?php
					 	if ($model->tender_endDate!='') {
						    $model->tender_endDate=date('Y-m-d',strtotime($model->tender_endDate));
					    }
						   $this->widget('zii.widgets.jui.CJuiDatePicker',
								array(
									'model'=>$model,
									'attribute'=>'tender_endDate',
									'value'=>$model->tender_endDate,
									'language' => 'es',
									'htmlOptions' => array('readonly'=>"readonly"),
									'options'=>array(
										'autoSize'=>true,
										'defaultDate'=>$model->tender_endDate,
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
						   		)
							);
		  	    	?>
				<?php echo $form->error($model,'tender_endDate'); ?>
		  		</div>
			</div>
			<div class="row form-group" style="padding: 10px" >
				<div class="col-md-6">
					<?php echo $form->labelEx($model,'tender_maxExtentDate'); ?>
					<?php
					if ($model->tender_maxExtentDate!='') {
						$model->tender_maxExtentDate=date('Y-m-d',strtotime($model->tender_maxExtentDate));
					}
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						  'model'=>$model,
						  'attribute'=>'tender_maxExtentDate',
						  'value'=>$model->tender_maxExtentDate,
						  'language' => 'es',
						  'htmlOptions' => array('readonly'=>"readonly"),
						  'options'=>array(
						  'autoSize'=>true,
						  'defaultDate'=>$model->tender_maxExtentDate,
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
					?>
					<?php echo $form->error($model,'tender_maxExtentDate'); ?>
				</div>
				<div class="col-md-6">
					<?php echo $form->labelEx($model,'tender_durationInDays'); ?>
					<?php echo $form->textField($model,'tender_durationInDays', array('readonly'=>true, 'style'=>'width:100px;')); ?>
				<?php echo $form->error($model,'tender_durationInDays'); ?>
				</div>
			</div>

	</div>
		<div class="form-group"><?php echo $form->labelEx($model,'estado'); ?></div>
		<div class="form-group"><?php echo  $form->dropDownList($model,'estado',$model->listaEstados(),array('prompt'=>'--Seleccione un valor--'));?> <?php echo $form->error($model,'estado'); ?></div>
		<?php

		  if ($model->isNewRecord) {
			  $fechaCreacion=date("Y-m-d H:i:s");
		  echo $form->hiddenField($model,'fecha_creacion',array('value'=>$fechaCreacion));
	  }
	  else {
		  //echo $usuarioActual;
		  echo $form->labelEx($model,'fecha_creacion');
	  ?>
		<?php echo $form->textField($model,'fecha_creacion',array('value'=>$model->fecha_creacion,'disabled'=>'true')); ?>
		<?php } ?>
	  <?php echo $form->error($model,'fecha_creacion'); ?></span></div>

        <div class="form-group"></div>

          <div class="form-group"></div>

         <div class="form-group">
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

        <div class="form-group buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks')); ?>
        </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
    <?php $lid = 0;
          if (!$model->isNewRecord) {
             $lid = $model->idFuncionario; ?>
             CargarDetalleFuncionario(<?php echo $lid; ?>)
             cargaCalioferente();
    <?php }  ?>

    function CargarDetalleFuncionario(lid) {
        $('#DIV_InfoFuncionario').hide(500);
        if(lid>'0') {
            $('#DIV_InfoFuncionario').show(500);
        }
    }

    function cargaCalioferente(){
        $('#filas_oferentes').load('<?php echo CController::createUrl("/calificacionOferente/ViewDetOferentes", array("id"=>$model->idCalificacion, "event"=>"Update")); ?>');
    }

    function IniciarDetalleFuncionario(lid) {
        $('#DIV_InfoFuncionario').load('<?php if (!$model->isNewRecord) { echo CController::createUrl("/calificacion/FuncionarioDetalle", array('id'=>$model->idFuncionario));} ?>');
    }

    function pad(n, length){
        n = n.toString();
        while(n.length < length) n = "0" + n;
        return n;
    }

    function send_oferente() {
        var data=$("#calificacion-oferente-form").serialize();

        $.ajax({ type: 'POST',
                 url: '<?php echo CController::createUrl('/calificacionOferente/create2', array('id'=>$model->idCalificacion)); ?>',
                 data:data,
                 success:function(data){
                        //alert("Datos Enviados");
                        //alert("Error alguno: " + JSON.stringify(data));
                        cargaCalioferente();
                        //$('#oferentes-dialog-form').dialog("close");
                 },
                error: function(data) { // if error occured
                            alert("Error el oferente ya existe!");
                            alert("Error alguno: " + JSON.stringify(data));
                        },
                dataType:'html'
              });
    }
</script>


<script type="text/javascript">
$().ready(function(){
    $("#Calificacion_contract_durationInDays")
    .focus(
    function(){
        var start = $('#Calificacion_contract_startDate').datepicker('getDate');
        var end   = $('#Calificacion_contract_endDate').datepicker('getDate');
        var days   = (end - start)/1000/60/60/24;
        if (start!=null)
            {
            $('#Calificacion_contract_durationInDays').val(days+" dias");
            }
        });
	$("#Calificacion_award_durationInDays")
    .focus(
    function(){
        var start = $('#Calificacion_award_startDate').datepicker('getDate');
        var end   = $('#Calificacion_award_endDate').datepicker('getDate');
        var days   = (end - start)/1000/60/60/24;
        if (start!=null)
            {
            $('#Calificacion_award_durationInDays').val(days+" dias");
            }
        });
	$("#Calificacion_enquiry_durationInDays")
    .focus(
    function(){
        var start = $('#Calificacion_enquiry_startDate').datepicker('getDate');
        var end   = $('#Calificacion_enquiry_endDate').datepicker('getDate');
        var days   = (end - start)/1000/60/60/24;
        if (start!=null)
            {
            $('#Calificacion_enquiry_durationInDays').val(days+" dias");
            }
        });
	$("#Calificacion_tender_durationInDays")
	.focus(
    function(){
        var start = $('#Calificacion_tender_startDate').datepicker('getDate');
        var end   = $('#Calificacion_tender_endDate').datepicker('getDate');
        var days   = (end - start)/1000/60/60/24;
        if (start!=null)
            {
            $('#Calificacion_tender_durationInDays').val(days+" dias");
            }
        });

    });
    function initDateInputs(){
      $("#TenderDocuments_datePublished").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });
      $("#TenderDocuments_dateModified").datepicker({
          uiLibrary: "bootstrap4",
          dateFormat: 'yy-mm-dd',
		  changeYear:true,
		  changeMonth:true
      });
    }

    function loadDocuments(){
      console.log("Calling this");
        $('#filas_desembolsos').load('<?php echo CController::createUrl("/Calificacion/ViewDocuments", array("id"=>$model->idCalificacion, "event"=>"Update")); ?>');

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
            url: '<?php echo CController::createUrl("tenderDocuments/create", array("id"=>$model->idCalificacion)); ?>',
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
                url: '<?php echo CController::createUrl("tenderDocuments/update"); ?>'+'&id='+idTenderDocuments,
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
                url: '<?php echo CController::createUrl("tenderDocuments/update"); ?>'+'&id='+idTenderDocuments,
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

<?php


Yii::app()->clientScript->registerScript('id_something',
''
. 'valorcomboContrato = document.getElementById("Calificacion_tipocontrato").value;'
. 'valorIdFuncionario = document.getElementById("Calificacion_idFuncionario").value;'
. 'IniciarDetalleFuncionario(valorIdFuncionario);'
, CClientScript::POS_LOAD);

?>
