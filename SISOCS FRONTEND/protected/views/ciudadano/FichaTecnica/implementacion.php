<div class="animated fadeIn">
    <?php
                                    if (!empty($ejecucion)) {
                                        ?>
        <h5>Datos de contacto del proveedor de los servicios</h5>
        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
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
                    <label for="name" class="control-label col-sm-3" style="font-weight:bold">Teléfono fijo:</label>
                    <div class="col-sm-9" style="text-align:justify">
                        <p>
                            <?php echo (!empty($ejecucion[0]['contacto_telefono'])) ? $ejecucion[0]['contacto_telefono'] : 'No ha divulgado esta información'; ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <label for="name" class="control-label col-sm-3" style="font-weight:bold">Correo electrónico:</label>
                    <div class="col-sm-9" style="text-align:justify">
                        <p>
                            <?php echo (!empty($ejecucion[0]['contacto_email'])) ? $ejecucion[0]['contacto_email'] : 'No ha divulgado esta información'; ?>
                        </p>
                    </div>
                </div>

                <div class="col-md-12 col-xs-12 col-sm-12">
                    <!-- <label for="name" class="control-label col-sm-3" style="font-weight:bold">Fecha Publicado:</label> -->
                    <div class="col-sm-9" style="text-align:justify">
                        <p>
                            <?php /* echo (!empty($ejecucion[0]['fecha_publicacion'])) ? date("d/m/y", strtotime($ejecucion[0]['fecha_publicacion'])) : 'No ha divulgado esta información'; */ ?>
                        </p>
                    </div>
                </div>

                <div class="col-md-12 col-xs-12 col-sm-12">
                    <label for="name" class="control-label col-sm-3" style="font-weight:bold">Fecha de inicio:</label>
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
            <h5>
               Inversiones realizadas
            </h5>
            <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
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

                <table class="display hover row-border" width="100%" id="desembolsos_table">
                    <thead>
                        <tr style="background:#29a4dd;color:#fff;">

                            <th style="padding: 10px;">Número</th>
                            <th>Descripción</th>
                            <th>Monto</th>
                            <th>Fecha desembolso</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                                        $td_style = false;
                                            while ($rowY < $total_y) {
                                                ?>
                        <tr>
                            <?php
                                        if ($td_style == false) {
                                            ?>
                                <td style="background: #f1f1f1">
                                    <?php echo $desembolso[$rowY]['desembolso']; ?>
                                </td>
                                <td style="background: #f9f9f9">
                                    <?php echo $desembolso[$rowY]['descripcion']; ?>
                                </td>
                                <td style="background: #f9f9f9">
                                    <?php echo (!empty($desembolso[$rowY]['monto'])) ? number_format($desembolso[$rowY]['monto'], 2) : 'No ha divulgado esta información'; ?>
                                </td>
                                <td style="background: #f9f9f9">
                                    <?php echo date("d/m/y", strtotime($desembolso[$rowY]['fecha_desembolso'])); ?>
                                </td>
                                <?php
                                                        $td_style = true;
                                        } else {
                                            ?>
                                    <td style="background: #fafafa">
                                        <?php echo $desembolso[$rowY]['desembolso']; ?>
                                    </td>
                                    <td style="background: #fff">
                                        <?php echo $desembolso[$rowY]['descripcion']; ?>
                                    </td>
                                    <td style="background: #fff">
                                        <?php echo (!empty($desembolso[$rowY]['monto'])) ? number_format($desembolso[$rowY]['monto'], 2) : 'No ha divulgado esta información'; ?>
                                    </td>
                                    <td style="background: #fff">
                                        <?php echo date("d/m/y", strtotime($desembolso[$rowY]['fecha_desembolso'])); ?>
                                    </td>
                                    <?php
                                                        $td_style = false;
                                        } ?>
                        </tr>
                        <?php
                                                    $rowY++;
                                            } ?>
                    </tbody>
                </table>
                <?php
                                        } else {
                                            echo "<p>No ha divulgado esta información </p>";
                                        } ?>
                    <!-- Fin Tabla-->

        </div>

        <div class="code-boxInverse">
            <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
                <!--<li class="nav-item">
                    <a class="nav-link active" id="inicioEjectucionMilestone" data-toggle="tab" href="#tabInicioEjecucionMilestone" role="tab"
                        aria-controls="inicioEjectucionMilestone" aria-selected="true">Hito de implementación</a>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link active" id="inicioEjectucionTariffs" data-toggle="tab" href="#tabInicioEjecucionTariffs" role="tab" aria-controls="inicioEjecucionTariffs">Tarifas</a>
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
            <!--<div class="tab-pane fade in active" id="tabInicioEjecucionMilestone" role="tabpanel" aria-labelledby="inicioEjectucionMilestone">
                <div class="code-boxInverse">
                    <h5> Hitos de implementación </h5>
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

                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Fecha prometida</th>
                                    <th>Fecha entrega</th>
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
            -->
            <div class="tab-pane fade in active" id="tabInicioEjecucionTariffs" role="tabpanel" aria-labelledby="inicioEjecucionTariffs">
                <div class="code-boxInverse">
                    <h5> Tarifas </h5>
                    <?php
                                                $generidData = Tariffs::model()->findAll(array(
                                                    'condition' => 'idInicioEjecucion=:id',
                                                    'params' => array(
                                                        ':id' => $ejecucion[0]['idInicioEjecucion']
                                                    )
                                                )); ?>

                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                        <table class="display hover row-border" id="TariffsTable" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr style="background:#29a4dd;color:#fff">

                                    <th>Título</th>
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
                    <h5> Transacciones </h5>
                    <?php
                                                $generidData = Transactions::model()->findAll(array(
                                                    'condition' => 'idInicioEjecucion=:id',
                                                    'params' => array(
                                                        ':id' => $ejecucion[0]['idInicioEjecucion']
                                                    )
                                                )); ?>

                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
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
                    <h5> Documentos de la implementación</h5>
                    <?php
                                                $generidData = ImplementationDocuments::model()->findAll(array(
                                                    'condition' => 'idInicioEjecucion=:id',
                                                    'params' => array(
                                                        ':id' => $ejecucion[0]['idInicioEjecucion']
                                                    )
                                                )); ?>

                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
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
