<?php
/* @var $this AvancesController */
/* @var $model Avances */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'avances-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

<center>
	<table border="0" align="center">		
	<tr>
		<td colspan="3">		
			<div class="row">
				<?php echo $form->labelEx($model,'codigo_inicio_ejecucion'); ?>
				<?php echo $form->textField($model,'codigo_inicio_ejecucion',array('size'=>10,'maxlength'=>10,'readonly'=>'true', 'value'=>$cod_inicio_ejecucion,)); ?>
				<?php echo $form->error($model,'codigo_inicio_ejecucion'); ?>
			</div>
		</td>
	
	</tr>		
	<tr>
		<td width="25%">
			<div class="row">
				<label>Avance fisico obra acumulado (%)</label>
			</div>
		</td>		
		<td width="25%">	
			<div class="row">
				<?php echo $form->labelEx($model,'porcent_programado'); ?>
				<?php echo $form->textField($model,'porcent_programado', array('size'=>10,'maxlength'=>10)); ?>
				<?php echo $form->error($model,'porcent_programado'); ?>
			</div>
		</td>		
		<td>					
			<div class="row">
				<?php echo $form->labelEx($model,'porcent_real'); ?>
				<?php echo $form->textField($model,'porcent_real', array('size'=>10,'maxlength'=>10)); ?>
				<?php echo $form->error($model,'porcent_real'); ?>
			</div>
		</td>	
	</tr>	
	<tr>
		<td width="25%">
			<div class="row">
				<label>Avance financiero de la obra acumulado (Lempira)</label>
			</div>
		</td>
		<td width="25%">		
			<div class="row">
				<?php echo $form->labelEx($model,'finan_programado'); ?>
				<?php echo $form->textField($model,'finan_programado',array('size'=>10,'maxlength'=>10)); ?>
				<?php echo $form->error($model,'finan_programado'); ?>
			</div>
		</td>		
		<td>					
			<div class="row">
				<?php echo $form->labelEx($model,'finan_real'); ?>
				<?php echo $form->textField($model,'finan_real',array('size'=>10,'maxlength'=>10)); ?>
				<?php echo $form->error($model,'finan_real'); ?>
			</div>
		</td>
	</tr>	
	<tr>		
		<td>	
			<div class="row">
				<?php echo $form->labelEx($model,'fecha_avance'); ?>
				<?php
				if ($model->fecha_avance!='') {
				$model->fecha_avance=date('Y-m-d h:m:s',strtotime($model->fecha_avance));
				}
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'attribute'=>'fecha_avance',
				//'value' =>(isset($_GET["fecha_avance"])? $_GET["fecha_avance"]: date("d-m-Y", mktime()+60*60*24)),

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
			<div class="row">
				<?php echo $form->labelEx($model,'desc_problemas'); ?>				
			        <?php echo $form->textArea($model, 'desc_problemas', array('maxlength' => 200, 'rows' => 6, 'cols' => 25)); ?>					
				<?php echo $form->error($model,'desc_problemas'); ?>
			</div>
		</td>
		<td>
			<div class="row">
				<?php echo $form->labelEx($model,'desc_temas'); ?>
				<?php echo $form->textArea($model, 'desc_temas', array('maxlength' => 200, 'rows' => 6, 'cols' => 25)); ?>				
				<?php echo $form->error($model,'desc_temas'); ?>
			</div>	
		</td>	
	</tr>	
	<tr>
		<td>		
			<div class="row" style="display:none">
				<?php echo $form->labelEx($model,'fecha_registro'); ?>
				<?php echo $form->textField($model,'fecha_registro',array('disabled'=>true)); ?>
				<?php echo $form->error($model,'fecha_registro'); ?>
			</div>
		</td>
		<td>	
			<div class="row" style="display:none">
				<?php echo $form->labelEx($model,'user_registro'); ?>
				<?php echo $form->textField($model,'user_registro',array('size'=>16,'maxlength'=>16,'disabled'=>true)); ?>
				<?php echo $form->error($model,'user_registro'); ?>
			</div>
		</td>
		<td>
		</td>
	</tr>
	<tr>
	    <td colspan="3">
		<div class="row">
			<?php echo $form->labelEx($model,'estado_sol'); ?>
			<?php echo $form->dropDownList($model,'estado_sol',$model->listaEstadosSol());?>
			<?php echo $form->error($model,'estado_sol'); ?>
		</div>		
	    </td>		
	</tr>
	<tr>	
		<td colspan="2" align="Center">
		</br></br>
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar'); ?>
				<?php //echo CHtml::button('Cerrar', array('onclick' =>'js:function(){  $(this).dialog("close"); }')); ?>					
				<?php //echo CHtml::button('Cancel',array('onclick'=>"window.parent.$('#dialogItem').dialog('close');window.parent.$('#dialogItem').attr('src','');")); ?>
			       <?php echo CHtml::button('Atras',array('submit'=>array('inicioEjecucion/admin'))); ?>
				
		</td>			  	    	    	
	</tr>
    <?php 
            $codcontrato =$model->codigo_inicio_ejecucion;
            $cod_avances =$model->codigo;
    ?>
   
	</table>
