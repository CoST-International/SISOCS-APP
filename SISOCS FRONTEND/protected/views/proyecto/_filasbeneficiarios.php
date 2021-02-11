
<div class="row">
    <?php if (count($datos)>0) { ?>
        <table class="tablesorter table table-bordered hasFilters tablesorter-bootstrap">
            <colgroup>
                <!-- <col style="width: 18%;"> -->
                <col style="width: 4%;">
                <col style="width: 4%;">
                <col style="width: 4%;">
				<col style="width: 4%;">
                <?php if ($evento != 'View') { ?>
                <col style="width: 4%;">
                <?php }; ?>
            </colgroup>
            <thead>
                <tr class="tablesorter-headerRow"><!--
                    <th style="-moz-user-select: none;" unselectable="on" tabindex="0" data-column="0" class="tablesorter-header bootstrap-header">
                        <div class="tablesorter-wrapper" style="position:relative;height:100%;width:100%">
                            <div class="tablesorter-header-inner">Codigo Proyecto<i class="tablesorter-icon bootstrap-icon-unsorted"></i></div>
                        </div>
                    </th> -->
                    <th style="-moz-user-select: none;" unselectable="on" tabindex="0" data-column="3" class="filter-false tablesorter-header bootstrap-header">
                        <div class="tablesorter-wrapper" style="position:relative;height:100%;width:100%">
                            <div class="tablesorter-header-inner">Departamento <i class="tablesorter-icon bootstrap-icon-unsorted"></i></div>
                        </div>
                    </th>
                    <th style="-moz-user-select: none;" unselectable="on" tabindex="0" data-column="0" class="tablesorter-header bootstrap-header">
                        <div class="tablesorter-wrapper" style="position:relative;height:100%;width:100%">
                            <div class="tablesorter-header-inner">Municipio<i class="tablesorter-icon bootstrap-icon-unsorted"></i></div>
                        </div>
                    </th>
					<th style="-moz-user-select: none;" unselectable="on" tabindex="0" data-column="0" class="tablesorter-header bootstrap-header">
                        <div class="tablesorter-wrapper" style="position:relative;height:100%;width:100%">
                            <div class="tablesorter-header-inner">Comentarios<i class="tablesorter-icon bootstrap-icon-unsorted"></i></div>
                        </div>
                    </th>
                    <?php if ($evento != 'View') { ?>
					<th style="-moz-user-select: none;" unselectable="on" tabindex="0" data-column="0" class="tablesorter-header bootstrap-header">
                        <div class="tablesorter-wrapper" style="position:relative;height:100%;width:100%">
                            <div class="tablesorter-header-inner">Accion <i class="tablesorter-icon bootstrap-icon-unsorted"></i></div>
                        </div>
                    </th>
                    <?php }; ?>
                </tr>
            </thead>
            <tbody>
            <?php
                $rs = 'odd';
                for ($i=0; $i<count($datos); $i++) {
                    if ($datos[$i]['idProyecto'] != NULL) {
                        echo '<tr class='.$rs.'">';
                        //echo '    <td>'.$datos[$i]['idProyecto'].'</td>';
                        echo '    <td>'.$datos[$i]['departamento'].'</td>';
                        echo '    <td>'.$datos[$i]['municipio'].'</td>';
                        echo '    <td>'.$datos[$i]['Beneficio'].'</td>';
                        if ($evento != 'View') {
                            echo '    <td>';
                            echo CHtml::link('Eliminar',array('proyecto/DeleteGet',array('pro'=>$datos[$i]['idProyecto'],'mun'=>$datos[$i]['idMunicipio'],'dep'=>$datos[$i]['idDepartamento'])),array('class'=>'del'));
                            echo '    </td>';
                        }
                        echo '</tr>';
                        $rs = ($rs == 'odd') ? 'even' : 'odd';
                    }
                }
            ?>
            </tbody>
        </table>
    <?php } ?>
</div>
