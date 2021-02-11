<?php
/* @var $this CalificacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Calificaciones',
);

$this->menu=array(
	array('label'=>'Crear Calificacion', 'url'=>array('create')),
	array('label'=>'Gestionar Calificaciones', 'url'=>array('admin')),
);
?>

<div class="content_header">
        <h1 style="font-size:2em;color:#141414">Gestionar  Invitaciones y Calificaciones</h1>
        <hr class="lineOne">
    </div>

<?php /*
$this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $model->published(),
        'filter' => $model,
        'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
        'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
        'summaryText' => 'Mostrando {start} - {end} de {count} registros',
        'htmlOptions' => array('class' => 'grid-view rounded'),
        'columns' => array(
				array('header' => 'Id de Calificación',
					  'name'   => 'idCalificacion'),
				array('header'=>'Número de Proceso',
					  'name'=> 'numproceso'),
				array('header'=>'Nombre de Proceso',
					  'name'=> 'nomprocesoproyecto'),	
				array('header'=>'Método de Adquisición',
					  'name'=>'idMetodo0.siglas'),
				array(
                        'htmlOptions'=>array(
							'width'=>'120',
							'style'=>'text-align:right',
						 ),
						'header' => 'Acciones',
                        'class' => 'CButtonColumn',
						'deleteConfirmation'=>"js:'¿Desea eliminar el registro con código : '+$(this).parent().parent().children(':nth-child(1)').text()+'?'",
						'template' => '{view}',
						'buttons' => array(
										   'view' => array( 
														'label' => '<span class="btn btn-primary" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-eye" aria-hidden="true" style="padding:4px;"></i></span>',  
														'options'=>array('title'=>'Ver'),
														'imageUrl' => false,
														),
										   ),
                ),
        ),
));
*/
?>

<table class="display hover row-border" id="tabla_calificacion_admin" cellspacing="0" style="width:100%;">
        <thead>
            <tr style="background:#29a4dd;color:#fff">
                <th>Id</th>
                <th>Número de Proceso</th>
				<th>Nombre de Proceso</th>
				<th>Método de Adquisición</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
			
			<?php
				
                    foreach($model->published()->getData() as $records) {
                        ?>
                <tr>
                    <td>
                        <?php echo $records->idCalificacion; ?>
                    </td>
                    <td>
						<?php echo $records->numproceso; ?>
                    </td>
                    <td>
						<?php echo $records->nomprocesoproyecto; ?>
					</td>
					<td>
						<?php echo $records->idMetodo0->siglas; ?>
					</td>
                    <td style="text-align:center">
                        <div class="row_buttons">
                            <button class="btn btn-primary" type="button" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
                                <a href="<?php echo  Yii::app()->baseUrl."/index.php?r=calificacion/view&id=".$records->idCalificacion; ?>" style="color:#fff"><i class="fa fa-eye" aria-hidden="true" style="padding:4px;"></i></a>
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

            var table = $('#tabla_calificacion_admin').DataTable({
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


            $('#tabla_calificacion_admin tbody').on('click', 'tr', function () {
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
