<?php
/* @var $this FinalEjecucionController */
/* @var $model FinalEjecucion */

$this->breadcrumbs=array(
    'Final de Implementacion'=>array('index'),
    'Crear',
);

$this->menu=array(
            array('label'=>'Listar Contratos no finalizados', 'url'=>array('GestionFinales/admin')),
            array('label'=>'Lista de finalizaciones (Publicadas)', 'url'=>array('GestionFinales/publicadas')),
            array('label'=>'Gestionar finalizaciones', 'url'=>array('admin')),
        );

?>






      <div class="content_header">
            <h1 style="font-size:2em;color:#141414">Administrar Finalizacione de contrato</h1>

            <p>
                  Tambi&eacuten puede escribir un operador de comparaci&oacuten (
                  <b>&lt;</b>,
                  <b>&lt;=</b>,
                  <b>&gt;</b>,
                  <b>&gt;=</b>,
                  <b>&lt;&gt;</b>
                  o
                  <b>=</b>) al principio de cada uno de los valores de b&uacutesqueda para especificar c&oacutemo se debe hacer
                  la comparaci&oacuten.
            </p>
            <hr class="lineOne">
      </div>


      <div class="search-form" style="display:none">
      </div>
      <!-- search-form -->

      <?php /*
$this->widget('zii.widgets.grid.CGridView',
              array('dataProvider' => $model->search(),
                    'filter' => $model,
                    'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
                    'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
                    'summaryText' => 'Mostrando {start} - {end} de {count} registros',
                    'htmlOptions' => array('class' => 'grid-view rounded'),
                                        'ajaxUpdate'=>false,
                    'columns' => array(
                                        array('header' => 'Código',
                                              'name'   => 'idFinalizacion'),
                                        array('header' => 'Costo de Finalización',
                                              'name' => 'costoFinalizacion',),
                                        array('header' => 'Alcance de Finalización',
                                              'name'   => 'alcanceFinalizacion',),
                    array('header' => 'Id de Implementación',
                                              'name'   => 'idInicioEjecucion',),
                                        array('header' => 'Fecha de Finalización',
                                              'name'   => 'fechaFinalizacion',
                                              'value'  => 'Yii::app()->dateFormatter->format("d/M/y",strtotime($data->fechaFinalizacion))'),
                                        array('htmlOptions'=>array('width'=>'140',
                                                                   'style'=>'text-align:center'),
                                              'header' => 'Acciones',
                                              'class' => 'CButtonColumn',
                                              'deleteConfirmation'=>"js:'¿Desea eliminar el registro con código : '+$(this).parent().parent().children(':nth-child(1)').text()+'?'",
                                              'template' => '{update}{delete}',
                                              'buttons' => array('update' => array(
                                                                                                        'label' => '<span class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></span>',
                                                                                                        'options'=>array('title'=>'Editar'),
                                                                                                        'imageUrl' => false,
                                                                                                        ),
                                                                                            'delete' => array(
                                                                                                        'label' => '<span class="btn btn-danger" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-trash" aria-hidden="true" style="padding:4px;"></i></span>',
                                                                                                        'options'=>array('title'=>'Eliminar'),
                                                                                                        'imageUrl' => false,
                                                                                                        'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
                                                                                                        ),

                                                            ),
                                        ),
                                 ),
              )
);*/
 ?>

      <table class="display hover row-border" id="tabla_finalEjecucion_admin" cellspacing="0" style="width:100%;">
            <thead>
                  <tr style="background:#29a4dd;color:#fff">
                        <th>Id</th>
                        <th>Costo de Finalización</th>
                        <th>Alcance de Finalización</th>
                        <th>Id Implementación</th>
                        <th>Fecha Finalización</th>
                        <th>Acciones</th>
                  </tr>
            </thead>
            <tbody>

                  <?php

                    foreach ($model->search()->getData() as $records) {
                        ?>
                        <tr>
                              <td>
                                    <?php echo $records->idFinalizacion; ?>
                              </td>
                              <td>
                                    <?php echo $records->costoFinalizacion; ?>
                              </td>
                              <td>
                                    <?php echo $records->alcanceFinalizacion ?>
                              </td>
                              <td>
                                    <?php echo $records->idInicioEjecucion ?>
                              </td>
                              <td>
                                    <?php echo Yii::app()->dateFormatter->format("d/M/y", strtotime($records->fechaFinalizacion)) ?>

                              </td>
                              <td style="text-align:center">
                                    <div class="row_buttons">
                                          <button class="btn btn-primary" type="button" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
                                                <a href="<?php echo  Yii::app()->baseUrl."/index.php?r=finalEjecucion/view&id=".$records->idFinalizacion?>" style="color:#fff">
                                                      <i class="fa fa-eye" aria-hidden="true" style="padding:4px;"></i>
                                                </a>
                                          </button>
                                          <button class="btn btn-warning" type="button" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
                                                <a href="<?php echo  Yii::app()->baseUrl."/index.php?r=finalEjecucion/update&id=".$records->idFinalizacion?>" style="color:#fff">
                                                      <i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i>
                                                </a>
                                          </button>
                                          <button class="btn btn-danger" type="button" onClick="<?php $str=Yii::app()->baseUrl;
                        echo " deleteFinalización( ".$records->idFinalizacion.") " ?>" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
                                                <i class="fa fa-trash-o" aria-hidden="true" style="padding:4px;"></i>
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

                  var table = $('#tabla_finalEjecucion_admin').DataTable({
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


                  $('#tabla_finalEjecucion_admin tbody').on('click', 'tr', function () {
                        if ($(this).hasClass('selected')) {
                              $(this).removeClass('selected');
                        }
                        else {
                              table.$('tr.selected').removeClass('selected');
                              $(this).addClass('selected');
                        }
                  });


                  deleteFinalización = function (id) {
                        const url = "<?php echo Yii::app()->baseUrl?>/index.php?r=finalEjecucion/delete&id=" + id;

                        swal({
                              title: '¿Desea eliminar el registro con código : ' + id + ' ?',
                              text: "No se podrá recuperar en un futuro",
                              type: 'warning',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'Sí, ¡Borrar!',
                              cancelButtonText: 'No, ¡Mantener!',
                              confirmButtonClass: 'btn btn-success',
                              cancelButtonClass: 'btn btn-danger',
                              buttonsStyling: false,
                              reverseButtons: true
                        }).then((result) => {

                              if (result) {

                                    jQuery.ajax({
                                          'type': 'POST',
                                          'data': {
                                                'id': id
                                          },
                                          'url': url,
                                          'cache': false,
                                          'success': function (data) {
                                                table.row('.selected').remove().draw(false);
                                                swal(
                                                      '¡Borrado!',
                                                      'El registro ha sido eliminado',
                                                      'success'
                                                )
                                          },
                                          'error:': function (error) {

                                                swal(
                                                      'Error!',
                                                      'El registro NO ha sido eliminado',
                                                      'error'
                                                )
                                          }
                                    });
                              } else if (result.dismiss === 'cancel') {
                                    swal(
                                          '¡Cancelado!',
                                          'El registro está seguro',
                                          'error'
                                    )
                              }
                        }).catch(swal.noop)
                  }

            });


      </script>
