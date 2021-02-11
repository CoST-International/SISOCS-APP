<?php
/* @var $this ContractDocumentsController */
/* @var $model ContractDocuments */

$this->breadcrumbs=array(
	'Contract Documents'=>array('index'),
	'Gestionar',
);

$this->menu=array(
	array('label'=>'Listar ContractDocuments', 'url'=>array('index')),
	array('label'=>'Crear ContractDocuments', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#contract-documents-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestionar Contract Documents</h1>

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
	'id'=>'contract-documents-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idContratacion',
		'documentType',
		'title',
		'description',
		'url',
		/*
		'pageStart',
		'pageEnd',
		'datePublished',
		'dateModified',
		'accessDetails',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
