<?php

class FinalEjecucionController extends Controller
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
	public function actionCreate()
	{
		$model=new FinalEjecucion;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);
		 $path = Yii::getPathOfAlias('webroot.images.doc_subidos');
		if(isset($_POST['FinalEjecucion']))
		{
			$model->attributes=$_POST['FinalEjecucion'];
			$model->idInicioEjecucion=Yii::app()->request->getQuery('id');
			$model->usuario_creacion=Yii::app()->user->id;
			$model->fecha_creacion=date("Y/m/d");



			if($model->save())

			$dir = Yii::app()->Controller->GetPath('webroot.adjuntos', 8, $model->idFinalizacion);
			$image1 = CUploadedFile::getInstance($model, 'image1');
			$image2 = CUploadedFile::getInstance($model, 'image2');
			$image3 = CUploadedFile::getInstance($model, 'image3');
			$image4 = CUploadedFile::getInstance($model, 'image4');
			$image5 = CUploadedFile::getInstance($model, 'image5');
			if (strlen($image1) > 0) {

					if ($image1->saveAs($dir . '/' . $image1->getName())) {
							$model->adj_documentoGarantia = Yii::app()->Controller->getURL($dir . '/' . $image1->getName());
					}
			}
			if (strlen($image2) > 0) {

					if ($image2->saveAs($dir . '/' . $image2->getName())) {
							$model->adj_actaRecepcion = Yii::app()->Controller->getURL($dir . '/' . $image2->getName());
					}
			}
			if (strlen($image3) > 0) {

					if ($image3->saveAs($dir . '/' . $image3->getName())) {
							$model->adj_informesEvaluacion = Yii::app()->Controller->getURL($dir . '/' . $image3->getName());
					}
			}
			if (strlen($image4) > 0) {

					if ($image4->saveAs($dir . '/' . $image4->getName())) {
							$model->adj_informeDisconformidad = Yii::app()->Controller->getURL($dir . '/' . $image4->getName());
					}
			}
			if (strlen($image5) > 0) {

					if ($image5->saveAs($dir . '/' . $image5->getName())) {
							$model->adj_informeAseguramientoCalidad = Yii::app()->Controller->getURL($dir . '/' . $image5->getName());
					}
			}
			$model->save();

				$this->redirect(array('create','id'=>$model->idInicioEjecucion));
		}

		$this->render('create',array(
			'model'=>$model
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

		if(isset($_POST['FinalEjecucion']))
		{
			$model->attributes=$_POST['FinalEjecucion'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idFinalizacion));
		}

		$this->render('update',array(
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
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('FinalEjecucion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		/*$model=new FinalEjecucion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FinalEjecucion']))
			$model->attributes=$_GET['FinalEjecucion'];

		$this->render('admin',array(
			'model'=>$model,
		));*/
		$model = new GestionAvances();
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['GestionAvances'])) $model->attributes = $_GET['GestionAvances'];

		$this->render('admin', array(
				'model' => $model
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FinalEjecucion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=FinalEjecucion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param FinalEjecucion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='final-ejecucion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
