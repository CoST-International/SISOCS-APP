<div class="animated fadeIn">
<?php
    if (!empty($adjudicacion)) {
        ?>

        <form class="form-horizontal" role="form" style="padding-top:10px">
    <div class="row">

        <div class="col-md-12 col-xs-12 col-sm-12">
            <label for="name" class="control-label col-sm-3" style="font-weight:bold">Número de adjudicación:</label>
            <div class="col-sm-9" style="text-align:justify">
                <p>
                    <?php echo (!empty($adjudicacion[0]['numproceso'])) ? $adjudicacion[0]['numproceso'] : 'No ha divulgado esta información'; ?>
                </p>
            </div>
        </div>
        <div class="col-md-12 col-xs-12 col-sm-12">
            <label for="name" class="control-label col-sm-3" style="font-weight:bold">Método de evaluación:</label>
            <div class="col-sm-9" style="text-align:justify">
                <p>
                    <?php $metodoEvaluacion=Yii::app()->db->createCommand('SELECT m.adquisicion FROM cs_metodo m WHERE m.idMetodo=(SELECT cali.idmetodo from cs_calificacion cali WHERE cali.idCalificacion='.$calificacion[0]['idCalificacion'].')')->queryAll(); ?>
                    <?php echo (!empty($metodoEvaluacion[0]['adquisicion'])) ? $metodoEvaluacion[0]['adquisicion'] : 'No ha divulgado esta información'; ?>
                </p>
            </div>
        </div>
    </div>
    </form>
    <br/>
    <div class="code-boxInverse">
        <h5> Documentos de la adjudicación </h5>
        <?php
                                                $generidData = AwardDocuments::model()->findAll(array(
                                                    'condition' => 'idAdjudicacion=:id',
                                                    'params' => array(
                                                        ':id' => $adjudicacion[0]['idAdjudicacion']
                                                    )
                                                )); ?>

            <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
            <table class="display hover row-border" id="AwardDocumentsTable" cellspacing="0" style="width:100%;">
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
    <div class="code-boxInverse">
                    <h5> Oferentes preferidos </h5>
                    <?php
                                                $generidData = PreferredBidders::model()->findAll(array(
                                                    'condition' => 'idContratacion=:id',
                                                    'params' => array(
                                                        ':id' => $contratacion[0]['idContratacion']
                                                    )
                                                )); ?>

                        <hr align="left" style="border-top: 2px solid #29a4dd;width:100%;margin-top:0px;margin-bottom: 2.5em;">
                        <table class="display hover row-border" id="PreferredBiddersTable" cellspacing="0" style="width:100%;">
                            <thead>
                                <tr style="background:#29a4dd;color:#fff">
                                    <th>Nombre</th>

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
    <table class="general">
        <tr>
            <td style="text-align:center">
                <?php /*echo CHtml::Button('Ver información de respaldo', array(
                                                'onclick' => '$("#respAdjudicacion").dialog("open"); return false;'
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
