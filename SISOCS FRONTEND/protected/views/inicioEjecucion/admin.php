<?php
/* @var $this InicioEjecucionController */
/* @var $model InicioEjecucion */

$this->breadcrumbs = array(
    'Implementacion' => array('index'),
    'Administrar',
);

$this->menu = array(
    array('label' => 'Lista de Implementacion (Publicados)', 'url' => array('index')),
    array('label' => 'Crear Implementación', 'url' => array('create')),
);
?>


      <div class="content_header">
            <h1 style="font-size:2em;color:#141414">Gestionar Implementación</h1>

            <p>
                  También puede escribir un operador de comparación (
                  <b>&lt;</b>,
                  <b>&lt;=</b>,
                  <b>&gt;</b>,
                  <b>&gt;=</b>,
                  <b>&lt;&gt;</b>
                  o
                  <b>=</b>) al principio de cada uno de los valores de búsqueda para especificar cómo se debe hacer la comparación.
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
                    'columns' => array( array('header' => 'idInicioEjecucion',
                                              'name' => 'idInicioEjecucion'),
                                        array('header' => '#Contrato',
                                              'name' => 'idContratacion0.ncontrato',
					                                    'value'  => '$data->idContratacion0["ncontrato"]',
                                              'filter' => CHtml::activeTextField($model, 'numero_contrato')),
                                        array('header' => 'Titulo del Contrato',
                                              'name' => 'idContratacion0.titulocontrato',
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
*/
        ?>
            <table class="display hover row-border" id="tabla_inicioEjecucion_admin" cellspacing="0" style="width:100%;">
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
                                                      <a href="<?php echo  Yii::app()->baseUrl."/index.php?r=inicioEjecucion/view&id=".$records->idInicioEjecucion; ?>" style="color:#fff">
                                                            <i class="fa fa-eye" aria-hidden="true" style="padding:4px;"></i>
                                                      </a>
                                                </button>
                                                <button class="btn btn-warning" type="button" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
                                                      <a href="<?php echo  Yii::app()->baseUrl."/index.php?r=inicioEjecucion/update&id=".$records->idInicioEjecucion; ?>" style="color:#fff">
                                                            <i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i>
                                                      </a>
                                                </button>
                                                <button class="btn btn-danger" type="button" onClick="<?php $str=Yii::app()->baseUrl;
                      			  echo " deleteiniEjecucion( ".$records->idInicioEjecucion.") " ?>" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
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

                        var table = $('#tabla_inicioEjecucion_admin').DataTable({
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


                        $('#tabla_inicioEjecucion_admin tbody').on('click', 'tr', function () {
                              if ($(this).hasClass('selected')) {
                                    $(this).removeClass('selected');
                              }
                              else {
                                    table.$('tr.selected').removeClass('selected');
                                    $(this).addClass('selected');
                              }
                        });

                        deleteiniEjecucion = function (id) {
                              const url = "<?php echo Yii::app()->baseUrl?>/index.php?r=inicioEjecucion/delete&id=" + id;

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
