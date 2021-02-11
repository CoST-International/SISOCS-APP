<?php

class ProyectoMunicipioController extends Controller
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
	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','delete', 'Municipios','update'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionCreate($id)
	{
		$model=new ProyectoMunicipio;
        $this->performAjaxValidation($model);
        
        if(isset($_POST['ProyectoMunicipio'])) {
            $model->attributes=$_POST['ProyectoMunicipio'];
            if($model->save()) {
            	try {
		            Yii::app()->Controller->saveMongo($model->idProyecto);
		        } catch (Exception $e) {
		            
	        	}
                echo 'GUARDADO : <BR>'; print_r($model); //$this->redirect(array('view','id'=>$model->primaryKey));
            } else {
                echo json_encode(array('error' => $model->getErrors().'|||'.var_dump($model)));
            }
        } else {
            $this->renderpartial('_form',array(
                'model'=>$model, 'idProyecto'=>$id
            ));
        }

	}

	public function actionUpdate($idMunicipio,$idDepartamento,$idProyecto)
	{

		$criteria=new CDbCriteria;

		$criteria->params=array(':idMunicipio' => intval($idMunicipio),':idDepartamento'=>intval($idDepartamento),':idProyecto'=>intval($idProyecto));
		$criteria->condition='(idMunicipio = :idMunicipio) AND (idDepartamento=:idDepartamento) AND (idProyecto=:idProyecto)';
		$model=ProyectoMunicipio::model()->find($criteria);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['ProyectoMunicipio']))
		{
			$model->attributes=$_POST['ProyectoMunicipio'];
			$model->save();
			try {
	            Yii::app()->Controller->saveMongo($model->idProyecto);
	        } catch (Exception $e) {
	            
	        }
		}

		$this->renderPartial('_form',array(
			'model'=>$model,
			'idProyecto' => $idProyecto
		));
	}


	public function actionDelete($idMunicipio,$idDepartamento,$idProyecto)
	{
				$criteria=new CDbCriteria;

		$criteria->params=array(':idMunicipio' => intval($idMunicipio),':idDepartamento'=>intval($idDepartamento),':idProyecto'=>intval($idProyecto));
		$criteria->condition='(idMunicipio = :idMunicipio) AND (idDepartamento=:idDepartamento) AND (idProyecto=:idProyecto)';
		$model=ProyectoMunicipio::model()->find($criteria);
		$model->delete();
		try {
            Yii::app()->Controller->saveMongo($model->idProyecto);
        } catch (Exception $e) {
            
        }
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function loadModel(array $id)
	{
		$model=ProyectoMunicipio::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='proyecto-municipio-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionMunicipios()
	{
		
		$data=Location::model()->findAll('idDepartamento=:idDepartamento', array(':idDepartamento'=>$_POST['ProyectoMunicipio_idDepartamento']));
 
		$data=CHtml::listData($data,'idMunicipio','municipio');
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
					   array('value'=>$value),CHtml::encode($name),true);
		}
		
	}
}