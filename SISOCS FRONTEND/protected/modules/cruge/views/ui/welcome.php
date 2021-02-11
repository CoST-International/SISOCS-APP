<?php
// llamada cuando el actionRegistration ha insertado a un usuario
?>
    <div class="login_Style">
        <div class='form'>
            <h1 style="padding-top:30px">
                <?php echo CrugeTranslator::t("Bienvenido");?>
            </h1>
            <hr>
            <div class="" id="logon-form">
                <div class="row" id="specialRow">
                    <div class="col-md-12">
                        <p>
                            <b>
                                <?php echo CrugeTranslator::t('registration', 'The account has been created!'); ?>
                            </b>
                        </p>
                        <p>
                            <?php echo CrugeTranslator::t('registration', 'Click here to login using new credentials:'); ?>
                            <strong><?php echo Yii::app()->user->ui->loginLink; ?></strong>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>