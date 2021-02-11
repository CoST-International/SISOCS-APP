<?php
/* @var $this InicioEjecucionController */
/* @var $model InicioEjecucion */

$this->breadcrumbs=array(
	'Gestion de Avances'=>array('index'),
	'Administrar',
);

?>


<div class="content_header">
            <h1 style="font-size:2em;color:#141414">Gestión de los Avances y Garantías de un Contrato/Proyecto</h1>

            <p>
Tambi&eacuten puede escribir un operador de comparaci&oacuten (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
o <b>=</b>) al principio de cada uno de los valores de b&uacutesqueda para especificar c&oacutemo se debe hacer la comparaci&oacuten.
</p>
            <hr class="lineOne">
</div>

<?php 
/*
$this->widget('zii.widgets.grid.CGridView', 
              array('dataProvider' => $model->search(),
                    'filter' => $model,
                    'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
                    'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
                    'summaryText' => 'Mostrando {start} - {end} de {count} registros',
                    'htmlOptions' => array('class' => 'grid-view rounded'),
                    'columns' => array(
                                        array('header' => 'Código',
                                              'name'   => 'idInicioEjecucion'),
                                        array('header' => 'Titulo del Contrato',
                                              'name' => 'idContratacion0.titulocontrato',
                                           'value'  => '$data->idContratacion0["titulocontrato"]',
                                           // 'value'  => '$data->contratacion0["titulocontrato"]',
                                              'filter' => CHtml::activeTextField( $model, 'titulo_contrato' )),
                                        array('header' => 'Fecha de inicio',
                                              'name'   => 'fecha_inicio',
                                              'value'  => 'Yii::app()->dateFormatter->format("d/M/y",strtotime($data->fecha_inicio))'), 
                                        array('htmlOptions'=>array('width'=>'140',
                                                                   'style'=>'text-align:center'),
                                              'header' => 'Acciones',
                                              'class' => 'CButtonColumn',
                                              'deleteConfirmation'=>"js:'¿Desea eliminar el registro con código : '+$(this).parent().parent().children(':nth-child(1)').text()+'?'",
                                              'template' => '{avances}{garantias}',
                                              'buttons' => array('avances' => array('label' => '<span class="btn btn-small"><span class="icon-user"></span></span>', 
                                                                                    'url' => 'Yii::app()->createUrl("/avances/admin", array("id"=>$data->idInicioEjecucion))',
                                                                                    'options'=>array('title'=>'Avances'),
                                                                                    'imageUrl' => false),
                                                                 'garantias' => array('label' => '<span class="btn btn-small"><span class="icon-shopping-cart"></span></span>', 
                                                                                    'url' => 'Yii::app()->createUrl("/garantias/admin", array("id"=>$data->idInicioEjecucion))',
                                                                                    'options'=>array('title'=>'Garantias'),
                                                                                    'imageUrl' => false)
                                                            ),
                                        ),
                                 ),
              )
); 
*/
?>

<table class="display hover row-border" id="tabla_avances_admin" cellspacing="0" style="width:100%;">
                  <thead>
                        <tr style="background:#29a4dd;color:#fff">
                              <th>Id</th>
                              <th>#Contrato</th>
                              <th>Título del Contrato</th>
                              <th>Fecha Inicio</th>
                              <th>Acciones</th>
                        </tr>
                  </thead>
                  <tbody>

                        <?php
				
                    foreach($model->search()->getData() as $records) {
                        ?>
                              <tr>
                                    <td>
                                          <?php echo $records->idInicioEjecucion; ?>
                                    </td>
                                    <td>
                                           <?php echo $records->idContratacion0["ncontrato"]; ?>
                                    </td>
                                    <td>
                                          <?php echo $records->idContratacion0["titulocontrato"]; ?>
                                    </td>
                                    <td>
                                          <?php
                                                if($records->fecha_inicio==null){
                                                      echo '';
                                                }else{
                                                      echo Yii::app()->dateFormatter->format("d/M/y",strtotime($records->fecha_inicio));
                                                }
                                          ?>
                                    </td>
                                    <td style="text-align:center">
                                          <div class="row_buttons">
                                                <button class="btn btn-primary" type="button" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
                                                      <a href="<?php echo  Yii::app()->baseUrl."/index.php?r=avances/admin&id=".$records->idInicioEjecucion; ?>" style="color:#fff">
                                                            <i class="fa fa-user" aria-hidden="true" style="padding:4px;"></i>
                                                      </a>
                                                </button>
                                                <button class="btn btn-warning" type="button" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
                                                      <a href="<?php echo  Yii::app()->baseUrl."/index.php?r=garantias/admin&id=".$records->idInicioEjecucion; ?>" style="color:#fff">
                                                            <i class="fa fa-shopping-cart" aria-hidden="true" style="padding:4px;"></i>
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

                        var table = $('#tabla_avances_admin').DataTable({
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


                        $('#tabla_avances_admin tbody').on('click', 'tr', function () {
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