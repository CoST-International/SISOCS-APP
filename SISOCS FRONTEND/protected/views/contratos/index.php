<?php
/* @var $this ContratosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Contratos',
);

$this->menu=array(
    array('label'=>'Crear Modificación', 'url'=>array('create')),
    array('label'=>'Gestionar Modificacines', 'url'=>array('admin')),
);
?>

	<div class="content_header">
		<h1 style="font-size:2em;color:#141414">Gestión de Contratos</h1>


		<hr class="lineOne">
	</div>

	<?php /*$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
)); */?>

	<table class="display hover row-border" id="tabla_contratos" cellspacing="0" style="width:100%;">
		<thead>
			<tr style="background:#29a4dd;color:#fff">
				<th>Id</th>
				<th>Id Contratación</th>
				<th>Número de Modificación</th>
				<th>Fecha de Modificación del Contrato</th>
				<th>Tipo de Modificación al Contrato</th>		
				<th>Precio Actualizado</th>
				<th>Fecha Actualizada de Terminación del Contrato</th>
				<th>Estado</th>
				<th>Programa Actualizado de Trabajo</th>
				<th>Alcance Actualizado del Proyecto</th>
				<th >Justificación de la Modificación al Contrato</th>
				<th>Adendas a los Contratos Debidamente Suscritas</th>
				<th>Otro</th>
			</tr>
		</thead>
		<tbody>

			<?php
					
	                foreach ($dataProvider->getData() as $records) {
            ?>
				<tr>
					<td style="text-align:center">
						<?php echo $records->idContratos; ?>
						<button class="btn btn-primary" type="button" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
							<a href="<?php echo  Yii::app()->baseUrl." /index.php?r=contratos/view&id=".$records->idContratos; ?>" style="color:#fff">
								<i class="fa fa-eye" aria-hidden="true" style="padding:4px;"></i>
							</a>
						</button>
					</td>

					<td>
						<?php echo $records->idContratacion; ?>
					</td>
					<td>
						<?php echo $records->nmodifica?>
					</td>

					<td>
						<?php echo Yii::app()->dateFormatter->format("d/M/y", strtotime($records->fecha)); ?>
					</td>

					<td>
						<?php echo $records->tipomodifica ?>
					</td>

					<td>
						<?php echo number_format($records->precioactual, "2", ".", ","); ?>
					</td>

					<td>
						<?php echo Yii::app()->dateFormatter->format("d/M/y", strtotime($records->fechatercontra)); ?>
					</td>

					<td>
						<?php echo $records->estado ?>
					</td>

					<td>
						<?php echo $records->prograactu ?>
					</td>

					<td>
						<?php echo $records->alcanceactucontrato ?>
					</td>

					<td>
						<?php echo $records->justimodcontrato ?>
					</td>

					<td>
						<?php echo $records->adendas ?>
					</td>

					<td>
					<?php echo $records->otro ?>
					</td>

				</tr>

				<?php
                    } ?>
		</tbody>
	</table>

	<script type="text/javascript">
		$(document).ready(function () {

			var table = $('#tabla_contratos').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },

				"pagingType": "simple",
				"scrollX": "100%",
				"processing": true,
				"autoWidth": true,
				"info": true,
				"responsive": true

			});


			$('#tabla_contratos tbody').on('click', 'tr', function () {
				if ($(this).hasClass('selected')) {
					$(this).removeClass('selected');
				}
				else {
					table.$('tr.selected').removeClass('selected');
					$(this).addClass('selected');
				}
			});

			deletecontratacion = function (id) {
				const url = "<?php echo Yii::app()->baseUrl?>/index.php?r=contratos/delete&id=" + id;

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