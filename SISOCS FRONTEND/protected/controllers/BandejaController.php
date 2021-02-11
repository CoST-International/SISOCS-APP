<?php

class BandejaController extends Controller
{
	public function actionIndex()
	{
		//$this->render('index');
            $this->render('_imagenes');
	}
        public function actions()
    {
    return array(
        'captcha'=>array(
        'class'=>'CCaptchaAction','backColor'=>0xFFFFFF,),
        'page'=>array('class'=>'CViewAction',),
        'yiifilemanagerfilepicker'=>array(
    'class'=>
        'ext.yiifilemanagerfilepicker.YiiFileManagerFilePickerAction'),
    );
    }
    
    public function actioninfoUsuario() {
        $this->render("infousuarios");
    }

    // Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}