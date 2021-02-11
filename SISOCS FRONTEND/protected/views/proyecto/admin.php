<?php
/* @var $this ProyectoController */
/* @var $model Proyecto */

$this->breadcrumbs = array(
    'Proyectos' => array('index'),
    'Gestionar',
);

$this->menu = array(
    array('label' => 'Listar Proyectos (Publicados)', 'url' => array('index')),
    array('label' => 'Crear Proyecto', 'url' => array('create')),

);

?>

    <div class="content_header">
        <h1 style="font-size:2em;color:#141414">Gestionar Planificación de Proyectos</h1>

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

    <div id="statusMsg">
        <?php if (Yii::app()->user->hasFlash('success')):?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
        <?php endif; ?>

        <?php if (Yii::app()->user->hasFlash('error')):?>
        <div class="flash-error">
            <?php echo Yii::app()->user->getFlash('error'); ?>
        </div>
        <?php endif; ?>
    </div>

    <?php /*
$this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $model->search(),
        'filter' => $model,
        'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css'),
        'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
        'summaryText' => 'Mostrando {start} - {end} de {count} registros',
        'htmlOptions' => array('class' => 'grid-view rounded'),
        'ajaxUpdate'=>false,
        'columns' => array(
                array('header' => 'idProyecto',
                      'name'   => 'idProyecto'),
                array('header' => 'Código',
                      'name'   => 'codigo'),
                array('header' => 'Nombre del Proyecto',
                      'name'   => 'nombre_proyecto'),
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
                                                        'imageUrl' => true,
                            //'click'=>'function(event){alert("Hola");event.preventDefault();}',
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
));
*/
?>


    <table class="display hover row-border" id="tabla_admin" cellspacing="0" style="width:100%;">
        <thead>
            <tr style="background:#29a4dd;color:#fff">
                <th>Id</th>
                <th>Código</th>
                <th>Nombre</th>
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
                        <?php echo $records[$row] ['idProyecto']; ?>
                    </td>
                    <td>
                        <?php echo $records[$row] ['codigo']; ?>
                    </td>
                    <td>
                        <?php echo $records[$row] ['nombre_proyecto']; ?>
                    </td>
                    <td style="text-align:center">
                        <div class="row_buttons">

                            <a class="btn btn-primary" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;" href="<?php echo  Yii::app()->baseUrl."/index.php?r=proyecto/view&id=".$records[$row]['idProyecto']?>" style="color:#fff"><i class="fa fa-eye" aria-hidden="true" style="padding:4px;"></i></a>

                            <a class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;" href="<?php echo  Yii::app()->baseUrl."/index.php?r=proyecto/update&id=".$records[$row]['idProyecto']?>" style="color:#fff"><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></a>

                            <button class="btn btn-danger" type="button" onClick="<?php $str=Yii::app()->baseUrl; echo "deleteProject(".$records[$row] ['idProyecto'].")" ?>" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
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

            var table = $('#tabla_admin').DataTable({
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


            $('#tabla_admin tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            deleteProject = function (id) {
                const url ="<?php echo Yii::app()->baseUrl?>/index.php?r=proyecto/delete&id="+id;
            
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