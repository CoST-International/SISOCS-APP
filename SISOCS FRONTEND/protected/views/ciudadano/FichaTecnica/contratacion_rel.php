<div class="animated fadeIn">
    <?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/protected/views/ciudadano/FichaTecnica/assets/js/timeline.js');
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/protected/views/ciudadano/FichaTecnica/assets/css/timeline.css');
    if (!empty($contratacion)) {
            ?>

        <form class="form-horizontal" role="form" style="padding-top:10px">
            <div class="row">

                <div class="col-md-12 col-xs-12 col-sm-12">
                    <label for="name" class="control-label col-sm-3" style="font-weight:bold">Número de contratación:</label>
                    <div class="col-sm-9" style="text-align:justify">
                        <p>
                            <?php echo (!empty($contratacion[0]['ncontrato'])) ? $contratacion[0]['ncontrato'] : 'No ha divulgado esta información'; ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <label for="name" class="control-label col-sm-3" style="font-weight:bold">Nombre:</label>
                    <div class="col-sm-9" style="text-align:justify">
                        <p>
                            <?php echo (!empty($contratacion[0]['titulocontrato'])) ? $contratacion[0]['titulocontrato'] : 'No ha divulgado esta información'; ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <label for="name" class="control-label col-sm-3" style="font-weight:bold">Empresa:</label>
                    <div class="col-sm-9" style="text-align:justify">
                        <p>
                            <?php echo (!empty($contratacion[0]['nombre_oferente'])) ? $contratacion[0]['nombre_oferente'] : 'No ha divulgado esta información'; ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <label for="name" class="control-label col-sm-3" style="font-weight:bold">Alcance:</label>
                    <div class="col-sm-9" style="text-align:justify">
                        <p>
                            <?php echo (!empty($contratacion[0]['alcances'])) ? $contratacion[0]['alcances'] : 'No ha divulgado esta información'; ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <label for="name" class="control-label col-sm-3" style="font-weight:bold">Fecha de inicio:</label>
                    <div class="col-sm-9" style="text-align:justify">
                        <p>
                            <?php echo (!empty($contratacion[0]['fechainicio'])) ? date("d/m/y", strtotime($contratacion[0]['fechainicio'])) : 'No ha divulgado esta información'; ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <label for="name" class="control-label col-sm-3" style="font-weight:bold">Fecha final:</label>
                    <div class="col-sm-9" style="text-align:justify">
                        <p>
                            <?php echo (!empty($contratacion[0]['fechafinal'])) ? date("d/m/y", strtotime($contratacion[0]['fechafinal'])) : 'No ha divulgado esta información'; ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <label for="name" class="control-label col-sm-3" style="font-weight:bold">Costo en Lempiras:</label>
                    <div class="col-sm-9" style="text-align:justify">
                        <p>
                            <?php echo (!empty($contratacion[0]['precioLPS'])) ? number_format($contratacion[0]['precioLPS'], 2) : 'No ha divulgado esta información'; ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <label for="name" class="control-label col-sm-3" style="font-weight:bold">Costo equivalente Dólares:</label>
                    <div class="col-sm-9" style="text-align:justify">
                        <p>
                            <?php echo (!empty($contratacion[0]['precioUSD'])) ? number_format($contratacion[0]['precioUSD'], 2) : 'No ha divulgado esta información'; ?>
                        </p>
                    </div>
                </div>
            </div>
        </form>
        <?php
            $generidData = ContractDocuments::model()->findAll(array(
                'condition' => 'idContratacion=:id',
                'params' => array(
                    ':id' => $contratacion[0]['idContratacion']
                )
            ));
            if (count($generidData) != 0){
        ?>

        <div class="code-boxInverse">
            <h5> Documentos de la contratación </h5>


                <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                <table class="display hover row-border" id="ContractDocumentsTable" cellspacing="0" style="width:100%;">
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
        <?php
            }
        ?>
        <?php
            $countContractsOrganizationDetails = ContractsOrganizationDetails::model()->count(array(
                'condition' => 'idContratacion=:id',
                'params' => array(
                    ':id' => $contratacion[0]['idContratacion']
                )
            ));
            $countContractsSignatories = ContractsSignatories::model()->count(array(
                'condition' => 'idContratacion=:id',
                'params' => array(
                    ':id' => $contratacion[0]['idContratacion']
                )
            ));
            $countDebtEquityRatio = DebtEquityRatio::model()->count(array(
                'condition' => 'idContratacion=:id',
                'params' => array(
                    ':id' => $contratacion[0]['idContratacion']
                )
            ));
            $countGovSupportGuarantee = GovSupportGuarantee::model()->count(array(
                'condition' => 'idContratacion=:id',
                'params' => array(
                    ':id' => $contratacion[0]['idContratacion']
                )
            ));
            $countRiskAllocation = RiskAllocation::model()->count(array(
                'condition' => 'idContratacion=:id',
                'params' => array(
                    ':id' => $contratacion[0]['idContratacion']
                )
            ));
            $countActualIrr = ActualIrr::model()->count(array(
                'condition' => 'idContratacion=:id',
                'params' => array(
                    ':id' => $contratacion[0]['idContratacion']
                )
            ));
            $countAmendment = Amendment::model()->count(array(
                'condition' => 'idContratacion=:id',
                'params' => array(
                    ':id' => $contratacion[0]['idContratacion']
                )
            ));
            $countShareholders = Shareholders::model()->count(array(
                'condition' => 'idContratacion=:id',
                'params' => array(
                    ':id' => $contratacion[0]['idContratacion']
                )
            ));
            $countLendersSuppliers = LendersSuppliers::model()->count(array(
                'condition' => 'idContratacion=:id',
                'params' => array(
                    ':id' => $contratacion[0]['idContratacion']
                )
            ));
            $counShareCapital = ShareCapital::model()->count(array(
                'condition' => 'idContratacion=:id',
                'params' => array(
                    ':id' => $contratacion[0]['idContratacion']
                )
            ));
        ?>
        <div class="page-title section-title-double animated fadeIn">
            <h2>Información financiera</h2>
            <span></span>
        </div>

        <div class="code-boxInverse">
            <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
                <?php
                    if(($countContractsSignatories) != 0){
                ?>
                <li class="nav-item">
                    <a class="nav-link active" id="contratacionSignatories" data-toggle="tab" href="#tabSignatoriesContract" role="tab" aria-controls="contratacionSignatories">Firmantes</a>
                </li>
                <?php
                    }
                ?>
                <?php
                    if(($countContractsOrganizationDetails) != 0){
                ?>
                <li class="nav-item">
                    <a class="nav-link" id="contratacionOrganization" data-toggle="tab" href="#tabOrganizationContract" role="tab" aria-controls="contratacionOrganization">Detalles de organización</a>
                </li>
                <?php
                    }
                ?>
                <?php
                    if(($countShareholders) != 0){
                ?>
                <li class="nav-item">
                    <a class="nav-link" id="contratacionShareholders" data-toggle="tab" href="#tabShareHolder" role="tab" aria-controls="contratacionShareholders">Accionistas</a>
                </li>
                <?php
                    }
                ?>
                <?php
                    if(($countLendersSuppliers) != 0){
                ?>
                <li class="nav-item">
                    <a class="nav-link" id="contratacionLendersSup" data-toggle="tab" href="#tabLenderSup" role="tab" aria-controls="contratacionLendersSup">Prestamistas comerciales / Inversionistas institucionales</a>
                </li>
                <?php
                    }
                ?>
                <?php
                    if(($countGovSupportGuarantee) != 0){
                ?>
                <li class="nav-item">
                    <a class="nav-link" id="contratacionGov" data-toggle="tab" href="#tabContratacionGob" role="tab" aria-controls="contratacionGov">Garantía de gobierno</a>
                </li>
                <?php
                    }
                ?>
                <?php
                    if(($countRiskAllocation) != 0){
                ?>
                <li class="nav-item">
                    <a class="nav-link active" id="contratacionRisk" data-toggle="tab" href="#tabRisk" role="tab" aria-controls="contratacionRisk">Riesgos</a>
                </li>
                <?php
                    }
                ?>
                <?php
                    if(($countDebtEquityRatio) != 0){
                ?>
                <li class="nav-item">
                    <a class="nav-link" id="contratacionDebtRatio" data-toggle="tab" href="#tabDebtContract" role="tab" aria-controls="contratacionDebtRatio">Ratio de capital de la deuda</a>
                </li>
                <?php
                    }
                ?>
                <?php
                    if(($countActualIrr) != 0){
                ?>
                <li class="nav-item">
                    <a class="nav-link" id="contratacionIRR" data-toggle="tab" href="#tabIRR" role="tab" aria-controls="contratacionIRR">IRR actual</a>
                </li>
                <?php
                    }
                ?>
                <?php
                    if(($counShareCapital) != 0){
                ?>
                <li class="nav-item">
                    <a class="nav-link" id="contratacionShare" data-toggle="tab" href="#tabShare" role="tab" aria-controls="contratacionShare">Capital compartido</a>
                </li>
                <?php
                    }
                ?>
                <?php
                    if(($countAmendment) != 0){
                ?>
                <li class="nav-item">
                    <a class="nav-link" id="contratacionAmendment" data-toggle="tab" href="#tabAmendment" role="tab" aria-controls="contratacionAmendment">Renegociaciones</a>
                </li>
                <?php
                    }
                ?>
            </ul>
        </div>


        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade " id="tabOrganizationContract" role="tabpanel" aria-labelledby="contratacionOrganization">
                <div class="code-boxInverse">
                    <h5> Detalles de organización </h5>
                    <?php
                                                $generidData = ContractsOrganizationDetails::model()->findAll(array(
                                                    'condition' => 'idContratacion=:id',
                                                    'params' => array(
                                                        ':id' => $contratacion[0]['idContratacion']
                                                    )
                                                )); ?>

                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                        <table class="display hover row-border" id="ContractsOrganizationDetailsTable" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr style="background:#29a4dd;color:#fff">
                                    <th>Organización</th>
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
                                                <?php echo $generidData[$row] ['parties_id']; ?>
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
            <?php
                    if(($countContractsSignatories) != 0){
                ?>
            <div class="tab-pane fade in active" id="tabSignatoriesContract" role="tabpanel" aria-labelledby="contratacionSignatories">
                <div class="code-boxInverse">
                    <h5> Firmantes </h5>
                    <?php
                                                $generidData = ContractsSignatories::model()->findAll(array(
                                                    'condition' => 'idContratacion=:id',
                                                    'params' => array(
                                                        ':id' => $contratacion[0]['idContratacion']
                                                    )
                                                )); ?>

                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                        <table class="display hover row-border" id="ContractsSignatoriesTable" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr style="background:#29a4dd;color:#fff">
                                    <th>Nombre Fuente</th>
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
                                                <?php echo $generidData[$row] ['parties_name']; ?>
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
            <?php
                }
            ?>
            <div class="tab-pane fade " id="tabDebtContract" role="tabpanel" aria-labelledby="contratacionDebtRatio">
                <div class="code-boxInverse">
                    <h5> Ratio de capital de la deuda </h5>
                    <?php
                                                $generidData = DebtEquityRatio::model()->findAll(array(
                                                    'condition' => 'idContratacion=:id',
                                                    'params' => array(
                                                        ':id' => $contratacion[0]['idContratacion']
                                                    )
                                                )); ?>

                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                        <table class="display hover row-border" id="DebtEquityRatioTable" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr style="background:#29a4dd;color:#fff">

                                    <th>Equidad de capital de la deuda</th>
                                    <th>Cantidad del capital social</th>
                                    <th>Moneda del capital social</th>
                                    <th>Detalles de la razón de la equidad de la deuda</th>
                                    <th>Relación de subsidio</th>
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
                                                <?php echo $generidData[$row] ['debtEquityRatio']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['shareCapital_amount']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['shareCapital_currency']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['debtEquityRatioDetails']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['subsidyRatio']; ?>
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
            <div class="tab-pane fade " id="tabContratacionGob" role="tabpanel" aria-labelledby="contratacionGov">
                <div class="code-boxInverse">
                    <h5> Garantía de gobierno </h5>
                    <?php
                                                $generidData = GovSupportGuarantee::model()->findAll(array(
                                                    'condition' => 'idContratacion=:id',
                                                    'params' => array(
                                                        ':id' => $contratacion[0]['idContratacion']
                                                    )
                                                )); ?>

                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                        <table class="display hover row-border" id="GovSupportGuaranteeTable" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr style="background:#29a4dd;color:#fff">

                                    <th>Título</th>
                                    <th>Categoría de financiación</th>
                                    <th>Fecha inicio</th>
                                    <th>Fecha final</th>
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
                                                <?php echo $generidData[$row] ['title']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['financeCategory']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['startDate']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['endDate']; ?>
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
            <div class="tab-pane fade in active" id="tabRisk" role="tabpanel" aria-labelledby="contratacionRisk">
                <div class="code-boxInverse">
                    <h5> Riesgos </h5>
                    <?php
                                                /*$generidData = RiskAllocation::model()->findAll(array(
                                                    'condition' => 'idContratacion=:id',
                                                    'params' => array(
                                                        ':id' => $contratacion[0]['idContratacion']
                                                    )
                                                )); */

                                                $sql = 'SELECT `idContratacion`, `description`, `allocation_party_id`, `cs_parties`.`legalName` FROM `cs_risk_allocation` LEFT OUTER JOIN `cs_parties` ON `cs_risk_allocation`.`allocation_party_id` = `cs_parties`.`id` WHERE `idContratacion` = '.$contratacion[0]['idContratacion'];

                                                $generidData = Yii::app()->db->createCommand($sql)->queryAll();

                                                ?>

                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">

                        <table class="display hover row-border" id="RiskAllocationTable" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr style="background:#29a4dd;color:#fff">
                                    <th>Descripción</th>
                                    <th>Asignación</th>
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
                                                <?php echo $generidData[$row]['description']; //echo $generidData[$row] ['description']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row]['legalName']; //echo $generidData[$row] ['legalName']; ?>
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
            <div class="tab-pane fade " id="tabShare" role="tabpanel" aria-labelledby="contratacionShare">
                <div class="code-boxInverse">
                    <h5> Capital compartido </h5>
                    <?php
                                                $generidData = ShareCapital::model()->findAll(array(
                                                    'condition' => 'idContratacion=:id',
                                                    'params' => array(
                                                        ':id' => $contratacion[0]['idContratacion']
                                                    )
                                                )); ?>

                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                        <table class="display hover row-border" id="ShareCapitalTable" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr style="background:#29a4dd;color:#fff">

                                    <th>Ratio de capital de la deuda</th>
                                    <th>Monto capital compartido</th>
                                    <th>Moneda capital compartido</th>
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
                                                <?php echo $generidData[$row] ['debtEquityRatio']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['shareCapital_amount']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['shareCapital_currency']; ?>
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
            <div class="tab-pane fade " id="tabIRR" role="tabpanel" aria-labelledby="contratacionIRR">
                <div class="code-boxInverse">
                    <h5> IRR actual </h5>
                    <?php
                                                $generidData = ActualIrr::model()->findAll(array(
                                                    'condition' => 'idContratacion=:id',
                                                    'params' => array(
                                                        ':id' => $contratacion[0]['idContratacion']
                                                    )
                                                )); ?>

                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                        <table class="display hover row-border" id="ActualIrrTable" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr style="background:#29a4dd;color:#fff">
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Duración de periodo en días</th>
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
                                                <?php echo $generidData[$row] ['period_durationInDays']; ?>
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
            <div class="tab-pane fade" id="tabAmendment" role="tabpanel" aria-labelledby="contratacionAmendment">
                <div class="code-boxInverse">
                    <h5> Renegociaciones </h5>
                    <?php
                                                $generidData = Amendment::model()->findAll(array(
                                                    'condition' => 'idContratacion=:id',
                                                    'params' => array(
                                                        ':id' => $contratacion[0]['idContratacion']
                                                    )
                                                )); ?>

                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                        <table class="display hover row-border" id="AmendmentTable" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr style="background:#29a4dd;color:#fff">

                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Fecha</th>
                                    <th>Razón</th>
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
                                                <?php echo $generidData[$row] ['date']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['rationale']; ?>
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
            <div class="tab-pane fade " id="tabShareHolder" role="tabpanel" aria-labelledby="contratacionShareholders">
                <div class="code-boxInverse">
                    <h5> Accionistas </h5>
                    <?php
                                                $generidData = Shareholders::model()->findAll(array(
                                                    'condition' => 'idContratacion=:id',
                                                    'params' => array(
                                                        ':id' => $contratacion[0]['idContratacion']
                                                    )
                                                )); ?>

                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                        <table class="display hover row-border" id="ShareholdersTable" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr style="background:#29a4dd;color:#fff">

                                    <th>Nombre</th>
                                    <th>Derechos de votación</th>
                                    <th>Detalles del derecho de votación</th>
                                    <th>Accionado</th>
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
                                                <?php echo $generidData[$row] ['shareholder_name']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['votingRights']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['votingRightsDetails']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['shareholding']; ?>
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
            <div class="tab-pane fade " id="tabLenderSup" role="tabpanel" aria-labelledby="contratacionLendersSup">
                <div class="code-boxInverse">
                    <h5> Prestamistas comerciales / Inversionistas institucionales </h5>
                    <?php
                                                $generidData = LendersSuppliers::model()->findAll(array(
                                                    'condition' => 'idContratacion=:id',
                                                    'params' => array(
                                                        ':id' => $contratacion[0]['idContratacion']
                                                    )
                                                )); ?>

                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                        <table class="display hover row-border" id="LendersSuppliersTable" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr style="background:#29a4dd;color:#fff">
                                    <th>Nombre</th>
                                    <th>Derechos de votación</th>
                                    <th>Detalles del derecho de votación</th>
                                    <th>Accionado</th>
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
                                                <?php echo $generidData[$row] ['shareholder_name']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['votingRights']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['votingRightsDetails']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <?php echo $generidData[$row] ['shareholding']; ?>
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

            <div class="tab-pane fade " id="tabcontratacionProyectosRelacionados" role="tabpanel" aria-labelledby="contratacionProyectosRelacionados">
                <div class="code-boxInverse">
                    <h5> Proyectos relacionados </h5>
                    <?php
                                                $sql     = 'SELECT rp.id, p.nombre_proyecto, rp.idProyecto FROM cs_related_process rp JOIN cs_proyecto p ON rp.idProyecto = p.idProyecto AND p.estado = \'PUBLICADO\' where rp.idContratacion = ' . $contratacion[0]['idContratacion'];
                                        $command = Yii::app()->db->createCommand($sql);
                                        $generidData      = $command->queryAll(); ?>

                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                        <table class="display hover row-border" id="ProyectosRelacionadosTable" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr style="background:#29a4dd;color:#fff">
                                    <th>Nombre Proyecto</th>
                                    <th>Ver Proyecto </th>
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
                                                <?php echo $generidData[$row] ['nombre_proyecto']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php
                                                                    echo CHtml::link(CHtml::Button('Ver Detalle', array('class' => 'hvr-grow','id' => 'tableButton')), array('PreFichaTecnica','id'=>$generidData[$row] ['idProyecto'])); ?>
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



        <table class="general">
            <tr>
                <td style="text-align:center">
                    <?php /*echo CHtml::Button('Ver información de respaldo', array(
                                                'onclick' => '$("#respContratacion").dialog("open"); return false;'
                                            ));*/
                                                ?>
                </td>
            </tr>
        </table>
        <?php
                                    } else {
                                        echo "<p>No ha divulgado esta información </p>";
                                    }
                                    ?>

</div>
