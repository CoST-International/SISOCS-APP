<?php
/* @var $this GarantiasController */
/* @var $model Garantias */

$this->breadcrumbs=array(
	'Garantiases'=>array('index'),
	'Gestionar',
);

$this->menu=array(
	array('label'=>'Listar Garantias', 'url'=>array('index')),
	array('label'=>'Crear Garantias', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#garantias-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestionar Garantiases</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', 
              array('dataProvider' => $model->search(),
                    'filter' => $model,
                    'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
                    'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
                    'summaryText' => 'Mostrando {start} - {end} de {count} registros',
                    'htmlOptions' => array('class' => 'grid-view rounded'),
                    'columns' => array(
                                        array('header' => 'idGarantia',
                                              'name'   => 'idGarantia'),
                                        array('header' => 'Implementacion',
                                              'name' => 'idInicioEjecucion'),
                                        array('header' => 'Tipo garantia',
                                              'name' => 'idTipoGarantia',
                                              'value'  => '$data->idTipoGarantia0["nombre"]'),
                                        array('header' => 'Fecha de Vencimiento',
                                              'name'   => 'fecha_vencimiento',
                                              'value'  => 'Yii::app()->dateFormatter->format("d/M/y",strtotime($data->fecha_vencimiento))'), 
                                        array('htmlOptions'=>array('width'=>'140',
                                                                   'style'=>'text-align:center'),
                                              'header' => 'Acciones',
                                              'class' => 'CButtonColumn',
                                              'deleteConfirmation'=>"js:'¿Desea eliminar el registro con código : '+$(this).parent().parent().children(':nth-child(1)').text()+'?'",
                                              //'template' => '{avances}{garantias}',
                                              'buttons' => array('view' => array( 'label' => '<span class="btn btn-primary" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-eye" aria-hidden="true" style="padding:4px;"></i></span>', 
                                                                                'options' => array('title' => 'Ver'),
                                                                                'imageUrl' => false),
                                                                'update' => array('label' => '<span class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></span>', 
                                                                                  'url' => 'Yii::app()->createUrl("/garantias/update", array("id"=>$data->idGarantia,"idInicioEjecucion"=>$data->idInicioEjecucion))',
                                                                                  'options' => array('title' => 'Editar'),
                                                                                  'imageUrl' => false),
                                                                'delete' => array('label' => '<span class="btn btn-danger" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-trash" aria-hidden="true" style="padding:4px;"></i></span>', 
                                                                                  'options' => array('title' => 'Eliminar'),
                                                                                  'imageUrl' => false)
                                                            ),
                                        ),
                                 ),
              )
); 
 ?>
