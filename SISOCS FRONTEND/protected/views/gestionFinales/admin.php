<?php
/* @var $this GestionFinalesController */
/* @var $model GestionFinales */

$this->breadcrumbs=array(
	'Finalización de Contratos'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Contratos no finalizados', 'url'=>array('index')),
	array('label'=>'Lista de finalizaciones (Publicadas)', 'url'=>array('publicadas')),
	array('label'=>'Gestionar finalizaciones', 'url'=>array('finalEjecucion/admin')),
);
?>


<div class="content_header">
            <h1 style="font-size:2em;color:#141414">Administrar Finalización de contratos</h1>

            <p>
            Tambi&eacuten puede escribir un operador de comparaci&oacuten (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
            o <b>=</b>) al principio de cada uno de los valores de b&uacutesqueda para especificar c&oacutemo se debe hacer la comparaci&oacuten.
            </p>
            <hr class="lineOne">
</div>


<?php /*
$this->widget('zii.widgets.grid.CGridView',
              array('dataProvider' => $model->notFinalized(),
                    'filter' => $model,
                    'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
                    'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
                    'summaryText' => 'Mostrando {start} - {end} de {count} registros',
                    'htmlOptions' => array('class' => 'grid-view rounded'),
										'ajaxUpdate'=>false,
                    'columns' => array(
                                        array('header' => 'idInicioEjecucion',
                                              'name'   => 'idInicioEjecucion'),
                                        array('header' => 'Titulo del Contrato',
                                              'name' => 'idContratacion0.titulocontrato',
                                              'value'  => '$data->idContratacion0["titulocontrato"]',
                                              'filter' => CHtml::activeTextField( $model, 'titulo_contrato' )),
                                        array('header' => 'Fecha de inicio',
                                              'name'   => 'fecha_inicio',
                                              'value'  => 'Yii::app()->dateFormatter->format("d/M/y",strtotime($data->fecha_inicio))'),
                                        array('htmlOptions'=>array('width'=>'140',
                                                                   'style'=>'text-align:center'),
                                              'header' => 'Acciones',
                                              'class' => 'CButtonColumn',
                                              'deleteConfirmation'=>"js:'¿Desea eliminar el registro con código : '+$(this).parent().parent().children(':nth-child(1)').text()+'?'",
                                              'template' => '{finalizaciones}',
                                              'buttons' => array('finalizaciones' => array('label' => '<span class="btn btn-success">Finalizar</span>',
                                                                                    'url' => 'Yii::app()->createUrl("/FinalEjecucion/create", array("id"=>$data->idInicioEjecucion))',
                                                                                    'options'=>array('title'=>'Finalizar Contrato'),
                                                                                    'imageUrl' => false)

                                                            ),
                                        ),
                                 ),
              )
);*/
 ?>

<table class="display hover row-border" id="tabla_gestionFinales_admin" cellspacing="0" style="width:100%;">
                  <thead>
                        <tr style="background:#29a4dd;color:#fff">
                              <th>Id</th>
                              <th>Titulo del Contrato</th>
                              <th>Fecha inicio</th>
                              <th>Acciones</th>
                        </tr>
                  </thead>
                  <tbody>

                        <?php
				
                    foreach($model->notFinalized()->getData() as $records) {
                        ?>
                              <tr>
                                    <td>
                                          <?php echo $records->idInicioEjecucion; ?>
                                    </td>
                                    <td>
                                          <?php echo $records->idContratacion0["titulocontrato"]?>
                                           
                                    </td>
                                    <td>
                                          <?php echo $records->fecha_inicio ?>
                                    </td>
                                    <td style="text-align:center">
                                          <div class="row_buttons">
                                                <button class="btn btn-primary" type="button" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
                                                      <a href="<?php echo  Yii::app()->baseUrl."/index.php?r=FinalEjecucion/create&id=".$records->idInicioEjecucion; ?>" style="color:#fff">
                                                           Finalizar
                                                      </a>
                                                </button>
                                          </div>
                                    </td>

                              </tr>                      

                              <?php
                      
                    } ?>
                  </tbody>
            </table>

            <script type="text/javascript">
                  $(document).ready(function () {

                        var table = $('#tabla_gestionFinales_admin').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },

                              "pagingType": "simple",
                              "scrollX": "500",
                              "processing": true,
                              "autoWidth": true,
                              "info": true,
                              "responsive": true

                        });


                        $('#tabla_gestionFinales_admin tbody').on('click', 'tr', function () {
                              if ($(this).hasClass('selected')) {
                                    $(this).removeClass('selected');
                              }
                              else {
                                    table.$('tr.selected').removeClass('selected');
                                    $(this).addClass('selected');
                              }
                        });

                  });
            </script>




