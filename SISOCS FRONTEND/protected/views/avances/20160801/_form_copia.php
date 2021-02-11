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
				<label>Avance Físico Obra Acumulado (%)</label>
			</div>
		</td>		
		<td width="25%">	
			<div class="row">
				<?php echo $form->labelEx($model,'porcent_programado'); ?>
				<?php echo $form->textField($model,'porcent_programado', array('size'=>15,'maxlength'=>15)); ?>
				<?php echo $form->error($model,'porcent_programado'); ?>
			</div>
		</td>		
		<td>					
			<div class="row">
				<?php echo $form->labelEx($model,'porcent_real'); ?>
				<?php echo $form->textField($model,'porcent_real', array('size'=>15,'maxlength'=>15)); ?>
				<?php echo $form->error($model,'porcent_real'); ?>
			</div>
		</td>	
	</tr>	
	<tr>
		<td width="25%">
			<div class="row">
				<label>Avance Financiero de la Obra Acumulado (Lempiras)</label>
			</div>
		</td>
		<td width="25%">		
			<div class="row">
				<?php echo $form->labelEx($model,'finan_programado'); ?>
				<?php echo $form->textField($model,'finan_programado',array('size'=>15,'maxlength'=>15)); ?>
				<?php echo $form->error($model,'finan_programado'); ?>
			</div>
		</td>		
		<td>					
			<div class="row">
				<?php echo $form->labelEx($model,'finan_real'); ?>
				<?php echo $form->textField($model,'finan_real',array('size'=>15,'maxlength'=>15)); ?>
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
				<?php echo CHtml::button('Atras',array('submit'=>array('inicioEjecucion/admin'))); ?>
		</td>			  	    	    	
	</tr>
	</table>
</center>
	
<?php 
    $codcontrato = $model->codigo_inicio_ejecucion;
    $cod_avances = $model->codigo;
?>

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
				
					<label>---  Adjuntar Documentos  ---</label>
				<label>Documento de Garantía que Puede ser i) Fianza o Garantía Bancaria, Emitida por una Institución Financiera Autorizada; ii) Bonos del Estado y; iii) Cheques Certificados.</label>							
				<div class="row">
					<?php echo $form->textField($model,'adj_garantias'); ?>
					<?php echo $form->fileField($model2,'nombre_doc1',array('size'=>200,'maxlength'=>200,)); ?>		
				</div>
																	
				</br><label>Informes de Avance de Implementación que Presentan los Contratistas</label>							
				<div class="row">
					<?php echo $form->textField($model,'adj_avances'); ?>				
					<?php echo $form->fileField($model2,'nombre_doc2',array('size'=>200,'maxlength'=>200,)); ?>	
				</div>
				
				</br><label>Informes de Supervisión de la Construcción</label>							
				<div class="row">
					<?php echo $form->textField($model,'adj_supervicion'); ?>					
					<?php echo $form->fileField($model2,'nombre_doc3',array('size'=>200,'maxlength'=>200,)); ?>	
				</div>
				
				</br><label>Informes de Evaluación de Proyecto (Continuos y al Finalizar)</label>							
				<div class="row">	
				<?php echo $form->textField($model,'adj_evaluacion'); ?>
					<?php echo $form->fileField($model2,'nombre_doc4',array('size'=>200,'maxlength'=>200,)); ?>	
				</div>
				
				</br><label>Informes de Auditoría Técnica</label>							
				<div class="row">	
				<?php echo $form->textField($model,'adj_tecnica'); ?>
					<?php echo $form->fileField($model2,'nombre_doc5',array('size'=>200,'maxlength'=>200,)); ?>	
				</div>
				
				</br><label>Informes de Auditoría Financiera</label>							
				<div class="row">	
				<?php echo $form->textField($model,'adj_financiero'); ?>
					<?php echo $form->fileField($model2,'nombre_doc6',array('size'=>200,'maxlength'=>200,)); ?>	
				</div>
				
				</br><label>Acta de Recepción Definitiva</label>							
				<div class="row">
					<?php echo $form->textField($model,'adj_recepcion'); ?>				
					<?php echo $form->fileField($model2,'nombre_doc7',array('size'=>200,'maxlength'=>200,)); ?>	
				</div>
				
				</br><label>Informe de Disconformidad, Cuando Corresponda</label>							
				<div class="row">	
					<?php echo $form->textField($model,'adj_disconformidad'); ?>	
					<?php echo $form->fileField($model2,'nombre_doc8',array('size'=>200,'maxlength'=>200,)); ?>	
				</div></br>
											
				<?php
					if($cod_avances!=''){
						echo CHtml::submitButton($model2->isNewRecord ? 'Guardar Documentos' : 'Guardar Documentos');
					  
					};
				?>
		
			<?php $this->endWidget(); ?>
						
		</div>
	</td>
</tr>	
<tr>	
	<td>
		<div class="form3">
		 <label>---  Adjuntar Imágenes  ---</label>
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
					<?php echo $form->fileField($model3,'nombre_img',array('size'=>200,'maxlength'=>200)); ?>	
				</div>				
					    
			<?php
				if($cod_avances!='') {
                
					echo CHtml::submitButton($model3->isNewRecord ? 'Guardar' : 'Guardar',array('class'=>'specialLinks'));
					
                    $filtro_grid_img = $cod_avances;
					
                    if($filtro_grid_img==''){$filtro_grid_img='0';}			
					
					$dataProImg=new CActiveDataProvider('ImgAdjuntadas',array(
										'criteria'=>array(
										    'condition'=>'cod_avance='.$filtro_grid_img,
										    'order'=>'codigo ASC',									    
										),
										'countCriteria'=>array(
										    'condition'=>'cod_avance='.$filtro_grid_img,
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
							'urlExpression'=>'$data->nombre_img',
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