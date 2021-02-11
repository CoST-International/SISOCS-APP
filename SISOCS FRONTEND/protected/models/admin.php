<?php
/* @var $this InicioEjecucionController */
/* @var $model InicioEjecucion */

$this->breadcrumbs = array(
    'Implementacion' => array('index'),
    'Administrar',
);

$this->menu = array(
    array('label' => 'Lista Implementación', 'url' => array('index')),
    array('label' => 'Crear Implementación', 'url' => array('create')),
);
?>

<h1>Gestionar datos generales de la ejecución</h1>

<p>
    Tambi&eacuten puede escribir un operador de comparaci&oacuten (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    o <b>=</b>) al principio de cada uno de los valores de b&uacutesqueda para especificar c&oacutemo se debe hacer la comparaci&oacuten.
</p>

<?php

$this->widget('zii.widgets.grid.CGridView',
              array('dataProvider' => $model->search(),
                    'filter' => $model,
                    'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
                    'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
                    'summaryText' => 'Mostrando {start} - {end} de {count} registros',
                    'htmlOptions' => array('class' => 'grid-view rounded'),
                    'columns' => array( array('header' => 'Código',
                                              'name' => 'idInicioEjecucion'),
                                        array('header' => 'Titulo del Contrato',
                                              'name' => 'contratacion0.titulocontrato',
											  'value'  => '$data->idContratacion0["titulocontrato"]',
                                              'filter' => CHtml::activeTextField($model, 'titulo_contrato')),
                                        array('header' => 'Fecha de inicio',
                                              'name' => 'fecha_inicio',
                                              'value' => 'Yii::app()->dateFormatter->format("d/M/y",strtotime($data->fecha_inicio))'),
                                        array('htmlOptions' => array(
                                                                    'width' => '140',
                                                                    'style' => 'text-align:justified'),
                                              'header' => 'Acciones',
                                              'class' => 'CButtonColumn',
                                              'deleteConfirmation' => "js:'¿Desea eliminar el registro con código : '+$(this).parent().parent().children(':nth-child(1)').text()+'?'",
                                              'template' => '{view}{update}{delete}',
                                              'buttons' => array('view' => array( 'label' => '<span class="btn btn-primary" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-eye" aria-hidden="true" style="padding:4px;"></i></span>', 
                                                                                'options' => array('title' => 'Ver'),
                                                                                'imageUrl' => false),
                                                                'update' => array('label' => '<span class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></span>', 
                                                                                  'options' => array('title' => 'Editar'),
                                                                                  'imageUrl' => false),
                                                                'delete' => array('label' => '<span class="btn btn-danger" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-trash" aria-hidden="true" style="padding:4px;"></i></span>', 
                                                                                  'options' => array('title' => 'Eliminar'),
                                                                                  'imageUrl' => false)
                                                            ),
                                        ),
                                 ),
              )
        );
?>
