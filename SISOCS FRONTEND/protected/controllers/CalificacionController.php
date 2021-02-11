<?php

class CalificacionController extends Controller {

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
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete'
                ) // we only allow deletion via POST request
        ;
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     *
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array(
                    'index',
                    'view'
                ),
                'users' => array(
                    '*'
                )
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'create',
					'create3',
                    'update',
                    'getEnlaceVacio',
                    'FuncionarioDetalle',
                    'SelectUnidad',
                    'calificacionOferente',
                    'ViewDetOferentes',
                    'DeleteFuenteGet',
                    'ViewDocuments'
                ),
                'users' => array(
                    '@'
                )
            ),
            array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array(
                    'admin',
                    'delete'
                ),
                'users' => array(
                    'admin', '@',
                )
            ),
            array(
                'deny', // deny all users
                'users' => array(
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
		$criteria->condition = "idCalificacion = $id";

		$model = Calificacion::model()->find($criteria);
		if ($model === null)
			throw new CHttpException(404, 'La página solicitada no existe o no tiene los permisos para acceder a ella.');

		$this->render('view', array(
            'model' => $model
        ));

    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
     protected function afterSave()
{
     parent::afterSave();
   echo $this->id;
}
    public function actionCreate() {
        $model = new Calificacion();

        $this->performAjaxValidation($model);

        if (isset($_POST ['Calificacion'])) {
            //$model->unsetAttributes();
            $model->attributes = $_POST ['Calificacion'];
			if (!$model->contract_startDate) {
				$model->contract_startDate=null;
			}
			if (!$model->contract_endDate) {
				$model->contract_endDate=null;
			}
			if (!$model->contract_startDate) {
				$model->contract_startDate=null;
			}
			if (!$model->contract_maxExtentDate) {
				$model->contract_maxExtentDate=null;
			}

			if (!$model->award_startDate) {
				$model->award_startDate=null;
			}
			if (!$model->award_endDate) {
				$model->award_endDate=null;
			}
			if (!$model->award_maxExtentDate) {
				$model->award_maxExtentDate=null;
			}

			if (!$model->enquiry_startDate) {
				$model->enquiry_startDate=null;
			}
			if (!$model->enquiry_endDate) {
				$model->enquiry_endDate=null;
			}
			if (!$model->enquiry_maxExtentDate) {
				$model->enquiry_maxExtentDate=null;
			}

			if (!$model->tender_startDate) {
				$model->tender_startDate=null;
			}
			if (!$model->tender_endDate) {
				$model->tender_endDate=null;
			}
			if (!$model->tender_maxExtentDate) {
				$model->tender_maxExtentDate=null;
			}
            if($model->save()){

              $product = Yii::app()->db->createCommand("SELECT MAX(idCalificacion) idCalificacion FROM cs_calificacion")->queryRow();
              $id=$product['idCalificacion'];
                if ($model->estado=="BORRADOR" || $model->estado=="REVISIÓN") {
                  $model->usuario_creacion = Yii::app()->user->id;

                }else {
                  $model->usuario_publicacion = Yii::app()->user->id;
                  $mdoel->fecha_publicacion=date("Y/m/d");
                }
				$model->usuario_creacion = Yii::app()->user->id;
				if ($model->estado=="PUBLICADO") {
					$model->usuario_publicacion = Yii::app()->user->id;
					$model->fecha_publicacion=date("Y-m-d H:i:s");
				}
				elseif($model->estado=="REVISIÓN"){
					$this->mandarCorreo(2,$id);
				}
                $model->save();
                //$product = Yii::app()->db->createCommand("SELECT MAX(idCalificacion) idCalificacion FROM cs_calificacion")->queryRow();
                //$id=$product['idCalificacion'];
                $this->redirect(array(
                    'update',
                    'id' => $id
                )); // view
          }
            /*$criteria2 = new CDbCriteria();
              $criteria2->select = 'idCalificacion';
              $criteria2->order  = 'idCalificacion DESC';
              $criteria2->limit = 1;
              $product2 = Calificacion::model()->find($criteria2);
              // id of last row
              $lastId2 = $product->idCalificacion;
              $ulid2=$lastId;*/
                //guardar usuario que publico el articulo

                //$this->mandarCorreo(2, $model->idCalificacion);


          }

        $this->render('create', array(
            'model' => $model
        ));
    }

	public function actionCreate3($idCreate) {

        $model = new Calificacion ();

        $this->performAjaxValidation($model);

        if (isset($_POST ['Calificacion'])) {


            $model->attributes = $_POST ['Calificacion'];
			if (!$model->contract_startDate) {
				$model->contract_startDate=null;
			}
			if (!$model->contract_endDate) {
				$model->contract_endDate=null;
			}
			if (!$model->contract_startDate) {
				$model->contract_startDate=null;
			}
			if (!$model->contract_maxExtentDate) {
				$model->contract_maxExtentDate=null;
			}

			if (!$model->award_startDate) {
				$model->award_startDate=null;
			}
			if (!$model->award_endDate) {
				$model->award_endDate=null;
			}
			if (!$model->award_maxExtentDate) {
				$model->award_maxExtentDate=null;
			}

			if (!$model->enquiry_startDate) {
				$model->enquiry_startDate=null;
			}
			if (!$model->enquiry_endDate) {
				$model->enquiry_endDate=null;
			}
			if (!$model->enquiry_maxExtentDate) {
				$model->enquiry_maxExtentDate=null;
			}

			if (!$model->tender_startDate) {
				$model->tender_startDate=null;
			}
			if (!$model->tender_endDate) {
				$model->tender_endDate=null;
			}
			if (!$model->tender_maxExtentDate) {
				$model->tender_maxExtentDate=null;
			}
            $model->usuario_creacion = Yii::app()->user->id;
            //$model->estado = 'BORRADOR';
            $product = Yii::app()->db->createCommand("SELECT MAX(idCalificacion) idCalificacion FROM cs_calificacion")->queryRow();
			$id=$product['idCalificacion'];

			$model->usuario_creacion = Yii::app()->user->id;

            $model->save();
            $product = Yii::app()->db->createCommand("SELECT MAX(idCalificacion) idCalificacion FROM cs_calificacion")->queryRow();
			$id=$product['idCalificacion'];
            $ulid2=$id;
			if ($model->estado=="PUBLICADO") {
				$model->usuario_publicacion = Yii::app()->user->id;
				$model->fecha_publicacion=date("Y-m-d H:i:s");
			}
			elseif($model->estado=="REVISIÓN"){
				$this->mandarCorreo(2,$ulid2);
			}
                //guardar usuario que publico el articulo

                //$this->mandarCorreo(2, $model->idCalificacion);
                $this->redirect(array(
                    'update',
                    'id' => $ulid2
                )); // view
            }


        $this->render('create', array(
            'model' => $model,'idCreate'=>$idCreate
        ));
    }
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *        	the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model);

        if (isset($_POST ['Calificacion'])) {

            $model->attributes = $_POST ['Calificacion'];
			if (!$model->contract_startDate) {
				$model->contract_startDate=null;
			}
			if (!$model->contract_endDate) {
				$model->contract_endDate=null;
			}
			if (!$model->contract_startDate) {
				$model->contract_startDate=null;
			}
			if (!$model->contract_maxExtentDate) {
				$model->contract_maxExtentDate=null;
			}

			if (!$model->award_startDate) {
				$model->award_startDate=null;
			}
			if (!$model->award_endDate) {
				$model->award_endDate=null;
			}
			if (!$model->award_maxExtentDate) {
				$model->award_maxExtentDate=null;
			}

			if (!$model->enquiry_startDate) {
				$model->enquiry_startDate=null;
			}
			if (!$model->enquiry_endDate) {
				$model->enquiry_endDate=null;
			}
			if (!$model->enquiry_maxExtentDate) {
				$model->enquiry_maxExtentDate=null;
			}

			if (!$model->tender_startDate) {
				$model->tender_startDate=null;
			}
			if (!$model->tender_endDate) {
				$model->tender_endDate=null;
			}
			if (!$model->tender_maxExtentDate) {
				$model->tender_maxExtentDate=null;
			}


            if ($model->save()) {

                $id = $model->idCalificacion;

                if($model->estado=="PUBLICADO"){
                    $model->usuario_publicacion=Yii::app()->user->id;
                    $model->fecha_publicacion=date("Y-m-d H:i:s");
                    Yii::app()->db->createCommand()->update(
          							'cs_calificacion_oferente',
          							array('estado'=>$model->estado,
          							'fecha_publicacion'=>$model->fecha_publicacion,
          							'usuario_publicacion'=>$model->usuario_publicacion),
          							'idCalificacion=:id',
          							array(':id'=>$model->idCalificacion)
          					);

                } else {
                    $model->usuario_publicacion=0;
                    Yii::app()->db->createCommand()->update(
          							'cs_calificacion_oferente',
          							array('estado'=>$model->estado,
          							'fecha_creacion'=>$model->fecha_creacion,
          							'usuario_creacion'=>$model->usuario_creacion),
          							'idCalificacion=:id',
          							array(':id'=>$model->idCalificacion)
          					);

                }


				if ($model->estado=="PUBLICADO") {
					$model->usuario_publicacion = Yii::app()->user->id;
					$model->fecha_publicacion=date("Y-m-d H:i:s");
				}
				elseif($model->estado=="REVISIÓN"){
					$this->mandarCorreo(2,$model->idCalificacion);
				}
                $model->save();
                //$this->mandarCorreo(2, $model->idCalificacion);
				// try{
				// 	$this->mandarCorreo(2, $model->idCalificacion);
				// }catch(Exception $e){
                //
				// }

                $this->redirect(array(
                    'view',
                    'id' => $model->idCalificacion
                )); // view
            }
        }

        $this->render('update', array(
            'model' => $model
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id
     *        	the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET ['ajax']))
            $this->redirect(isset($_POST ['returnUrl']) ? $_POST ['returnUrl'] : array(
                        'admin'
                    ) );
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new Calificacion('published',array('pagination'=>false));
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET ['Calificacion']))
            $model->attributes = $_GET ['Calificacion'];

        $this->render('index', array(
            'model' => $model
        ));
    }



    /**
     * Manages all models.
     */
    public function actionAdmin() {

        $model = new Calificacion('search',array('pagination'=>false));
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET ['Calificacion']))
            $model->attributes = $_GET ['Calificacion'];

        $this->render('admin', array(
            'model' => $model
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param integer $id
     *        	the ID of the model to be loaded
     * @return Calificacion the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
      $criteria = new CDbCriteria;
      if (Yii::app()->user->isSuperAdmin) {
        $criteria->condition = "idCalificacion = $id";
      } elseif (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
        $criteria->condition = "idCalificacion = $id AND (estado = 'BORRADOR' OR estado = 'REVISION' OR estado = 'REVISÓN')";
      } else {
        $criteria->condition = "idCalificacion = $id AND (estado = 'BORRADOR')";
      }

      $model = Calificacion::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(404, 'La página solicitada no existe o no tiene los privilegios para verla.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     *
     * @param Calificacion $model
     *        	the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST ['ajax']) && $_POST ['ajax'] === 'calificacion-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * *******************************************************************
     */
    /**
     * ************** CUSTOM FUNCTIONS / ACTIONS *************************
     */

    /**
     * *******************************************************************
     */
    public function getEnlaceVacio($url, $href) {
        if (strlen($href) > 10) {
            $enlace = $url;
        } else {
            $enlace = "No Aplica";
        }

        return $enlace;
    }

    public function actionGeneratePdf() {
        $session = new CHttpSession ();
        $session->open();

        $model = Calificacion::model()->findAll();

        $html = $this->renderPartial('expenseGridtoReport', array(
            'model' => $model
                ), true);

        $pdf = Yii::createComponent('application.extensions.MPDF56.mpdf');
        $pdf = new mPDF ();
        $pdf->WriteHTML($html);
        $nom = "PDF_" . date("d-m-Y") . ".pdf";
        $url = Yii::app()->baseUrl . '/' . $nom;
        $pdf->Output($nom, "F");
        echo '<a href=' . $url . '>Descargar Reporte </a>';
        Yii::app()->end();
    }

    public function actionGenerateExcel() {
        $session = new CHttpSession ();
        $session->open();

        if (isset($session ['Empleado_records'])) {
            $model = $session ['Empleado_records'];
        } else
            $model = Calificacion::model()->findAll();
        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('excelReport', array(
                    'model' => $model
                        ), true));
    }

    public function actionFuncionarioDetalle($id) {
        $model = Funcionarios::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        else
            $this->renderPartial('detalleFuncionario', array(
                'model' => $model,
                'id' => $id
                    ), false);
    }

    public function actionSelectUnidad(){
                    $id_uno = $_POST['Calificacion']['idEnte'];

            $lista= EntesUnidad::model()->findAll('idEnte = :id_uno',array(':id_uno'=>$id_uno));
            $lista=  CHtml::listData($lista,'idUnidad','nombre');

            foreach ($lista as $valor => $descripcion){
                //echo CHtml::tag('opcion',array('value'=>$valor),CHtml::encode($descripcion),true);
                //echo CHtml::tag('opcion',array('value'=>$valor),CHtml::encode($descripcion),TRUE);
                echo CHtml::tag('option',array('value'=>$valor),CHtml::encode($descripcion),true);
            }
    }

    public function actionDeleteFuenteGet(){
        try {
            // $d= ProgramaFuente::model()->findAll('idPrograma=:p and idFuente=:f',array(':p'=>$_GET[0]['idPrograma'],':f'=>$_GET[0]['idFuente']));
            $command = Yii::app()->db->createCommand();
            $pro = $command->delete('cs_calificacion_oferente', 'idCalificacion=:p and idOferente=:f', array(
                ':p' => $_GET [0] ['idCalificacion'],
                ':f' => $_GET [0] ['idOferente']
                    ));
            $this->actionUpdate($_GET [0] ['idCalificacion']);
        } catch (Exception $ex) {
            $model->addError(null, $ex->getMessage());
        }
    }

    public function actioncalificacionOferente(){
        $var=5;
        $var2=6;
    }


    public function actionViewDocuments($id, $event)
    {

        $md = new TenderDocuments();
        $md->unsetAttributes();
        $md->idCalificacion = $id;
        $mf = TenderDocuments::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idCalificacion=:id',
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

}
