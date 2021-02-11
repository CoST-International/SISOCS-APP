<div class="animated fadeIn">
    <?php
                                    if (!empty($ejecucion)) {
                                        ?>
        <h4>Datos de contacto del proveedor de los servicios</h4>
        <hr>
        <form class="form-horizontal" role="form" style="padding-top:10px">
            <div class="row">

                
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <label for="name" class="control-label col-sm-3" style="font-weight:bold">Nombre:</label>
                    <div class="col-sm-9" style="text-align:justify">
                        <p>
                            <?php echo (!empty($ejecucion[0]['contacto_nombre'])) ? $ejecucion[0]['contacto_nombre'] : 'No ha divulgado esta información'; ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <label for="name" class="control-label col-sm-3" style="font-weight:bold">Dirección:</label>
                    <div class="col-sm-9" style="text-align:justify">
                        <p>
                            <?php echo (!empty($ejecucion[0]['contacto_direccion'])) ? $ejecucion[0]['contacto_direccion'] : 'No ha divulgado esta información'; ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <label for="name" class="control-label col-sm-3" style="font-weight:bold">Teléfono Fijo:</label>
                    <div class="col-sm-9" style="text-align:justify">
                        <p>
                            <?php echo (!empty($ejecucion[0]['contacto_telefono'])) ? $ejecucion[0]['contacto_telefono'] : 'No ha divulgado esta información'; ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <label for="name" class="control-label col-sm-3" style="font-weight:bold">Correo Electrónico:</label>
                    <div class="col-sm-9" style="text-align:justify">
                        <p>
                            <?php echo (!empty($ejecucion[0]['contacto_email'])) ? $ejecucion[0]['contacto_email'] : 'No ha divulgado esta información'; ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <label for="name" class="control-label col-sm-3" style="font-weight:bold">Fecha Publicado:</label>
                    <div class="col-sm-9" style="text-align:justify">
                        <p>
                            <?php echo (!empty($ejecucion[0]['fecha_publicacion'])) ? date("d/m/y", strtotime($ejecucion[0]['fecha_publicacion'])) : 'No ha divulgado esta información'; ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <label for="name" class="control-label col-sm-3" style="font-weight:bold">Fecha de Inicio:</label>
                    <div class="col-sm-9" style="text-align:justify">
                        <p>
                            <?php $fechaIP = explode("-", $ejecucion[0]['fecha_inicio']);
                                if ($fechaIP[0] == "00") {
                                } else {
                                    echo date('d/m/Y', strtotime($ejecucion[0]['fecha_inicio']));
                                } ?>
                        </p>
                    </div>
                </div>
            </div>
        </form>
        <br/>
        <div class="code-boxInverse">
            <h4>
                <strong>Inversión Realizada</strong>
            </h4>
            <hr>
            <!-- Inicio Tabla -->
            <?php
                        if (empty($desembolso)) {
                            $desembolso = Yii::app()->db->createCommand()->select('*')->from('cs_desembolsos_montos')->where('idInicioEjecucion=:id', array(':id' => $ejecucion[0]['idInicioEjecucion']))->order(array('desembolso ASC'))->queryAll();
                            $rowY       = 0;
                            $total_y    = count($desembolso);
                        } else {
                            echo "<p>No ha divulgado esta información </p>";
                        }
                                        if (!empty($desembolso)) {
                                            ?>
                <table class="table table-bordered table-hover" width="100%">
                    <tr>
                        <th>Número</th>
                        <th>Descripción</th>
                        <th>Monto</th>
                        <th>Fecha Desembolso</th>
                    </tr>
                    <?php
                                        $td_style = false;
                                            while ($rowY < $total_y) {
                                                ?>
                        <tr>
                            <?php
                                        if ($td_style == false) {
                                            ?>
                                <td>
                                    <?php echo $desembolso[$rowY]['desembolso']; ?>
                                </td>
                                <td>
                                    <?php echo $desembolso[$rowY]['descripcion']; ?>
                                </td>
                                <td>
                                    <?php echo (!empty($desembolso[$rowY]['monto'])) ? number_format($desembolso[$rowY]['monto'], 2) : 'No ha divulgado esta información'; ?>
                                </td>
                                <td>
                                    <?php echo date("d/m/y", strtotime($desembolso[$rowY]['fecha_desembolso'])); ?>
                                </td>
                                <?php
                                                        $td_style = true;
                                        } else {
                                            ?>
                                    <td>
                                        <?php echo $desembolso[$rowY]['desembolso']; ?>
                                    </td>
                                    <td>
                                        <?php echo $desembolso[$rowY]['descripcion']; ?>
                                    </td>
                                    <td>
                                        <?php echo (!empty($desembolso[$rowY]['monto'])) ? number_format($desembolso[$rowY]['monto'], 2) : 'No ha divulgado esta información'; ?>
                                    </td>
                                    <td>
                                        <?php echo date("d/m/y", strtotime($desembolso[$rowY]['fecha_desembolso'])); ?>
                                    </td>
                                    <?php
                                                        $td_style = false;
                                        } ?>
                        </tr>
                        <?php
                                                    $rowY++;
                                            } ?>
                </table>
                <?php
                                        } else {
                                            echo "<p>No ha divulgado esta información </p>";
                                        } ?>
                    <!-- Fin Tabla-->

        </div>

        <div class="code-boxInverse">
            <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="inicioEjectucionMilestone" data-toggle="tab" href="#tabInicioEjecucionMilestone" role="tab"
                        aria-controls="inicioEjectucionMilestone" aria-selected="true">Hito de implementación</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="inicioEjectucionTariffs" data-toggle="tab" href="#tabInicioEjecucionTariffs" role="tab" aria-controls="inicioEjecucionTariffs">Tarifas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="inicioEjectucionSignatories" data-toggle="tab" href="#tabInicioEjecucionSignatories" role="tab" aria-controls="inicioEjecucionSignatories">Transaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="inicioEjecucionDocumentos" data-toggle="tab" href="#tabInicioEjecucionDocumentos" role="tab" aria-controls="inicioEjecucionDocumentos">Documentos</a>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade in active" id="tabInicioEjecucionMilestone" role="tabpanel" aria-labelledby="inicioEjectucionMilestone">
                <div class="code-boxInverse">
                    <h4> Hitos de implementación </h4>
                    <?php
                                                $generidData = ImplementationMilestone::model()->findAll(array(
                                                    'condition' => 'idInicioEjecucion=:id',
                                                    'params' => array(
                                                        ':id' => $ejecucion[0]['idInicioEjecucion']
                                                    )
                                                )); ?>

                        <hr>
                        <table class="display hover row-border" id="ImplementationMilestoneTable" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr style="background:#29a4dd;color:#fff">

                                    <th>Titulo</th>
                                    <th>Descripcion</th>
                                    <th>Fecha Prometida</th>
                                    <th>Fecha Entrega</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                                        $total_x=count($generidData);
                                        $row=0;
                                        while ($row< $total_x) {
                                            ?>
                                    <tr>

                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['title']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['description']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['dueDate']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['dateMet']; ?>
                                            </span>
                                        </td>
                                    </tr>

                                    <?php
                                                        $row++;
                                        } ?>
                            </tbody>
                        </table>
                </div>
            </div>
            <div class="tab-pane fade" id="tabInicioEjecucionTariffs" role="tabpanel" aria-labelledby="inicioEjecucionTariffs">
                <div class="code-boxInverse">
                    <h4> Tarifas </h4>
                    <?php
                                                $generidData = Tariffs::model()->findAll(array(
                                                    'condition' => 'idInicioEjecucion=:id',
                                                    'params' => array(
                                                        ':id' => $ejecucion[0]['idInicioEjecucion']
                                                    )
                                                )); ?>

                        <hr>
                        <table class="display hover row-border" id="TariffsTable" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr style="background:#29a4dd;color:#fff">

                                    <th>Titulo</th>
                                    <th>Notas</th>
                                    <th>Dimensiones</th>
                                    <th>Monto</th>
                                    <th>Moneda</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                                        $total_x=count($generidData);
                                        $row=0;
                                        while ($row< $total_x) {
                                            ?>
                                    <tr>

                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['tittle']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['notes']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['dimensions']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['amount']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['currency']; ?>
                                            </span>
                                        </td>
                                    </tr>

                                    <?php
                                                        $row++;
                                        } ?>
                            </tbody>
                        </table>
                </div>
            </div>
            <div class="tab-pane fade" id="tabInicioEjecucionSignatories" role="tabpanel" aria-labelledby="inicioEjecucionSignatories">
                <div class="code-boxInverse">
                    <h4> Transacciones </h4>
                    <?php
                                                $generidData = Transactions::model()->findAll(array(
                                                    'condition' => 'idInicioEjecucion=:id',
                                                    'params' => array(
                                                        ':id' => $ejecucion[0]['idInicioEjecucion']
                                                    )
                                                )); ?>

                        <hr>
                        <table class="display hover row-border" id="TransactionsTable" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr style="background:#29a4dd;color:#fff">

                                    <th>Fecha</th>
                                    <th>Nombre de pagador</th>
                                    <th>Nombre del beneficiario</th>
                                    <th>Monto</th>
                                    <th>Moneda</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                                        $total_x=count($generidData);
                                        $row=0;
                                        while ($row< $total_x) {
                                            ?>
                                    <tr>

                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['date']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['payer_name']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['payee_name']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['amount']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['currency']; ?>
                                            </span>
                                        </td>
                                    </tr>

                                    <?php
                                                        $row++;
                                        } ?>
                            </tbody>
                        </table>
                </div>
            </div>
            <div class="tab-pane fade" id="tabInicioEjecucionDocumentos" role="tabpanel" aria-labelledby="inicioEjecucionDocumentos">
                <div class="code-boxInverse">
                    <h4> Documentos </h4>
                    <?php
                                                $generidData = ImplementationDocuments::model()->findAll(array(
                                                    'condition' => 'idInicioEjecucion=:id',
                                                    'params' => array(
                                                        ':id' => $ejecucion[0]['idInicioEjecucion']
                                                    )
                                                )); ?>

                        <hr>
                        <table class="display hover row-border" id="ImplementationDocumentsTable" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr style="background:#29a4dd;color:#fff">

                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Documentos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                                        $total_x=count($generidData);
                                        $row=0;
                                        while ($row< $total_x) {
                                            ?>
                                    <tr>

                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['title']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['description']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <a href="<?php echo $generidData[$row] ['url']; ?>" target="_blank">Descargar / Ver</a>
                                            </span>
                                        </td>

                                    </tr>

                                    <?php
                                                        $row++;
                                        } ?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>


        <?php
                                    } else {
                                        echo "<p>No ha divulgado esta información </p>";
                                    }
                                    ?>
</div>
