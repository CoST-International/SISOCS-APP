<?php
/* @var $this AdjudicacionController */
/* @var $model Adjudicacion */


$this->breadcrumbs=array(
	'Adjudicaciones'=>array('index'),
	$model->idAdjudicacion,
);

if ($model->estado === 'PUBLICADO') {
    $this->menu=array(
        array('label'=>'Listar Adjudicaciones (Publicadas)', 'url'=>array('index')),
        array('label'=>'Crear Adjudicación', 'url'=>array('create')),
        array('label'=>'Gestionar Adjudicaciones', 'url'=>array('admin')),
    );
} else {
    $this->menu=array(
        array('label'=>'Listar Adjudicaciones (Publicadas)', 'url'=>array('index')),
        array('label'=>'Crear Adjudicación', 'url'=>array('create')),
        array('label'=>'Actualizar Adjudicación', 'url'=>array('update', 'id'=>$model->idAdjudicacion)),
        array('label'=>'Eliminar Adjudicación', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idAdjudicacion),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
        array('label'=>'Gestionar Adjudicaciones', 'url'=>array('admin')),
    );
}
?>

<h1>Ver Evaluación de las Ofertas/ Adjudicación #<?php echo $model->numproceso; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idAdjudicacion',
		'idCalificacion',
		'idMetodoAdjudicacion',
		'numproceso',
		'nparticipantes',

		'estado',
		'fecha_creacion',
        'fecha_publicacion',
	),
));

?>
