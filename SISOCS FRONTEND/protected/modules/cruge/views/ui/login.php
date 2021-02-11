<script type="text/javascript">
    $(document).ready(function(){
        $('.login_Style').insertAfter('.row-fluid');
        $('.row-fluid').hide();
    });
</script>
<div class="login_Style">
	<br>
	<?php if (Yii::app()->user->hasFlash('loginflash')): ?>
	<div class="flash-error">
		<?php echo Yii::app()->user->getFlash('loginflash'); ?>
	</div>
	<?php else: ?>
	<div class="formLogin">
		<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'logon-form',
    'enableClientValidation'=>false,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>
		
		<form class="form-horizontal" role="form">
            <div class="row" id="specialRow">
                <div class="col-md-12">
				<h1>
					<?php echo CrugeTranslator::t('logon', "Login"); ?>
				</h1>
                    <hr>
                </div>
            </div>
            <div class="row" id="specialRow">
                <div class="col-md-12">
                    <div class="form-group has-danger">
                      
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
							<?php echo $form->textField($model, 'username', array('class'=>'form-control', 'id'=>'UserName','placeholder'=> 'Enter your UserName','required'=>'true')); ?>
						</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-control-feedback">
                        <span class="text-danger align-middle">	
							<?php echo $form->error($model, 'username'); ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row" id="specialRow">
                <div class="col-md-12">
                    <div class="form-group">
                      
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
							<?php echo $form->passwordField($model, 'password', array('class'=>'form-control', 'id'=>'password','placeholder'=> 'Enter your Password','required'=>'true')); ?>
						</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-control-feedback">
                        <span class="text-danger align-middle">
						<?php echo $form->error($model, 'password'); ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row" id="specialRow">
                <div class="col-md-12 rememberMe" style="padding-top: .35rem">
                    <div class="form-check mb-2 mr-sm-2 mb-sm-0">
                        <label class="form-check-label">
						<?php echo $form->checkBox($model, 'rememberMe',array('class'=>'form-check-input','name'=>'remember')); ?>
                            <span style="padding-bottom: .15rem">Recordarme</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top: 1rem" id="specialRow">
                <div class="col-md-12">
					<?php Yii::app()->user->ui->tbutton(CrugeTranslator::t('logon', "Login"), array('class'=>'btn btn-common')); ?>
                    <!--button type="submit" class="btn btn-success"><i class="fa fa-sign-in"></i> Login</button-->
				</div>
				<div class="col-md-12 loginFooter">
					<hr>
					<div style="float:left">
						<?php echo Yii::app()->user->ui->passwordRecoveryLink; ?>
					</div>
					<div style="float:right">
						<?php
					if (Yii::app()->user->um->getDefaultSystem()->getn('registrationonlogin')===1) {
						echo Yii::app()->user->ui->registrationLink;
					}
		
					?>
					</div>
			    </div>
            </div>
        </form>
		<?php
        //	si el componente CrugeConnector existe lo usa:
        //
        if (Yii::app()->getComponent('crugeconnector') != null) {
            if (Yii::app()->crugeconnector->hasEnabledClients) {
                ?>
			<div class='crugeconnector'>
				<span>
					<?php echo CrugeTranslator::t('logon', 'You also can login with'); ?>:</span>
				<ul>
					<?php 
            $cc = Yii::app()->crugeconnector;
                foreach ($cc->enabledClients as $key=>$config) {
                    $image = CHtml::image($cc->getClientDefaultImage($key));
                    echo "<li>".CHtml::link(
                    $image,
                    $cc->getClientLoginUrl($key)
                )."</li>";
                } ?>
				</ul>
			</div>
			<?php
            }
        } ?>


				<?php $this->endWidget(); ?>
	</div>
	<?php endif; ?>
</div>