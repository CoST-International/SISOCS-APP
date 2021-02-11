
<?php 

$this->widget('zii.widgets.grid.CGridView', 
              array('dataProvider' => $model->search(),
                    'filter' => null,
                    'enableSorting' => false,
                    'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css', 'pageSize' => $model->count()),
                    'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
                    'summaryText' => 'Mostrando {start} - {end} de {count} registros',
                    'htmlOptions' => array('class' => 'grid-view rounded'),
                    'columns' => array(
                                        array('header' => 'idGarantia',
                                              'name'   => 'idGarantia'),
                                        array('header' => 'Tipo garantia',
                                              'name' => 'idTipoGarantia',
                                              'value'  => '$data->idTipoGarantia0["nombre"]'),
                                        array('header' => 'Fecha de Vencimiento',
                                              'name'   => 'fecha_vencimiento',
                                              'htmlOptions'=>array('style'=>'text-align: right;'),
                                              'value'  => 'Yii::app()->dateFormatter->format("d/M/y",strtotime($data->fecha_vencimiento))'), 
                                        array('htmlOptions'=>array('width'=>'140',
                                                                   'style'=>'text-align:center'),
                                              'header' => 'Acciones',
                                              'class' => 'CButtonColumn',
                                              'deleteConfirmation'=>"js:'¿Desea eliminar el registro con código : '+$(this).parent().parent().children(':nth-child(1)').text()+'?'",
                                              'template' => '{update}{delete}',
                                              'buttons' => array('update' => array('label' => '<span class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></span>', 
                                                                                  'url' => 'Yii::app()->createUrl("/garantias/update", array("id"=>$data->idGarantia))',
                                                                                  'options' => array('title' => 'Editar'),
                                                                                  'imageUrl' => false),
                                                                'delete' => array('label' => '<span class="btn btn-danger" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-trash" aria-hidden="true" style="padding:4px;"></i></span>', 
                                                                                  'url' => 'Yii::app()->createUrl("InicioEjecucion/DeleteGarantias", array("codigo" => $data->idGarantia, "cod_inicioEjecucion"=>$data->idInicioEjecucion ))',
                                                                                  'options' => array('title' => 'Eliminar'),
                                                                                  'imageUrl' => false)
                                                            ),
                                        ),
                                 ),
              )
); 

?>


