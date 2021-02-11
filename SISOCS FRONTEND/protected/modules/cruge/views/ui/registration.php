<div class="login_Style">
	<div class="formLogin"> id="regForm">
		<h1 style="padding-top:30px">
			<?php echo ucwords(CrugeTranslator::t("registrarse"));?>
			<hr>
		</h1>
		<?php
            /*
                $model:  es una instancia que implementa a ICrugeStoredUser
            */
        ?>
			<?php $form = $this->beginWidget('CActiveForm', array(
                'id'=>'registration-form',
                'enableAjaxValidation'=>false,
                'enableClientValidation'=>false,
                ));
            ?>
			<form class="form-horizontal" role="form">
				<div class="col-md-6 col-xs-12 col-sm-12">
					<div class="row" id="specialRow">
						<div class="col-md-12">
							<h5 style="float:left">
								<?php echo ucfirst(CrugeTranslator::t("datos de la cuenta"));?>
							</h5>
							<hr>
							<br>
						</div>
					</div>
					<div class="row" id="specialRow">
						<div class="col-md-12">
							<div class="form-group has-danger">
								<label class="" for="UserName">UserName</label>
								<div class="input-group mb-2 mr-sm-2 mb-sm-0">
									<div class="input-group-addon" style="width: 2.6rem">
										<i class="fa fa-user"></i>
									</div>
									<?php 
                                        $username=CrugeUtil::config()->availableAuthModes[0];
                                        echo $form->textField($model, $username, array('class'=>'form-control', 'id'=>'UserName','placeholder'=> 'Enter your UserName','required'=>'true'));
                                    ?>

								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-control-feedback">
								<span class="text-danger align-middle">
									<?php	
                                        echo $form->error($model, $username);
                                    ?>
								</span>
							</div>
						</div>
					</div>
					<div class="row" id="specialRow">
						<div class="col-md-12">
							<div class="form-group">
								<label class="" for="email">Email</label>
								<div class="input-group mb-2 mr-sm-2 mb-sm-0">
									<div class="input-group-addon" style="width: 2.6rem">
										<i class="fa fa-envelope-open"></i>
									</div>
									<?php 
                                        $email=CrugeUtil::config()->availableAuthModes[1];
                                        echo $form->textField($model, $email, array('class'=>'form-control', 'id'=>'email','type'=>'email','placeholder'=> 'Enter your email','required'=>'true'));
                                    ?>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-control-feedback">
								<span class="text-danger align-middle">
									<?php
                                    echo $form->error($model, $email);
                                ?>
								</span>
							</div>
						</div>
					</div>
					<div class="row" id="specialRow">
						<div class="col-md-12">
							<div class="form-group">
								<label class="" for="email">Password</label>
								<div class="input-group mb-2 mr-sm-2 mb-sm-0">
									<div class="input-group-addon" style="width: 2.6rem">
										<i class="fa fa-key"></i>
									</div>
									<?php 
                                        
                                            echo $form->textField($model, 'newPassword', array('class'=>'form-control', 'id'=>'newPassword','type'=>'password','placeholder'=> 'Enter your password','required'=>'true'));
                                        ?>
								</div>
								<p class='hint'>
									<?php echo CrugeTranslator::t(
                                    "su contraseña, letras o digitos o los caracteres @#$%. minimo 6 simbolos."
                                        );?>
								</p>
								<center>
									<?php echo CHtml::ajaxbutton(
                                        CrugeTranslator::t("Generar una nueva clave"),
                                        Yii::app()->user->ui->ajaxGenerateNewPasswordUrl,
                                        array('success'=>new CJavaScriptExpression('fnSuccess'),
                                        'error'=>new CJavaScriptExpression('fnError')),
                                        array('class'=>'btn btn-common')
                                    );
                                    ?>
								</center>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-control-feedback">
								<span class="text-danger align-middle">
									<?php
                                        echo $form->error($model, 'newPassword');
                                    ?>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-xs-12 col-sm-12">
					<?php 
                        if (count($model->getFields()) > 0) {
                            ?>
							<div class="row" id="specialRow">
								<div class="col-md-12">
									<h5 style="float:left">
										<?php echo ucfirst(CrugeTranslator::t("Perfil")); ?>
									</h5>
									<hr>
									<br>
								</div>
							</div>
					<?php
                         
                            foreach ($model->getFields() as $f) {
								// aqui $f es una instancia que implementa a: ICrugeField
								echo "<div class='row' id='specialRow'> ";
									echo "<div class='col-md-12'>";						
										echo "<div class='form-group has-danger'>";
											echo Yii::app()->user->um->getLabelField($f);											
											echo Yii::app()->user->um->getInputField($model, $f);														
										echo"</div>";
									echo"</div>";
									echo "<div class='col-md-12'>";	
										echo "<div class='form-control-feedback'>";
											echo "<span class='text-danger align-middle'>";																											
													echo $form->error($model, $f->fieldname);											
											echo "</span>";
										echo"</div>";
									echo"</div>";
								echo"</div>";
                            }
                        } else {
                            ?>
					<div class="row" id="specialRow">
						<div class="col-md-12">
							<h5 style="float:left">
									<?php echo ucfirst(CrugeTranslator::t("No Perfil Entry")); ?>
							</h5>
							<hr>
							<br>
						</div>
					</div>
					<?php
                        }
                    ?>		
				</div>
				<div class="col-md-12 col-xs-12 col-sm-12">
					<!-- inicio - terminos y condiciones -->
					<?php
						if(Yii::app()->user->um->getDefaultSystem()->getn('registerusingterms') == 1)
						{
					?>
						<div class='form-group-vert'>
							<h6>
								<?php echo ucfirst(CrugeTranslator::t("terminos y condiciones"));?>
							</h6>
							<?php echo CHtml::textArea('terms'
							,Yii::app()->user->um->getDefaultSystem()->get('terms')
							,array('readonly'=>'readonly','rows'=>5,'cols'=>'80%')
							); ?>
							<div>
								<span class='required'>*</span>
								<?php echo CrugeTranslator::t(Yii::app()->user->um->getDefaultSystem()->get('registerusingtermslabel')); ?>
							</div>
							<?php echo $form->checkBox($model,'terminosYCondiciones'); ?>
							<?php echo $form->error($model,'terminosYCondiciones'); ?>
						</div>
						<!-- fin - terminos y condiciones -->
						<?php } ?>
						<!-- inicio pide captcha -->
						<?php if(Yii::app()->user->um->getDefaultSystem()->getn('registerusingcaptcha') == 1) { ?>
						<div class='form-group-vert'>
							<h6>
								<?php echo ucfirst(CrugeTranslator::t("codigo de seguridad"));?>
							</h6>
							<div class="row">
								<div>
									<?php $this->widget('CCaptcha'); ?>
									<?php echo $form->textField($model,'verifyCode'); ?>
								</div>
								<div class="hint">
									<?php echo CrugeTranslator::t("por favor ingrese los caracteres o digitos que vea en la imagen");?>
								</div>
								<?php echo $form->error($model,'verifyCode'); ?>
							</div>
						</div>
						<?php } ?>
						<!-- fin pide captcha-->
					<hr>
					<center>
						<?php Yii::app()->user->ui->tbutton("Registrarse", array('class'=>'btn btn-common')); ?>
					</center>
					<div class="error">
						<?php echo $form->errorSummary($model); ?>
					</div>
					
				</div>
			</form>


			<?php $this->endWidget(); ?>
	</div>
</div>
<script type="text/javascript">
	function fnSuccess(data) {
		$('#CrugeStoredUser_newPassword').val(data);
	}
	function fnError(e) {
		alert("error: " + e.responseText);
	}
	$(document).ready(function(){
        $('.login_Style').insertAfter('.row-fluid');
        $('.row-fluid').hide();
    });
</script>