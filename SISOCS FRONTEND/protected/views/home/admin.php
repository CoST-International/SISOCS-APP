<?php
/* @var $this CiudadanoController */

$this->breadcrumbs=array(
	'Ciudadano'=>array('/ciudadano'),
	'Admin',
);
?>
<?php
Yii::app()->clientScript->registerScript('search2', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#programa-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Módulo Ciudadano</h1>

<p>
Puede opcionalmente ingresar un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) al inicio de cada valor  para especificar como debe ser la busqueda.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'programa-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'programa',
		'nombreprograma',
		'entes',
		'funcinombre',
		'proposito0.proyectos.proyecto',
        //'value'=>$model->proposito0->proyectos->proyecto,
		//'funcirol',
		//'proposito',
		/*
		'sector',
		'subsector',
		'descripcion',
		'costoesti',
		'fechaapro',
		'fuentefinan',
		'tipomone',
		'monto',
		'cartaconvenio',
		'otro1',
		'planope',
		'presupuesto',
		'perfildelprogra',
		'otro2',
		'fechacreacion',
		'estado',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),
	),
)); ?>
