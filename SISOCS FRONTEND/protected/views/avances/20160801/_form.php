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
	'enableAjaxValidation' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

<center>
	<table border="0" align="center">		
	<tr>
		<td colspan="3">		
			<div class="row">
				<?php echo $form->labelEx($model,'idInicioEjecucion'); ?>
				<?php echo $form->textField($model,'idInicioEjecucion',array('size'=>10,'maxlength'=>10,'readonly'=>'true', 'value'=>$idInicioEjecucion)); ?>
				<?php echo $form->error($model,'idInicioEjecucion'); ?>
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
				<?php echo $form->labelEx($model,'fecha_avance'); ?>
				<?php echo $form->textField($model,'fecha_avance',array('disabled'=>true)); ?>
				<?php echo $form->error($model,'fecha_avance'); ?>
			</div>
		</td>
		<td>	
			<div class="row" style="display:none">
				<?php echo $form->labelEx($model,'usuario_creacion'); ?>
				<?php echo $form->textField($model,'usuario_creacion',array('size'=>16,'maxlength'=>16,'disabled'=>true)); ?>
				<?php echo $form->error($model,'usuario_creacion'); ?>
			</div>
		</td>
		<td>
		</td>
	</tr>

		
		</br>
		        <tr>
	    <td colspan="3">
		<label>---  Adjuntar Documentos  ---</label>
	    </td>		
	</tr>
	</br>
		
	<tr>
	
	    <td colspan="3">
			<label>Documento de Garantía que Puede ser i) Fianza o Garantía Bancaria, Emitida por una Institución Financiera Autorizada; ii) Bonos del Estado y; iii) Cheques Certificados.</label>							
			
					<?php echo $form->textField($model,'adj_garantias'); 
					    echo $form->fileField($model, 'image1');
						echo $form->error($model, 'image1'); ?>
	    </td>		
	</tr>
	
	<tr>
	    <td colspan="3">
			</br><label>Informes de Avance de Implementación que Presentan los Contratistas</label>							
				<div class="row">
					<?php 	echo $form->textField($model,'adj_avances'); 				
							echo $form->fileField($model, 'image2');
							echo $form->error($model, 'image2'); ?>
				</div>
	    </td>		
	</tr>
	
	<tr>
	    <td colspan="3">
			</br><label>Informes de Supervisión de la Construcción</label>							
				<div class="row">
					<?php echo $form->textField($model,'adj_supervicion'); 
							echo $form->fileField($model, 'image3');
							echo $form->error($model, 'image3'); ?>
				</div>
	    </td>		
	</tr>
	
	<tr>
	    <td colspan="3">
			</br><label>Informes de Evaluación de Proyecto (Continuos y al Finalizar)</label>							
				<div class="row">	
				<?php echo $form->textField($model,'adj_evaluacion'); 
					echo $form->fileField($model, 'image4');
							echo $form->error($model, 'image4'); ?>
				</div>
	    </td>		
	</tr>
	
	<tr>
	    <td colspan="3">
			</br><label>Informes de Auditoría Técnica</label>							
				<div class="row">	
				<?php echo $form->textField($model,'adj_tecnica'); 
				echo $form->fileField($model, 'image5');
				echo $form->error($model, 'image5'); ?>
				</div>
	    </td>		
	</tr>
	
	
	<tr>
	    <td colspan="3">
	</br><label>Informes de Auditoría Financiera</label>							
				<div class="row">	
				<?php echo $form->textField($model,'adj_financiero'); 
				echo $form->fileField($model, 'image6');
				echo $form->error($model, 'image6'); ?>
				</div>
	    </td>		
	</tr>
	
	<tr>
	    <td colspan="3">
		</br><label>Acta de Recepción Definitiva</label>							
				<div class="row">
					<?php echo $form->textField($model,'adj_recepcion'); 
					echo $form->fileField($model, 'image7');
					echo $form->error($model, 'image7'); ?>
				</div>	
	    </td>		
	</tr>
	
	<tr>
	    <td colspan="3">
		</br><label>Informe de Disconformidad, Cuando Corresponda</label>							
				<div class="row">	
					<?php echo $form->textField($model,'adj_disconformidad'); 
					echo $form->fileField($model, 'image8');
					echo $form->error($model, 'image8'); ?>
				</div></br>	
	    </td>		
	</tr>
	
	<tr>
	    <td colspan="3">
		<div class="row">
			<?php echo $form->labelEx($model,'estado'); ?>
			<?php echo $form->dropDownList($model,'estado',$model->listaEstadosSol());?>
			<?php echo $form->error($model,'estado'); ?>
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
    $codcontrato = $model->idInicioEjecucion;
    $cod_avances = $model->idAvances;
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
					<?php //echo $form->textField($model2,'cod_contrato',array('size'=>25,'maxlength'=>25,'readonly'=>'true', 'value'=>$cod_inicio_ejecucion,)); ?>
				</div>
                
				<div class="row" style="display:none">
					<?php //echo $form->textField($model2,'cod_avance',array('size'=>25,'maxlength'=>25,'readonly'=>'true', 'value'=>$cod_avances,)); ?>
				</div>				
				

											
				<?php
					//if($cod_avances!=''){
					//	echo CHtml::submitButton($model2->isNewRecord ? 'Guardar Documentos' : 'Guardar Documentos');
					  
					//};
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
			    'id' => 'AvancesImagenes-form',
			    'enableAjaxValidation' => false,
			    'htmlOptions' => array('enctype' => 'multipart/form-data')
				));
			?>

			    <?php echo $form->errorSummary($model3); ?>
			    
				<div class="row" style="display:none">

					<?php echo $form->textField($model3,'idAvances',array('size'=>25,'maxlength'=>25,'readonly'=>'true', 'value'=>$model->idAvances)); ?>
				</div>
			
				<div class="row" style="display:none">
					<?php echo $form->textField($model3,'ubicacion_imagen',array('size'=>60,'maxlength'=>100)); ?>
				</div>
			    
				<div class="row">
					<?php echo $form->fileField($model3,'nombre_imagem',array('size'=>200,'maxlength'=>200)); ?>	
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
