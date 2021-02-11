<?php
/* @var $this FinalEjecucionController */
/* @var $model FinalEjecucion */

$this->breadcrumbs=array(
	'Final de Implementacion'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Final de Implementación', 'url'=>array('index')),
	array('label'=>'Implementación Finalizados', 'url'=>array('finalized')),
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
              array('dataProvider' => $model->notFinalized(),
                    'filter' => $model,
                    'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
                    'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
                    'summaryText' => 'Mostrando {start} - {end} de {count} registros',
                    'htmlOptions' => array('class' => 'grid-view rounded'),
										'ajaxUpdate'=>false,
                    'columns' => array(
                                        array('header' => 'Código',
                                              'name'   => 'idInicioEjecucion'),
                                        array('header' => 'Titulo del Contrato',
                                              'name' => 'idContratacion0.titulocontrato',
                                           'value'  => '$data->idContratacion0["titulocontrato"]',
                                           // 'value'  => '$data->contratacion0["titulocontrato"]',
                                              'filter' => CHtml::activeTextField( $model, 'titulo_contrato' )),
                                        array('header' => 'Fecha de inicio',
                                              'name'   => 'fecha_inicio',
                                              'value'  => 'Yii::app()->dateFormatter->format("d/M/y",strtotime($data->fecha_inicio))'),
                                        array('htmlOptions'=>array('width'=>'140',
                                                                   'style'=>'text-align:center'),
                                              'header' => 'Acciones',
                                              'class' => 'CButtonColumn',
                                              'deleteConfirmation'=>"js:'¿Desea eliminar el registro con código : '+$(this).parent().parent().children(':nth-child(1)').text()+'?'",
                                              'template' => '{avances}',
                                              'buttons' => array('avances' => array('label' => '<span class="btn btn-success">Finalizar</span>',
                                                                                    'url' => 'Yii::app()->createUrl("../FinalEjecucion/create", array("id"=>$data->idInicioEjecucion))',
                                                                                    'options'=>array('title'=>'Finalizar Ejecución'),
                                                                                    'imageUrl' => false)

                                                            ),
                                        ),
                                 ),
              )
);
 ?>
