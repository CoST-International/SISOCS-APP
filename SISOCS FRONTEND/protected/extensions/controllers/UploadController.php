<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Upload
 *
 * @author juan
 */
class UploadController extends Controller {
	
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
    //put your code here
     function actionIndex()
   {
	   //inicializa variable $file
        $file="";
      $dir = Yii::app()->params['carpetaimg'];  
       //$dir = Yii::getPathOfAlias('images');
      //$dir = Yii::app()->baseUrl.'/images';
      $uploaded = false;
      $model=new Upload();
      if(isset($_POST['Upload']))
      {
          $model->attributes=$_POST['Upload'];
          $file=CUploadedFile::getInstance($model,'file');
          if($model->validate()){
            $uploaded = $file->saveAs($dir.'/'.$file->getName());
            $uploaded=true;
        }
      }
      $this->render('index', array(
         'model' => $model,
         'uploaded' => $uploaded,
         'dir' => $dir,
		 'nombre'=>$file->getName(),
      ));
   }
}

?>
