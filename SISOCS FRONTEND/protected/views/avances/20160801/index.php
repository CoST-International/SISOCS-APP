<?php
/* @var $this AvancesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Avances',
);

$this->menu=array(
	//array('label'=>'Crear Avances', 'url'=>array('create')),
	array('label'=>'Administrar Avances', 'url'=>array('admin2','id'=>Yii::app()->getSession()->get('cod_inicioEjecucion'))),
);
?>


<div class="content_header">
<h1 style="font-size:2em;color:#141414">Avances en la ejecuci&oacute;n</h1>


<hr class="lineOne">
</div>

<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */?>

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
                                                <a href="<?php echo  Yii::app()->baseUrl." /index.php?r=finalEjecucion/view&id=".$records->idFinalizacion?>" style="color:#fff">
                                                      <i class="fa fa-eye" aria-hidden="true" style="padding:4px;"></i>
                                                </a>
                                          </button>
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

            });

             
      </script>
