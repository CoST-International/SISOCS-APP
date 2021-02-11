<?php
/* @var $this ProyectoController */
/* @var $model Proyecto */

$this->breadcrumbs=array(
      'Ciudadano'=>array('index'),
      $model->idproyect,
);
?>

<h1>Ver Planificacion #<?php echo $model->idproyect; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
      'data'=>$model,
      'attributes'=>array(
            'idproyect',
            'programa',
            'codproyecto',
            'proyecto',
            'ubicacion',
            'fuentefinan',
            'region',
            'depto',
            'tramo',
            'ruta',
            'tipored',
            'estadored',
            'proposito',
            'descrip',
            'presupuesto',
            'benemunicipio',
            //'especiplano',
               array('label'=>'especiplano',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->especiplano), Yii::app()->baseUrl . '/images/'.$model->especiplano)
                   ),
            array('label'=>'presuprogra',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->presuprogra), Yii::app()->baseUrl . '/images/'.$model->presuprogra)
                   ),
            array('label'=>'estudiofact',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->estudiofact), Yii::app()->baseUrl . '/images/'.$model->estudiofact)
                   ),
            array('label'=>'estudioimpact',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->estudioimpact), Yii::app()->baseUrl . '/images/'.$model->estudioimpact)
                   ),
             array('label'=>'licambi',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->licambi), Yii::app()->baseUrl . '/images/'.$model->licambi)
                   ),
            array('label'=>'estuimpactierra',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->estuimpactierra), Yii::app()->baseUrl . '/images/'.$model->estuimpactierra)
                   ),
            array('label'=>'planreasea',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->planreasea), Yii::app()->baseUrl . '/images/'.$model->planreasea)
                   ),
              array('label'=>'plananual',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->plananual), Yii::app()->baseUrl . '/images/'.$model->plananual)
                   ),
            array('label'=>'acuerdofinan',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->acuerdofinan), Yii::app()->baseUrl . '/images/'.$model->acuerdofinan)
                   ),
             array('label'=>'otro',
                   'type'=>'raw',
                   'value'=>CHtml::link(CHtml::encode($model->otro), Yii::app()->baseUrl . '/images/'.$model->otro)
                   ),
            'fechacreacion',
            'estado',
      ),
)); ?>
