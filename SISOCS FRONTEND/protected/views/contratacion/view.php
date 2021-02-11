<?php
/* @var $this ContratacionController */
/* @var $model Contratacion */

$this->breadcrumbs=array(
	'Contrataciones'=>array('index'),
	$model->idContratacion,
);
if ($model->estado === 'PUBLICADO') {
    $this->menu=array(
        array('label'=>'Listar Contrataciones (Publicadas)', 'url'=>array('index')),
        array('label'=>'Crear Contratación', 'url'=>array('create')),
        array('label'=>'Gestionar Contrataciones', 'url'=>array('admin')),
    );
} else {
    $this->menu=array(
        array('label'=>'Listar Contrataciones (Publicadas)', 'url'=>array('index')),
        array('label'=>'Crear Contratación', 'url'=>array('create')),
        array('label'=>'Actualizar Contratación', 'url'=>array('update', 'id'=>$model->idContratacion)),
        array('label'=>'Eliminar Contratación', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idContratacion),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
        array('label'=>'Gestionar Contrataciones', 'url'=>array('admin')),
    );
}
?>

<h1>Ver Contratación #<?php echo $model->ncontrato; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idContratacion',
		'idAdjudicacion',
		'ncontrato',
		'titulocontrato',
		'idEntidad0.descripcion',
		array('label'=>'Precio Total del Contrato  (Lempiras)', 'value'=>number_format($model->precioLPS,2,'.',',')),
		array('label'=>'Precio Total del Contrato (USD)', 'value'=>number_format($model->precioUSD,2,'.',',')),
		'alcances',
		'fechainicio',
		'fechafinal',
		'duracioncontrato',
		'fecha_creacion',
        'fecha_publicacion'
	),
));
?>