</center>	

<?php $this->endWidget(); ?>

</div><!-- form -->
<table>
<tr>
	<td>
		<div class="form2">
		       
		       <?php
			$form = $this->beginWidget('CActiveForm', array(
			    'id' => 'doc-adjuntados-form',
			    'enableAjaxValidation' => false,
			    'htmlOptions' => array('enctype' => 'multipart/form-data')
				));
			?>	
			    <?php echo $form->errorSummary($model2); ?>
			    
				<div class="row" style="display:none">

					<?php echo $form->textField($model2,'cod_contrato',array('size'=>25,'maxlength'=>25,'readonly'=>'true', 'value'=>$cod_inicio_ejecucion,)); ?>
				</div>
				<div class="row" style="display:none">

					<?php echo $form->textField($model2,'cod_avance',array('size'=>25,'maxlength'=>25,'readonly'=>'true', 'value'=>$cod_avances,)); ?>
				</div>				
			
				<div class="row" style="display:none">
					<?php echo $form->textField($model2,'ubicacion_doc',array('size'=>60,'maxlength'=>100)); ?>
				</div>
			    
				<label>Documento de garantía que puede ser i) Fianza o Garantía bancaria, emitida por una institución financiera autorizada; ii) Bonos del Estado y; iii) Cheques Certificados.</label>							
				<div class="row">
					<?php echo $form->fileField($model2,'nombre_doc1',array('size'=>200,'maxlength'=>200,)); ?>		
				</div>
															
				<?php
					//  if($cod_avances!=''){
					//	echo CHtml::submitButton($model2->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks'));
					//   };
				?>	

			
				</br><label>Informes de avance de implementación que presentan los contratistas</label>							
				<div class="row">	
					<?php echo $form->fileField($model2,'nombre_doc2',array('size'=>200,'maxlength'=>200,)); ?>	
				</div>
															
				<?php
					//  if($cod_avances!=''){
					//	echo CHtml::submitButton($model2->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks'));
					//  }; 
				?>
				
				
				</br><label>Informes de supervisión de la construcción</label>							
				<div class="row">	
					<?php echo $form->fileField($model2,'nombre_doc3',array('size'=>200,'maxlength'=>200,)); ?>	
				</div>
															
				<?php
					//  if($cod_avances!=''){
					//	echo CHtml::submitButton($model2->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks'));
					//   };
				?>
				
				
				</br><label>Informes de evaluación de proyecto (continuos y al finalizar)</label>							
				<div class="row">	
					<?php echo $form->fileField($model2,'nombre_doc4',array('size'=>200,'maxlength'=>200,)); ?>	
				</div>
															
				<?php
					//  if($cod_avances!=''){
					//	echo CHtml::submitButton($model2->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks'));
					//   };
				?>				
				
				</br><label>Informes de auditoría técnica</label>							
				<div class="row">	
					<?php echo $form->fileField($model2,'nombre_doc5',array('size'=>200,'maxlength'=>200,)); ?>	
				</div>
															
				<?php
					//  if($cod_avances!=''){
					//	echo CHtml::submitButton($model2->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks'));
					//   };
				?>
				
				</br><label>Informes de auditoría financiera</label>							
				<div class="row">	
					<?php echo $form->fileField($model2,'nombre_doc6',array('size'=>200,'maxlength'=>200,)); ?>	
				</div>
															
				<?php
					//  if($cod_avances!=''){
					//	echo CHtml::submitButton($model2->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks'));
					//   };
				?>
				
				
				</br><label>Acta de recepción definitiva</label>							
				<div class="row">	
					<?php echo $form->fileField($model2,'nombre_doc7',array('size'=>200,'maxlength'=>200,)); ?>	
				</div>
															
				<?php
					//  if($cod_avances!=''){
					//	echo CHtml::submitButton($model2->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks'));
					//   };
				?>
				
				
				</br><label>Informe de disconformidad, cuando corresponda</label>							
				<div class="row">	
					<?php echo $form->fileField($model2,'nombre_doc8',array('size'=>200,'maxlength'=>200,)); ?>	
				</div></br>
											
				<?php
					  if($cod_avances!=''){
						echo CHtml::submitButton($model2->isNewRecord ? 'Guardar Documentos' : 'Guardar Documentos');
					  
				?>				

				
				
				
				
			<?php $filtro_grid_doc =$model->codigo_inicio_ejecucion;
					     if($filtro_grid_doc==''){$filtro_grid_doc='0';}			
					;?>
			<?php
					
																			
					$dataProDoc=new CActiveDataProvider('DocAdjuntados',array(
										'criteria'=>array(
										    //'with'=>array('answers', 'hardwaredetails'=>array( 'on'=>'hardwaredetail_Id=' .$modelHD->Id,'together'=>true,'joinType'=>'INNER JOIN',)),
										    'condition'=>'cod_contrato='.$filtro_grid_doc,
										    'order'=>'codigo ASC',									    
										),
										'countCriteria'=>array(
										    'condition'=>'cod_contrato='.$filtro_grid_doc,
										    // 'order' and 'with' clauses have no meaning for the count query
										),
										'pagination'=>array(
										    'pageSize'=>20,
										),));
					
		
	
					$this->widget('zii.widgets.grid.CGridView', array(
						'id'=>'documentos-grid',
						'dataProvider'=>$dataProDoc,
						'htmlOptions'=>array('style'=>'word-wrap:break-word; width:850px; table-layout:fixed; '),
						'columns'=>array(
							array('name'=>'nombre_doc1',
							       'headerHtmlOptions' => array('style' => 'display:none'),
							       'htmlOptions'=>array('width'=>'0px', 'style' => 'display:none')),
							 array(
							'class'=>'CLinkColumn',
							'header'=>'Doc. Garantias',
							'labelExpression'=>'$data->nombre_fisico1',
							'urlExpression'=>'$data->direccionDocumento1()',
						      ),
						       
						       array('name'=>'nombre_doc2',
							       'headerHtmlOptions' => array('style' => 'display:none'),
							       'htmlOptions'=>array('width'=>'0px', 'style' => 'display:none')),
							 array(
							'class'=>'CLinkColumn',
							'header'=>'Doc. Avances',
							'labelExpression'=>'$data->nombre_fisico2',
							'urlExpression'=>'$data->direccionDocumento2()',
							//'htmlOptions'=>array('style' => 'white-space: normal; width:50%;'),
						      ),
						        array('name'=>'nombre_doc3',
							       'headerHtmlOptions' => array('style' => 'display:none'),
							       'htmlOptions'=>array('width'=>'0px', 'style' => 'display:none')),
							 array(
							'class'=>'CLinkColumn',
							'header'=>'Doc. Supervision',
							'labelExpression'=>'$data->nombre_fisico3',
							'urlExpression'=>'$data->direccionDocumento3()',
						      ),
				                      array('name'=>'nombre_doc4',
							       'headerHtmlOptions' => array('style' => 'display:none'),
							       'htmlOptions'=>array('width'=>'0px', 'style' => 'display:none')),
							 array(
							'class'=>'CLinkColumn',
							'header'=>'Doc. Evaluacion',
							'labelExpression'=>'$data->nombre_fisico4',
							'urlExpression'=>'$data->direccionDocumento4()',
						      ),
						        array('name'=>'nombre_doc5',
							       'headerHtmlOptions' => array('style' => 'display:none'),
							       'htmlOptions'=>array('width'=>'0px', 'style' => 'display:none')),
							 array(
							'class'=>'CLinkColumn',
							'header'=>'Doc. Audt. Tecnica',
							'labelExpression'=>'$data->nombre_fisico5',
							'urlExpression'=>'$data->direccionDocumento5()',
						      ),							 
				
						       array('name'=>'nombre_doc6',
							       'headerHtmlOptions' => array('style' => 'display:none'),
							       'htmlOptions'=>array('width'=>'0px', 'style' => 'display:none')),
							 array(
							'class'=>'CLinkColumn',
							'header'=>'Doc. Audt. Financiera',
							'labelExpression'=>'$data->nombre_fisico6',
							'urlExpression'=>'$data->direccionDocumento6()',
						      ),
						        array('name'=>'nombre_doc7',
							       'headerHtmlOptions' => array('style' => 'display:none'),
							       'htmlOptions'=>array('width'=>'0px', 'style' => 'display:none')),
							 array(
							'class'=>'CLinkColumn',
							'header'=>'Doc. Acta Recepcion',
							'labelExpression'=>'$data->nombre_fisico7',
							'urlExpression'=>'$data->direccionDocumento7()',
						      ),
				                      array('name'=>'nombre_doc8',
							       'headerHtmlOptions' => array('style' => 'display:none'),
							       'htmlOptions'=>array('width'=>'0px', 'style' => 'display:none')),
							 array(
							'class'=>'CLinkColumn',
							'header'=>'Doc. Disconformidad',
							'labelExpression'=>'$data->nombre_fisico8',
							'urlExpression'=>'$data->direccionDocumento8()',
						      ),
						       

							
						),
					));
					};
					?>
		
			<?php $this->endWidget(); ?>
						
		</div>
	</td>
