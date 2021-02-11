<?php
/* @var $this ProyectoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Proyectos',
);

$this->menu=array(
    array('label'=>'Crear Proyecto', 'url'=>array('create')),
    array('label'=>'Gestionar Proyectos', 'url'=>array('admin')),
);
?>


<div class="content_header">
        <h1 style="font-size:2em;color:#141414">Planificación de Proyectos (Publicados)</h1>
        <hr class="lineOne">
    </div>


<?php
/*$this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $model->published(),
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
));*/

?>

<table class="display hover row-border" id="tabla_published" cellspacing="0" style="width:100%;">
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
	 		
                    foreach($model->published()->getData() as $records) {
                        ?>
                <tr>
                    <td>
                        <?php echo $records->idProyecto; ?>
                    </td>
                    <td>
                        <?php echo $records->codigo; ?>
                    </td>
                    <td>
                        <?php echo $records->nombre_proyecto; ?>
                    </td>
                    <td style="text-align:center">
                        <div class="row_buttons">
                            <button class="btn btn-primary" type="button" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;">
                                <a href="<?php echo  Yii::app()->baseUrl."/index.php?r=proyecto/view&id=".$records->idProyecto?>" style="color:#fff"><i class="fa fa-eye" aria-hidden="true" style="padding:4px;"></i></a>
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

            var table = $('#tabla_published').DataTable({
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


            $('#tabla_published tbody').on('click', 'tr', function () {
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