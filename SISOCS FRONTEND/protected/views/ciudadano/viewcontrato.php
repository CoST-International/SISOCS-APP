<?php
/* @var $this ProyectoController */
/* @var $model Proyecto */

$this->breadcrumbs=array(
      'Ciudadano'=>array('index'),
      $model->idContratacion,
);
?>

<h1>Ver Contratación #<?php echo $model->idContratacion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
      'data'=>$model,
      'attributes'=>array(
            'idContratacion',
            'idAdjudicacion',
            'idEntidad',
            'idoferente',
            'precio',
            'alcances',
            'fechainicio',
            'fechafinal',
            'duracioncontrato',
            array('label'=>'Acta de apertura de las ofertas',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->documentocontra), Yii::app()->baseUrl . '/images/'.$model->documentocontra)
                   ),
              array('label'=>'Informe y acta de recomendacion',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->regante), Yii::app()->baseUrl . '/images/'.$model->regante)
                   ),
             array('label'=>'Resolucion de la adjudicacion',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->espeplanos), Yii::app()->baseUrl . '/images/'.$model->espeplanos)
                   ),
            /*'documentocontra',
            'regante',
            'espeplanos',*/
            'estado',
            array('label'=>'Otro',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->otro), Yii::app()->baseUrl . '/images/'.$model->otro)
                   ),
            //'otro',
            'ncontrato',
            'titulocontrato',
      ),
)); ?>
