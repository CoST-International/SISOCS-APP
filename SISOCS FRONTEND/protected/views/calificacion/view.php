<?php
/* @var $this CalificacionController */
/* @var $model Calificacion */

$this->breadcrumbs=array(
	'Calificaciones'=>array('index'),
	$model->idCalificacion,
);

$this->menu=array(
	array('label'=>'Listar Calificaciones (Publicadas)', 'url'=>array('index')),
	array('label'=>'Crear Calificación', 'url'=>array('create')),
	array('label'=>'Actualizar Calificación', 'url'=>array('update', 'id'=>$model->idCalificacion)),
	array('label'=>'Eliminar Calificación', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idCalificacion),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Calificaciones', 'url'=>array('admin')),
);
?>

<h1>Ver Calificaci&oacuten #<?php echo $model->numproceso; ?></h1>

<?php

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idCalificacion',
		'idProyecto',
        'idProyecto0.codigo',
		'idProyecto0.nombre_proyecto',
		'numproceso',
		'nomprocesoproyecto',
		'idFuncionario0.nombre',
            'idTipoContrato0.contrato',
            'estado',
            'idEnte0.descripcion',
            'idMetodo0.adquisicion',
             array('label'=>$model->getAttributeLabel('usuario_creacion'),
            'type' => 'raw',
            'value'=>$model->Usuario($model->usuario_creacion)
        ),
		'fecha_creacion',
        array('label'=>$model->getAttributeLabel('usuario_publicacion'),
            'type' => 'raw',
            'value'=>$model->Usuario($model->usuario_publicacion)
        ),
            'fecha_publicacion',
	),
));
?>

<div id="filas_oferentes"></div>

<script type="text/javascript">
    cargaCalioferente();

	function cargaCalioferente(){
        $('#filas_oferentes').load('<?php echo CController::createUrl("/calificacionOferente/list", array('id'=>$model->idCalificacion)); ?>');
    }
</script>
