<?php

class GarantiasController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','create2','update'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','admin2','delete'),
                'users'=>array('admin', '@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = "idGarantia = $id";

        $model = Garantias::model()->find($criteria);


        $this->render('view', array(
                'model' => $model
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($id)
    {
        $model=new Garantias;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Garantias'])) {
            $model->attributes=$_POST['Garantias'];
            if ($model->save()) {
                $this->redirect(array('view','id'=>$model->idGarantia));
            }
        }

        $this->render('create', array(
            'model'=>$model,
            'idInicioEjecucion' => $id
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
                if ($model->estado=="PUBLICADO") {
                    $model->usuario_publicacion=Yii::app()->user->id;
                    $model->fecha_publicacion=date("Y-m-d H:i:s");
                } else {
                    $model->usuario_publicacion=0;
                }

        if (isset($_POST['Garantias'])) {
            $model->attributes=$_POST['Garantias'];
            if ($model->save()) {
                $this->redirect(array('view','id'=>$model->idGarantia));
            }
        }

        $this->render('update', array(
            'model'=>$model,

        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model = new Garantias('published',array('pagination'=>false));
        $model->unsetAttributes(); // clear any default values
        $this->render('index', array(
          'model' => $model
        ));
    }

    /**
     * Manages all models.
     */

    public function actionAdmin($id)
    {
        $model = new Garantias();
        $model->unsetAttributes();
        $model->idInicioEjecucion = $id;

        if (isset($_GET['Garantias'])) {
            $model->attributes=$_GET['Garantias'];
        }

        $this->render('admin', array(
                'model' => $model
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Garantias the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $criteria = new CDbCriteria;
        if (Yii::app()->user->isSuperAdmin) {
            $criteria->condition = "idGarantia = $id";
        } elseif (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
            $criteria->condition = "idGarantia = $id AND (estado = 'BORRADOR' OR estado = 'REVISION' OR estado = 'REVISÓN')";
        } else {
            $criteria->condition = "idGarantia = $id AND (estado = 'BORRADOR')";
        }

        $model = Garantias::model()->find($criteria);
        if ($model === null) {
            throw new CHttpException(404, 'La página solicitada no existe, no tiene los privilegios para verla o ya esta publicada.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Garantias $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax']==='garantias-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
