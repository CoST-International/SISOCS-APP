<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

    public function actionMobile()
	{
		echo 'Mobile Page';
	}

    public function actionIndex2()
	{
		echo 'Mobile Page';
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		if (Yii::app()->user->isGuest)
		  $this->render('index');
        else
            $this->redirect(Yii::app()->createUrl('site/ws'));
	}


    /**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionWorkspace()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//enviando los datos de los programas y filtando los datos


		$this->render('workspace');
	}

    public function actionWs()
	{
        $proyecto = null;
        $calificacion = null;
        $adjudicacion = null;
        $contratacion = null;
        $inicio_ejecucion = null;
        $gestion_contratos = null;
        $avances = null;
        $uid = Yii::app()->user->id;
        $mensajes = array();
        $mensajes['id'] = $uid;
        $mensajes['Proyectos'] = Yii::app()->user->isInRole(Yii::app()->user->id, 'Proyectos');
        $mensajes['Publicador'] = Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador');

		//------------------------------------- PROYECTOS
        if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Proyectos')) { //rol=Proyectos
            $criterio = 'false';
            if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
                $criterio = "estado='REVISIÓN'";
            } else {
                $criterio = "estado='BORRADOR' AND usuario_creacion = $uid";
            }

            $rawData = Proyecto::model()->findAll($criterio);
            $count = count($rawData);

            $proyecto = new CArrayDataProvider($rawData, array(
                        'keyField' => 'idProyecto',
                        'totalItemCount' => $count,

                        'sort' => array(
                            'attributes' => array(
                                'idProyecto',
                                'codigo',
                                'nombre_proyecto',
                                'fecha_creacion'
                            ),
                            'defaultOrder' => array(
                                'idProyecto' => CSort::SORT_ASC,
                            ),
                        ),
                        'pagination' => array(
                            'pageSize' => 10,
                        ),
                    ));
            $mensajes['count-proyectos'] = $count;
            $mensajes['Criterio'] = $criterio;

        }

        //------------------------------------- CALIFICACION
        if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Adquisiciones')) { //  rol=Calificacion
            $criterio = 'false';
            if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
                $criterio = "estado='REVISIÓN'";
            } else {
                $criterio = "estado='BORRADOR' AND usuario_creacion = $uid";
            }

            $mensajes['criterio'] = $criterio;

            $rawData = Calificacion::model()->findAll($criterio);
            $count = count($rawData);

            $calificacion = new CArrayDataProvider($rawData, array(
                        'keyField' => 'idCalificacion',
                        'totalItemCount' => $count,

                        'sort' => array(
                            'attributes' => array(
                                'idCalificacion',
                                'numproceso',
                                'nomprocesoproyecto',
                                'fecha_creacion'
                            ),
                            'defaultOrder' => array(
                                'idCalificacion' => CSort::SORT_ASC,
                            ),
                        ),
                        'pagination' => array(
                            'pageSize' => 10,
                        ),
                    ));

        }

        //------------------------------------- ADJUDICACION
        if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Adjudicaciones')) { // rol=Adjudicacion
            $criterio = 'false';
            if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
                $criterio = "estado='REVISIÓN'";
            } else {
                $criterio = "estado='BORRADOR' AND usuario_creacion = $uid";
            }

            $rawData = Adjudicacion::model()->findAll($criterio);
            $count = count($rawData);

            $adjudicacion = new CArrayDataProvider($rawData, array(
                        'keyField' => 'idAdjudicacion',
                        'totalItemCount' => $count,

                        'sort' => array(
                            'attributes' => array(
                                'idAdjudicacion',
                                'numproceso',
                                'nomprocesoproyecto',
                                'nconsulnac',
                                'nconsulinter',
                                'fecha_creacion'
                            ),
                            'defaultOrder' => array(
                                'idAdjudicacion' => CSort::SORT_ASC,
                            ),
                        ),
                        'pagination' => array(
                            'pageSize' => 10,
                        ),
                    ));

        }

        //------------------------------------- CONTRATACION
        if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Adquisiciones')) { // rol=Contratacion
            $criterio = 'false';
            if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
                $criterio = "estado='REVISIÓN'";
            } else {
                $criterio = "estado='BORRADOR' AND usuario_creacion = $uid";
            }

            $rawData = Contratacion::model()->findAll($criterio);
            $count = count($rawData);

            $contratacion = new CArrayDataProvider($rawData, array(
                        'keyField' => 'idContratacion',
                        'totalItemCount' => $count,

                        'sort' => array(
                            'attributes' => array(
                                'idContratacion',
                                'titulocontrato',
                                'precio',
                                'fechainicio',
                                'fechafinal',
                            ),
                            'defaultOrder' => array(
                                'idContratacion' => CSort::SORT_ASC,
                            ),
                        ),
                        'pagination' => array(
                            'pageSize' => 10,
                        ),
                    ));

        }


        //------------------------------------- INICIO DE EJECUCION
        if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Avances')) { // rol=Avances
            $criterio = 'false';
            if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
                $criterio = "estado='REVISIÓN'";
            } else {
                $criterio = "estado='BORRADOR' AND usuario_creacion = $uid";
            }

            $rawData = InicioEjecucion::model()->findAll($criterio);
            $count = count($rawData);

            $inicio_ejecucion = new CArrayDataProvider($rawData, array(
                        'keyField' => 'idInicioEjecucion',
                        'totalItemCount' => $count,

                        'sort' => array(
                            'attributes' => array(
                                'idInicioEjecucion',
                                'idContratacion0.titulocontrato',
                                'idContacto0.Nombres',
                                'fecha_inicio'
                            ),
                            'defaultOrder' => array(
                                'idContratacion' => CSort::SORT_ASC,
                            ),
                        ),
                        'pagination' => array(
                            'pageSize' => 10,
                        ),
                    ));

        }

        //------------------------------------- GESTION DE CONTRATOS
        if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Avances')) { // rol=Avances
            $criterio = 'false';
            if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
                $criterio = "estado='REVISIÓN'";
            } else {
                $criterio = "estado='BORRADOR' AND usuario_creacion = $uid";
            }

            $rawData = Contratos::model()->findAll($criterio);
            $count = count($rawData);

            $gestion_contratos = new CArrayDataProvider($rawData, array(
                        'keyField' => 'idContratos',
                        'totalItemCount' => $count,

                        'sort' => array(
                            'attributes' => array(
                                'idContratos',
                                'idContratacion0.titulocontrato',
                                'nmodifica',
                                'tipomodifica',
                                'fecha'
                            ),
                            'defaultOrder' => array(
                                'idContratacion' => CSort::SORT_ASC,
                            ),
                        ),
                        'pagination' => array(
                            'pageSize' => 10,
                        ),
                    ));

        }

        //------------------------------------- AVANCES
        if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Avances')) { // rol=Avances
            $criterio = 'false';
            if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
                $criterio = "estado='REVISIÓN'";
            } else {
                $criterio = "estado='BORRADOR' AND usuario_creacion = $uid";
            }

            $rawData = Avances::model()->findAll($criterio);
            $count = count($rawData);

            $avances = new CArrayDataProvider($rawData, array(
                        'keyField' => 'idAvances',
                        'totalItemCount' => $count,

                        'sort' => array(
                            'attributes' => array(
                                'idAvances',
                                'finan_programado',
                                'finan_real',
                                'fecha_avance'
                            ),
                            'defaultOrder' => array(
                                'idContratacion' => CSort::SORT_ASC,
                            ),
                        ),
                        'pagination' => array(
                            'pageSize' => 10,
                        ),
                    ));

        }


        $this->render('ws', array(
                'proyecto' => $proyecto,
                'calificacion' => $calificacion,
                'adjudicacion' => $adjudicacion,
                'contratacion' => $contratacion,
                'inicio_ejecucion' => $inicio_ejecucion,
                'gestion_contratos' => $gestion_contratos,
                'avances' => $avances,
                'mensajes' => $mensajes
            ));

	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

//        public function filters()
//	{
//            return array(array('CrugeAccessControlFilter'));
//            }
}
