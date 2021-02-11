<?php
/* @var $this CalificacionOferenteController */
/* @var $model2 CalificacionOferente */

	$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'grid-CaliOfer',
			'dataProvider' => $model2->search(),
			'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
			'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
			'summaryText' => 'Mostrando {start} - {end} de {count} registros',
			'htmlOptions' => array('class' => 'grid-view rounded'),
			'columns' => array(
					array('header'=>'Codigo',
						  'name'=> 'idoferente',
						  'sortable'=>false,
						  'htmlOptions'=>array('width'=>'100px', 'align'=>'center')),
					array('header'=>'Nombre de Oferente',
						  'name'=> 'idOferente_rel.nombre_oferente'),
					array(
							'htmlOptions'=>array(
								'width'=>'120',
								'align'=>'center',
							 ),
							'header' => 'Acciones',
							'class' => 'CButtonColumn',
							'deleteConfirmation'=>"¿Desea eliminar el registro?",
							'template' => '{Borrar}',
							'buttons'=>array(
											'Borrar' =>array(
															'imageUrl'=>false,
															'label' => '<span class="btn btn-danger" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-trash" aria-hidden="true" style="padding:4px;"></i></span>',  
															'options'=>array('title'=>'Eliminar'),
															'url'=>'Yii::app()->createUrl("calificacionOferente/Borrar", array("id[idCalificacion]"=>$data->idCalificacion, "id[idoferente]"=>$data->idoferente) )',
															'click'=>"function() {
																		if(!confirm('Eliminar ?')) return false;
																		$.fn.yiiGridView.update('grid-CaliOfer', {
																				type:'POST',
																				url:$(this).attr('href'),
																				success:function(text,status) {
																					$.fn.yiiGridView.update('grid-CaliOfer');
																					window.history.back();
																				}
																		});
																		return false;
																	}",
															),
											),
							
							
							/*
							'buttons' => array(
												'delete' => array( 
															'label' => '<span class="btn btn-danger" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-trash" aria-hidden="true" style="padding:4px;"></i></span>',  
															'options'=>array('title'=>'Eliminar'),
															'imageUrl' => false,
															),
											   ),*/
					),
			),
	));

?>
