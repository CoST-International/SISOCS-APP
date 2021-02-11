<?php
/* @var $this DesembolsosMontosController */
/* @var $model DesembolsosMontos */

$this->breadcrumbs=array(
	'Desembolsos Montoses'=>array('index'),
	'Gestionar',
);

$this->menu=array(
	array('label'=>'Listar DesembolsosMontos', 'url'=>array('index')),
	array('label'=>'Crear DesembolsosMontos', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#desembolsos-montos-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestionar Desembolsos Montoses</h1>

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

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'desembolsos-montos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'idDesembolso',
		'idInicioEjecucion',
		'desembolso',
		'monto',
		'descripcion',
		'fecha_desembolso',
		/*
		'estado',
		'usuario_creacion',
		'fecha_creacion',
		'usuario_publicacion',
		'fecha_publicacion',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
