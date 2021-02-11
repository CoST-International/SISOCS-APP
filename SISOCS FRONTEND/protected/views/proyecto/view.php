<?php
/* @var $this ProyectoController */
/* @var $model Proyecto */

$this->breadcrumbs = array(
    'Proyectos' => array('index'),
    $model->idProyecto,
);

if ($model->estado === 'PUBLICADO') {
  $this->menu = array(
      array('label' => 'Listar Proyectos (Publicados)', 'url' => array('index')),
      array('label' => 'Crear Proyecto', 'url' => array('create')),
      array('label' => 'Gestionar Proyectos', 'url' => array('admin')),
  );
} else {
  $this->menu = array(
      array('label' => 'Listar Proyectos (Publicados)', 'url' => array('index')),
      array('label' => 'Crear Proyecto', 'url' => array('create')),
      array('label' => 'Actualizar Proyecto', 'url' => array('update', 'id' => $model->idProyecto)),
      array('label' => 'Eliminar Proyecto', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->idProyecto), 'confirm' => 'Esta seguro que desea eliminar este elemento?')),
      array('label' => 'Gestionar Proyectos', 'url' => array('admin')),
  );
}

?>

<h1>Ver Planificación de Proyecto #<?php echo $model->codigo; ?></h1>

<div id="statusMsg">
    <?php if(Yii::app()->user->hasFlash('success')):?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
    <?php endif; ?>

    <?php if(Yii::app()->user->hasFlash('error')):?>
        <div class="flash-error">
            <?php echo Yii::app()->user->getFlash('error'); ?>
        </div>
    <?php endif; ?>
</div>

<?php
$proposito = Yii::app()->db->createCommand("SELECT proposito FROM cs_proyecto WHERE idProyecto=".$model->idProyecto)->queryScalar();

$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'idProyecto',
        'codigo',
        'nombre_proyecto',
        array(
			'label'=>"Proposito",
			'value'=>$proposito,
		),
        'descrip',
        'idSector0.sector',
        'idSubSector0.subsector',
        'idEnte0.descripcion',
        'idFuncionario0.nombre',
        'idRol0.rol',
		array('label' => 'Presupuesto',
            'value' => number_format($model->presupuesto, 2, '.', ',')),
        'fechaaprob',
		'codsefin',
		'descambiental',
		'descreasentamiento',

        //'usuario_creacion',
        //'usuario_creacion',
	'fecha_creacion',
        array('label'=>$model->getAttributeLabel('usuario_publicacion'),
            'type' => 'raw',
            'value'=>$model->Usuario($model->usuario_publicacion)
        ),
	//'usuario_publicacion',
	'fecha_publicacion',
    ),
));

echo '</br>';

$this->actionViewDetMunicipio($model->idProyecto, 'View');
$this->actionViewDetFuente($model->idProyecto, 'View');

?>
