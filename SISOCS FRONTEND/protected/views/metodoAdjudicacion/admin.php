<?php
/* @var $this MetodoAdjudicacionController */
/* @var $model MetodoAdjudicacion */

$this->breadcrumbs=array(
	//'Metodo Adjudicacions'=>array('index'),
	'Gestionar',
);

$this->menu=array(
	//array('label'=>'Listar MetodoAdjudicacion', 'url'=>array('index')),
	array('label'=>'Crear MetodoAdjudicacion', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#metodo-adjudicacion-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestionar Método de Adjudicación</h1>

<p>
Tambi&eacuten puede escribir un operador de comparaci&oacuten (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
o <b>=</b>) al principio de cada uno de los valores de b&uacutesqueda para especificar c&oacutemo se debe hacer la comparaci&oacuten.

</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php /*$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'metodo-adjudicacion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'idMetodoAdjudicacion',
		'nombre',
		array(
			'class'=>'CButtonColumn',
		),
	),
));*/
$this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $model->search(),
        'filter' => $model,
        'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
        'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
        'summaryText' => 'Mostrando {start} - {end} de {count} registros',
        'htmlOptions' => array('class' => 'grid-view rounded'),
        'columns' => array(
				array('header' => 'Id Método Adjudicación',
					  'name'   => 'idMetodoAdjudicacion'),
				array('header' => 'Nombre',
					  'name'   => 'nombre'),

				array(
                        'htmlOptions'=>array(
							'width'=>'120',
							'style'=>'text-align:right',
						 ),
						'header' => 'Acciones',
                        'class' => 'CButtonColumn',
						'deleteConfirmation'=>"js:'¿Desea eliminar el registro con código : '+$(this).parent().parent().children(':nth-child(1)').text()+'?'",
						'template' => '{view}{update}{delete}',
						'buttons' => array(
										   'view' => array(
														'label' => '<span class="btn btn-primary" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-eye" aria-hidden="true" style="padding:4px;"></i></span>', 
														'options'=>array('title'=>'Ver'),
														'imageUrl' => false,
														),
											'update' => array(
														'label' => '<span class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></span>', 
														'options'=>array('title'=>'Editar'),
														'imageUrl' => false,
														),
											'delete' => array(
											            'label' => '<span class="btn btn-danger" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-trash" aria-hidden="true" style="padding:4px;"></i></span>', 
														'options'=>array('title'=>'Eliminar'),
														'imageUrl' => false,
														),
										   ),
                ),
        ),
));
 ?>
