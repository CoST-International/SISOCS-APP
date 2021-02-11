<?php
/* @var $this AvancesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Avances',
);

$this->menu=array(
	array('label'=>'Crear Avances','url'=>Yii::app()->createUrl("/avances/create", array("id"=>$idInicioEjecucion))),
	array('label'=>'Gestionar Avances', 'url'=>Yii::app()->createUrl("/GestionAvances/admin")),
);
?>

	<div class="content_header">
		<h1 style="font-size:2em;color:#141414">Avances (Publicados)</h1>


		<hr class="lineOne">
	</div>


	<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */?>

	<table class="display hover row-border" id="tabla_avances" cellspacing="0" style="width:100%;">
		<thead>
			<tr style="background:#29a4dd;color:#fff">
				<th>Id</th>
				<th>% Físico Programado</th>
				<th>% Físico Real</th>
				<th>% Fínanciero Programado</th>
				<th>% Fínanciero Real</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>

			<?php
					
                    foreach($dataProvider->getData() as $records) {
                        ?>
				<tr>
					<td>
						<?php echo $records->idAvances; ?>
					</td>
					<td>
						<?php echo $records->porcent_programado; ?>
					</td>
					<td>
						<?php echo $records->porcent_real ?>
					</td>
					<td>
						<?php echo $records->finan_programado ?>
					</td>
					<td>
						<?php echo $records->finan_real ?>
					</td>
					<td style="text-align:center">
						<div class="row_buttons">
							<button class="btn btn-primary" type="button" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
								<a href="<?php echo  Yii::app()->baseUrl." /index.php?r=avances/view&id=".$records->idAvances; ?>" style="color:#fff">
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

			var table = $('#tabla_avances').DataTable({
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


			$('#tabla_avances tbody').on('click', 'tr', function () {
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