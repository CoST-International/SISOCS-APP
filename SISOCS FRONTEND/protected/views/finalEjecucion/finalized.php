<?php
/* @var $this FinalEjecucionController */
/* @var $model FinalEjecucion */

$this->breadcrumbs=array(
	'Final de Implementación'=>array('index'),
	'Listado de Finalizaciones de Implementación',
);

$this->menu=array(
	//array('label'=>'Listar FinalEjecucion', 'url'=>array('index')),
	array('label'=>'Crear Final de Implementacion', 'url'=>array('admin')),
);

/*Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#final-ejecucion-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");*/
?>

<h1>Administrar Finales de Implementación</h1>

<p>
Tambi&eacuten puede escribir un operador de comparaci&oacuten (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
o <b>=</b>) al principio de cada uno de los valores de b&uacutesqueda para especificar c&oacutemo se debe hacer la comparaci&oacuten.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(
	//'model'=>$model,
//)); ?>
</div><!-- search-form -->

<?php /*$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'final-ejecucion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'idFinalizacion',
		'costoFinalizacion',
		'alcanceFinalizacion',
		'fechaFinalizacion',
		'adj_documentoGarantia',
		'adj_actaRecepcion',
		/*
		'adj_informesEvaluacion',
		'adj_informeDisconformidad',
		'adj_informeAseguramientoCalidad',
		'razonesCambios',
		'indicador1',
		'indicador2',
		'indicador3',
		'indicador4',
		'indicador5',
		'indicador6',
		'indicador7',
		'indicador8',
		'idInicioEjecucion',
		'estadoContratoActual',
		'usuario_creacion',
		'fecha_creacion',

		array(
			'class'=>'CButtonColumn',
		),
	),
));*/
$this->widget('zii.widgets.grid.CGridView',
              array('dataProvider' => $model->search(),
                    'filter' => $model,
                    'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
                    'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
                    'summaryText' => 'Mostrando {start} - {end} de {count} registros',
                    'htmlOptions' => array('class' => 'grid-view rounded'),
										'ajaxUpdate'=>false,
                    'columns' => array(
                                        array('header' => 'Código',
                                              'name'   => 'idFinalizacion'),
                                        array('header' => 'Costo de Finalización',
                                              'name' => 'costoFinalizacion',),
                                        array('header' => 'Alcance de Finalización',
                                              'name'   => 'alcanceFinalizacion',),
																				array('header' => 'Id de Implementación',
                                              'name'   => 'idInicioEjecucion',),
                                        array('header' => 'Fecha de Finalización',
                                              'name'   => 'fechaFinalizacion',
                                              'value'  => 'Yii::app()->dateFormatter->format("d/M/y",strtotime($data->fechaFinalizacion))'),
                                        array('htmlOptions'=>array('width'=>'140',
                                                                   'style'=>'text-align:center'),
                                              'header' => 'Acciones',
                                              'class' => 'CButtonColumn',
                                              'deleteConfirmation'=>"js:'¿Desea eliminar el registro con código : '+$(this).parent().parent().children(':nth-child(1)').text()+'?'",
                                              'template' => '{update}{delete}',
                                              'buttons' => array('update' => array(
																										'label' => '<span class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></span>', 
																										'options'=>array('title'=>'Editar'),
																										'imageUrl' => false,
																										),
																							'delete' => array(
																							            'label' => '<span class="btn btn-danger" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-trash" aria-hidden="true" style="padding:4px;"></i></span>', 
																										'options'=>array('title'=>'Eliminar'),
																										'imageUrl' => false,
												                                                        'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
																										),

                                                            ),
                                        ),
                                 ),
              )
);
 ?>
