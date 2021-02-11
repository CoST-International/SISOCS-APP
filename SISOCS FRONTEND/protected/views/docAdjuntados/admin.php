<?php
/* @var $this DocAdjuntadosController */
/* @var $model DocAdjuntados */

$this->breadcrumbs=array(
	'Doc Adjuntadoses'=>array('index'),
	'Gestionar',
);

$this->menu=array(
	array('label'=>'Listar DocAdjuntados', 'url'=>array('index')),
	array('label'=>'Crear DocAdjuntados', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#doc-adjuntados-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestionar Doc Adjuntadoses</h1>

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
	'id'=>'doc-adjuntados-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'codigo',
		'cod_contrato',
		'nombre_doc',
		'ubicacion_doc',
		'fecha_registro',
		'user_registro',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
