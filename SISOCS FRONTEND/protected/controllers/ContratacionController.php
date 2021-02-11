<?php
class ContratacionController extends Controller {

	/**
	 *
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 *      using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

	/**
	 *
	 * @return array action filters
	 */
	public function filters() {
		// return array(
		// 'accessControl', // perform access control for CRUD operations
		// 'postOnly + delete', // we only allow deletion via POST request
		// );
		return array (
				'accessControl',
				array (
					'CrugeAccessControlFilter'
				)
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 *
	 * @return array access control rules
	 */
	public function accessRules() {
		return array (
				array (
						'allow', // allow all users to perform 'index' and 'view' actions
						'actions' => array (
								'index',
								'view',
								'search'
						),
						'users' => array (
								'*'
						)
				),
				array (
						'allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions' => array (
								'admin',
								'create',
								'create3',
								'update',
								'profile',
								'ViewDocuments',
								'ViewMilestone',
								'ViewOrganizationDetails',
								'ViewSignatures',
								'ViewDebtEquityRatio',
								'ViewGovSupportGuarantee',
								'ViewPreferredBidders',
								'ViewRiskAllocation',
								'ViewShareCapital',
								'ViewActualIRR',
								'ViewAmendment',
								'ViewShareholders',
								'ViewLenderSuppliers',
								'ViewFinance',
								'ViewRelatedProcess'
						),
						'users' => array (
								'@'
						)
				),
				array (
						'allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions' => array (
								'delete',
								'profile'
						),
						'users' => array (
								'admin'
						)
				),
				array (
						'deny', // deny all users
						'users' => array (
								'*'
						)
				)
		);
	}

	/**
	 * Displays a particular model.
	 *
	 * @param integer $id
	 *        	the ID of the model to be displayed
	 */
	public function actionView($id) {

        $criteria = new CDbCriteria;
        $criteria->condition = "idContratacion = $id";

        $model = Contratacion::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(404, 'La página solicitada no existe o no tiene los permisos para verla.');

		$this->render ( 'view', array (
				'model' => $model
		) );
	}

	public function getEnlaceVacio($url, $href) {
		if (strlen ( $href ) > 10) {
			$enlace = $url;
		} else {
			$enlace = "No Aplica";
		}

		return $enlace;
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$model = new Contratacion ();

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation ( $model );

		if (isset ( $_POST ['Contratacion'] )) {
			$model->attributes = $_POST ['Contratacion'];

			if ($model->save ()) {
				try {
				    $sql = "SELECT DISTINCT a.idProyecto FROM cs_contratacion d JOIN cs_adjudicacion c ON d.idAdjudicacion = c.idAdjudicacion JOIN cs_calificacion b ON c.idCalificacion = b.idCalificacion JOIN cs_proyecto a ON a.idProyecto = b.idProyecto   WHERE d.idContratacion  =".$model->idContratacion;
				    $command=Yii::app()->db->createCommand($sql);
				    $tempId=$command->queryAll();
					Yii::app()->Controller->saveMongo($tempId[0]["idProyecto"]);
				} catch (Exception $e) {

				}
				$id = $model->idContratacion;
				$dir = Yii::app ()->Controller->GetPath ( 'webroot.adjuntos', 4, $id );

				/*
				 * print_r($_POST['Contratacion']);
				 * echo 'uno'; exit;
				 */

				/*
				 * if ($model->validate(array('image1'))) {
				 * echo 'dos';
				 * $image1 = CUploadedFile::getInstance($model, 'image1');
				 * echo 'tres';
				 * } else { $image1 = ''; }
				 * if ($model->validate(array('image2'))) {
				 * $image2 = CUploadedFile::getInstance($model, 'image2');
				 * } else { $image2 = ''; }
				 * if ($model->validate(array('image3'))) {
				 * $image3 = CUploadedFile::getInstance($model, 'image3');
				 * } else { $image3 = ''; }
				 * if ($model->validate(array('image4'))) {
				 * $image4 = CUploadedFile::getInstance($model, 'image4');
				 * } else { $image4 = ''; }
				 */

				$image1 = CUploadedFile::getInstance ( $model, 'image1' );
				$image2 = CUploadedFile::getInstance ( $model, 'image2' );
				$image3 = CUploadedFile::getInstance ( $model, 'image3' );
				$image4 = CUploadedFile::getInstance ( $model, 'image4' );

				if (strlen ( $image1 ) > 0) {
					if ($image1->saveAs ( $dir . '/' . $image1->getName () )) {
						$model->documentocontra = Yii::app ()->Controller->getURL ( $dir . '/' . $image1->getName () );
					}
				}
				if (strlen ( $image2 ) > 0) {
					if ($image2->saveAs ( $dir . '/' . $image2->getName () )) {
						$model->regante = Yii::app ()->Controller->getURL ( $dir . '/' . $image2->getName () );
					}
				}
				if (strlen ( $image3 ) > 0) {

					if ($image3->saveAs ( $dir . '/' . $image3->getName () )) {
						$model->espeplanos = Yii::app ()->Controller->getURL ( $dir . '/' . $image3->getName () );
					}
				}
				if (strlen ( $image4 ) > 0) {

					if ($image4->saveAs ( $dir . '/' . $image4->getName () )) {
						$model->otro = Yii::app ()->Controller->getURL ( $dir . '/' . $image4->getName () );
					}
				}

                                 $model->usuario_creacion=Yii::app()->user->id;
                                if($model->estado=="PUBLICADO"){
                                    $model->usuario_publicacion=Yii::app()->user->id;
                                    $model->fecha_publicacion=date("Y-m-d H:i:s");
                                } else {
                                    $model->usuario_publicacion=0;
                                }
				$model->usuario_creacion = Yii::app()->user->id;
				if ($model->estado=="PUBLICADO") {
					$model->usuario_publicacion = Yii::app()->user->id;
					$model->fecha_publicacion=date("Y-m-d H:i:s");
				}
				elseif($model->estado=="REVISIÓN"){
					$this->mandarCorreo(4,$model->idContratacion);
				}
				$model->save ();
			}

			//$this->mandarCorreo ( 4, $model->idContratacion );
			$this->redirect ( array (
					'view',
					'id' => $model->idContratacion
			) );
		}

		$this->render ( 'create', array (
				'model' => $model
		) );
	}


	public function actionCreate3($idCreate) {
		$model = new Contratacion ();

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation ( $model );

		if (isset ( $_POST ['Contratacion'] )) {
			$model->attributes = $_POST ['Contratacion'];
            if ($idCreate > 0) {
                $model->idAdjudicacion = $idCreate;
            }


			if ($model->save ()) {
				try {
				    $sql = "SELECT DISTINCT a.idProyecto FROM cs_contratacion d JOIN cs_adjudicacion c ON d.idAdjudicacion = c.idAdjudicacion JOIN cs_calificacion b ON c.idCalificacion = b.idCalificacion JOIN cs_proyecto a ON a.idProyecto = b.idProyecto   WHERE d.idContratacion  =".$model->idContratacion;
				    $command=Yii::app()->db->createCommand($sql);
				    $tempId=$command->queryAll();
					Yii::app()->Controller->saveMongo($tempId[0]["idProyecto"]);
				} catch (Exception $e) {

				}
				$id = $model->idContratacion;
				$dir = Yii::app ()->Controller->GetPath ( 'webroot.adjuntos', 4, $id );

				$image1 = CUploadedFile::getInstance ( $model, 'image1' );
				$image2 = CUploadedFile::getInstance ( $model, 'image2' );
				$image3 = CUploadedFile::getInstance ( $model, 'image3' );
				$image4 = CUploadedFile::getInstance ( $model, 'image4' );

				if (strlen ( $image1 ) > 0) {
					if ($image1->saveAs ( $dir . '/' . $image1->getName () )) {
						$model->documentocontra = Yii::app ()->Controller->getURL ( $dir . '/' . $image1->getName () );
					}
				}
				if (strlen ( $image2 ) > 0) {
					if ($image2->saveAs ( $dir . '/' . $image2->getName () )) {
						$model->regante = Yii::app ()->Controller->getURL ( $dir . '/' . $image2->getName () );
					}
				}
				if (strlen ( $image3 ) > 0) {

					if ($image3->saveAs ( $dir . '/' . $image3->getName () )) {
						$model->espeplanos = Yii::app ()->Controller->getURL ( $dir . '/' . $image3->getName () );
					}
				}
				if (strlen ( $image4 ) > 0) {

					if ($image4->saveAs ( $dir . '/' . $image4->getName () )) {
						$model->otro = Yii::app ()->Controller->getURL ( $dir . '/' . $image4->getName () );
					}
				}

                $model->usuario_creacion=Yii::app()->user->id;
                if($model->estado=="PUBLICADO"){
                    $model->usuario_publicacion=Yii::app()->user->id;
                    $model->fecha_publicacion=date("Y-m-d H:i:s");
                } else {
                    $model->usuario_publicacion=0;
                }

				$model->usuario_creacion = Yii::app()->user->id;
				if ($model->estado=="PUBLICADO") {
					$model->usuario_publicacion = Yii::app()->user->id;
					$model->fecha_publicacion=date("Y-m-d H:i:s");
				}
				elseif($model->estado=="REVISIÓN"){
					$this->mandarCorreo(4,$model->idContratacion);
				}
				$model->save ();
			}

			//$this->mandarCorreo ( 4, $model->idContratacion );
            if ($model->idContratacion > 0) {
                $this->redirect ( array (
                            'view',
                            'id' => $model->idContratacion
                    ) );
            }

		}

		$this->render( 'create', array (
				'model' => $model ,'idCreate'=>$idCreate
		) );
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *        	the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model = $this->loadModel ( $id );

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation ( $model );
		// $dir = Yii::getPathOfAlias('webroot.images');

		if (isset ( $_POST ['Contratacion'] )) {
			$model->attributes = $_POST ['Contratacion'];

			if ($model->save ()) {
				try {
				    $sql = "SELECT DISTINCT a.idProyecto FROM cs_contratacion d JOIN cs_adjudicacion c ON d.idAdjudicacion = c.idAdjudicacion JOIN cs_calificacion b ON c.idCalificacion = b.idCalificacion JOIN cs_proyecto a ON a.idProyecto = b.idProyecto   WHERE d.idContratacion  =".$model->idContratacion;
				    $command=Yii::app()->db->createCommand($sql);
				    $tempId=$command->queryAll();
					Yii::app()->Controller->saveMongo($tempId[0]["idProyecto"]);
				} catch (Exception $e) {

				}
				$id = $model->idContratacion;
				$dir = Yii::app ()->Controller->GetPath ( 'webroot.adjuntos', 4, $id );

				/*
				 * if ($model->validate(array('image1'))) {
				 * $image1 = CUploadedFile::getInstance($model, 'image1');
				 * } else { $image1 = ''; }
				 * if ($model->validate(array('image2'))) {
				 * $image2 = CUploadedFile::getInstance($model, 'image2');
				 * } else { $image2 = ''; }
				 * if ($model->validate(array('image3'))) {
				 * $image3 = CUploadedFile::getInstance($model, 'image3');
				 * } else { $image3 = ''; }
				 * if ($model->validate(array('image4'))) {
				 * $image4 = CUploadedFile::getInstance($model, 'image4');
				 * } else { $image4 = ''; }
				 */

				$image1 = CUploadedFile::getInstance ( $model, 'image1' );
				$image2 = CUploadedFile::getInstance ( $model, 'image2' );
				$image3 = CUploadedFile::getInstance ( $model, 'image3' );
				$image4 = CUploadedFile::getInstance ( $model, 'image4' );

				if (strlen ( $image1 ) > 0) {
					if ($image1->saveAs ( $dir . '/' . $image1->getName () )) {
						$model->documentocontra = Yii::app ()->Controller->getURL ( $dir . '/' . $image1->getName () );
					}
				}
				if (strlen ( $image2 ) > 0) {
					if ($image2->saveAs ( $dir . '/' . $image2->getName () )) {
						$model->regante = Yii::app ()->Controller->getURL ( $dir . '/' . $image2->getName () );
					}
				}
				if (strlen ( $image3 ) > 0) {

					if ($image3->saveAs ( $dir . '/' . $image3->getName () )) {
						$model->espeplanos = Yii::app ()->Controller->getURL ( $dir . '/' . $image3->getName () );
					}
				}
				if (strlen ( $image4 ) > 0) {
					if ($image4->saveAs ( $dir . '/' . $image4->getName () )) {
						$model->otro = Yii::app ()->Controller->getURL ( $dir . '/' . $image4->getName () );
					}
				}
				if($model->estado=="PUBLICADO"){
                                    $model->usuario_publicacion=Yii::app()->user->id;
                                    $model->fecha_publicacion=date("Y-m-d H:i:s");
                                } else {
                                    $model->usuario_publicacion=0;
                                }

				if ($model->estado=="PUBLICADO") {
					$model->usuario_publicacion = Yii::app()->user->id;
					$model->fecha_publicacion=date("Y-m-d H:i:s");
				}
				elseif($model->estado=="REVISIÓN"){
					$this->mandarCorreo(4,$model->idContratacion);
				}
				$model->save ();
			}
			//$this->mandarCorreo ( 4, $model->idContratacion );
			$this->redirect ( array (
					'view',
					'id' => $model->idContratacion
			) );
		}

		$this->render ( 'update', array (
				'model' => $model
		) );
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 *
	 * @param integer $id
	 *        	the ID of the model to be deleted
	 */
	public function actionDelete($id) {
		$this->loadModel ( $id )->delete ();

		try {
		   /* $sql = "SELECT DISTINCT a.idProyecto FROM cs_contratacion d JOIN cs_adjudicacion c ON d.idAdjudicacion = c.idAdjudicacion JOIN cs_calificacion b ON c.idCalificacion = b.idCalificacion JOIN cs_proyecto a ON a.idProyecto = b.idProyecto   WHERE d.idContratacion  =".$id;
		    $command=Yii::app()->db->createCommand($sql);
		    $tempId=$command->queryAll();
			Yii::app()->Controller->saveMongo($tempId[0]["idProyecto"]);*/
		} catch (Exception $e) {

		}
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (! isset ( $_GET ['ajax'] ))
			$this->redirect ( isset ( $_POST ['returnUrl'] ) ? $_POST ['returnUrl'] : array (
					'admin'
			) );
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex2() {
		if (! Yii::app ()->user->isGuest) {
			// $dataProvider=new CActiveDataProvider('Contratacion');
			$dataProvider = new CActiveDataProvider ( 'Contratacion', array (
					'criteria' => array (
							'condition' => 'estado !="PUBLICADO"'
					)
			) );
		} else {
			$dataProvider = new CActiveDataProvider ( 'Contratacion', array (
					'criteria' => array (
							'condition' => 'estado ="PUBLICADO"'
					)
			) );
		}
		$this->render ( 'index', array (
				'dataProvider' => $dataProvider
		) );
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex() {
        $model = new Contratacion('published');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Contratacion']))
            $model->attributes = $_GET['Contratacion'];
			$this->render('index', array(
				'model' => $model
			));

	}

	public function actionAdmin() {
		/*$model = new Contratacion('search');
		$model->unsetAttributes();
		if (isset($_GET ['Contratacion'])) $model->attributes = $_GET['Contratacion'];
		$records = Contratacion::model()->findAll();
		$this->render('admin', array(
				'model' => $model,
				'records'=>$records
		));*/
		$model = new Contratacion('search');
		$criteria = new CDbCriteria;

        if (!Yii::app()->user->isSuperAdmin) {
            $criteria->addSearchCondition('t.usuario_creacion', Yii::app()->user->id, true, 'AND');
            $criteria->addSearchCondition('t.estado', 'BORRADOR', true, 'AND');
            if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
                $criteria->addSearchCondition('t.estado', 'REVISIÓN', true, 'OR');
            }

        }
		$model->unsetAttributes(); // clear any default values
		//if (isset($_GET['Contratacion'])) $model->attributes = $_GET['Contratacion'];
		$records = Contratacion::model()->findAll($criteria);
		$this->render('admin', array(
			'model' => $model,
			'records2' => $records
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 *
	 * @param integer $id
	 *        	the ID of the model to be loaded
	 * @return Contratacion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id) {
		$criteria = new CDbCriteria;
		if (Yii::app()->user->isSuperAdmin) {
			$criteria->condition = "idContratacion = $id";
		} elseif (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
			$criteria->condition = "idContratacion = $id AND (estado = 'BORRADOR' OR estado = 'REVISION' OR estado = 'REVISÓN')";
		} else {
			$criteria->condition = "idContratacion = $id AND (estado = 'BORRADOR')";
		}

		$model = Contratacion::model ()->find($criteria);
		if ($model === null)
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 *
	 * @param Contratacion $model
	 *        	the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'contratacion-form') {
			echo CActiveForm::validate ( $model );
			Yii::app ()->end ();
		}
	}

	// Funciones para la impresion
	public function actionGenerateExcel() {
		$session = new CHttpSession ();
		$session->open ();

		if (isset ( $session ['Empleado_records'] )) {
			$model = $session ['Empleado_records'];
		} else
			$model = Contratacion::model ()->findAll ();
			// $model = Programa::model()->find('programa'=$model->programa');

		Yii::app ()->request->sendFile ( date ( 'YmdHis' ) . '.xls', $this->renderPartial ( 'excelReport', array (
				'model' => $model
		), true ) );
	}
	public function actionGeneratePdf() {
		$session = new CHttpSession ();
		$session->open ();
		// Yii::import('application.modules.admin.extensions.giiplus.bootstrap.*');
		// require_once('tcpdf/tcpdf.php');
		// require_once('tcpdf/config/lang/eng.php');

		$model = Contratacion::model ()->findAll ();

		$html = $this->renderPartial ( 'expenseGridtoReport', array (
				'model' => $model
		), true );

		$pdf = Yii::createComponent ( 'application.extensions.MPDF56.mpdf' );
		$pdf = new mPDF ();
		$pdf->WriteHTML ( $html );
		$nom = "Programia_" . date ( "d-m-Y" ) . ".pdf";
		$url = Yii::app ()->baseUrl . '/' . $nom;
		// $url=Yii::app()->basePath."/images/".$nom;
		$pdf->Output ( $nom, "F" );
		echo '<a href=' . $url . '>Descargar Reporte </a>';
		Yii::app ()->end ();
	}

	public function actionViewDocuments($id, $event)
    {

        $md = new ContractDocuments();
        $md->unsetAttributes();
        $md->idContratacion = $id;
        $mf = ContractDocuments::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idContratacion=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderpartial('_filas', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }
    public function actionViewMilestone($id, $event)
    {

        $md = new ContractsMilestone();
        $md->unsetAttributes();
        $md->idContratacion = $id;
        $mf = ContractsMilestone::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idContratacion=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderpartial('_filasMilestone', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }
    public function actionViewOrganizationDetails($id, $event)
    {

        $md = new ContractsOrganizationDetails();
        $md->unsetAttributes();
        $md->idContratacion = $id;
        $mf = ContractsOrganizationDetails::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idContratacion=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderpartial('_filasOrganizationDetails', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }
    public function actionViewSignatures($id, $event)
    {

        $md = new ContractsSignatories();
        $md->unsetAttributes();
        $md->idContratacion = $id;
        $mf = ContractsSignatories::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idContratacion=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderpartial('_filasSignatures', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }
    public function actionViewDebtEquityRatio($id, $event)
    {

        $md = new DebtEquityRatio();
        $md->unsetAttributes();
        $md->idContratacion = $id;
        $mf = DebtEquityRatio::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idContratacion=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderpartial('_filasDebtEquityRatio', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }
    public function actionViewGovSupportGuarantee($id, $event)
    {

        $md = new GovSupportGuarantee();
        $md->unsetAttributes();
        $md->idContratacion = $id;
        $mf = GovSupportGuarantee::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idContratacion=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderpartial('_filasGovSupportGuarantee', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }
    public function actionViewPreferredBidders($id, $event)
    {

        $md = new PreferredBidders();
        $md->unsetAttributes();
        $md->idContratacion = $id;
        $mf = PreferredBidders::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idContratacion=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderpartial('_filasPreferredBidders', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }
    public function actionViewRiskAllocation($id, $event)
    {

        $md = new RiskAllocation();
        $md->unsetAttributes();
        $md->idContratacion = $id;
        $mf = RiskAllocation::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idContratacion=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderpartial('_filasRiskAllocation', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }
    public function actionViewShareCapital($id, $event)
    {

        $md = new ShareCapital();
        $md->unsetAttributes();
        $md->idContratacion = $id;
        $mf = ShareCapital::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idContratacion=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderpartial('_filasShareCapital', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }
    public function actionViewActualIRR($id, $event)
    {

        $md = new ActualIrr();
        $md->unsetAttributes();
        $md->idContratacion = $id;
        $mf = ActualIrr::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idContratacion=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderpartial('_filasActualIRR', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }
    public function actionViewAmendment($id, $event)
    {

        $md = new Amendment();
        $md->unsetAttributes();
        $md->idContratacion = $id;
        $mf = Amendment::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idContratacion=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderpartial('_filasamendment', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }
    public function actionViewShareholders($id, $event)
    {

        $md = new Shareholders();
        $md->unsetAttributes();
        $md->idContratacion = $id;
        $mf = Shareholders::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idContratacion=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderpartial('_filasshareholders', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }
    public function actionViewLenderSuppliers($id, $event)
    {

        $md = new LendersSuppliers();
        $md->unsetAttributes();
        $md->idContratacion = $id;
        $mf = LendersSuppliers::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idContratacion=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderpartial('_filaslendersupplier', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
    }
	public function actionViewFinance($id, $event)
    {

        $md = new Finance();
        $md->unsetAttributes();
        $md->idContratacion = $id;
        $mf = Finance::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idContratacion=:id',
            'params' => array(
                ':id' => $id
            )
        ));
        $this->renderpartial('_filasfinance', array(
            'datos' => $mf,
            'evento' => $event,
            'model' => $md
        ),false,true);
	}
	
	public function actionViewRelatedProcess($id, $event)
    {
        $sql     = 'SELECT rp.id, p.nombre_proyecto as idProyecto FROM cs_related_process rp JOIN cs_proyecto p ON rp.idProyecto = p.idProyecto where rp.idContratacion = ' . $id;
        $command = Yii::app()->db->createCommand($sql);
        $mf      = $command->queryAll();
        $this->renderpartial('_filasRelated', array(
            'datos' => $mf,
			'evento' => $event
		),false,true);
	
    }
}
