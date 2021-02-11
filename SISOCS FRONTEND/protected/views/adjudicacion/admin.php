<?php
/* @var $this AdjudicacionController */
/* @var $model Adjudicacion */

$this->breadcrumbs = array(
    'Adjudicacioness' => array('index'),
    'Gestionar',
);

$this->menu = array(
    array('label' => 'Listar Adjudicaciones (Publicadas)', 'url' => array('index')),
    array('label' => 'Crear Adjudicación', 'url' => array('create')),
);

?>

<div class="content_header">
<h1 style="font-size:2em;color:#141414">Gestionar Evaluación de las Ofertas/ Adjudicación</h1>

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
$this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $model->search(),
        'filter' => $model,
        'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
        'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
        'summaryText' => 'Mostrando {start} - {end} de {count} registros',
        'htmlOptions' => array('class' => 'grid-view rounded'),
        'columns' => array(
    				array('header' => 'Id de Adjudicación',
    					    'name' => 'idAdjudicacion'),
    				array('header' => 'Número de Proceso',
    					    'name' => 'numproceso'),
    				array('header' => 'Costo estimado (Lempiras)',
        					'name' => 'costoesti',
        					'value' => 'number_format($data->costoesti, 2, ".", ",")',
        					'htmlOptions'=>array('style' => 'text-align: right;')),
    				array('htmlOptions'=>array(
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
*/
?>

<table class="display hover row-border" id="tabla_admin_adjudicacion" cellspacing="0" style="width:100%;">
        <thead>
            <tr style="background:#29a4dd;color:#fff">
                <th>Id</th>
                <th>Número de Proceso</th>
                <th>Costo estimado (Lempiras)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php

                    $total_x=count($records);
                    $row=0;
                    while ($row< $total_x) {
                        ?>
                <tr>
                    <td>
                        <?php echo $records[$row] ['idAdjudicacion']; ?>
                    </td>
                    <td>
                        <?php echo $records[$row] ['numproceso']; ?>
                    </td>
                    <td>
						<?php echo 
						number_format($records[$row] ['costoesti'], 2, ".", ",");
						 ?>
                    </td>
                    <td style="text-align:center">
                        <div class="row_buttons">
                           
                            <a class="btn btn-primary" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;" href="<?php echo  Yii::app()->baseUrl."/index.php?r=adjudicacion/view&id=".$records[$row]['idAdjudicacion']?>" style="color:#fff"><i class="fa fa-eye" aria-hidden="true" style="padding:4px;"></i></a>
                       
                            <a class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"  href="<?php echo  Yii::app()->baseUrl."/index.php?r=adjudicacion/update&id=".$records[$row]['idAdjudicacion']?>" style="color:#fff"><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></a>
    
                            <button class="btn btn-danger" type="button" onClick="<?php $str=Yii::app()->baseUrl; echo "deleteAdjudicacion(".$records[$row] ['idAdjudicacion'].")" ?>" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
                                <i class="fa fa-trash-o" aria-hidden="true" style="padding:4px;"></i>
                            </button>

                        </div>
                    </td>

                </tr>

                <?php
                        $row++;
                    } ?>
        </tbody>
    </table>
    <script type="text/javascript">
        $(document).ready(function () {

            var table = $('#tabla_admin_adjudicacion').DataTable({
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


            $('#tabla_admin_adjudicacion tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            deleteAdjudicacion = function (id) {
                const url ="<?php echo Yii::app()->baseUrl?>/index.php?r=adjudicacion/delete&id="+id;
            
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
                            'error:':function(error){
                              
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
