<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('editable', dirname(__FILE__).'/../extensions/editable');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
//Variable para galeria
$current_domain = 'http://localhost:8888/sisocs/' ;

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'SISOCS',
        'theme'=>'blackboot',        //'theme'=>'blackboot',//'abound',//'bootstrap',//'mattskitchen',//'twitter_fluid',//'newssourcefinal',//'blackboot',//'freearch',
        'language'=>'es',
        'sourceLanguage' => 'es_es',
        
	// preloading 'log' component
    'preload'=>array('log'),
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.vermapa.*',
		'application.helpers.*',
		'application.modules.user.models.*',
		'application.modules.user.components.*',
		'ext.RBACModels.components.*', // RBACActiveRecord and RBACDataProvider  
		'ext.EchMultiselect.*',       
		'application.extensions.awegen.components.*',
		'application.extensions.awegen.*',
		'application.extensions.awegen.AweCrud.components.*', // AweCrud components
		'application.extensions.editable.*' ,
		'application.widgets.bootstrap.*',
		'application.extensions.galleria.*',
		'ext.editable.*',
		'application.extensions.widgets.*',
		'application.extensions.select2.ESelect2',
		'application.modules.cruge.components.*',
		'application.modules.cruge.extensions.crugemailer.*',
		'ext.ECompositeUniqueValidator',
		'ext.cascadedropdown.ECascadeDropDown',
	),
   //'theme'=>'bootstrap',
	'modules'=>array(
	    'reportes',
            'importcsv'=>array(
            'path'=>'images'),
             'vermapa',
            'graficos',
            'admin',

             'user'=>array(
            # encrypting method (php hash function)
            'hash' => 'md5',
 
            # send activation email
            'sendActivationMail' => true,
 
            # allow access for non-activated users
            'loginNotActiv' => false,
 
            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,
 
            # automatically login from registration
            'autoLogin' => true,
                 
             #activacion de filtro
                 
 
            # registration path
            'registrationUrl' => array('/user/registration'),
 
            # recovery password path
            'recoveryUrl' => array('/user/recovery'),
 
            # login form path
            'loginUrl' => array('/user/login'),
 
            # page after login
            'returnUrl' => array('/user/profile'),
 
            # page after logout
            'returnLogoutUrl' => array('/user/login'),
        ),
	// rbac configured to run with module Yii-User
//       'rbac'=>array(
//                // Table where Users are stored. RBAC Manager use it as read-only
//                'tableUser'=>'User', 
//                // The PRIMARY column of the User Table
//                'columnUserid'=>'id',
//                // only for display name and could be same as id
//                'columnUsername'=>'username',
//                // only for display email for better identify Users
//                'columnEmail'=>'email', // email (only for display)
//                
//                ),	
            
            // uncomment the following to enable the Gii tool
/*		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1234',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1',$_SERVER['REMOTE_ADDR']),
                         'generatorPaths' => array(
                             //'bootstrap.gii',
                              //'awegen',
                               'ext.giiplus', 
                             ) ,
		),*/
	'cruge'=>array(
				'tableprefix'=>'cruge_',

				// para que utilice a protected.modules.cruge.models.auth.CrugeAuthDefault.php
				//
				// en vez de 'default' pon 'authdemo' para que utilice el demo de autenticacion alterna
				// para saber mas lee documentacion de la clase modules/cruge/models/auth/AlternateAuthDemo.php
				//
				'availableAuthMethods'=>array('default'),

				'availableAuthModes'=>array('username','email'),

                                // url base para los links de activacion de cuenta de usuario
				'baseUrl'=>'http://www.soptravi.net.com/',

				 // NO OLVIDES PONER EN FALSE TRAS INSTALAR
				 'debug'=>false,
				 'rbacSetupEnabled'=>true,
				 'allowUserAlways'=>false,

				// MIENTRAS INSTALAS..PONLO EN: false
				// lee mas abajo respecto a 'Encriptando las claves'
				//
				'useEncryptedPassword' => false,

				// Algoritmo de la función hash que deseas usar
				// Los valores admitidos están en: http://www.php.net/manual/en/function.hash-algos.php
				'hash' => 'md5',
              /*  'session' => array(
                        'timeout' => 300,
                ),*/

				// Estos tres atributos controlan la redirección del usuario. Solo serán son usados si no
				// hay un filtro de sesion definido (el componente MiSesionCruge), es mejor usar un filtro.
				//  lee en la wiki acerca de:
                                //   "CONTROL AVANZADO DE SESIONES Y EVENTOS DE AUTENTICACION Y SESION"
                                //
				// ejemplo:
				//		'afterLoginUrl'=>array('/site/welcome'),  ( !!! no olvidar el slash inicial / )
				//		'afterLogoutUrl'=>array('/site/page','view'=>'about'),
				//
				'afterLoginUrl'=>null,
				'afterLogoutUrl'=>array('/site/index'),
				'afterSessionExpiredUrl'=>array('/site/index'),

				// manejo del layout con cruge.
				//
				'loginLayout'=>'//layouts/column2',
				'registrationLayout'=>'//layouts/column2',
				'activateAccountLayout'=>'//layouts/column2',
				'editProfileLayout'=>'//layouts/column2',
				// en la siguiente puedes especificar el valor "ui" o "column2" para que use el layout
				// de fabrica, es basico pero funcional.  si pones otro valor considera que cruge
				// requerirá de un portlet para desplegar un menu con las opciones de administrador.
				//
				'generalUserManagementLayout'=>'ui',

				// permite indicar un array con los nombres de campos personalizados, 
				// incluyendo username y/o email para personalizar la respuesta de una consulta a: 
				// $usuario->getUserDescription(); 
				'userDescriptionFieldsArray'=>array('email'), 

			),
            'imgManager' => array(
                                     'import' => array('imgManager.*','imgManager.components.*'),
                                     'layout' => 'application.views.layouts.column1',
                                      'upload_directory' => 'gal_images',
                                      'max_file_number' => '10',                  //max number of files for bulk upload.
                                      'max_file_size' => '1mb',
                                                      ),
            

	),

	// application components
	'components'=>array(
            'metadata'=>array('class'=>'Metadata'),
            'counter' => array(
            			'class' => 'application.extensions.UserCounter',
        	),
//            'user'=>array(
//                    // enable cookie-based authentication
//                   'class' => 'WebUser',//descomentar si desea uilizar el modulo rbac
//                //'class'=>'CDbAuthManager',
//                    'allowAutoLogin'=>true,
//                    'loginUrl' => array('/user/login'),
//        ),
//
//		'user'=>array(
//			// enable cookie-based authentication
//			'allowAutoLogin'=>true,
//		),
            //  IMPORTANTE:  asegurate de que la entrada 'user' (y format) que por defecto trae Yii
			//               sea sustituida por estas a continuación:
			//
			'user'=>array(
				'allowAutoLogin'=>true,
				'class' => 'application.modules.cruge.components.CrugeWebUser',
                                
				'loginUrl' => array('/cruge/ui/login'),
			),
			'authManager' => array(
                                //'connectionID'=>'db',
				'class' => 'application.modules.cruge.components.CrugeAuthManager',
                                'defaultRoles'=>array('invitado','guest'),
//                                'itemTable'=>'cruge_authitem', // Tabla que contiene los elementos de autorizacion
//                                'itemChildTable'=>'cruge_authitemchild', // Tabla que contiene los elementos padre-hijo
//                                'assignmentTable'=>'cruge_authassignment', // Tabla que contiene la signacion usuario-autorizacion
			),
			'crugemailer'=>array(
				'class' => 'application.modules.cruge.components.CrugeMailer',
				'mailfrom' => 'info@soptravi.net',
				'subjectprefix' => 'SISOCS - ',
				'debug' => false,
			),
			'format' => array(
				'datetimeFormat'=>"d M, Y h:m:s a",
			),
                
                'email'=>array(
                    'class'=>'application.extensions.email.Email',
                    'delivery'=>'php', //Will use the php mailing function.  
                    //May also be set to 'debug' to instead dump the contents of the email into the view
                ),
         /*'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),*/
       'bootstrap'=>array(
                        'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
                        'coreCss'=>true, // whether to register the Bootstrap core CSS (bootstrap.min.css), defaults to true
                        'responsiveCss'=>false, // whether to register the Bootstrap responsive CSS (bootstrap-responsive.min.css), default to false
                        'plugins'=>array(
                                              // Optionally you can configure the "global" plugins (button, popover, tooltip and transition)
                                              // To prevent a plugin from being loaded set it to false as demonstrated below
                                        'transition'=>false, // disable CSS transitions
                                        'tooltip'=>array(
                                               'selector'=>'a.tooltip', // bind the plugin tooltip to anchor tags with the 'tooltip' class
                                               'options'=>array(
                                                         'placement'=>'bottom', // place the tooltips below instead
                                                              ),
                                                        ),
                                ),
                                  ),

                
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
           
//		'db'=>array(
//			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
//		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
					/*
                    'connectionString' => 'mysql:host=localhost;dbname=sisocs',
                    'emulatePrepare' => true,
                    'username' => 'soptravidb2',
                    'password' => '1ns3p!g0b!hn',
                    'charset' => 'utf8',
                    'tablePrefix' => 'cs_',
                   */
                   'connectionString' => 'mysql:host=localhost;dbname=sisocs',
                    'emulatePrepare' => true,
                    'username' => 'root',
                    'password' => 'root',
                    'charset' => 'utf8',
                    'tablePrefix' => 'cs_',
                    
		),
//         'authManager'=>array(
//                    'class'=>'CDbAuthManager', // Database driven Yii-Auth Manager
//                    'connectionID'=>'db', // db connection as above
//                    'defaultRoles'=>array('registered'), // default Role for logged in users
//                    'showErrors'=>true, // show eval()-errors in buisnessRules
//             ),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
            'messages' => array (
            'extensionPaths' => array(
                'AweCrud' => 'ext.AweCrud.messages', // AweCrud messages directory.
            ),
                ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
                'carpetaimg'=> YII::app()->basePath."/images",
	),
);
