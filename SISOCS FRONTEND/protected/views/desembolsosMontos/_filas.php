
<?php
//'value'  => 'Yii::app()->format->number($data->fecha_desembolso)'
// Buscar manera de que muestre los 50 registros de golpe
if (isset($evento)) {
  $this->widget('zii.widgets.grid.CGridView',
                array('dataProvider' => $model->search(),
                      'filter' => null,
                      'enableSorting' => false,
                      'enablePagination' => true,
                      'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css', 'pageSize' => 50)
                      'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
                      'summaryText' => 'Mostrando {start} - {end} de {count} registros',
                      'htmlOptions' => array('class' => 'grid-view rounded'),
                      'columns' => array(
                                          array('header' => '   #',
                                                'name'   => 'desembolso'),
                                          array('header' => 'Descripcion',
                                                'name' => 'descripcion'),
                                          array('header' => 'Monto',
                                                'name' => 'monto'),
                                          array('header' => 'Fecha de desembolso',
                                                'name'   => 'fecha_desembolso',
                                                'htmlOptions'=>array('style'=>'text-align: right;'),
                                              /*'value'  => 'Yii::app()->dateFormatter->format("dd/MM/yyyy",strtotime($data->fecha_desembolso))'*/),
                                          array('htmlOptions'=>array('width'=>'140',
                                                                     'style'=>'text-align:center'),
                                                'header' => 'Acciones',
                                                'class' => 'CButtonColumn',
                                                'deleteConfirmation'=>"js:'¿Desea eliminar el registro con código : '+$(this).parent().parent().children(':nth-child(1)').text()+'?'",
                                                'template' => '{update}{delete}',
                                                'buttons' => array('update' => array('label' => '<span class="btn btn-warning" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-edit" aria-hidden="true" style="padding:4px;"></i></span>', 
                                                                                    'url' => 'Yii::app()->createUrl("/desembolsosMontos/update", array("id"=>$data->idDesembolso))','options' => array('title' => 'Editar'),
                                                                                    'imageUrl' => false),
                                                                  'delete' => array('label' => '<span class="btn btn-danger" style="padding:5px;border-radius:2px;margin-right:5px;border: #fff solid 1px;"><i class="fa fa-trash" aria-hidden="true" style="padding:4px;"></i></span>', 
                                                                                    'url' => 'Yii::app()->createUrl("InicioEjecucion/DeleteDesembolso", array("codigo" => $data->idDesembolso, "cod_inicioEjecucion"=>$data->idInicioEjecucion))',
                                                                                    'options' => array('title' => 'Eliminar'),
                                                                                    'imageUrl' => false)
                                                              ),
                                          ),
                                   ),
                )
  );
}
else {
  echo "Hacer redirect";
}
?>

<!--

<div class="row">
    <?php if (count($datos) > 0) { ?>
        <table class="tablesorter table table-bordered hasFilters tablesorter-bootstrap" width="60%">
            <colgroup>
                <col style="width: 4%;">
                <col style="width: 36%;">
                <col style="width: 18%;">
                <col style="width: 28%;">
                <?php if ($evento != 'View') { ?>
                <col style="width: 6%;">
                <?php }; ?>
            </colgroup>
            <thead>
                <tr class="tablesorter-headerRow">
                    <th style="-moz-user-select: none;" unselectable="on" tabindex="0" data-column="0" class="tablesorter-header bootstrap-header">
                        <div class="tablesorter-wrapper" style="position:relative;height:100%;width:100%">
                            <div class="tablesorter-header-inner"># <i class="tablesorter-icon bootstrap-icon-unsorted"></i></div>
                        </div>
                    </th>
                    <th style="-moz-user-select: none;" unselectable="on" tabindex="0" data-column="2" class="tablesorter-header bootstrap-header">
                        <div class="tablesorter-wrapper" style="position:relative;height:100%;width:100%">
                            <div class="tablesorter-header-inner">Descripcion <i class="tablesorter-icon bootstrap-icon-unsorted"></i></div>
                        </div>
                    </th>
                    <th style="-moz-user-select: none;" unselectable="on" tabindex="0" data-column="3" class="filter-false tablesorter-header bootstrap-header">
                        <div class="tablesorter-wrapper" style="position:relative;height:100%;width:100%">
                            <div class="tablesorter-header-inner">Monto <i class="tablesorter-icon bootstrap-icon-unsorted"></i></div>
                        </div>
                    </th>
                    <th style="-moz-user-select: none;" unselectable="on" tabindex="0" data-column="4" class="filter-false tablesorter-header bootstrap-header">
                        <div class="tablesorter-wrapper" style="position:relative;height:100%;width:100%">
                            <div class="tablesorter-header-inner">Fecha <i class="tablesorter-icon bootstrap-icon-unsorted"></i></div>
                        </div>
                    </th>
                    <?php if ($evento != 'View') { ?>
                    <th style="-moz-user-select: none;" unselectable="on" tabindex="0" data-column="5" class="filter-false tablesorter-header bootstrap-header">
                        <div class="tablesorter-wrapper" style="position:relative;height:100%;width:100%">
                            <div class="tablesorter-header-inner">Acciones <i class="tablesorter-icon bootstrap-icon-unsorted"></i></div>
                        </div>
                    </th>
                    <?php }; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $rs = 'odd';
                foreach ($datos as $i => $item):
                    ?>
                    <tr class="<?php echo $rs; ?>">
                        <td><?php echo $item->desembolso; ?></td>
                        <td><?php echo $item->descripcion; ?></td>
                        <td><?php echo number_format($item->monto, 2, '.', ','); ?></td>
                        <td><?php echo Yii::app()->dateFormatter->format("y-m-d",strtotime($item->fecha_desembolso));
									//echo $item->fecha_desembolso;
						?></td>
                        <?php if ($evento != 'View') {
                                echo '<td>';
                                echo CHtml::link('Eliminar', $this->createUrl('InicioEjecucion/DeleteDesembolso', array('codigo' => $item->idDesembolso, 'cod_inicioEjecucion'=>$item->idInicioEjecucion )), array('class' => 'del'));
                                echo '</td>';

                              }
                        ?>
                    </tr>
                    <?php
                    $rs = ($rs == 'odd') ? 'even' : 'odd';
                endforeach;
                ?>
            </tbody>
        </table>
    <?php } ?>
</div>
-->
