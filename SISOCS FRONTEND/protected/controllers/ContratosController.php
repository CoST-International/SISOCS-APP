<?php
class ContratosController extends Controller {

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
								'GeneratePdf',
								'GenerateExcel',
								'ViewDocuments'
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
								'view',
								'ViewDocumentsDetails'
						),
						'users' => array (
								'@'
						)
				),
				array (
						'allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions' => array (
								'delete'
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
		$this->render ( 'view', array (
				'model' => $this->loadModel ( $id )
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
		$model = new Contratos ();

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation ( $model );

		if (isset ( $_POST ['Contratos'] )) {
			$model->attributes = $_POST ['Contratos'];
			if (!$model->fechatercontra) {
				$model->fechatercontra=null;
			}
			if ($model->save ()) {
				$id = $model->idContratos;
				$dir = Yii::app ()->Controller->GetPath ( 'webroot.adjuntos', 5, $id );

				$image1 = CUploadedFile::getInstance ( $model, 'image1' );
				$image2 = CUploadedFile::getInstance ( $model, 'image2' );
				$image3 = CUploadedFile::getInstance ( $model, 'image3' );
				$image4 = CUploadedFile::getInstance ( $model, 'image4' );

				if (strlen ( $image1 ) > 0) {
					if ($image1->saveAs ( $dir . '/' . $image1->getName () )) {
						$model->adendas = Yii::app ()->Controller->getURL ( $dir . '/' . $image1->getName () );
					}
				}
				if (strlen ( $image2 ) > 0) {
					if ($image2->saveAs ( $dir . '/' . $image2->getName () )) {
						$model->prograactu = Yii::app ()->Controller->getURL ( $dir . '/' . $image2->getName () );
					}
				}
				if (strlen ( $image3 ) > 0) {

					if ($image3->saveAs ( $dir . '/' . $image3->getName () )) {
						$model->otro = Yii::app ()->Controller->getURL ( $dir . '/' . $image3->getName () );
					}
				}
				if (strlen ( $image4 ) > 0) {

					if ($image4->saveAs ( $dir . '/' . $image4->getName () )) {
						$model->prograini = Yii::app ()->Controller->getURL ( $dir . '/' . $image4->getName () );
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
					$this->mandarCorreo(5,$model->idContratos);
				}

				$model->save ();

                $this->mandarCorreo(5, $model->idContratos);
                    $this->redirect(array(
                    'update',
                     'id' => $model->idContratos
                     ));
			}

                        /*
			$this->mandarCorreo (5, $model->idContratos);
			$this->redirect ( array (
					'view',
					'id' => $model->idContratos
			) );*/


		}


		$this->render ( 'create', array (
				'model' => $model
		) );
	}


	public function actionCreate3($idCreate) {
		$model = new Contratos ();

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation ( $model );

		if (isset ( $_POST ['Contratos'] )) {
			$model->attributes = $_POST ['Contratos'];
			if (!$model->fechatercontra) {
				$model->fechatercontra=null;
			}
			if ($model->save ()) {
				$id = $model->idContratos;
				$dir = Yii::app ()->Controller->GetPath ( 'webroot.adjuntos', 5, $id );

				$image1 = CUploadedFile::getInstance ( $model, 'image1' );
				$image2 = CUploadedFile::getInstance ( $model, 'image2' );
				$image3 = CUploadedFile::getInstance ( $model, 'image3' );
				$image4 = CUploadedFile::getInstance ( $model, 'image4' );

				if (strlen ( $image1 ) > 0) {
					if ($image1->saveAs ( $dir . '/' . $image1->getName () )) {
						$model->adendas = Yii::app ()->Controller->getURL ( $dir . '/' . $image1->getName () );
					}
				}
				if (strlen ( $image2 ) > 0) {
					if ($image2->saveAs ( $dir . '/' . $image2->getName () )) {
						$model->prograactu = Yii::app ()->Controller->getURL ( $dir . '/' . $image2->getName () );
					}
				}
				if (strlen ( $image3 ) > 0) {

					if ($image3->saveAs ( $dir . '/' . $image3->getName () )) {
						$model->otro = Yii::app ()->Controller->getURL ( $dir . '/' . $image3->getName () );
					}
				}
				if (strlen ( $image4 ) > 0) {

					if ($image4->saveAs ( $dir . '/' . $image4->getName () )) {
						$model->prograini = Yii::app ()->Controller->getURL ( $dir . '/' . $image4->getName () );
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
					$this->mandarCorreo(5,$model->idContratos);
				}

				$model->save ();

                $this->mandarCorreo(5, $model->idContratos);
                $this->redirect(array(
                'update',
                 'id' => $model->idContratos
                 ));
			}

                        /*
			$this->mandarCorreo (5, $model->idContratos);
			$this->redirect ( array (
					'view',
					'id' => $model->idContratos
			) );*/


		}


		$this->render ( 'create', array (
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

		if (isset ( $_POST ['Contratos'] )) {
			$model->attributes = $_POST ['Contratos'];
			if (!$model->fechatercontra) {
				$model->fechatercontra=null;
			}
			if ($model->save ()) {
				$id = $model->idContratos;
				$dir = Yii::app ()->Controller->GetPath ( 'webroot.adjuntos', 5, $id );

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
						$model->adendas = Yii::app ()->Controller->getURL ( $dir . '/' . $image1->getName () );
					}
				}
				if (strlen ( $image2 ) > 0) {
					if ($image2->saveAs ( $dir . '/' . $image2->getName () )) {
						$model->prograactu = Yii::app ()->Controller->getURL ( $dir . '/' . $image2->getName () );
					}
				}
				if (strlen ( $image3 ) > 0) {

					if ($image3->saveAs ( $dir . '/' . $image3->getName () )) {
						$model->otro = Yii::app ()->Controller->getURL ( $dir . '/' . $image3->getName () );
					}
				}
				if (strlen ( $image4 ) > 0) {

					if ($image4->saveAs ( $dir . '/' . $image4->getName () )) {
						$model->prograini = Yii::app ()->Controller->getURL ( $dir . '/' . $image4->getName () );
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
					$this->mandarCorreo(5,$model->idContratos);
				}
				$model->save ();
			}
			//$this->mandarCorreo ( 5, $model->idContratos );
			$this->redirect ( array (
					'view',
					'id' => $model->idContratos
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
			// $dataProvider=new CActiveDataProvider('Contratos');
			$dataProvider = new CActiveDataProvider ( 'Contratos', array (
					'criteria' => array (
							'condition' => 'estado !="PUBLICADO"'
					),
					'pagination'=>false,
			) );
		} else {
			$dataProvider = new CActiveDataProvider ( 'Contratos', array (
					'criteria' => array (
							'condition' => 'estado ="PUBLICADO"'
					),
					'pagination'=>false,
			) );
		}
		$this->render ( 'index', array (
				'dataProvider' => $dataProvider
		) );
	}

	public function actionViewDocumentsDetails($id, $event)
    {

        $md = new ContratosDocuments();
        $md->unsetAttributes();
        $md->idContrato = $id;
        $mf = ContratosDocuments::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idContrato=:id',
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

	/**
	 * Manages all models.
	 */
	public function actionIndex() {
		$dataProvider = new CActiveDataProvider ( 'Contratos' ,array('pagination'=>false,));
		$this->render ( 'index', array (
				'dataProvider' => $dataProvider,

		) );
	}
	public function actionAdmin() {
		$model = new Contratos ( 'search' );
		$criteria = new CDbCriteria;

        if (!Yii::app()->user->isSuperAdmin) {
            $criteria->addSearchCondition('t.usuario_creacion', Yii::app()->user->id, true, 'AND');
            $criteria->addSearchCondition('t.estado', 'BORRADOR', true, 'AND');
            if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
                $criteria->addSearchCondition('t.estado', 'REVISIÓN', true, 'OR');
            }

        }
		$model->unsetAttributes (); // clear any default values
		if (isset ( $_GET ['Contratos'] ))
			$model->attributes = $_GET ['Contratos'];

		$records = Contratos::model ()->findAll ($criteria);

		$this->render ( 'admin', array (
				'model' => $model,
				'records2'=>$records,
		) );
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 *
	 * @param integer $id
	 *        	the ID of the model to be loaded
	 * @return Contratos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id) {
		$criteria = new CDbCriteria;
		if (Yii::app()->user->isSuperAdmin) {
			$criteria->condition = "idContratos = $id";
		} elseif (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
			$criteria->condition = "idContratos = $id AND (estado = 'BORRADOR' OR estado = 'REVISION' OR estado = 'REVISÓN')";
		} else {
			$criteria->condition = "idContratos = $id AND (estado = 'BORRADOR')";
		}

		$model = Contratos::model()->find ( $criteria );
		if ($model === null)
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 *
	 * @param Contratos $model
	 *        	the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'contratos-form') {
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
			$model = Contratos::model ()->findAll ();
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

		$model = Contratos::model ()->findAll ();

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
}
