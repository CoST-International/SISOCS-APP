<?php

class CalificacionOferenteController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
        public $layout='';

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
				'actions'=>array('index','view', 'list','ViewDetOferentes'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','create2','update', 'borrar', 'delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
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
	public function actionView(array $id)
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

		$model=new CalificacionOferente;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CalificacionOferente']))
		{
			$model->attributes=$_POST['CalificacionOferente'];
			if($model->save()){
				try {
				    $sql = "SELECT DISTINCT a.idProyecto FROM cs_calificacion b JOIN cs_proyecto a ON a.idProyecto = b.idProyecto WHERE b.idCalificacion  =".$model->idCalificacion;
				    $command=Yii::app()->db->createCommand($sql);
				    $tempId=$command->queryAll();
					Yii::app()->Controller->saveMongo($tempId[0]["idProyecto"]);
				} catch (Exception $e) {
					
				}
				$this->redirect(array('view','id'=>$model->idCalificacionOferente));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function nombreOferente($o) {
        return Parties::model()->find("id = $o")->legalName;
    }

    public function actionCreate2($id){
        $model=new CalificacionOferente;

    // Uncomment the following line if AJAX validation is needed
    $this->performAjaxValidation($model);

    if(isset($_POST['CalificacionOferente']))
    {
	    $model->attributes=$_POST['CalificacionOferente'];
	    if($model->save()){
	    	try {
				    $sql = "SELECT DISTINCT a.idProyecto FROM cs_calificacion b JOIN cs_proyecto a ON a.idProyecto = b.idProyecto WHERE b.idCalificacion  =".$model->idCalificacion;
				    $command=Yii::app()->db->createCommand($sql);
				    $tempId=$command->queryAll();
					Yii::app()->Controller->saveMongo($tempId[0]["idProyecto"]);
				} catch (Exception $e) {
					
				}
            //$this->redirect(array('view','id'=>$model->id));
                    } else {
                        echo json_encode(array('error' => $model->getErrors().'|||'.var_dump($model)));
                    }
		    //$this->redirect(array('view','id'=>$model->idCalificacionOferente));
    }

    $this->renderpartial('_form',array(
	    'model'=>$model, 'idCalificacion'=>$id
    ));
    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate(array $id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CalificacionOferente']))
		{
			$model->attributes=$_POST['CalificacionOferente'];
			if($model->save()){
				try {
				    $sql = "SELECT DISTINCT a.idProyecto FROM cs_calificacion b JOIN cs_proyecto a ON a.idProyecto = b.idProyecto WHERE b.idCalificacion  =".$model->idCalificacion;
				    $command=Yii::app()->db->createCommand($sql);
				    $tempId=$command->queryAll();
					Yii::app()->Controller->saveMongo($tempId[0]["idProyecto"]);
				} catch (Exception $e) {
					
				}
				$this->redirect(array('view','id'=>$model->idCalificacionOferente));
			}
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

         public function actionViewDetOferentes($id, $event){


        $mf = CalificacionOferente::model()->findAll('idCalificacion=:pf', array(
            ':pf' => $id
					));
					//$mf =Yii::app()->db->createCommand("SELECT * FROM cs_calificacion_oferente JOIN cs_oferente oferente ON oferente.idOferente=cs_calificacion_oferente.idOferente WHERE idCalificacion=".$id)->queryAll();
        $this->renderpartial('_filasOferente', array(
            'datos' => $mf,
            'evento' => $event
        ));


    }
	public function actionBorrar(array $id)
	{
		$model = $this->loadModel($id);
		$model->delete();
		try {
		    $sql = "SELECT DISTINCT a.idProyecto FROM cs_calificacion b JOIN cs_proyecto a ON a.idProyecto = b.idProyecto WHERE b.idCalificacion  =".$model->idCalificacion;
		    $command=Yii::app()->db->createCommand($sql);
		    $tempId=$command->queryAll();
			Yii::app()->Controller->saveMongo($tempId[0]["idProyecto"]);
		} catch (Exception $e) {
			
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
				Yii::app()->user->setFlash('idmetodo', 'Registro eliminado exitosamente');
		//$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		$this->redirect('index.php?r=calificacion/update&id='.$id['idCalificacion']);
	}
	public function actionDelete(array $id)
	{
		$this->loadModel($id)->delete();
		$this->redirect('index.php?r=calificacion/update&id='.$id['idCalificacion']);
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('CalificacionOferente');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * List all models.
	 */
	public function actionList($id)
	{
		$model=new CalificacionOferente('search');
		$model->unsetAttributes();  // clear any default values
        $model->idCalificacion=$id;
		if(isset($_GET['CalificacionOferente']))
			$model->attributes=$_GET['CalificacionOferente'];

		$this->renderPartial('list',array(
			'model2'=>$model
		),false,true);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($id)
	{
		$model=new CalificacionOferente('search');
		$model->unsetAttributes();  // clear any default values
        $model->idCalificacion=$id;
		if(isset($_GET['CalificacionOferente']))
			$model->attributes=$_GET['CalificacionOferente'];

		$this->renderPartial('admin',array(
			'model2'=>$model
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CalificacionOferente the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CalificacionOferente::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CalificacionOferente $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='calificacion-oferente-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
