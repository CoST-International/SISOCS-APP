<?php
/* @var $this MunicipioController */
/* @var $model Municipio */

$this->breadcrumbs=array(
	//'Municipios'=>array('index'),
	'Gestionar',
);

$this->menu=array(
	//array('label'=>'Listar Municipio', 'url'=>array('index')),
	array('label'=>'Crear Municipio', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#municipio-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Municipios</h1>

<p>
Tambi&eacuten puede escribir un operador de comparaci&oacuten (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
o <b>=</b>) al principio de cada uno de los valores de b&uacutesqueda para especificar c&oacutemo se debe hacer la comparaci&oacuten.
</p>

<?php

$this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $model->search(),
        'filter' => $model,
        'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
        'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
        'summaryText' => 'Mostrando {start} - {end} de {count} registros',
        'htmlOptions' => array('class' => 'grid-view rounded'),
        'columns' => array(
				array('header' => 'Departamento',
					  'name'=>'idDepartamento',
                      'filter'=>CHtml::listData(Departamento::model()->findAll(), 'departamento', 'departamento'),
					  'value'  => '$data->FK_idDepartamento["departamento"]',),
				array('header' => 'Código',
					  'name'   => 'idMunicipio'),
				array('header' => 'Nombre del municipio',
				      'name'   => 'municipio'),
				array(
                        'htmlOptions'=>array(
							'width'=>'120',
							'style'=>'text-align:right',
						 ),
						'header' => 'Acciones',
                        'class' => 'CButtonColumn',
						'deleteConfirmation'=>"js:'¿Desea eliminar el registro con código : '+$(this).parent().parent().children(':nth-child(1)').text()+'?'",
						'template' => '{update}{delete}',
						'buttons' => array(
										   /*'view' => array(
														'label' => '<span class="btn btn-primary" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-eye" aria-hidden="true" style="padding:4px;"></i></span>', 
														'options'=>array('title'=>'Ver'),
														'imageUrl' => false,
														'url'=>'Yii::app()->createUrl("municipio/view/",array("idMunicipio"=>$data->idMunicipio, "idDepartamento"=>$data->idDepartamento))'
													),*/
											'update' => array(
														'label' => '<span class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></span>', 
														'options'=>array('title'=>'Editar'),
														'imageUrl' => false,
														'url'=>'Yii::app()->createUrl("municipio/update/",array("idMunicipio"=>$data->idMunicipio, "idDepartamento"=>$data->idDepartamento))'
														),
											'delete' => array(
											            'label' => '<span class="btn btn-danger" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-trash" aria-hidden="true" style="padding:4px;"></i></span>', 
														'options'=>array('title'=>'Eliminar'),
														'imageUrl' => false,
														'url'=>'Yii::app()->createUrl("municipio/delete/",array("idMunicipio"=>$data->idMunicipio, "idDepartamento"=>$data->idDepartamento))'
														),
										   ),
                ),
        ),
));
/*


	$this->widget('application.extensions.tablesorter.Sorter', array(
    'data'=>$records,
    'columns'=>array(
       'idmunicipio',
		'id',
		'depto',
		'municipio',
    )
));
*/
?>
