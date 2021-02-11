<?php

class ActAvancesController extends Controller
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
				'actions'=>array('create','update','cargarSubact'),
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
	public function actionCreate($cod_contrato, $cod_avances)
	{

		$model=new ActAvances;

		      // Uncomment the following line if AJAX validation is needed  
		      $this->performAjaxValidation($model);  
		       if(isset($_POST['ActAvances']))  
		       {  
			  $model->attributes=$_POST['ActAvances'];
			  
		          if($model->save()){ //save the record to the database  
		             if (Yii::app()->request->isAjaxRequest) // check for ajax request  
		             {  
				echo CJSON::encode(array(  // display message  
					  'status'=>'success',  
					  //'div'=>"Actividad agregada correctamente"  
				      ));  
			        exit;         
		             }  
		             else{  
				//$this->redirect(array('actavances/view','id'=>$model->codigo)); // if the condition fail redirect the user to post/view
				$this->redirect(array('avances/update','id'=>$model->cod_avances));
			     }  
			  }  
		      }  
		if (Yii::app()->request->isAjaxRequest) // check the condition  
		{  
			echo CJSON::encode(array(  
			'status'=>'failure',  
			'div'=>$this->renderPartial('_form', array('model'=>$model,'cod_contrato'=>$cod_contrato,'cod_avances'=>$cod_avances,), true)));
			exit;
			 $this->refreash();  	
		}  
		else{  
			$this->render('create',array(  // return the form  
			'model'=>$model,'cod_contrato'=>$cod_contrato, 'cod_avances'=>$cod_avances,
		      ));  
		}  		
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

		if(isset($_POST['ActAvances']))
		{
			$model->attributes=$_POST['ActAvances'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->codigo));
		}

		$this->render('update',array(
			'model'=>$model,'cod_contrato'=>$model->cod_contrato, 'cod_avances'=>$model->cod_avances,
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
		$dataProvider=new CActiveDataProvider('ActAvances');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$records=ActAvances::model()->findAll();

		$this->render('admin',array(
			'records'=>$records,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ActAvances the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ActAvances::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ActAvances $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='act-avances-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionCargarSubact()
        {
		/*$var="prueba";
		echo "<script>alert('$var')</script>";*/
				 
	       $data = CatgSubActividades::model()->findAll('cod_actividad=:cod_actividad', array(':cod_actividad' => (int) $_POST['cod_actividad']));
	       $data = CHtml::listData($data, 'codigo', 'descripcion');
	       echo "<option value=''>Seleccione ...</option>";
	       foreach ($data as $value => $name) {
		   echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
	       }
						    
                                             
                                             
        }	
	
	
}
