<?php

class AmendmentController extends Controller
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
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id)
	{
		$model=new Amendment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Amendment']))
		{
			$model->attributes=$_POST['Amendment'];
			if($model->save()){
				try {
				    $sql = "SELECT DISTINCT a.idProyecto FROM cs_contratacion d JOIN cs_adjudicacion c ON d.idAdjudicacion = c.idAdjudicacion JOIN cs_calificacion b ON c.idCalificacion = b.idCalificacion JOIN cs_proyecto a ON a.idProyecto = b.idProyecto   WHERE d.idContratacion  =".$model->idContratacion;
				    $command=Yii::app()->db->createCommand($sql);
				    $tempId=$command->queryAll();
					Yii::app()->Controller->saveMongo($tempId[0]["idProyecto"]);
				} catch (Exception $e) {

				}
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->renderPartial('_form',array(
			'model'=>$model,
			'idContratacion'=>$id
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
        //$modelIdContratacion = Yii::app()->db->createCommand('SELECT idContratacion FROM cs_amendment WHERE id='.$id)->queryScalar();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Amendment']))
		{
			$model->attributes=$_POST['Amendment'];
			if($model->save()){
				try {
				    $sql = "SELECT DISTINCT a.idProyecto FROM cs_contratacion d JOIN cs_adjudicacion c ON d.idAdjudicacion = c.idAdjudicacion JOIN cs_calificacion b ON c.idCalificacion = b.idCalificacion JOIN cs_proyecto a ON a.idProyecto = b.idProyecto   WHERE d.idContratacion  =".$model->idContratacion;
				    $command=Yii::app()->db->createCommand($sql);
				    $tempId=$command->queryAll();
					Yii::app()->Controller->saveMongo($tempId[0]["idProyecto"]);
				} catch (Exception $e) {

				}
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->renderPartial('update',array(
			'model'=>$model,
			'idContratacion'=>$model->idContratacion
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);

		try {
		    $sql = "SELECT DISTINCT a.idProyecto FROM cs_contratacion d JOIN cs_adjudicacion c ON d.idAdjudicacion = c.idAdjudicacion JOIN cs_calificacion b ON c.idCalificacion = b.idCalificacion JOIN cs_proyecto a ON a.idProyecto = b.idProyecto   WHERE d.idContratacion  =".$model->idContratacion;
		    $command=Yii::app()->db->createCommand($sql);
		    $tempId=$command->queryAll();
			Yii::app()->Controller->saveMongo($tempId[0]["idProyecto"]);
		} catch (Exception $e) {

		}
        $model->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		/*if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));*/
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Amendment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Amendment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Amendment']))
			$model->attributes=$_GET['Amendment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Amendment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Amendment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Amendment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='amendment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