</tr>	
<tr>	
	<td>
		<div class="form3">
		 <label>Adjuntar Imagenes</label>
		<?php
			$form = $this->beginWidget('CActiveForm', array(
			    'id' => 'img-adjuntados-form',
			    'enableAjaxValidation' => false,
			    'htmlOptions' => array('enctype' => 'multipart/form-data')
				));
			?>

			    <?php echo $form->errorSummary($model3); ?>
			    
				<div class="row" style="display:none">

					<?php echo $form->textField($model3,'cod_contrato',array('size'=>25,'maxlength'=>25,'readonly'=>'true', 'value'=>$cod_inicio_ejecucion,)); ?>
				</div>
			
				<div class="row" style="display:none">
					<?php echo $form->textField($model3,'ubicacion_img',array('size'=>60,'maxlength'=>100)); ?>
				</div>
			    
											
				<div class="row">
					<?php //echo $form->labelEx($model3,'nombre_img'); ?>
					<?php echo $form->fileField($model3,'nombre_img',array('size'=>200,'maxlength'=>200)); ?>	
					<?php //echo $form->error($model3,'nombre_img'); ?>
				</div>				
					    
			<?php
				if($cod_avances!=''){
					echo CHtml::submitButton($model3->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks'));
				   
			?>	

			<?php $filtro_grid_img =$model->codigo_inicio_ejecucion;
					     if($filtro_grid_img==''){$filtro_grid_img='0';}			
					;?>
					
					
			<?php
										
					
					$dataProImg=new CActiveDataProvider('ImgAdjuntadas',array(
										'criteria'=>array(
										    'condition'=>'cod_contrato='.$filtro_grid_img,
										    'order'=>'codigo ASC',									    
										),
										'countCriteria'=>array(
										    'condition'=>'cod_contrato='.$filtro_grid_img,
										),
										'pagination'=>array(
										    'pageSize'=>20,
										),));
					

					$this->widget('zii.widgets.grid.CGridView', array(
						'id'=>'imagenes-grid',
						'dataProvider'=>$dataProImg,
						'columns'=>array(
							 array('name'=>'nombre_img',
							       'headerHtmlOptions' => array('style' => 'display:none'),
							       'htmlOptions'=>array('width'=>'0px', 'style' => 'display:none')),
							 array(
							'class'=>'CLinkColumn',
							'header'=>'Imagenes',
							'labelExpression'=>'$data->nombre_fisico',
							'urlExpression'=>'$data->direccionImagenes()',
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