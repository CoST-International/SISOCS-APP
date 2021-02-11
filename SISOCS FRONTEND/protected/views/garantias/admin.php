<?php
/* @var $this GarantiasController */
/* @var $model Garantias */

$this->breadcrumbs=array(
	'Avances y Garantías'=>array('/GestionAvances/admin'),
	'Gestionar Garantías',
);

$this->menu=array(
	array('label'=>'Listar Garantias (publicadas)', 'url'=>array('/garantias/index')),
	array('label'=>'Crear Garantia', 'url'=>Yii::app()->createUrl("/garantias/create", array("id"=>$model->idInicioEjecucion))),
	array('label'=>'Regresar', 'url'=>Yii::app()->createUrl("/GestionAvances/admin")),
);
?>

<div class="content_header">
            <h1 style="font-size:2em;color:#141414">Gestion Garantías de la Ejecución #<?php echo isset($model->idInicioEjecucion)?$model->idInicioEjecucion:'';?></h1>


            <hr class="lineOne">
</div>



<?php
/*
$this->widget('zii.widgets.grid.CGridView',
              array('dataProvider' => $model->search(),
                    'filter' => null,
                    'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
                    'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
                    'summaryText' => 'Mostrando {start} - {end} de {count} registros',
                    'htmlOptions' => array('class' => 'grid-view rounded'),
                    'columns' => array(
                                        array('header' => 'idGarantia',
                                              'name'   => 'idGarantia'),
                                        array('header' => 'Implementacion',
                                              'name' => 'idInicioEjecucion'),
                                        array('header' => 'Tipo garantia',
                                              'name' => 'idTipoGarantia',
                                              'value'  => '$data->idTipoGarantia0["nombre"]'),
                                        array('header' => 'Fecha de Vencimiento',
                                              'name'   => 'fecha_vencimiento',
                                              'value'  => 'Yii::app()->dateFormatter->format("d/M/y",strtotime($data->fecha_vencimiento))'),
                                        array('htmlOptions'=>array('width'=>'140',
                                                                   'style'=>'text-align:center'),
                                              'header' => 'Acciones',
                                              'class' => 'CButtonColumn',
                                              'deleteConfirmation'=>"js:'¿Desea eliminar el registro con código : '+$(this).parent().parent().children(':nth-child(1)').text()+'?'",
                                              //'template' => '{avances}{garantias}',
                                              'buttons' => array('view' => array( 'label' => '<span class="btn btn-primary" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-eye" aria-hidden="true" style="padding:4px;"></i></span>', 
                                                                                'options' => array('title' => 'Ver'),
                                                                                'imageUrl' => false),
                                                                'update' => array('label' => '<span class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></span>', 
                                                                                  'url' => 'Yii::app()->createUrl("/garantias/update", array("id"=>$data->idGarantia,"idInicioEjecucion"=>$data->idInicioEjecucion))',
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
*/
?>

<table class="display hover row-border" id="itabla_garantias_admin" cellspacing="0" style="width:100%;">
                  <thead>
                        <tr style="background:#29a4dd;color:#fff">
                              <th>Id</th>
                              <th>Implementación</th>
                              <th>Tipo Garantía</th>
                              <th>Fecha Vencimiento</th>
                              <th>Acciones</th>
                        </tr>
                  </thead>
                  <tbody>

                        <?php
				
                    foreach($model->search()->getData() as $records) {
                        ?>
                              <tr>
                                    <td>
                                          <?php echo $records->idGarantia; ?>
                                    </td>
                                    <td>
                                           <?php echo $records->idInicioEjecucion?>
                                    </td>
                                    <td>
                                          <?php echo $records->idTipoGarantia0["nombre"]; ?>
                                    </td>
                                    <td>
                                          <?php
                                                if($records->fecha_vencimiento==null){
                                                      echo '';
                                                }else{
                                                      echo Yii::app()->dateFormatter->format("d/M/y",strtotime($records->fecha_vencimiento));
                                                }
                                          ?>
                                    </td>
                                    <td style="text-align:center">
                                          <div class="row_buttons">
                                                <button class="btn btn-primary" type="button" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
                                                      <a href="<?php echo  Yii::app()->baseUrl."/index.php?r=garantias/view&id=".$records->idGarantia; ?>" style="color:#fff">
                                                            <i class="fa fa-eye" aria-hidden="true" style="padding:4px;"></i>
                                                      </a>
                                                </button>
                                                <button class="btn btn-warning" type="button" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
                                                      <a href="<?php echo  Yii::app()->baseUrl."/index.php?r=garantias/update&id=".$records->idGarantia; ?>" style="color:#fff">
                                                            <i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i>
                                                      </a>
                                                </button>
                                                <button class="btn btn-danger" type="button" onClick="<?php $str=Yii::app()->baseUrl;
                      			  echo "deleteiniEjecucion( ".$records->idGarantia.") " ?>" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
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

                        var table = $('#itabla_garantias_admin').DataTable({
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


                        $('#itabla_garantias_admin tbody').on('click', 'tr', function () {
                              if ($(this).hasClass('selected')) {
                                    $(this).removeClass('selected');
                              }
                              else {
                                    table.$('tr.selected').removeClass('selected');
                                    $(this).addClass('selected');
                              }
                        });

                        deleteiniEjecucion = function (id) {
                              const url = "<?php echo Yii::app()->baseUrl?>/index.php?r=garantias/delete&id=" + id;

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
