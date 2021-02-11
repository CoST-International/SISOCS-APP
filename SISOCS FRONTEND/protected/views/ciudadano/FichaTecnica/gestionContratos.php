<div class="animated fadeIn">
<?php
                                    if (!empty($contratos_gestion)) {
                                        $IdContr   = $contratacion[0]['idContratacion'];
                                        $ids       = $_GET['id'];
                                        $rowContra = Yii::app()->db->createCommand()->select('*')->from('vContratos')->where('idContratacion=:id', array(
                                            ':id' => $IdContr
                                        ))->order('nmodifica')->queryAll();
                                        $rowc      = 0;
                                        $total_c   = count($rowContra);
                                        if (!empty($rowContra)) {
                                            ?>

    <table class="display hover row-border" id="GestionContratosTable" cellspacing="0" style="width:100%;">
        <thead>
            <tr style="background:#29a4dd;color:#fff">
                <th>Número de modificación</th>
                <th>Fecha de modificación del contrato</th>
                <th>Tipo modificación</th>
                <th>Justificación de contrato</th>
                <th>Cambio en el precio original del contrato</th>
                <th>Alcance actual contrato</th>
            </tr>
        </thead>
        <tbody>
            <?php

                                        $total_x=count($rowContra);
                                            $row=0;
                                            while ($row< $total_x) {
                                                ?>
                <tr>
                    <td>
                        <span>
                            <?php echo $rowContra[$row] ['nmodifica']; ?>
                        </span>
                    </td>
                    <td>
                        <span>
                            <?php echo date("d/m/y", strtotime($rowContra[$row] ['fecha'])); ?>
                        </span>
                    </td>
                    <td>
                        <span>
                            <?php echo $rowContra[$row] ['tipomodifica']; ?>
                        </span>
                    </td>
                    <td>
                        <span>
                            <?php echo $rowContra[$row] ['justimodcontrato']; ?>
                        </span>
                    </td>
                    <td>
                        <span>
                            <?php echo number_format($rowContra[$row]['precioactual']); ?>
                        </span>
                    </td>
                    <td>
                        <span>
                            <?php echo $rowContra[$row]['alcanceactucontrato']; ?>
                        </span>
                    </td>
                </tr>

                <?php
                                        $row++;
                                            } ?>
        </tbody>
    </table>
    <div class="page-title animated fadeIn">
        <h4>Documentos de la renegociación</h4>
    </div>
        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
        <?php
                                    $listId = [];
                                    foreach ($rowContra as $valor) {
                                        $listId[] = $valor["idContratos"];
                                    }
                                    $generidData = ContratosDocuments::model()->findAll(array(
                                        'condition' => 'idContrato IN ('.join(',', $listId).')'
                                    )); ?>

            <hr>
            <table class="display hover row-border" id="ContratosDocumentsTable" cellspacing="0" style="width:100%;">
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



    <?php
                                        } else {
                                            echo 'No se han realizado modificaciones a este contrato';
                                        }
                                    } else {
                                        echo "<p>No ha divulgado esta información </p>";
                                    }
                                    ?>
        </div>
