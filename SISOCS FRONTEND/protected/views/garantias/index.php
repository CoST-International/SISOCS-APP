<?php
/* @var $this GarantiasController */
/* @var $model Garantias */

$this->breadcrumbs=array(
	'Avances y Garantías'=>array('/GestionAvances/admin'),
	'Gestionar Garantías',
);

$this->menu=array(
	array('label'=>'Listar Garantías (publicadas)', 'url'=>array('/garantias/index')),
	array('label'=>'Crear Garantía', 'url'=>Yii::app()->createUrl("/garantias/create", array("id"=>$model->idInicioEjecucion))),
	array('label'=>'Regresar', 'url'=>Yii::app()->createUrl("/GestionAvances/admin")),
);
?>



<div class="content_header">
            <h1 style="font-size:2em;color:#141414">Listado de Garantías publicadas</h1>


            <hr class="lineOne">
</div>


<?php
/*
$this->widget('zii.widgets.grid.CGridView',
              array('dataProvider' => $model->published(),
                    'filter' => $model,
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
																							'template' => '{view}',
																							'buttons' => array('view' => array( 'label' => '<span class="btn btn-primary" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-eye" aria-hidden="true" style="padding:4px;"></i></span>', 
                                                                                'options' => array('title' => 'Ver'),
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
      
  foreach($model->published()->getData() as $records) {
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

   

});
</script>




