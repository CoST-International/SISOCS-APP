<?php
/* @var $this AvancesController */
/* @var $model Avances */

$this->breadcrumbs=array(
	'Avances y Garantías'=>array('/GestionAvances/admin'),
	'Gestionar Avances',
);

$this->menu=array(
	array('label'=>'Listar Avances (publicados)', 'url'=>Yii::app()->createUrl("/avances/index", array("id"=>$model->idInicioEjecucion))),
	array('label'=>'Crear Avances', 'url'=>Yii::app()->createUrl("/avances/create", array("id"=>$model->idInicioEjecucion))),
	array('label'=>'Regresar', 'url'=>Yii::app()->createUrl("/GestionAvances/admin")),
);
?>




<div class="content_header">
            <h1 style="font-size:2em;color:#141414">Gestionar Avances en la Ejecuci&oacute;n # <?php echo $idInicioEjecucion; ?></h1>


            <hr class="lineOne">
</div>

<?php /*
 if (count($model) > 0) {
    $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider' => $model->searchWithInicioEjecucion($idInicioEjecucion),
            'filter' => $model,
            'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
            'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
            'summaryText' => 'Mostrando {start} - {end} de {count} registros',
            'htmlOptions' => array('class' => 'grid-view .grid-size rounded'),
            'columns' => array(
                    array('header' => 'Id Avance',
                          'name'   => 'idAvances'),
                    array('header' => '% Físico Programado',
													'headerHtmlOptions' => array ('style' => 'text-align: right;'),
                          'name'   => 'porcent_programado'),
                    array('header' => '% Físico Real',
													'headerHtmlOptions' => array ('style' => 'text-align: right;'),
                          'name'   => 'porcent_real'),
                    array('header' => '% Fínanciero Programado',
													'headerHtmlOptions' => array ('style' => 'text-align: right;'),
                          'name'   => 'finan_programado'),
                    array('header' => '% Fínanciero Real',
													'headerHtmlOptions' => array ('style' => 'text-align: right;'),
                          'name'   => 'finan_real'),
                    array(
                            'htmlOptions'=>array(
                                'width'=>'120',
                                'style'=>'text-align:right',
                             ),
                            'header' => 'Acciones',
                            'class' => 'CButtonColumn',
                            'deleteConfirmation'=>"js:'¿Desea eliminar el registro con código : '+$(this).parent().parent().children(':nth-child(1)').text()+'?'",
                            'template' => '{view}{update}{delete}',
                            'buttons' => array(
                                               'view' => array(
                                                            'label' => '<span class="btn btn-primary" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-eye" aria-hidden="true" style="padding:4px;"></i></span>', 
                                                            'options'=>array('title'=>'Ver'),
                                                            'imageUrl' => false,
                                                            ),
                                                'update' => array(
                                                            'label' => '<span class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></span>', 
                                                            'options'=>array('title'=>'Editar'),
                                                            'imageUrl' => false,
                                                            ),
                                                'delete' => array(
                                                            'label' => '<span class="btn btn-danger" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-trash" aria-hidden="true" style="padding:4px;"></i></span>', 
                                                            'options'=>array('title'=>'Eliminar'),
                                                            'imageUrl' => false,
                                                            ),
                                               ),
                    ),
            ),
    ));
}
else {
    echo 'Na hay avances registrados en esta ejecución.';
}
*/
?>

<table class="display hover row-border" id="tabla_gestion_avances_admin" cellspacing="0" style="width:100%;">
                  <thead>
                        <tr style="background:#29a4dd;color:#fff">
                              <th>Id</th>
                              <th> Descripción de Temas </th>
                              <th>% Físico Programado</th>
                              <th>% Físico Real</th>
                              <th> Descripción de Problemas </th>
                              <th>Acciones</th>
                        </tr>
                  </thead>
                  <tbody>

                        <?php
				
                    foreach($model->searchWithInicioEjecucion($idInicioEjecucion)->getData() as $records) {
                        ?>
                              <tr>
                                    <td>
                                          <?php echo $records->idAvances; ?>
                                    </td>
                                    <td>
                                           <?php echo $records->desc_temas; ?>
                                    </td>
                                    <td>
                                          <?php echo $records->porcent_real ?>
                                    </td>
                                    <td>
                                          <?php echo $records->finan_programado ?>
                                    </td>
                                    <td>
                                          <?php echo $records->desc_problemas ?>
                                    </td>
                                    <td style="text-align:center">
                                          <div class="row_buttons">
                                                <button class="btn btn-primary" type="button" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
                                                      <a href="<?php echo  Yii::app()->baseUrl."/index.php?r=avances/view&id=".$records->idAvances; ?>" style="color:#fff">
                                                            <i class="fa fa-eye" aria-hidden="true" style="padding:4px;"></i>
                                                      </a>
                                                </button>
                                                <button class="btn btn-warning" type="button" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
                                                      <a href="<?php echo  Yii::app()->baseUrl."/index.php?r=avances/update&id=".$records->idAvances; ?>" style="color:#fff">
                                                            <i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i>
                                                      </a>
                                                </button>
                                                <button class="btn btn-danger" type="button" onClick="<?php $str=Yii::app()->baseUrl;
                      			  echo "deleteAvance( ".$records->idAvances.") " ?>" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
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

                        var table = $('#tabla_gestion_avances_admin').DataTable({
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


                        $('#tabla_gestion_avances_admin tbody').on('click', 'tr', function () {
                              if ($(this).hasClass('selected')) {
                                    $(this).removeClass('selected');
                              }
                              else {
                                    table.$('tr.selected').removeClass('selected');
                                    $(this).addClass('selected');
                              }
                        });

                        deleteAvance = function (id) {
                              const url = "<?php echo Yii::app()->baseUrl?>/index.php?r=avances/delete&id=" + id;

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


