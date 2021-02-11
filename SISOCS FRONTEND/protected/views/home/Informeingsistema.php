<div class="informe_sistema">
    <div class="row">
        <h1 class="section-title wow fadeIn animated" data-wow-delay=".2s">
            PROJECTS
        </h1>
        <p class="section-subcontent"></p>
        <hr class="lineOne">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="coolBox">
                <h5>
                    <strong style="font-size:.8em">Proyectos:</strong>
                    <label style="float:right;font-size:.8em">
                        <?php echo count(Proyecto::Model()->findAll());?>
                    </label>
                </h5>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="coolBox" style="float:right">
                <h5>
                    <strong style="font-size:.8em">Contratos:</strong>
                    <label style="float:right;font-size:.8em">USD.
                        <?php
                            $sum=Yii::app()->db->createCommand()
                            ->select('sum(precio)')
                            ->from('cs_contratacion')
                            ->queryScalar();
                            echo number_format(($sum/1000000), 2). "M";?>
                    </label>
                </h5>
            </div>
        </div>

    </div>
    <?php Yii::app()->counter->refresh();?>
    <div class="row">
           

    </div>

</div>

<div align="center">

  
    <table>
        <tr>
            <td>Usuarios Conectados:</td>
            <td>
                <?php echo Yii::app()->counter->getOnline(); ?>
            </td>
        </tr>
        <tr>
            <td>Usuarios que se conectaron el día de hoy:</td>
            <td>
                <?php echo Yii::app()->counter->getToday(); ?>
            </td>
        </tr>
        <tr>
            <td>Usuarios que se conectaron el día de ayer:</td>
            <td>
                <?php echo Yii::app()->counter->getYesterday(); ?>
            </td>
        </tr>
        <tr>
            <td>Total de usuarios que se han conectado:</td>
            <td>
                <?php echo Yii::app()->counter->getTotal(); ?>
            </td>
        </tr>
        <tr>
            <td>Máximo de usuarios conectados:</td>
            <td>
                <?php echo Yii::app()->counter->getMaximal(); ?>
            </td>
        </tr>
        <tr>
            <td>Fecha del máximo de usuarios conectados:</td>
            <td>
                <?php echo date('d.m.Y', Yii::app()->counter->getMaximalTime()); ?>
            </td>
        </tr>
    </table>
</div>