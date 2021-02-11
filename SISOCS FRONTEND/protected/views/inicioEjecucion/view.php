<?php
/* @var $this InicioEjecucionController */
/* @var $model InicioEjecucion */

$this->breadcrumbs=array(
	'Implementacion'=>array('index'),
	$model->idInicioEjecucion,
);

if ($model->estado === 'PUBLICADO') {
    $this->menu=array(
        array('label'=>'Lista de Implementacion (Publicados)', 'url'=>array('index')),
        array('label'=>'Crear Implementacion', 'url'=>array('create')),
        array('label'=>'Gestionar Implementacion', 'url'=>array('admin')),
    );
} else {
    $this->menu=array(
        array('label'=>'Lista de Implementacion (Publicados)', 'url'=>array('index')),
        array('label'=>'Crear Implementacion', 'url'=>array('create')),
        array('label'=>'Actualizar Implementacion', 'url'=>array('update', 'id'=>$model->idInicioEjecucion)),
        array('label'=>'Eliminar Implementacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idInicioEjecucion),'confirm'=>'�Est&aacute seguro/a de borrar este registro?')),
        array('label'=>'Gestionar Implementacion', 'url'=>array('admin')),
    );
}

?>

<h1>Datos de Inicio de Ejecuci&oacute;n #<?php echo $model->idInicioEjecucion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idInicioEjecucion',
		'idContratacion0.ncontrato',
		'idContratacion0.titulocontrato',
		'idContacto0.Nombres',
             array('label'=>$model->getAttributeLabel('usuario_creacion'),
            'type' => 'raw',
            'value'=>$model->Usuario($model->usuario_creacion)
        ),
		array('label'=>'Documento Programa Inicial',
                   'type'=>'raw',
                   'value'=>$this->getEnlaceVacio(CHtml::link(CHtml::encode(Yii::app()->Controller->getNameFromURL($model->programainicial)), Yii::app()->Controller->getNameFromEnlace($model->programainicial),array('target'=>'_blank')),$model->programainicial)
                   ),
        'fecha_creacion',
        'fecha_publicacion',
	),
));


 ?>
