<table class="table table-bordered table-hover" width="100%" id ="table_plan_desembolos">
    <thead>
        <tr style="background:#29a4dd;color:#fff">
            <th>Tipo</th>
            <th>Fecha vencimiento</th>
            <th>Monto</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if (!empty($ejecucion)) {
                $garantias = Yii::app()->db->createCommand()
                                                ->select('*')
                                                ->from('cs_garantias')
                                                ->where('idInicioEjecucion=:id', array(':id' => $ejecucion[0]['idInicioEjecucion']))
                                                ->queryAll();
                foreach ($garantias as $element) {
                    $tipoGarantias = Yii::app()->db->createCommand("SELECT nombre FROM cs_tipo_garantias WHERE idTipoGarantia=".$element['idTipoGarantia'])->queryScalar();
                    ?>
            <tr>
                <td>
                    <?php echo $tipoGarantias ?>
                </td>
                <td>
                    <?php echo $$element['fecha_vencimiento'] ?>
                </td>
                <td>
                    <?php echo $element['monto'] ?>
                </td>
                <td>
                    <?php echo $element['estado'] ?>
                </td>
            </tr>
            <?php
                }
            }
            ?>
    </tbody>
</table>
