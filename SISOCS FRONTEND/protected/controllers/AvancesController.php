<?php
class AvancesController extends Controller

{
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
    public

    function filters()
    {

        // return array(
        // 'accessControl', // perform access control for CRUD operations
        // 'postOnly + delete', // we only allow deletion via POST request
        // );

        return array(
            'accessControl',
            array(
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
    public

    function accessRules()
    {
        return array(
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array(
                    'view'
                ) ,
                'users' => array(
                    '*'
                )
            ) ,
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'index',
                    'index2',
                    'create',
                    'update',
                    'admin',
					'ViewDocuments'
                ) ,
                'users' => array(
                    '@'
                )
            ) ,
            array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array(
                    'admin',
                    'delete'
                ) ,
                'users' => array(
                    'admin',
                    '@',
                )
            ) ,
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
    public

    function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id)
        ));
    }

    public

    function actionIndex($id)
    {

        $dataProvider = new CActiveDataProvider('Avances', array(
            'criteria' => array(
                'condition' => 'idInicioEjecucion =' . $id . ''
            ),
            'pagination'=>false
        ));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'idInicioEjecucion' => $id
        ));
    }

    public

    function actionIndex2($id)
    {
        $dataProvider = new CActiveDataProvider('Avances',array(
            'pagination'=>false
        ));
        $this->render('index2', array(
            'dataProvider' => $dataProvider,
            'idInicioEjecucion' => $id
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public

    function actionCreate($id)
    {
        $idInicioEjecucion = $id;
        Yii::import('ext.EWideImage.*');
        $_SESSION['CoInSe'] = $idInicioEjecucion;
        $direcc = $_SESSION['CoInSe'];
        $model = new Avances();
        $model3 = new AvancesImagenes();
        $path = Yii::getPathOfAlias('webroot.images.doc_subidos');
        $path2 = YiiBase::getPathOfAlias('webroot.images.img_subidas.' . $direcc);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $this->performAjaxValidation(array(
            $model,
            $model3
        ));
        if (isset($_POST['Avances'])) {
            $criteria = new CDbCriteria();
            $criteria->select = 'estado';
            $criteria->condition = 'idInicioEjecucion=:idCod';
            $criteria->params = array(
                ':idCod' => $idInicioEjecucion
            );

            // $documento = InicioEjecucion::model()->find($criteria);

            $model_InicioEjecucion = InicioEjecucion::model()->find($criteria);

            $model->attributes = $_POST['Avances'];

            if ($model_InicioEjecucion->estado != "PUBLICADO" and $model->estado == "PUBLICADO") {
                $var = "El inicio de Ejecucion no esta en estado: PUBLICADO, No se puede crear Avances en estado PUBLICADO";
                echo "<script>alert('$var')</script>";
            } else {
                if ($model->save()) {

                    // upload archivos ////////////////////////////////////////////////

                    $dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 7, $id);
                    $image1 = CUploadedFile::getInstance($model, 'image1');
                    $image2 = CUploadedFile::getInstance($model, 'image2');
                    $image3 = CUploadedFile::getInstance($model, 'image3');
                    $image4 = CUploadedFile::getInstance($model, 'image4');
                    $image5 = CUploadedFile::getInstance($model, 'image5');
                    $image6 = CUploadedFile::getInstance($model, 'image6');
                    $image7 = CUploadedFile::getInstance($model, 'image7');
                    $image8 = CUploadedFile::getInstance($model, 'image8');
                    if (strlen($image1) > 0) {
                        if ($image1->saveAs($dir . '/' . $image1->getName())) {
                            $model->adj_garantias = Yii::app()->Controller->getURL($dir . '/' . $image1->getName());
                        }
                    }

                    if (strlen($image2) > 0) {
                        if ($image2->saveAs($dir . '/' . $image2->getName())) {
                            $model->adj_avances = Yii::app()->Controller->getURL($dir . '/' . $image2->getName());
                        }
                    }

                    if (strlen($image3) > 0) {
                        if ($image3->saveAs($dir . '/' . $image3->getName())) {
                            $model->adj_supervicion = Yii::app()->Controller->getURL($dir . '/' . $image3->getName());
                        }
                    }

                    if (strlen($image4) > 0) {
                        if ($image4->saveAs($dir . '/' . $image4->getName())) {
                            $model->adj_evaluacion = Yii::app()->Controller->getURL($dir . '/' . $image4->getName());
                        }
                    }

                    if (strlen($image5) > 0) {
                        if ($image5->saveAs($dir . '/' . $image5->getName())) {
                            $model->adj_tecnica = Yii::app()->Controller->getURL($dir . '/' . $image5->getName());
                        }
                    }

                    if (strlen($image6) > 0) {
                        if ($image6->saveAs($dir . '/' . $image6->getName())) {
                            $model->adj_financiero = Yii::app()->Controller->getURL($dir . '/' . $image6->getName());
                        }
                    }

                    if (strlen($image7) > 0) {
                        if ($image7->saveAs($dir . '/' . $image7->getName())) {
                            $model->adj_recepcion = Yii::app()->Controller->getURL($dir . '/' . $image7->getName());
                        }
                    }

                    if (strlen($image8) > 0) {
                        if ($image8->saveAs($dir . '/' . $image8->getName())) {
                            $model->adj_disconformidad = Yii::app()->Controller->getURL($dir . '/' . $image8->getName());
                        }
                    }

					$model->usuario_creacion = Yii::app()->user->id;
					if ($model->estado=="PUBLICADO") {
						$model->usuario_publicacion = Yii::app()->user->id;
						$model->fecha_publicacion=date("Y-m-d H:i:s");
					}
					elseif($model->estado=="REVISIÓN"){
						$this->mandarCorreo(7,$model->idAvances);
					}
                    $model->save();

                    // Fin del upload archivo //////////////////////////////////////

                    if ($model->estado == "REVISION") {
                        //Yii::app()->Controller->enviarCorreo(7, $model->idAvances);
                    };
                    $this->redirect(array(
                        'update',
                        'id' => $model->idAvances,
                        'idInicioEjecucion' => $idInicioEjecucion
                    ));
                }
            }
        }

        if (isset($_POST['ImgAdjuntadas'])) {
            $dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 7, $id);
            $model3->attributes = $_POST['ImgAdjuntadas'];
            $image1 = CUploadedFile::getInstance($model3, 'nombre_imagen');
            $model3->idAvances = $model->idAvances;
            if (strlen($image1) > 0) {
                if ($image1->saveAs($dir . '/' . $image1->getName())) {
                    $model3->nombre_imagen = Yii::app()->Controller->getURL($dir . '/' . $image1->getName());
                    $model3->nombre_fisico = $image1->getName();
                    $model3->ubicacion_imagen = $dir;
                    if ($model->estado == "PUBLICADO") {
                        $model3->usuario_publicacion = Yii::app()->user->id;
                        $model3->fecha_publicacion = date("Y-m-d H:i:s");
                    }
                    else {
                        $model3->usuario_publicacion = 0;
                        $model3->usuario_creacion = Yii::app()->user->id;
                        $model3->fecha_creacion = date("Y-m-d H:i:s");
                    }
                }
            }

            $model3->save();
           // EWideImage::load($dir . '/' . $image1->getName())->resize(400, 300)->saveToFile($dir . '/small_' . $image1->getName());
        }

        if (Yii::app()->request->isAjaxRequest) { // check the condition
            echo CJSON::encode(array(
                'status' => 'failure',
                'div' => $this->renderPartial('_form', array(
                    'model' => $model,
                    'model3' => $model3,
                    'idInicioEjecucion' => $idInicioEjecucion
                ) , true)
            ));
            exit();
            $this->refreash();
        } else {
            $this->render('create', array( // return the form
                'model' => $model,
                'model3' => $model3,
                'idInicioEjecucion' => $idInicioEjecucion
            ));
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *        	the ID of the model to be updated
     */
    public

    function getEnlaceVacio($url, $href)
    {
        if (strlen($href) > 10) {
            $enlace = $url;
        }
        else {
            $enlace = "No Aplica";
        }

        return $enlace;
    }

    public

    function actionUpdate($id)
    {
        Yii::import('ext.EWideImage.*');
        $model = $this->loadModel($id);
        $model3 = new AvancesImagenes();
        $this->performAjaxValidation($model);

        $id = $model->idAvances;

        if (isset($_POST['Avances'])) {
            $model->attributes = $_POST['Avances'];
            if ($model->save()) {
                $dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 7, $id);
                $image1 = CUploadedFile::getInstance($model, 'image1');
                $image2 = CUploadedFile::getInstance($model, 'image2');
                $image3 = CUploadedFile::getInstance($model, 'image3');
                $image4 = CUploadedFile::getInstance($model, 'image4');
                $image5 = CUploadedFile::getInstance($model, 'image5');
                $image6 = CUploadedFile::getInstance($model, 'image6');
                $image7 = CUploadedFile::getInstance($model, 'image7');
                $image8 = CUploadedFile::getInstance($model, 'image8');

                if (strlen($image1) > 0) {
                    if ($image1->saveAs($dir . '/' . $image1->getName())) {
                        $model->adj_garantias = Yii::app()->Controller->getURL($dir . '/' . $image1->getName());
                    }
                }

                if (strlen($image2) > 0) {
                    if ($image2->saveAs($dir . '/' . $image2->getName())) {
                        $model->adj_avances = Yii::app()->Controller->getURL($dir . '/' . $image2->getName());
                    }
                }

                if (strlen($image3) > 0) {
                    if ($image3->saveAs($dir . '/' . $image3->getName())) {
                        $model->adj_supervicion = Yii::app()->Controller->getURL($dir . '/' . $image3->getName());
                    }
                }

                if (strlen($image4) > 0) {
                    if ($image4->saveAs($dir . '/' . $image4->getName())) {
                        $model->adj_evaluacion = Yii::app()->Controller->getURL($dir . '/' . $image4->getName());
                    }
                }

                if (strlen($image5) > 0) {
                    if ($image5->saveAs($dir . '/' . $image5->getName())) {
                        $model->adj_tecnica = Yii::app()->Controller->getURL($dir . '/' . $image5->getName());
                    }
                }

                if (strlen($image6) > 0) {
                    if ($image6->saveAs($dir . '/' . $image6->getName())) {
                        $model->adj_financiero = Yii::app()->Controller->getURL($dir . '/' . $image6->getName());
                    }
                }

                if (strlen($image7) > 0) {
                    if ($image7->saveAs($dir . '/' . $image7->getName())) {
                        $model->adj_recepcion = Yii::app()->Controller->getURL($dir . '/' . $image7->getName());
                    }
                }

                if (strlen($image8) > 0) {
                    if ($image8->saveAs($dir . '/' . $image8->getName())) {
                        $model->adj_disconformidad = Yii::app()->Controller->getURL($dir . '/' . $image8->getName());
                    }
                }
            }

            if ($model->estado == "PUBLICADO") {
                $model->usuario_publicacion = Yii::app()->user->id;
                $model->fecha_publicacion   = date("Y-m-d H:i:s");
            } elseif($model->estado == "BORRADOR") {
                $model->usuario_creacion = Yii::app()->user->id;;
            }


			if ($model->estado=="PUBLICADO") {
				$model->usuario_publicacion = Yii::app()->user->id;
				$model->fecha_publicacion=date("Y-m-d H:i:s");
			}
			elseif($model->estado=="REVISIÓN"){
				$this->mandarCorreo(7,$model->idAvances);
			}

            $model->save();

            // $this->mandarCorreo(7, $model->idAvances);

        }

        if (isset($_POST['AvancesImagenes'])) {
            $dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 7, $id);
            $model3=new AvancesImagenes();
            $model3->attributes = $_POST['AvancesImagenes'];
            $image1 = CUploadedFile::getInstance($model3, 'nombre_imagen');
            $model3->idAvances = $model->idAvances;

            if (strlen($image1) > 0) {
                if ($image1->saveAs($dir . '/' . $image1->getName())) {
                    $model3->nombre_imagen = $dir . '/' . $image1->getName(); //Yii::app()->Controller->getURL($dir . '/' . $image1->getName());
                    $nombreImagen=Yii::app()->Controller->getURL($dir . '/' . $image1->getName());
                    $model3->nombre_fisico = $image1->getName();
                    $model3->ubicacion_imagen = $dir;
                    $model3->estado           = $model->estado;

                    if ($model->estado == "PUBLICADO") {
                        $model3->usuario_publicacion = Yii::app()->user->id;
                        $model3->fecha_publicacion   = date("Y-m-d H:i:s");
                    } else {
                        $model3->usuario_publicacion = 0;
                        $model3->usuario_creacion    = Yii::app()->user->id;
                        $model3->fecha_creacion      = date("Y-m-d H:i:s");
                    }
                }
            }

            //$model3->save();
            $modelo3=Yii::app()->db->createCommand()
            ->insert('cs_avances_imagenes',
            array('idAvances'=>$model->idAvances,'nombre_imagen'=>$nombreImagen,'nombre_fisico'=>$image1->getName(),'ubicacion_imagen'=>$dir,'usuario_creacion'=>Yii::app()->user->id));

            // Actualiza estado de imagenes existentes al estado del avance
            Yii::app()->db->createCommand()->update('cs_avances_imagenes', array(
                'estado' => $model->estado
            ), 'idAvances=:id', array(
                ':id' => $model->idAvances
            ));

            if ($model->estado == "REVISION") {
                Yii::app()->Controller->enviarCorreo(7, $model->idAvances);
            }

           // EWideImage::load ($dir.'/'.$image1->getName())->resize(400,300)->saveToFile($dir.'/small_'.$image1->getName());
        }

        $this->render('update', array(
            'model' => $model,
            'model3' => $model3,
            'idInicioEjecucion' => $model->idInicioEjecucion
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id
     *        	the ID of the model to be deleted
     */
    public

    function actionDelete($id)
    {

        // TODO: DELETE RELATED IMAGES FIRST !!!!!!!!!
		Yii::app()->controller->GuardarEliminado("cs_avances"," idAvances=".$id);
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser

        /*if (!isset($_GET['ajax'])) $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
            'admin'
        ));*/
    }

    /**
     * Manages all models.
     */
    public

    function actionAdmin($id)
    {
        $model = new Avances();
        $model->unsetAttributes();
	//if (isset($_GET['Avances'])) $model->attributes = $_GET['Avances'];
        $model->idInicioEjecucion = $id;
        $this->render('admin', array(
            'model' => $model,
            'idInicioEjecucion' => $id
        ));
    }

	public function actionViewDocuments($id, $event)
    {

        $md = new AdvanceDocuments();
        $md->unsetAttributes();
        $md->idAvance = $id;
        $mf = AdvanceDocuments::model()->findAll(array(
            'order' => 'id',
            'condition' => 'idAvance=:id',
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

    /*
    public function actionAdmin2($id) {
    $variableSession = Yii::app ()->getSession ()->add ( 'idInicioEjecucion', $id );
    $idSession = Yii::app ()->getSession()->get( 'idInicioEjecucion' );
    $Criteria = new CDbCriteria ();
    $Criteria->condition = "idInicioEjecucion = $idSession";
    $records = Avances::model ()->findAll ( $Criteria );
    $model = new Avances ();
    $model->unsetAttributes ();
    $model->idInicioEjecucion = $id;
    if (isset ( $_GET ['Avances'] )) {
    $model->attributes = $_GET ['Avances'];
    }

    $this->render ( 'admin', array (
    'model' => $model,
    'records' => $records
    ) );
    }

    */
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param integer $id
     *        	the ID of the model to be loaded
     * @return Avances the loaded model
     * @throws CHttpException
     */
    public

    function loadModel($id)
    {
        $model = Avances::model()->findByPk($id);
        if ($model === null) throw new CHttpException(404, 'La pÃ¡gina solicitada no existe.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     *
     * @param Avances $model
     *        	the model to be validated
     */
    protected
    function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'avances-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
