<div class="login_Style">
	<div class="formLogin">
		<h1 style="padding-top:30px">
			<?php echo CrugeTranslator::t("Recuperar la clave"); ?>
			<hr>
		</h1>

		<?php 
		if (Yii::app()->user->hasFlash('pwdrecflash')): 
		?>
		<div class="flash-success">
			<?php echo Yii::app()->user->getFlash('pwdrecflash'); ?>
		</div>
		<?php 
			else:
		?>
		<form class="form-horizontal" role="form" id="logon-form">
			<?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'pwdrcv-form',
            'enableClientValidation'=>false,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>

			<div class="row" id="specialRow">
				<div class="col-md-12">
					<div class="form-group has-danger">
						<label class="" for="UserName">UserName</label>
						<div class="input-group mb-2 mr-sm-2 mb-sm-0">
							<div class="input-group-addon" style="width: 2.6rem">
								<i class="fa fa-user"></i>
							</div>
							<?php 
                                echo $form->textField($model, 'username', array('class'=>'form-control', 'id'=>'UserName','placeholder'=> 'Enter your UserName','required'=>'true'));
                            ?>

						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-control-feedback">
						<span class="text-danger align-middle">
							<?php	
                                echo $form->error($model, 'username');
                            ?>
						</span>
					</div>
				</div>
			</div>
			<?php 
			if (CCaptcha::checkRequirements()): ?>
				<div class="row" id="specialRow">
					<div class="col-md-12">
						<div class="form-group">
							<?php echo $form->labelEx($model, 'verifyCode'); ?>
							<div class="input-group mb-2 mr-sm-2 mb-sm-0">
								<div class="input-group-addon" style="width: 2.6rem">
									<i class="fa fa-key"></i>
								</div>
								<?php 
									echo $form->textField($model, 'verifyCode', array('class'=>'form-control', 'id'=>'verifyCode','type'=>'text','placeholder'=> 'code...','required'=>'true'));
								?>
							</div>
							<?php $this->widget('CCaptcha'); ?>
							<div class="hint" style="color:#141414">
								<?php echo CrugeTranslator::t("Por favor ingrese los caracteres o digitos que vea en la imagen");?>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-control-feedback">
							<span class="text-danger align-middle">
								<?php echo $form->error($model, 'verifyCode'); ?>
							</span>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<div class="col-md-12 col-xs-12 col-sm-12">
				<hr>
				<center>
					<?php Yii::app()->user->ui->tbutton("Recuperar la Clave", array('class'=>'btn btn-common')); ?>
				</center>
			</div>

			<?php $this->endWidget(); ?>
		</form>
		<?php endif; ?>
	</div>
</div>