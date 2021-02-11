<?php
/* @var $this MonedasController */
/* @var $model Monedas */

$this->breadcrumbs=array(
	'Monedases'=>array('index'),
	'Gestionar',
);

$this->menu=array(
	array('label'=>'Listar Monedas', 'url'=>array('index')),
	array('label'=>'Crear Monedas', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#monedas-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Monedas</h1>

<p>
Tambi&eacuten puede escribir un operador de comparaci&oacuten (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
o <b>=</b>) al principio de cada uno de los valores de b&uacutesqueda para especificar c&oacutemo se debe hacer la comparaci&oacuten.
</p>


<?php 
	$this->widget('application.extensions.tablesorter.Sorter', array(
    'data'=>$records,
    'columns'=>array(
        'idMoneda',
		'moneda',
    )
));
?>
