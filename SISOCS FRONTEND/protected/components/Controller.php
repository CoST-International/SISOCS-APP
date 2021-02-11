<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */

class Controller extends CController
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout='//layouts/column1';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu=array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs=array();
    /*public function beforeAction() {
    if(Yii::app()->params['maintenance'] == true) {
        //throw new CHttpException(404, 'Estamos en mantenimiento Gracias.');
                print("Estamos en mantenimiento");
    }else{ $this->redirect(array('Ciudadano/index'));}
}*/
    private $_isMobile;

    const RE_MOBILE='/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220)/i';

    public function getIsMobile()
    {
        if ($this->_isMobile===null) {
            $this->_isMobile=isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE']) ||
                preg_match(self::RE_MOBILE, $_SERVER['HTTP_USER_AGENT']);
        }
        return false;
    }

    public function behaviors()
    {
        return array(
            'RBACAccessComponent'=>array(
                'class'=>'application.modules.rbac.components.RBACAccessVerifier',
                // optional default settings
                'checkDefaultIndex'=>'id', // used with buisness Rules if no Index given
                'allowCaching'=>false,  // cache RBAC Tree -- do not enable while development ;)
                'accessDeniedUrl'=>'/user/login',// used if User is logged in
                'loginUrl'=>'/user/login'// used if User is NOT logged in
            ),
        );
    }

    public function getPath2($base, $component, $id)
    {
        $path = '';
        $arr = array();
        $i=1;
        $where = '';
        $dir = $base;

        $connection=Yii::app()->db;
        $sql = 'SELECT idPrograma, idProyecto, idCalificacion, idAdjudicacion, idContratacion, idContratos, idEjecucion, idAvances, idFinalizacion FROM vIDPaths ';

        switch ($component) {
            case 1: $where = " WHERE idProyecto = :id"; break;
            case 2: $where = " WHERE idCalificacion = :id"; break;
            case 3: $where = " WHERE idAdjudicacion = :id"; break;
            case 4: $where = " WHERE idContratacion = :id"; break;
            case 5: $where = " WHERE idContratos = :id"; break;
            case 6: $where = " WHERE idEjecucion = :id"; break;
            case 7: $where = " WHERE idAvances = :id"; break;
                        case 8: $where = " WHERE idFinalizacion = :id";break;
        }

        $row=$connection->createCommand($sql.$where)->prepare(array(
            ":id" => $id
        ))->queryRow();

        if (!empty($row)) {
            foreach ($row as $r) {
                $arr[$i]=$r;
                $i++;
            }
            for ($i=1;$i<=$component;$i++) {
                $dir = $dir.'.'.$arr[$i];
                $path = realpath(Yii::getPathOfAlias($dir));
                if (!is_dir($path)) {
                    mkdir($path);
                }
            }
        }
        return $path;
    }

    public function getParameter($name, $default = '_000')
    {
        if (isset(Yii::app()->params[$name])) {
            return Yii::app()->params[$name];
        } else {
            return $default;
        }
    }

    public function showConfig()
    {
        $base = Yii::app()->Controller->getParameter('AttPath');
        $dir = $base.'.'.Yii::app()->Controller->getParameter('countryCode').'.'.Yii::app()->Controller->getParameter('ORG_ID');
        $path = Yii::getPathOfAlias($dir);

        return "<h1>base = $base<br/>dir = $dir<br/>path = $path</h1>";
    }
    /*public function GetPath($base, $component, $id) {

    //      1 = Proyectos
    //      2 = Calificacion
    //      3 = Adjudicacion
    //      4 = Contratacion
    //      5 = Gestion de contratos
    //      6 = Implementacion
    //      7 = Avances
    $arr = array();
    $where = '';
    $i=1;
    $AttPath = Yii::app()->Controller->getParameter('AttPath');
    $path = Yii::getPathOfAlias($AttPath);
    if (!is_dir($path)) { mkdir($path); }

    $CountyryCode = Yii::app()->Controller->getParameter('countryCode');
    $path = Yii::getPathOfAlias("$AttPath.$CountyryCode");
    if (!is_dir($path)) { mkdir($path); }

    $ORG_ID = Yii::app()->Controller->getParameter('ORG_ID');
    $path = Yii::getPathOfAlias("$AttPath.$CountyryCode.$ORG_ID");
    if (!is_dir($path)) { mkdir($path); }

    $base = "$AttPath.$CountyryCode.$ORG_ID";

    $dir = $base;
    $path = '-1';

    $connection=Yii::app()->db;
    $sql = 'Select '
        . '     idProyecto , '
        . '     idCalificacion , '
        . '     idAdjudicacion , '
        . '     idContratacion , '
        . '     idContratos , '
        . '     idInicioEjecucion  , '
        . '     idAvances '
        . ' From '
        . ' vidpaths' ;

    switch ($component) {
        case 1:
            $where = " Where idProyecto = $id";
            break;
        case 2:
            $where = " Where idCalificacion = $id";
            break;
        case 3:
            $where = " Where idAdjudicacion = $id";
            break;
        case 4:
            $where = " Where idContratacion = $id";
            break;
        case 5:
            $where = " Where idContratos = $id";
            break;
        case 6:
            $where = " Where  idInicioEjecucion  = $id";
            break;
        case 7:
            $where = " Where idAvances = $id";
            break;
    };

    $command=$connection->createCommand($sql.$where);
    $variableString=$sql.$where;
    $row=$command->queryRow();
    if (!empty($row)) {
        foreach($row as $r) {  $arr[$i] = $r; $i++; }

        $path = Yii::getPathOfAlias("$base");
        for ($i=1;$i<=$component;$i++) {
            $dir = $dir.'.'.$arr[$i];
            $path = Yii::getPathOfAlias($dir);
            if (!is_dir($path)) {
                    mkdir($path);
                }
        }
    }

    return $path;
    }*/
    public function GetPath($base, $component, $id, $name = null)
    {

        //      1 = Proyectos
        //      2 = Calificacion
        //      3 = Adjudicacion
        //      4 = Contratacion
        //      5 = Gestion de contratos
        //      6 = Implementacion
        //      7 = Avances
        $arr = array();
        $level = $component;
        $where = '';
        $i=1;
        $AttPath = Yii::app()->Controller->getParameter('AttPath');
        $path = Yii::getPathOfAlias($AttPath);
        if (!is_dir($path)) {
            mkdir($path);
        }

        $CountryCode = Yii::app()->Controller->getParameter('countryCode');
        $path = Yii::getPathOfAlias("$AttPath.$CountryCode");
        if (!is_dir($path)) {
            mkdir($path);
        }

        $ORG_ID = Yii::app()->Controller->getParameter('ORG_ID');
        $path = Yii::getPathOfAlias("$AttPath.$CountryCode.$ORG_ID");
        if (!is_dir($path)) {
            mkdir($path);
        }

        $base = "$AttPath.$CountryCode.$ORG_ID";

        $dir = $base;
        $path = '-1';

        $connection=Yii::app()->db;
        $sql = 'Select '
            . '     idProyecto , '
            . '     idCalificacion , '
            . '     idAdjudicacion , '
            . '     idContratacion , '
            . '     idInicioEjecucion  '
            . ' From '
            . ' vidpaths' ;

        switch ($component) {
            case 1:
                $where = " Where idProyecto = :id";
        $level = 0;
                break;
            case 2:
                $where = " Where idCalificacion = :id";
        $level = 1;
                break;
            case 3:
                $where = " Where idAdjudicacion = :id";
        $level = 2;
                break;
            case 4:
                $where = " Where idContratacion = :id";
        $level = 3;
                break;
            case 5:
                $where = " Where idContratos = :id";
        $level = 4;
                break;
            case 6:
                $where = " Where  idInicioEjecucion  = :id";
        $level = 4;
                break;
            case 7:
                $where = " Where idAvances = :id";
        $level = 5;
                break;
	    	case 8:
                $where = " Where idFinalizacion = :id";
		$level = 5;
				break;
			default:
				$where = " WHERE 0 = 1";
        };

        $command=$connection->createCommand($sql.$where)->prepare( array(
            ":id" => $id
        ));
        $variableString=$sql.$where;
        $row=$command->queryRow();
        if (!empty($row)) {
            foreach ($row as $r) {
                $arr[$i] = $r;
                $i++;
            }

            $path = Yii::getPathOfAlias("$base");
            for ($i=1;$i<=$level;$i++) {
                $dir = $dir.'.'.$arr[$i];
                $path = Yii::getPathOfAlias($dir);
                if (!is_dir($path)) {
                    mkdir($path);
                }
            }
            $path = Yii::getPathOfAlias($dir.'.'.$id);
            if (!is_dir($path)) {
                mkdir($path);
            }
        } else {
            $path = Yii::getPathOfAlias($dir.'.'.$name);
            if (!is_dir($path)) {
                mkdir($path);
            }
            $path = Yii::getPathOfAlias($dir.'.'.$name.'.'.$id);
            if (!is_dir($path)) {
                mkdir($path);
            }
        }

        //return "$path<br/><br/>$variableString<br/><br/>".print_r($arr,true);
        return $path;
    }

    /*public function GetPath($base, $component, $id) {

        //      1 = Proyectos
        //      2 = Calificacion
        //      3 = Adjudicacion
        //      4 = Contratacion
        //      5 = Gestion de contratos
        //      6 = Inicio de Ejecucion
        //      7 = Avances
        $arr = array();
        $level = $component;
        $where = '';
        $i=1;
        $AttPath = Yii::app()->Controller->getParameter('AttPath');
        $path = Yii::getPathOfAlias($AttPath);
        if (!is_dir($path)) { mkdir($path); }

        $CountryCode = Yii::app()->Controller->getParameter('countryCode');
        $path = Yii::getPathOfAlias("$AttPath.$CountryCode");
        if (!is_dir($path)) { mkdir($path); }

        $ORG_ID = Yii::app()->Controller->getParameter('ORG_ID');
        $path = Yii::getPathOfAlias("$AttPath.$CountryCode.$ORG_ID");
        if (!is_dir($path)) { mkdir($path); }

        $base = "$AttPath.$CountryCode.$ORG_ID";

        $dir = $base;
        $path = '-1';

        $connection=Yii::app()->db;
        $sql = 'Select '
            . '     idProyecto , '
            . '     idCalificacion , '
            . '     idAdjudicacion , '
            . '     idContratacion , '
            . '     idInicioEjecucion  '
            . ' From '
            . ' vidpaths' ;

        switch ($component) {
            case 1:
                $where = " Where idProyecto = $id";
        $level = 0;
                break;
            case 2:
                $where = " Where idCalificacion = $id";
        $level = 1;
                break;
            case 3:
                $where = " Where idAdjudicacion = $id";
        $level = 2;
                break;
            case 4:
                $where = " Where idContratacion = $id";
        $level = 3;
                break;
            case 5:
                $where = " Where idContratos = $id";
        $level = 4;
                break;
            case 6:
                $where = " Where  idInicioEjecucion  = $id";
        $level = 4;
                break;
            case 7:
                $where = " Where idAvances = $id";
        $level = 5;
                break;
        case 8:
                $where = " Where idFinalizacion = $id";
        $level = 5;
                break;
        };

        $command=$connection->createCommand($sql.$where);
        $variableString=$sql.$where;
        $row=$command->queryRow();
        if (!empty($row)) {
            foreach($row as $r) {  $arr[$i] = $r; $i++; }

            $path = Yii::getPathOfAlias("$base");
            for ($i=1;$i<=$level;$i++) {
                $dir = $dir.'.'.$arr[$i];
                $path = Yii::getPathOfAlias($dir);
                if (!is_dir($path)) {
                        mkdir($path);
                    }
            }
        $path = Yii::getPathOfAlias($dir.'.'.$id);
                if (!is_dir($path)) {
                        mkdir($path);
                    }
        }

        //return "$path<br/><br/>$variableString<br/><br/>".print_r($arr,true);
                return $path;
    }*/


    public function getURL($dir)
    {
        $str = str_replace('\\', '/', $dir);

        return substr($str, strlen(Yii::getPathOfAlias('webroot'))+1);
    }

    public function getNameFromURL($url)
    {
        return substr($url, strrpos($url, "/") + 1);
    }

    public function getEnlaceVacioFichas($url)
    {
        if (file_exists(Yii::getPathOfAlias('webroot').'/'.$url)) {
            $enlace = $url;
        } else {
            $enlace = "No Asignado";
        }

        return $enlace;
    }


    public function getNameFromEnlace($url)
    {
        if (file_exists(Yii::getPathOfAlias('webroot').'/'.$url)) {
            $enlace=$url;
        } else {
            $enlace="#";
        }
        return $enlace;
    }

    public function smart_resize_image(
        $file,
                          $width              = 0,
                          $height             = 0,
                          $proportional       = false,
                          $output             = 'file',
                          $delete_original    = true,
                          $use_linux_commands = false,
                          $quality = 50
    ) {
        if ($height <= 0 && $width <= 0) {
            return false;
        }

        # Setting defaults and meta
        $info                         = getimagesize($file);
        $image                        = '';
        $final_width                  = 0;
        $final_height                 = 0;
        list($width_old, $height_old) = $info;

        # Calculating proportionality
        if ($proportional) {
            if ($width  == 0) {
                $factor = $height/$height_old;
            } elseif ($height == 0) {
                $factor = $width/$width_old;
            } else {
                $factor = min($width / $width_old, $height / $height_old);
            }

            $final_width  = round($width_old * $factor);
            $final_height = round($height_old * $factor);
        } else {
            $final_width = ($width <= 0) ? $width_old : $width;
            $final_height = ($height <= 0) ? $height_old : $height;
        }

        # Loading image to memory according to type
        switch ($info[2]) {
          case IMAGETYPE_GIF:   $image = imagecreatefromgif($file);   break;
          case IMAGETYPE_JPEG:  $image = imagecreatefromjpeg($file);  break;
          case IMAGETYPE_PNG:   $image = imagecreatefrompng($file);   break;
          default: return false;
        }


        # This is the resizing/resampling/transparency-preserving magic
        $image_resized = imagecreatetruecolor($final_width, $final_height);
        if (($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG)) {
            $transparency = imagecolortransparent($image);

            if ($transparency >= 0) {
                $transparent_color  = imagecolorsforindex($image, $trnprt_indx);
                $transparency       = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                imagefill($image_resized, 0, 0, $transparency);
                imagecolortransparent($image_resized, $transparency);
            } elseif ($info[2] == IMAGETYPE_PNG) {
                imagealphablending($image_resized, false);
                $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
                imagefill($image_resized, 0, 0, $color);
                imagesavealpha($image_resized, true);
            }
        }
        imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);

        # Taking care of original, if needed
        if ($delete_original) {
            if ($use_linux_commands) {
                exec('rm '.$file);
            } else {
                @unlink($file);
            }
        }

        # Preparing a method of providing result
        switch (strtolower($output)) {
          case 'browser':
            $mime = image_type_to_mime_type($info[2]);
            header("Content-type: $mime");
            $output = null;
          break;
          case 'file':
            $output = $file;
          break;
          case 'return':
            return $image_resized;
          break;
          default:
          break;
        }

        # Writing image according to type to the output destination and image quality
        switch ($info[2]) {
          case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
          case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output, $quality);   break;
          case IMAGETYPE_PNG:
            $quality = 9 - (int)((0.9*$quality)/10.0);
            imagepng($image_resized, $output, $quality);
            break;
          default: return false;
        }

        return true;
    }

    public function mandarCorreo($idFormulario, $id)
    {
        //---------- Obtiene el correo del responsable del programa

        $ficha = '';
        $correo = '';
        $nombre = '';

        if ($idFormulario==8) { // FinalEjecucion
            $ficha = 'FinalEjecucion';
            $idtmp = $id;
            $idtmp = FinalEjecucion::model()->findByPk($idtmp)->idInicioEjecucion;
        };

        if ($idFormulario>=7) { // Avances
            if ($idFormulario==7) {
                $ficha = 'Avances';
                $idtmp = $id;
                $idtmp = Avances::model()->findByPk($idtmp)->codigo_inicio_ejecucion;
            };
        };
        if ($idFormulario>=6) { // InicioEjecucion
            if ($idFormulario==6) {
                $ficha = 'InicioEjecucion';
                $idtmp = $id;
            };
            $idtmp = InicioEjecucion::model()->findByPk($idtmp)->idContratacion;
            /* $idtmp = InicioEjecucion::model()->find(array(
                                                        'select'=>'idContratacion',
                                                        'condition'=>'idContratacion=:idContratacion',
                                                        'params'=>array(':idContratacion'=>$idtmp),
                                                     ))->idContratacion; */
        };
        if ($idFormulario>=5) { // Contratos (Gestion)
            if ($idFormulario==5) {
                $ficha = 'Contratos';
                $idtmp = Contratos::model()->findByPk($id)->idContratacion;
            }
        };
        if ($idFormulario>=4) { // Contratacion
            if ($idFormulario==4) {
                $ficha = 'Contratacion';
                $idtmp = $id;
            };
            $idtmp = Contratacion::model()->findByPk($idtmp)->idAdjudicacion;
        };
        if ($idFormulario>=3) { // Adjudicacion
            if ($idFormulario==3) {
                $ficha = 'Adjudicacion';
                $idtmp = $id;
            };
            $idtmp = Adjudicacion::model()->findByPk($idtmp)->idCalificacion;
        };
        if ($idFormulario>=2) { // Calificacion
            if ($idFormulario==2) {
                $ficha = 'Calificacion';
                $idtmp = $id;
            };
            $idtmp = Calificacion::model()->findByPk($idtmp)->idProyecto;
        };
        if ($idFormulario>=1) { // Proyecto
            if ($idFormulario==1) {
                $ficha = 'Proyecto';
                $idtmp = $id;
            };
            //$idtmp = Proyecto::model()->findByPk($id)->idFuncionario;
            $idProyecto = $idtmp;
            $idtmp = Yii::app()->db->createCommand("SELECT idFuncionario FROM cs_proyecto WHERE idProyecto=".$idtmp)->queryScalar();
        };
        if ($idtmp != 0) { // Funcionario
            $institucionActual = Yii::app()->db->createCommand('SELECT CONVERT(value USING utf8) institucion FROM cruge_fieldvalue WHERE iduser ='.Yii::app()->user->id)->queryScalar();
            $usuariosPublicadores = Yii::app()->db->createCommand('SELECT ca.userid u FROM cruge_authassignment ca JOIN cruge_fieldvalue cf ON cf.iduser =ca.userid and CONVERT(cf.value USING utf8) = "'.$institucionActual.'" and ca.itemname="Publicador"')->queryAll();
            $correoPublicadores="";
            if (!empty($usuariosPublicadores)) {
                $puntoComa=0;

                foreach ($usuariosPublicadores as $values) {
                    if ($puntoComa==0) {
                        $correoPublicadores = Yii::app()->db->createCommand('SELECT email from cruge_user WHERE iduser='.$values['u'])->queryScalar().';';
                    } else {
                        $correoPublicadores .= Yii::app()->db->createCommand('SELECT email from cruge_user WHERE iduser='.$values['u'])->queryScalar().';';
                    }

                    $puntoComa++;
                }
            }


            $correo = Yii::app()->db->createCommand("SELECT correo FROM cs_funcionarios WHERE idFuncionario=".$idtmp)->queryScalar();
            //$nombre = Funcionarios::model()->findByPk($idtmp)->nombre;
            $nombre = Yii::app()->db->createCommand("SELECT nombre FROM cs_funcionarios WHERE idFuncionario=".$idtmp)->queryScalar();
        };
        //---------------------------------------------------------

        foreach (explode(";", $correoPublicadores) as $value) {
        /*Yii::import('ext.phpmailer.JPhpMailer');
        $mail = new JPhpMailer;
        $mail->IsSMTP();
        $mail->Host = 'mx1.hostinger.es';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@francosdevelop.pw';
        $mail->Port = '587';
        $mail->Password = 'Hola1234';
        $mail->SetFrom('info@francosdevelop.pw', 'SISOCS');
        $mail->Subject = 'SISOCS: Accion requerida';
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        $mail->MsgHTML('Tiene una nueva solicitud, para trabajar en la misma puede dar clic <a href="http://67.207.88.38/dev/index.php?r='.$ficha.'/update&id='.$id.'" target="_blank">aqui</a>');
        $mail->AddAddress($value, "Publicador");
        $mail->Send();*/
        $actual_link = "http://$_SERVER[HTTP_HOST]";
        $messageBody='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">

			<head>
			  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

			  <title>Notificación de Cambio</title>
			</head>

			<body yahoo="" bgcolor="#ffffff">
			  <table width="100%" bgcolor="#ffffff" border="0" cellpadding="10" cellspacing="0">
				<tbody>
				  <tr>
					<td>
					  <table bgcolor="#ffffff" class="content" align="center" cellpadding="0" cellspacing="0" border="0">
						<tbody>
						  <tr>
							<td valign="top" mc:edit="headerBrand" id="templateContainerHeader">

							  <p style="text-align:center;margin:0;padding:0;">
								<img src="'.$actual_link.'/emailImg/logo.png"
								  style="display:inline-block;">
							  </p>

							</td>
						  </tr>
						  <tr>
							<td align="center" valign="top">
							  <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateContainer">
								<tbody>
								  <tr>
									<td valign="top" class="bodyContent" mc:edit="body_content_01">
									  <h1 style="color:#3386e4">
										<strong>Notificación de cambio en Proyectos</strong>
									  </h1>
									  <p>Hola, Administrador</p>

									</td>
								  </tr>
								</tbody>
							  </table>
							</td>
						  </tr>
						  <tr>
							<td align="center" valign="top">
							  <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateContainerImageFull" style="min-height:15px;">
								<tbody>
								  <tr>
                                    <td width="1">
                                    	  <img src=""
										style="width: 1px; display:block; margin:0; padding:0; border:0;">
									</td>
									<td valign="top" class="bodyContentImageFull" mc:edit="body_content_01">
									  <p style="text-align:center;margin:0;padding:0;float:right;">
										<img src="'.$actual_link.'/emailImg/mainImage.png"
										  style="display:block; margin:0; padding:0; border:0;">
									  </p>
									</td>
								  </tr>
								</tbody>
							  </table>
							</td>
						  </tr>
						  <tr>
							<td align="center" valign="top">
							  <!-- BEGIN BODY // -->
							  <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateContainerMiddle" class="brdBottomPadd">
								<tbody>
								  <tr>
									<td valign="top" class="bodyContent" mc:edit="body_content">
									  <h2>
										<strong>Se ha registrado un cambio en proyectos...</strong>
									  </h2>
									  <p>Para trabajar en la misma puede dar click en </p>
									  <a class="blue-btn" href="'.$actual_link.'/dev/index.php?r='.$ficha.'/update&id='.$id.'" target="_blank">
										<strong>Ver Cambio</strong>
									  </a>
									</td>
								  </tr>
								</tbody>
							  </table>
							  <!-- // END BODY -->
							</td>
						  </tr>
						  <tr>
							<td align="center" valign="top">
							  <!-- BEGIN BODY // -->
							  <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateContainerMiddleBtm">
								<tbody>
								  <tr align="top">
									<td valign="top" class="bodyContentImage">
									  <table border="0" cellpadding="0" cellspacing="0" valign="top">
										<tbody>
										  <tr>
											<td align="left" width="50" valign="top" mc:edit="footer_sigimage" style="margin:0;padding:0;">
											  <p style="margin-bottom:10px" padding:0;display:block;="">
												<img src="'.$actual_link.'/emailImg/userIcon.png">
											  </p>
											</td>
											<td width="15" align="left" valign="top" style="width:15px;margin:0;padding:0;">&nbsp;</td>
											<td align="left" valign="top" mc:edit="footer_sig" style="margin:0;padding-top:10px;line-height:1;">
											  <h4>
												<strong>Sistema SISOCS</strong>
											  </h4>
											  <h5>info@sapp.gob.hn</h5>
											</td>
										  </tr>
										</tbody>
									  </table>
									</td>
								  </tr>
								</tbody>
							  </table>
							  <!-- // END BODY -->
							</td>
						  </tr>
						  <tr>
							<td align="center" valign="top" id="bodyCellFooter" class="unSubContent">
							  <table width="100%" border="0" cellpadding="0" cellspacing="0" id="templateContainerFooter">
								<tbody>
								  <tr>
									<td valign="top" width="100%" mc:edit="footer_unsubscribe">
									  <p style="text-align:center;">
										<img src="./Single Article_files/cog-03.jpg" style="margin:0 auto 0 auto;display:inline-block;">
									  </p>
									  <h6 style="text-align:center;margin-top: 9px;">SAPP</h6>
									  <h6 style="text-align:center;">Centro Morazán, 18 Nivel, Torre 01.​</h6>
									  <h6 style="text-align:center;">Tegucigalpa, Honduras, CA​</h6>
									  <h6 style="text-align:center;margin-top: 7px;">
										<a href="http://sapp.gob.hn/" target="_blank">SAPP</a>
									  </h6>
									</td>
								  </tr>
								</tbody>
							  </table>
							</td>
						  </tr>

						</tbody>
					  </table>
					</td>
				  </tr>
				</tbody>
			  </table>
			  <style type="text/css">


				#outlook a {
				  padding: 0;
				}



				.ReadMsgBody {
				  width: 100%;
				}

				.ExternalClass {
				  width: 100%;
				}



				.ExternalClass,
				.ExternalClass p,
				.ExternalClass span,
				.ExternalClass font,
				.ExternalClass td,
				.ExternalClass div {
				  line-height: 100%;
				}


				body,
				table,
				td,
				p,
				a,
				li,
				blockquote {
				  -webkit-text-size-adjust: 100%;
				  -ms-text-size-adjust: 100%;
				}



				table,
				td {
				  mso-table-lspace: 0pt;
				  mso-table-rspace: 0pt;
				}



				td ul li {
				  font-size: 16px;
				}



				body {
				  margin: 0;
				  padding: 0;
				}

				img {
				  max-width: 100%;
				  border: 0;
				  line-height: 100%;
				  outline: none;
				  text-decoration: none;
				}

				table {
				  border-collapse: collapse !important;
				}

				.content {
				  width: 100%;
				  max-width: 600px;
				}

				.content img {
				  height: auto;
				  min-height: 1px;
				}

				#bodyTable {
				  margin: 0;
				  padding: 0;
				  width: 100% !important;
				}

				#bodyCell {
				  margin: 0;
				  padding: 0;
				}

				#bodyCellFooter {
				  margin: 0;
				  padding: 0;
				  width: 100% !important;
				  padding-top: 39px;
				  padding-bottom: 15px;
				}

				body {
				  margin: 0;
				  padding: 0;
				  min-width: 100%!important;
				}

				#templateContainerHeader {
				  font-size: 14px;
				  padding-top: 2.429em;
				  padding-bottom: 0.929em;
				}

				#templateContainerImageFull {
				  border-left: 1px solid #e2e2e2;
				  border-right: 1px solid #e2e2e2;
				}

				#templateContainerFootBrd {
				  border-bottom: 1px solid #e2e2e2;
				  border-left: 1px solid #e2e2e2;
				  border-right: 1px solid #e2e2e2;
				  border-radius: 0 0 4px 4px;
				  background-clip: padding-box;
				  border-spacing: 0;
				  height: 10px;
				  width: 100% !important;
				}

				#templateContainer {
				  border-top: 1px solid #e2e2e2;
				  border-left: 1px solid #e2e2e2;
				  border-right: 1px solid #e2e2e2;
				  border-radius: 4px 4px 0 0;
				  background-clip: padding-box;
				  border-spacing: 0;
				}

				#templateContainerMiddle {
				  border-left: 1px solid #e2e2e2;
				  border-right: 1px solid #e2e2e2;
				}

				#templateContainerMiddleBtm {
				  border-left: 1px solid #e2e2e2;
				  border-right: 1px solid #e2e2e2;
				  border-bottom: 1px solid #e2e2e2;
				  border-radius: 0 0 4px 4px;
				  background-clip: padding-box;
				  border-spacing: 0;
				}

				h1 {
				  color: #2e2e2e;
				  display: block;
				  font-family: Helvetica;
				  font-size: 26px;
				  line-height: 1.385em;
				  font-style: normal;
				  font-weight: normal;
				  letter-spacing: normal;
				  margin-top: 0;
				  margin-right: 0;
				  margin-bottom: 15px;
				  margin-left: 0;
				  text-align: left;
				}


				h2 {
				  color: #2e2e2e;
				  display: block;
				  font-family: Helvetica;
				  font-size: 22px;
				  line-height: 1.455em;
				  font-style: normal;
				  font-weight: normal;
				  letter-spacing: normal;
				  margin-top: 0;
				  margin-right: 0;
				  margin-bottom: 15px;
				  margin-left: 0;
				  text-align: left;
				}


				h3 {
				  color: #545454;
				  display: block;
				  font-family: Helvetica;
				  font-size: 18px;
				  line-height: 1.444em;
				  font-style: normal;
				  font-weight: normal;
				  letter-spacing: normal;
				  margin-top: 0;
				  margin-right: 0;
				  margin-bottom: 15px;
				  margin-left: 0;
				  text-align: left;
				}



				h4 {
				  color: #545454;
				  display: block;
				  font-family: Helvetica;
				  font-size: 14px;
				  line-height: 1.571em;
				  font-style: normal;
				  font-weight: normal;
				  letter-spacing: normal;
				  margin-top: 0;
				  margin-right: 0;
				  margin-bottom: 15px;
				  margin-left: 0;
				  text-align: left;
				}


				h5 {
				  color: #545454;
				  display: block;
				  font-family: Helvetica;
				  font-size: 13px;
				  line-height: 1.538em;
				  font-style: normal;
				  font-weight: normal;
				  letter-spacing: normal;
				  margin-top: 0;
				  margin-right: 0;
				  margin-bottom: 15px;
				  margin-left: 0;
				  text-align: left;
				}


				h6 {
				  color: #545454;
				  display: block;
				  font-family: Helvetica;
				  font-size: 12px;
				  line-height: 2.000em;
				  font-style: normal;
				  font-weight: normal;
				  letter-spacing: normal;
				  margin-top: 0;
				  margin-right: 0;
				  margin-bottom: 15px;
				  margin-left: 0;
				  text-align: left;
				}

				p {
				  color: #545454;
				  display: block;
				  font-family: Helvetica;
				  font-size: 16px;
				  line-height: 1.500em;
				  font-style: normal;
				  font-weight: normal;
				  letter-spacing: normal;
				  margin-top: 0;
				  margin-right: 0;
				  margin-bottom: 15px;
				  margin-left: 0;
				  text-align: left;
				}

				.unSubContent a:visited {
				  color: #a1a1a1;
				  text-decoration: underline;
				  font-weight: normal;
				}

				.unSubContent a:focus {
				  color: #a1a1a1;
				  text-decoration: underline;
				  font-weight: normal;
				}

				.unSubContent a:hover {
				  color: #a1a1a1;
				  text-decoration: underline;
				  font-weight: normal;
				}

				.unSubContent a:link {
				  color: #a1a1a1;
				  text-decoration: underline;
				  font-weight: normal;
				}

				.unSubContent a .yshortcuts {
				  color: #a1a1a1;
				  text-decoration: underline;
				  font-weight: normal;
				}

				.unSubContent h6 {
				  color: #a1a1a1;
				  font-size: 12px;
				  line-height: 1.5em;
				  margin-bottom: 0;
				}

				.bodyContent {
				  color: #505050;
				  font-family: Helvetica;
				  font-size: 14px;
				  line-height: 150%;
				  padding-top: 3.143em;
				  padding-right: 3.5em;
				  padding-left: 3.5em;
				  padding-bottom: 0.714em;
				  text-align: left;
				}

				.bodyContentImage {
				  color: #505050;
				  font-family: Helvetica;
				  font-size: 14px;
				  line-height: 150%;
				  padding-top: 2em;
				  padding-right: 3.571em;
				  padding-left: 3.571em;
				  padding-bottom: 2em;
				  text-align: left;
				}

				.bodyContentImage h4 {
				  color: #4E4E4E;
				  font-size: 13px;
				  line-height: 1.154em;
				  font-weight: normal;
				  margin-bottom: 0;
				}

				.bodyContentImage h5 {
				  color: #828282;
				  font-size: 12px;
				  line-height: 1.667em;
				  margin-bottom: 0;
				}



				a:visited {
				  color: #3386e4;
				  text-decoration: none;
				}

				a:focus {
				  color: #3386e4;
				  text-decoration: none;
				}

				a:hover {
				  color: #3386e4;
				  text-decoration: none;
				}

				a:link {
				  color: #3386e4;
				  text-decoration: none;
				}

				a .yshortcuts {
				  color: #3386e4;
				  text-decoration: none;
				}

				.bodyContent img {
				  height: auto;
				  max-width: 498px;
				}

				.footerContent {
				  color: #808080;
				  font-family: Helvetica;
				  font-size: 10px;
				  line-height: 150%;
				  padding-top: 2.000em;
				  padding-right: 2.000em;
				  padding-bottom: 2.000em;
				  padding-left: 2.000em;
				  text-align: left;
				}

				.footerContent a:link,
				.footerContent a:visited,



				.footerContent a .yshortcuts,
				.footerContent a span


				  {
				  color: #606060;
				  font-weight: normal;
				  text-decoration: underline;
				}

				.bodyContentImageFull p {
				  font-size: 0 !important;
				  margin-bottom: 0 !important;
				}

				.brdBottomPadd {
				  border-bottom: 1px solid #f0f0f0;
				}

				.brdBottomPadd .bodyContent {
				  padding-bottom: 2.286em;
				}

				a.blue-btn {
				  background: #5098ea;
				  display: inline-block;
				  color: #FFFFFF;
				  border-top: 10px solid #5098ea;
				  border-bottom: 10px solid #5098ea;
				  border-left: 20px solid #5098ea;
				  border-right: 20px solid #5098ea;
				  text-decoration: none;
				  font-size: 14px;
				  margin-top: 1.0em;
				  border-radius: 3px 3px 3px 3px;
				  background-clip: padding-box;
				}


				@media only screen and (max-width: 550px),
				screen and (max-device-width: 550px) {
				  body[yahoo] .hide {
					display: none!important;
				  }
				  body[yahoo] .buttonwrapper {
					background-color: transparent!important;
				  }
				  body[yahoo] .button {
					padding: 0px!important;
				  }
				  body[yahoo] .button a {
					background-color: #e05443;
					padding: 15px 15px 13px!important;
				  }
				  body[yahoo] .unsubscribe {
					font-size: 14px;
					display: block;
					margin-top: 0.714em;
					padding: 10px 50px;
					background: #2f3942;
					border-radius: 5px;
					text-decoration: none!important;
				  }
				}


				@media only screen and (max-width: 480px) {
				  h1 {
					font-size: 34px !important;
				  }
				  h2 {
					font-size: 30px !important;
				  }
				  h3 {
					font-size: 24px !important;
				  }
				  h4 {
					font-size: 18px !important;
				  }
				  h5 {
					font-size: 16px !important;
				  }
				  h6 {
					font-size: 14px !important;
				  }
				  p {
					font-size: 18px !important;
				  }
				  .brdBottomPadd .bodyContent {
					padding-bottom: 2.286em !important;
				  }
				  .bodyContent {
					padding: 6% 5% 1% 6% !important;
				  }
				  .bodyContent img {
					max-width: 100% !important;
				  }
				  .bodyContentImage {
					padding: 3% 6% 6% 6% !important;
				  }
				  .bodyContentImage img {
					max-width: 100% !important;
				  }
				  .bodyContentImage h4 {
					font-size: 16px !important;
				  }
				  .bodyContentImage h5 {
					font-size: 15px !important;
					margin-top: 0;
				  }
				}

				.ii a[href] {
				  color: inherit !important;
				}

				span>a,
				span>a[href] {
				  color: inherit !important;
				}

				a>span,
				.ii a[href]>span {
				  text-decoration: inherit !important;
				}
			  </style>


			</body>

			</html>';

            Yii::app()->crugemailer->sendReviewState($value, 'SISOCS: Accion requerida', $messageBody);
        }
        //Yii::app()->crugemailer->sendReviewState("ddiscua.dragon@gmail.com", 'SISOCS: Accion requerida', $messageBody);
    }

    public function sendSubscribeMail($idAnnouncement)
    {
        $arrayAnnouncement = Announcement::model()->findAll(array(
            'order' => 'id',
            'condition' => 'id=:id',
            'params' => array(
                ':id' => $idAnnouncement
            )
        ));

        $announcement = $arrayAnnouncement[0];

        $arraySubscribers = Subscriptions::model()->findAll(array("condition"=>"estado=1"));

        foreach ($arraySubscribers as $object) {
            $actual_link = "http://$_SERVER[HTTP_HOST]";
            $messageBody='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">

                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

                <title>Notificación de Cambio</title>
                </head>

                <body yahoo="" bgcolor="#ffffff">
                <table width="100%" bgcolor="#ffffff" border="0" cellpadding="10" cellspacing="0">
                <tbody>
                <tr>
                    <td>
                    <table bgcolor="#ffffff" class="content" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                        <tr>
                            <td valign="top" mc:edit="headerBrand" id="templateContainerHeader">

                            <p style="text-align:center;margin:0;padding:0;">
                                <img src="'.$actual_link.'/emailImg/logo.png"
                                style="display:inline-block;">
                            </p>

                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="top">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateContainer">
                                <tbody>
                                <tr>
                                    <td valign="top" class="bodyContent" mc:edit="body_content_01">
                                    <h1 style="color:#3386e4">
                                        <strong>Notificación de Subscripción</strong>
                                    </h1>
                                    <p>Hola, '.$object["name"].'</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="top">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateContainerImageFull" style="min-height:15px;">
                                <tbody>
                                <tr>
                                    <td width="1">
                                        <img src=""
                                        style="width: 1px; display:block; margin:0; padding:0; border:0;">
                                    </td>
                                    <td valign="top" class="bodyContentImageFull" mc:edit="body_content_01">
                                    <p style="text-align:center;margin:0;padding:0;float:right;">
                                        <img src="'.$actual_link.'/emailImg/mainImage.png"
                                        style="display:block; margin:0; padding:0; border:0;">
                                    </p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="top">
                            <!-- BEGIN BODY // -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateContainerMiddle" class="brdBottomPadd">
                                <tbody>
                                <tr>
                                    <td valign="top" class="bodyContent" mc:edit="body_content">
                                    <h2>
                                        <strong>'.$announcement["title"].'</strong>
                                    </h2>
                                    <p>'.$announcement["description"].'</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <!-- // END BODY -->
                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="top">
                            <!-- BEGIN BODY // -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateContainerMiddleBtm">
                                <tbody>
                                <tr align="top">
                                    <td valign="top" class="bodyContentImage">
                                    <table border="0" cellpadding="0" cellspacing="0" valign="top">
                                        <tbody>
                                        <tr>
                                            <td align="left" width="50" valign="top" mc:edit="footer_sigimage" style="margin:0;padding:0;">
                                            <p style="margin-bottom:10px" padding:0;display:block;="">
                                                <img src="'.$actual_link.'/emailImg/userIcon.png">
                                            </p>
                                            </td>
                                            <td width="15" align="left" valign="top" style="width:15px;margin:0;padding:0;">&nbsp;</td>
                                            <td align="left" valign="top" mc:edit="footer_sig" style="margin:0;padding-top:10px;line-height:1;">
                                            <h4>
                                                <strong>Sistema SISOCS</strong>
                                            </h4>
                                            <h5>info@sapp.gob.hn</h5>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <!-- // END BODY -->
                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="top" id="bodyCellFooter" class="unSubContent">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" id="templateContainerFooter">
                                <tbody>
                                <tr>
                                    <td valign="top" width="100%" mc:edit="footer_unsubscribe">
                                    <p style="text-align:center;">
                                        <img src="./Single Article_files/cog-03.jpg" style="margin:0 auto 0 auto;display:inline-block;">
                                    </p>
                                    <h6 style="text-align:center;margin-top: 9px;">SAPP</h6>
                                    <h6 style="text-align:center;">Centro Morazán, 18 Nivel, Torre 01.​</h6>
                                    <h6 style="text-align:center;">Tegucigalpa, Honduras, CA​</h6>
                                    <h6 style="text-align:center;margin-top: 7px;">
                                        <a href="http://sapp.gob.hn/" target="_blank">SAPP</a>
                                    </h6>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    </td>
                </tr>
                </tbody>
                </table>
                <style type="text/css">


                #outlook a {
                padding: 0;
                }



                .ReadMsgBody {
                width: 100%;
                }

                .ExternalClass {
                width: 100%;
                }



                .ExternalClass,
                .ExternalClass p,
                .ExternalClass span,
                .ExternalClass font,
                .ExternalClass td,
                .ExternalClass div {
                line-height: 100%;
                }


                body,
                table,
                td,
                p,
                a,
                li,
                blockquote {
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
                }



                table,
                td {
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
                }



                td ul li {
                font-size: 16px;
                }



                body {
                margin: 0;
                padding: 0;
                }

                img {
                max-width: 100%;
                border: 0;
                line-height: 100%;
                outline: none;
                text-decoration: none;
                }

                table {
                border-collapse: collapse !important;
                }

                .content {
                width: 100%;
                max-width: 600px;
                }

                .content img {
                height: auto;
                min-height: 1px;
                }

                #bodyTable {
                margin: 0;
                padding: 0;
                width: 100% !important;
                }

                #bodyCell {
                margin: 0;
                padding: 0;
                }

                #bodyCellFooter {
                margin: 0;
                padding: 0;
                width: 100% !important;
                padding-top: 39px;
                padding-bottom: 15px;
                }

                body {
                margin: 0;
                padding: 0;
                min-width: 100%!important;
                }

                #templateContainerHeader {
                font-size: 14px;
                padding-top: 2.429em;
                padding-bottom: 0.929em;
                }

                #templateContainerImageFull {
                border-left: 1px solid #e2e2e2;
                border-right: 1px solid #e2e2e2;
                }

                #templateContainerFootBrd {
                border-bottom: 1px solid #e2e2e2;
                border-left: 1px solid #e2e2e2;
                border-right: 1px solid #e2e2e2;
                border-radius: 0 0 4px 4px;
                background-clip: padding-box;
                border-spacing: 0;
                height: 10px;
                width: 100% !important;
                }

                #templateContainer {
                border-top: 1px solid #e2e2e2;
                border-left: 1px solid #e2e2e2;
                border-right: 1px solid #e2e2e2;
                border-radius: 4px 4px 0 0;
                background-clip: padding-box;
                border-spacing: 0;
                }

                #templateContainerMiddle {
                border-left: 1px solid #e2e2e2;
                border-right: 1px solid #e2e2e2;
                }

                #templateContainerMiddleBtm {
                border-left: 1px solid #e2e2e2;
                border-right: 1px solid #e2e2e2;
                border-bottom: 1px solid #e2e2e2;
                border-radius: 0 0 4px 4px;
                background-clip: padding-box;
                border-spacing: 0;
                }

                h1 {
                color: #2e2e2e;
                display: block;
                font-family: Helvetica;
                font-size: 26px;
                line-height: 1.385em;
                font-style: normal;
                font-weight: normal;
                letter-spacing: normal;
                margin-top: 0;
                margin-right: 0;
                margin-bottom: 15px;
                margin-left: 0;
                text-align: left;
                }


                h2 {
                color: #2e2e2e;
                display: block;
                font-family: Helvetica;
                font-size: 22px;
                line-height: 1.455em;
                font-style: normal;
                font-weight: normal;
                letter-spacing: normal;
                margin-top: 0;
                margin-right: 0;
                margin-bottom: 15px;
                margin-left: 0;
                text-align: left;
                }


                h3 {
                color: #545454;
                display: block;
                font-family: Helvetica;
                font-size: 18px;
                line-height: 1.444em;
                font-style: normal;
                font-weight: normal;
                letter-spacing: normal;
                margin-top: 0;
                margin-right: 0;
                margin-bottom: 15px;
                margin-left: 0;
                text-align: left;
                }



                h4 {
                color: #545454;
                display: block;
                font-family: Helvetica;
                font-size: 14px;
                line-height: 1.571em;
                font-style: normal;
                font-weight: normal;
                letter-spacing: normal;
                margin-top: 0;
                margin-right: 0;
                margin-bottom: 15px;
                margin-left: 0;
                text-align: left;
                }


                h5 {
                color: #545454;
                display: block;
                font-family: Helvetica;
                font-size: 13px;
                line-height: 1.538em;
                font-style: normal;
                font-weight: normal;
                letter-spacing: normal;
                margin-top: 0;
                margin-right: 0;
                margin-bottom: 15px;
                margin-left: 0;
                text-align: left;
                }


                h6 {
                color: #545454;
                display: block;
                font-family: Helvetica;
                font-size: 12px;
                line-height: 2.000em;
                font-style: normal;
                font-weight: normal;
                letter-spacing: normal;
                margin-top: 0;
                margin-right: 0;
                margin-bottom: 15px;
                margin-left: 0;
                text-align: left;
                }

                p {
                color: #545454;
                display: block;
                font-family: Helvetica;
                font-size: 16px;
                line-height: 1.500em;
                font-style: normal;
                font-weight: normal;
                letter-spacing: normal;
                margin-top: 0;
                margin-right: 0;
                margin-bottom: 15px;
                margin-left: 0;
                text-align: left;
                }

                .unSubContent a:visited {
                color: #a1a1a1;
                text-decoration: underline;
                font-weight: normal;
                }

                .unSubContent a:focus {
                color: #a1a1a1;
                text-decoration: underline;
                font-weight: normal;
                }

                .unSubContent a:hover {
                color: #a1a1a1;
                text-decoration: underline;
                font-weight: normal;
                }

                .unSubContent a:link {
                color: #a1a1a1;
                text-decoration: underline;
                font-weight: normal;
                }

                .unSubContent a .yshortcuts {
                color: #a1a1a1;
                text-decoration: underline;
                font-weight: normal;
                }

                .unSubContent h6 {
                color: #a1a1a1;
                font-size: 12px;
                line-height: 1.5em;
                margin-bottom: 0;
                }

                .bodyContent {
                color: #505050;
                font-family: Helvetica;
                font-size: 14px;
                line-height: 150%;
                padding-top: 3.143em;
                padding-right: 3.5em;
                padding-left: 3.5em;
                padding-bottom: 0.714em;
                text-align: left;
                }

                .bodyContentImage {
                color: #505050;
                font-family: Helvetica;
                font-size: 14px;
                line-height: 150%;
                padding-top: 2em;
                padding-right: 3.571em;
                padding-left: 3.571em;
                padding-bottom: 2em;
                text-align: left;
                }

                .bodyContentImage h4 {
                color: #4E4E4E;
                font-size: 13px;
                line-height: 1.154em;
                font-weight: normal;
                margin-bottom: 0;
                }

                .bodyContentImage h5 {
                color: #828282;
                font-size: 12px;
                line-height: 1.667em;
                margin-bottom: 0;
                }



                a:visited {
                color: #3386e4;
                text-decoration: none;
                }

                a:focus {
                color: #3386e4;
                text-decoration: none;
                }

                a:hover {
                color: #3386e4;
                text-decoration: none;
                }

                a:link {
                color: #3386e4;
                text-decoration: none;
                }

                a .yshortcuts {
                color: #3386e4;
                text-decoration: none;
                }

                .bodyContent img {
                height: auto;
                max-width: 498px;
                }

                .footerContent {
                color: #808080;
                font-family: Helvetica;
                font-size: 10px;
                line-height: 150%;
                padding-top: 2.000em;
                padding-right: 2.000em;
                padding-bottom: 2.000em;
                padding-left: 2.000em;
                text-align: left;
                }

                .footerContent a:link,
                .footerContent a:visited,



                .footerContent a .yshortcuts,
                .footerContent a span


                {
                color: #606060;
                font-weight: normal;
                text-decoration: underline;
                }

                .bodyContentImageFull p {
                font-size: 0 !important;
                margin-bottom: 0 !important;
                }

                .brdBottomPadd {
                border-bottom: 1px solid #f0f0f0;
                }

                .brdBottomPadd .bodyContent {
                padding-bottom: 2.286em;
                }

                a.blue-btn {
                background: #5098ea;
                display: inline-block;
                color: #FFFFFF;
                border-top: 10px solid #5098ea;
                border-bottom: 10px solid #5098ea;
                border-left: 20px solid #5098ea;
                border-right: 20px solid #5098ea;
                text-decoration: none;
                font-size: 14px;
                margin-top: 1.0em;
                border-radius: 3px 3px 3px 3px;
                background-clip: padding-box;
                }


                @media only screen and (max-width: 550px),
                screen and (max-device-width: 550px) {
                body[yahoo] .hide {
                    display: none!important;
                }
                body[yahoo] .buttonwrapper {
                    background-color: transparent!important;
                }
                body[yahoo] .button {
                    padding: 0px!important;
                }
                body[yahoo] .button a {
                    background-color: #e05443;
                    padding: 15px 15px 13px!important;
                }
                body[yahoo] .unsubscribe {
                    font-size: 14px;
                    display: block;
                    margin-top: 0.714em;
                    padding: 10px 50px;
                    background: #2f3942;
                    border-radius: 5px;
                    text-decoration: none!important;
                }
                }


                @media only screen and (max-width: 480px) {
                h1 {
                    font-size: 34px !important;
                }
                h2 {
                    font-size: 30px !important;
                }
                h3 {
                    font-size: 24px !important;
                }
                h4 {
                    font-size: 18px !important;
                }
                h5 {
                    font-size: 16px !important;
                }
                h6 {
                    font-size: 14px !important;
                }
                p {
                    font-size: 18px !important;
                }
                .brdBottomPadd .bodyContent {
                    padding-bottom: 2.286em !important;
                }
                .bodyContent {
                    padding: 6% 5% 1% 6% !important;
                }
                .bodyContent img {
                    max-width: 100% !important;
                }
                .bodyContentImage {
                    padding: 3% 6% 6% 6% !important;
                }
                .bodyContentImage img {
                    max-width: 100% !important;
                }
                .bodyContentImage h4 {
                    font-size: 16px !important;
                }
                .bodyContentImage h5 {
                    font-size: 15px !important;
                    margin-top: 0;
                }
                }

                .ii a[href] {
                color: inherit !important;
                }

                span>a,
                span>a[href] {
                color: inherit !important;
                }

                a>span,
                .ii a[href]>span {
                text-decoration: inherit !important;
                }
                </style>


                </body>

                </html>
            ';

            mail($object["email"],"SISOCS: Accion requerida",$messageBody,"Content-Type: text/html\r\nFrom: info@sisocs.org\r\n");
            //Yii::app()->crugemailer->sendReviewState($object["email"], 'SISOCS: Accion requerida', $messageBody);
            //Yii::app()->crugemailer->sendReviewState("ddiscua.dragon@gmail.com", 'SISOCS: Accion requerida', $messageBody);
        }
    }

    public function sendSubscribedMail($emailSubscribed, $nameSuscribed, $url)
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]";
        $messageBody='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">

            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

            <title>Notificación de Cambio</title>
            </head>

            <body yahoo="" bgcolor="#ffffff">
            <table width="100%" bgcolor="#ffffff" border="0" cellpadding="10" cellspacing="0">
            <tbody>
            <tr>
                <td>
                <table bgcolor="#ffffff" class="content" align="center" cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                    <tr>
                        <td valign="top" mc:edit="headerBrand" id="templateContainerHeader">

                        <p style="text-align:center;margin:0;padding:0;">
                            <img src="'.$actual_link.'/emailImg/logo.png"
                            style="display:inline-block;">
                        </p>

                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateContainer">
                            <tbody>
                            <tr>
                                <td valign="top" class="bodyContent" mc:edit="body_content_01">
                                <h1 style="color:#3386e4">
                                    <strong>Notificación de Subscripción</strong>
                                </h1>
                                <p>Hola, '.$nameSuscribed.'</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateContainerImageFull" style="min-height:15px;">
                            <tbody>
                            <tr>
                                <td width="1">
                                    <img src=""
                                    style="width: 1px; display:block; margin:0; padding:0; border:0;">
                                </td>
                                <td valign="top" class="bodyContentImageFull" mc:edit="body_content_01">
                                <p style="text-align:center;margin:0;padding:0;float:right;">
                                    <img src="'.$actual_link.'/emailImg/mainImage.png"
                                    style="display:block; margin:0; padding:0; border:0;">
                                </p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                        <!-- BEGIN BODY // -->
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateContainerMiddle" class="brdBottomPadd">
                            <tbody>
                            <tr>
                                <td valign="top" class="bodyContent" mc:edit="body_content">
                                <h2>
                                    <strong>Se ha subscrito a los anuncios de SISOCS, ahora recivirá todos los anuncios realizados desde la plataforma, favor confirmar la suscripción en:</strong>'.$url.'
                                </h2>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <!-- // END BODY -->
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                        <!-- BEGIN BODY // -->
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateContainerMiddleBtm">
                            <tbody>
                            <tr align="top">
                                <td valign="top" class="bodyContentImage">
                                <table border="0" cellpadding="0" cellspacing="0" valign="top">
                                    <tbody>
                                    <tr>
                                        <td align="left" width="50" valign="top" mc:edit="footer_sigimage" style="margin:0;padding:0;">
                                        <p style="margin-bottom:10px" padding:0;display:block;="">
                                            <img src="'.$actual_link.'/emailImg/userIcon.png">
                                        </p>
                                        </td>
                                        <td width="15" align="left" valign="top" style="width:15px;margin:0;padding:0;">&nbsp;</td>
                                        <td align="left" valign="top" mc:edit="footer_sig" style="margin:0;padding-top:10px;line-height:1;">
                                        <h4>
                                            <strong>Sistema SISOCS</strong>
                                        </h4>
                                        <h5>info@sapp.gob.hn</h5>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <!-- // END BODY -->
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top" id="bodyCellFooter" class="unSubContent">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" id="templateContainerFooter">
                            <tbody>
                            <tr>
                                <td valign="top" width="100%" mc:edit="footer_unsubscribe">
                                <p style="text-align:center;">
                                    <img src="./Single Article_files/cog-03.jpg" style="margin:0 auto 0 auto;display:inline-block;">
                                </p>
                                <h6 style="text-align:center;margin-top: 9px;">SAPP</h6>
                                <h6 style="text-align:center;">Centro Morazán, 18 Nivel, Torre 01.​</h6>
                                <h6 style="text-align:center;">Tegucigalpa, Honduras, CA​</h6>
                                <h6 style="text-align:center;margin-top: 7px;">
                                    <a href="http://sapp.gob.hn/" target="_blank">SAPP</a>
                                </h6>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>

                    </tbody>
                </table>
                </td>
            </tr>
            </tbody>
            </table>
            <style type="text/css">


            #outlook a {
            padding: 0;
            }



            .ReadMsgBody {
            width: 100%;
            }

            .ExternalClass {
            width: 100%;
            }



            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
            line-height: 100%;
            }


            body,
            table,
            td,
            p,
            a,
            li,
            blockquote {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            }



            table,
            td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            }



            td ul li {
            font-size: 16px;
            }



            body {
            margin: 0;
            padding: 0;
            }

            img {
            max-width: 100%;
            border: 0;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            }

            table {
            border-collapse: collapse !important;
            }

            .content {
            width: 100%;
            max-width: 600px;
            }

            .content img {
            height: auto;
            min-height: 1px;
            }

            #bodyTable {
            margin: 0;
            padding: 0;
            width: 100% !important;
            }

            #bodyCell {
            margin: 0;
            padding: 0;
            }

            #bodyCellFooter {
            margin: 0;
            padding: 0;
            width: 100% !important;
            padding-top: 39px;
            padding-bottom: 15px;
            }

            body {
            margin: 0;
            padding: 0;
            min-width: 100%!important;
            }

            #templateContainerHeader {
            font-size: 14px;
            padding-top: 2.429em;
            padding-bottom: 0.929em;
            }

            #templateContainerImageFull {
            border-left: 1px solid #e2e2e2;
            border-right: 1px solid #e2e2e2;
            }

            #templateContainerFootBrd {
            border-bottom: 1px solid #e2e2e2;
            border-left: 1px solid #e2e2e2;
            border-right: 1px solid #e2e2e2;
            border-radius: 0 0 4px 4px;
            background-clip: padding-box;
            border-spacing: 0;
            height: 10px;
            width: 100% !important;
            }

            #templateContainer {
            border-top: 1px solid #e2e2e2;
            border-left: 1px solid #e2e2e2;
            border-right: 1px solid #e2e2e2;
            border-radius: 4px 4px 0 0;
            background-clip: padding-box;
            border-spacing: 0;
            }

            #templateContainerMiddle {
            border-left: 1px solid #e2e2e2;
            border-right: 1px solid #e2e2e2;
            }

            #templateContainerMiddleBtm {
            border-left: 1px solid #e2e2e2;
            border-right: 1px solid #e2e2e2;
            border-bottom: 1px solid #e2e2e2;
            border-radius: 0 0 4px 4px;
            background-clip: padding-box;
            border-spacing: 0;
            }

            h1 {
            color: #2e2e2e;
            display: block;
            font-family: Helvetica;
            font-size: 26px;
            line-height: 1.385em;
            font-style: normal;
            font-weight: normal;
            letter-spacing: normal;
            margin-top: 0;
            margin-right: 0;
            margin-bottom: 15px;
            margin-left: 0;
            text-align: left;
            }


            h2 {
            color: #2e2e2e;
            display: block;
            font-family: Helvetica;
            font-size: 22px;
            line-height: 1.455em;
            font-style: normal;
            font-weight: normal;
            letter-spacing: normal;
            margin-top: 0;
            margin-right: 0;
            margin-bottom: 15px;
            margin-left: 0;
            text-align: left;
            }


            h3 {
            color: #545454;
            display: block;
            font-family: Helvetica;
            font-size: 18px;
            line-height: 1.444em;
            font-style: normal;
            font-weight: normal;
            letter-spacing: normal;
            margin-top: 0;
            margin-right: 0;
            margin-bottom: 15px;
            margin-left: 0;
            text-align: left;
            }



            h4 {
            color: #545454;
            display: block;
            font-family: Helvetica;
            font-size: 14px;
            line-height: 1.571em;
            font-style: normal;
            font-weight: normal;
            letter-spacing: normal;
            margin-top: 0;
            margin-right: 0;
            margin-bottom: 15px;
            margin-left: 0;
            text-align: left;
            }


            h5 {
            color: #545454;
            display: block;
            font-family: Helvetica;
            font-size: 13px;
            line-height: 1.538em;
            font-style: normal;
            font-weight: normal;
            letter-spacing: normal;
            margin-top: 0;
            margin-right: 0;
            margin-bottom: 15px;
            margin-left: 0;
            text-align: left;
            }


            h6 {
            color: #545454;
            display: block;
            font-family: Helvetica;
            font-size: 12px;
            line-height: 2.000em;
            font-style: normal;
            font-weight: normal;
            letter-spacing: normal;
            margin-top: 0;
            margin-right: 0;
            margin-bottom: 15px;
            margin-left: 0;
            text-align: left;
            }

            p {
            color: #545454;
            display: block;
            font-family: Helvetica;
            font-size: 16px;
            line-height: 1.500em;
            font-style: normal;
            font-weight: normal;
            letter-spacing: normal;
            margin-top: 0;
            margin-right: 0;
            margin-bottom: 15px;
            margin-left: 0;
            text-align: left;
            }

            .unSubContent a:visited {
            color: #a1a1a1;
            text-decoration: underline;
            font-weight: normal;
            }

            .unSubContent a:focus {
            color: #a1a1a1;
            text-decoration: underline;
            font-weight: normal;
            }

            .unSubContent a:hover {
            color: #a1a1a1;
            text-decoration: underline;
            font-weight: normal;
            }

            .unSubContent a:link {
            color: #a1a1a1;
            text-decoration: underline;
            font-weight: normal;
            }

            .unSubContent a .yshortcuts {
            color: #a1a1a1;
            text-decoration: underline;
            font-weight: normal;
            }

            .unSubContent h6 {
            color: #a1a1a1;
            font-size: 12px;
            line-height: 1.5em;
            margin-bottom: 0;
            }

            .bodyContent {
            color: #505050;
            font-family: Helvetica;
            font-size: 14px;
            line-height: 150%;
            padding-top: 3.143em;
            padding-right: 3.5em;
            padding-left: 3.5em;
            padding-bottom: 0.714em;
            text-align: left;
            }

            .bodyContentImage {
            color: #505050;
            font-family: Helvetica;
            font-size: 14px;
            line-height: 150%;
            padding-top: 2em;
            padding-right: 3.571em;
            padding-left: 3.571em;
            padding-bottom: 2em;
            text-align: left;
            }

            .bodyContentImage h4 {
            color: #4E4E4E;
            font-size: 13px;
            line-height: 1.154em;
            font-weight: normal;
            margin-bottom: 0;
            }

            .bodyContentImage h5 {
            color: #828282;
            font-size: 12px;
            line-height: 1.667em;
            margin-bottom: 0;
            }



            a:visited {
            color: #3386e4;
            text-decoration: none;
            }

            a:focus {
            color: #3386e4;
            text-decoration: none;
            }

            a:hover {
            color: #3386e4;
            text-decoration: none;
            }

            a:link {
            color: #3386e4;
            text-decoration: none;
            }

            a .yshortcuts {
            color: #3386e4;
            text-decoration: none;
            }

            .bodyContent img {
            height: auto;
            max-width: 498px;
            }

            .footerContent {
            color: #808080;
            font-family: Helvetica;
            font-size: 10px;
            line-height: 150%;
            padding-top: 2.000em;
            padding-right: 2.000em;
            padding-bottom: 2.000em;
            padding-left: 2.000em;
            text-align: left;
            }

            .footerContent a:link,
            .footerContent a:visited,



            .footerContent a .yshortcuts,
            .footerContent a span


            {
            color: #606060;
            font-weight: normal;
            text-decoration: underline;
            }

            .bodyContentImageFull p {
            font-size: 0 !important;
            margin-bottom: 0 !important;
            }

            .brdBottomPadd {
            border-bottom: 1px solid #f0f0f0;
            }

            .brdBottomPadd .bodyContent {
            padding-bottom: 2.286em;
            }

            a.blue-btn {
            background: #5098ea;
            display: inline-block;
            color: #FFFFFF;
            border-top: 10px solid #5098ea;
            border-bottom: 10px solid #5098ea;
            border-left: 20px solid #5098ea;
            border-right: 20px solid #5098ea;
            text-decoration: none;
            font-size: 14px;
            margin-top: 1.0em;
            border-radius: 3px 3px 3px 3px;
            background-clip: padding-box;
            }


            @media only screen and (max-width: 550px),
            screen and (max-device-width: 550px) {
            body[yahoo] .hide {
                display: none!important;
            }
            body[yahoo] .buttonwrapper {
                background-color: transparent!important;
            }
            body[yahoo] .button {
                padding: 0px!important;
            }
            body[yahoo] .button a {
                background-color: #e05443;
                padding: 15px 15px 13px!important;
            }
            body[yahoo] .unsubscribe {
                font-size: 14px;
                display: block;
                margin-top: 0.714em;
                padding: 10px 50px;
                background: #2f3942;
                border-radius: 5px;
                text-decoration: none!important;
            }
            }


            @media only screen and (max-width: 480px) {
            h1 {
                font-size: 34px !important;
            }
            h2 {
                font-size: 30px !important;
            }
            h3 {
                font-size: 24px !important;
            }
            h4 {
                font-size: 18px !important;
            }
            h5 {
                font-size: 16px !important;
            }
            h6 {
                font-size: 14px !important;
            }
            p {
                font-size: 18px !important;
            }
            .brdBottomPadd .bodyContent {
                padding-bottom: 2.286em !important;
            }
            .bodyContent {
                padding: 6% 5% 1% 6% !important;
            }
            .bodyContent img {
                max-width: 100% !important;
            }
            .bodyContentImage {
                padding: 3% 6% 6% 6% !important;
            }
            .bodyContentImage img {
                max-width: 100% !important;
            }
            .bodyContentImage h4 {
                font-size: 16px !important;
            }
            .bodyContentImage h5 {
                font-size: 15px !important;
                margin-top: 0;
            }
            }

            .ii a[href] {
            color: inherit !important;
            }

            span>a,
            span>a[href] {
            color: inherit !important;
            }

            a>span,
            .ii a[href]>span {
            text-decoration: inherit !important;
            }
            </style>


            </body>

            </html>
        ';
        mail($emailSubscribed,"SISOCS: Nuevo Anuncio",$messageBody,"Content-Type: text/html\r\nFrom: info@sisocs.org\r\n");
        //mail($emailSubscribed,"SISOCS: Subscripción realizada con éxito","<html><body><p>Te acabas de suscribir a los anuncios de sisocs, favor confirmar tu suscripción dando clik en el siguiente link:</p></body></html>".$url);
        //Yii::app()->crugemailer->sendReviewState($emailSubscribed, 'SISOCS: Subscripción realizada', $messageBody);
        //Yii::app()->crugemailer->sendReviewState("ddiscua.dragon@gmail.com", 'SISOCS: Accion requerida', $messageBody);

    }

    public function mandarCorreo2($idFormulario, $id, $idFuncionario)
    {
        //---------- Obtiene el correo del responsable del programa

        $ficha = '';
        $correo = '';
        $nombre = '';

        if ($idFormulario>=7) { // Avances
            if ($idFormulario==7) {
                $ficha = 'Avances';
                $idtmp = $id;
            };
            $idtmp = Avances::model()->findByPk($idtmp)->codigo_inicio_ejecucion;
        };
        if ($idFormulario>=6) { // InicioEjecucion
            if ($idFormulario==6) {
                $ficha = 'InicioEjecucion';
                $idtmp = $id;
            };
            $idtmp = InicioEjecucion::model()->findByPk($id)->idContratacion;
            /* $idtmp = InicioEjecucion::model()->find(array(
                                                        'select'=>'idContratacion',
                                                        'condition'=>'idContratacion=:idContratacion',
                                                        'params'=>array(':idContratacion'=>$idtmp),
                                                     ))->idContratacion; */
        };
        if ($idFormulario>=5) { // Contratos (Gestion)
            if ($idFormulario==5) {
                $ficha = 'Contratos';
                $idtmp = Contratos::model()->findByPk($id)->idContratacion;
            }
        };
        if ($idFormulario>=4) { // Contratacion
            if ($idFormulario==4) {
                $ficha = 'Contratacion';
                $idtmp = $id;
            };
            $idtmp = Contratacion::model()->findByPk($idtmp)->idAdjudicacion;
        };
        if ($idFormulario>=3) { // Adjudicacion
            if ($idFormulario==3) {
                $ficha = 'Adjudicacion';
                $idtmp = $id;
            };
            $idtmp = Adjudicacion::model()->findByPk($idtmp)->idCalificacion;
        };
        if ($idFormulario>=2) { // Calificacion
            if ($idFormulario==2) {
                $ficha = 'Calificacion';
                $idtmp = $id;
            };
            $idtmp = Calificacion::model()->findByPk($idtmp)->idProyecto;
        };
        if ($idFormulario>=1) { // Proyecto
            if ($idFormulario==1) {
                $ficha = 'Proyecto';
                $idtmp = $id;
            };
            $idtmp = Proyecto::model()->findByPk($idtmp)->idFuncionario;
        };
        if ($idtmp != 0) { // Funcionario
                $correo = Funcionarios::model()->findByPk($idFuncionario)->correo; // Validar que sea una direccion de correo valida
                $nombre = Funcionarios::model()->findByPk($idFuncionario)->nombre;
        };
        //---------------------------------------------------------

        Yii::import('ext.phpmailer.JPhpMailer');
        $mail = new JPhpMailer;
        $mail->CharSet = "UTF-8";
        $mail->IsSMTP();                                       // Set mailer to use SMTP
        $mail->Host = 'smtp.soptravi.net';                       // Specify main and backup server
        $mail->Port = '465';
        $mail->SMTPAuth = true;                                // Enable SMTP authentication
        $mail->Username = 'info@soptravi.net';                          // SMTP username
        $mail->Password = 'Soptravi123';                        // SMTP password
        $mail->SMTPSecure = 'ssl';                             // Enable encryption, 'ssl' also accepted
        $mail->SMTPKeepAlive = true;
        $mail->SetFrom('info@soptravi.net', 'SISOCS');
        $mail->Subject = 'SISOCS: Accion requerida';
        $mail->MsgHTML('Tiene una nueva solicitud, para trabajar en la misma puede dar clic <a href="http://soptravi.net/sisocs3/index.php?r='.$ficha.'/update&id='.$id.'" target="_blank">aqui</a>');
        $mail->AddAddress($correo, $nombre);
        $mail->Send();




        // Yii::import('ext.phpmailer.JPhpMailer');
                        // $mail = new JPhpMailer;
                        // $mail->IsSMTP();
                        // $mail->Host = 'smtp.soptravi.net';
                        // $mail->SMTPAuth = true;
                        // $mail->Username = 'info@soptravi.net';
                        // $mail->Password = 'Soptravi123';
                        // $mail->SetFrom('info@soptravi.net', 'SISOCS');
                        // $mail->Subject = 'SISOCS: Accion requerida';
                        // $mail->AltBody = 'Tiene una nueva revision que realizar, ';
                        // $mail->MsgHTML('Se realizaron cambios en la ficha '.$ficha.'-'.$id.', para revisar puede dar clic <a href="http://soptravi.net/sisocs/index.php?r='.$ficha.'/update&id='.$id.'" target="_blank">aqui</a>');
                        // $mail->AddAddress($correo, $nombre);
                        // $mail->Send();
    }


    public function saveMongo($projectId)
    {
        $actual_link = Yii::app()->params['NODE_URL'];
        $preOcid = Yii::app()->params['OCDS_Prefix'];
        $actual_link = $actual_link."sisocs/saveData?preOcid=".$preOcid."&ocid=".$projectId;
        //echo $actual_link . '<-  esto esta en Compoments/Controller.php';
        //throw new Exception('link: '.$actual_link);
        $curl = curl_init($actual_link);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        //   curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
        $curl_response = curl_exec($curl);
        curl_close($curl);
        //echo '<br>'; print_r($curl_response);
        //throw new Exception($curl_response);
    }

    public function listaParties()
    {
        $dat 	= Parties::model()->findAll(array("order"=>"id asc"));
        $list = CHtml::listData($dat, 'id', 'legalName');
        return $list;
    }
    public function listaCategoriasDeRiegos()
    {
        $dat 	= RiskCategory::model()->findAll(array("order"=>"id asc"));
        $list = CHtml::listData($dat, 'id', 'descripcion');
        return $list;
    }
    public function listaProyectos()
    {
        $dat 	= Proyecto::model()->findAll(array("order"=>"idProyecto asc"));
        $list = CHtml::listData($dat, 'idProyecto', 'nombre_proyecto');
        return $list;
    }
    public function listarSectores()
    {
        $dat   = Sector::model()->findAll(array("order"=>"idSector asc"));
        return $dat;
    }
    public function listaMonedas()
    {
        $dat 	= Currency::model()->findAll(array("order"=>"idCurrency asc"));
        $list = CHtml::listData($dat, 'moneda', 'moneda');
        return $list;
    }
    public function listaMonedasID()
    {
        $dat 	= Currency::model()->findAll(array("order"=>"idCurrency asc"));
        $list = CHtml::listData($dat, 'idCurrency', 'moneda');
        return $list;
    }
    public function listaMilestone()
    {
        $dat 	= ImplementationMilestone::model()->findAll(array("order"=>"id asc"));
        $list = CHtml::listData($dat, 'id', 'title');
        return $list;
    }

    public function listarDocumentType()
    {
        //$modelDocumentType = new DocumentTypes();
        $dat 	= DocumentTypes::model()->findAll(array("order"=>"idDocumentType asc"));
        $list = CHtml::listData($dat, 'title', 'title');
        return $list;
    }

    public function listaMunicipio($idDepartamento)
    {
        $dat 	= Municipio::model()->findAll(array("order"=>"idMunicipio asc",'condition'=>'idDepartamento='.$idDepartamento));
        $list = CHtml::listData($dat, 'idMunicipio', 'municipio');
        return $list;
    }

    public function listaCountry()
    {
        $dat 	= Country::model()->findAll(array("order"=>"idCountry asc"));
        $list = CHtml::listData($dat, 'descripcion', 'descripcion');
        return $list;
    }

    public function listaRegion()
    {
        $dat 	= Region::model()->findAll(array("order"=>"idRegion asc"));
        $list = CHtml::listData($dat, 'descripcion', 'descripcion');
        return $list;
    }

    public function listaDepartamento()
    {
        $dat 	= Departamento::model()->findAll(array("order"=>"idDepartamento asc"));
        $list = CHtml::listData($dat, 'departamento', 'departamento');
        return $list;
    }

    public function listaLocality()
    {
        $dat 	= Locality::model()->findAll(array("order"=>"idLocality asc"));
        $list = CHtml::listData($dat, 'descripcion', 'descripcion');
        return $list;
    }

    public function listaPartyRol()
    {
        $dat 	= PartyRol::model()->findAll(array("order"=>"idRol asc"));
        $list = CHtml::listData($dat, 'descripcion', 'descripcion');
        return $list;
    }

    public function listaFinanceCategory()
    {
        $dat 	= FinanceCategory::model()->findAll(array("order"=>"id asc"));
        $list = CHtml::listData($dat, 'descripcion', 'descripcion');
        return $list;
    }

    public function listaForecast($idProyecto)
    {
        $dat 	= Forecast::model()->findAll(array("order"=>"id asc", "condition"=>"idProyecto=".$idProyecto));
        $list = CHtml::listData($dat, 'id', 'title');
        return $list;
    }

    public function listaTipoContrato()
    {
        $dat = Yii::app()->db->createCommand("SELECT * FROM cs_tipocontrato order by idTipoContrato asc")->queryAll();
        return $dat;
    }

    public function GuardarEliminado($table, $condition)
    {
        $finDeLinea=0;
        $conteoColumna=0;
        $RecordsDeleted="";
        $registros	= Yii::app()->db->createCommand('SELECT * FROM '.$table.' WHERE '.$condition)->queryAll();
        $curdb  = explode('=', Yii::app()->db->connectionString);

        $finDeLinea = Yii::app()->db->createCommand('SELECT count(*) FROM information_schema.columns c WHERE TABLE_NAME = "'.$table.'"  AND TABLE_SCHEMA="'.$curdb[2].'"')->queryScalar();
        $Columnas = Yii::app()->db->createCommand('SELECT COLUMN_NAME c FROM information_schema.columns c WHERE TABLE_NAME = "'.$table.'" AND TABLE_SCHEMA="'.$curdb[2].'"')->queryAll();

        foreach ($registros as $key => $value) {
            foreach ($Columnas as $value2) {
                $conteoColumna++;
                if ($conteoColumna==$finDeLinea) {
                    $RecordsDeleted = $RecordsDeleted.$value[$value2['c']].'~^';
                    $conteoColumna=0;
                } else {
                    $RecordsDeleted = $RecordsDeleted.$value[$value2['c']].'~';
                }
            }
        }
        Yii::app()->db->createCommand('INSERT INTO cs_logDeletes (idUser,tabla,registros)VALUES('.Yii::app()->user->id.',"'.$table.'","'.$RecordsDeleted.'")')->execute();
    }

    public function GuardarEliminado2($table, $condition, $table2, $condition2)
    {
        $finDeLinea=0;
        $conteoColumna=0;
        $RecordsDeleted="";
        $registros	= Yii::app()->db->createCommand('SELECT * FROM '.$table.' WHERE '.$condition)->queryAll();
        $curdb  = explode('=', Yii::app()->db->connectionString);

        $finDeLinea = Yii::app()->db->createCommand('SELECT count(*) FROM information_schema.columns c WHERE TABLE_NAME = "'.$table.'"  AND TABLE_SCHEMA="'.$curdb[2].'"')->queryScalar();
        $Columnas = Yii::app()->db->createCommand('SELECT COLUMN_NAME c FROM information_schema.columns c WHERE TABLE_NAME = "'.$table.'" AND TABLE_SCHEMA="'.$curdb[2].'"')->queryAll();

        foreach ($registros as $key => $value) {
            foreach ($Columnas as $value2) {
                $conteoColumna++;
                if ($conteoColumna==$finDeLinea) {
                    $RecordsDeleted = $RecordsDeleted.$value[$value2['c']].'~^';
                    $conteoColumna=0;
                } else {
                    $RecordsDeleted = $RecordsDeleted.$value[$value2['c']].'~';
                }
            }
        }
        Yii::app()->db->createCommand('INSERT INTO cs_logDeletes (idUser,tabla,registros)VALUES('.Yii::app()->user->id.',"'.$table.'","'.$RecordsDeleted.'")')->execute();
    }


    public function enviarCorreo($idFormulario, $id)
    {
        //---------- Obtiene el correo del responsable del programa
        $ficha = '';
        $correo = '';
        $nombre = '';
        if ($idFormulario>=7) { // Avances
            if ($idFormulario==7) {
                $ficha = 'Avances';
                $idtmp = $id;
            };
            $idtmp = Avances::model()->findByPk($idtmp)->codigo_inicio_ejecucion;
        };
        if ($idFormulario>=6) { // InicioEjecucion
            if ($idFormulario==6) {
                $ficha = 'InicioEjecucion';
                $idtmp = $id;
            };
            $idtmp = InicioEjecucion::model()->find(array(
                                                            'select'=>'idContratacion',
                                                            'condition'=>'idContratacion=:idContratacion',
                                                            'params'=>array(':idContratacion'=>80),
                                                         ))->idContratacion;
        };
        if ($idFormulario>=5) { // Contratos (Gestion)
            if ($idFormulario==5) {
                $ficha = 'Contratos';
                $idtmp = Contratos::model()->findByPk($id)->idContratacion;
            }
        };
        if ($idFormulario>=4) { // Contratacion
            if ($idFormulario==4) {
                $ficha = 'Contratacion';
                $idtmp = $id;
            };
            $idtmp = Contratacion::model()->findByPk($idtmp)->idAdjudicacion;
        };
        if ($idFormulario>=3) { // Adjudicacion
            if ($idFormulario==3) {
                $ficha = 'Adjudicacion';
                $idtmp = $id;
            };
            $idtmp = Adjudicacion::model()->findByPk($idtmp)->idCalificacion;
        };
        if ($idFormulario>=2) { // Calificacion
            if ($idFormulario==2) {
                $ficha = 'Calificacion';
                $idtmp = $id;
            };
            $idtmp = Calificacion::model()->findByPk($idtmp)->idProyecto;
        };
        if ($idFormulario>=1) { // Proyecto
            if ($idFormulario==1) {
                $ficha = 'Proyecto';
                $idtmp = $id;
            };
            $idtmp = Proyecto::model()->findByPk($idtmp)->idPrograma;
        };
        if ($idtmp != 0) { // Funcionario
                $correo = Funcionarios::model()->findByPk($idtmp)->correo; // Validar que sea una direccion de correo valida
                $nombre = Funcionarios::model()->findByPk($idtmp)->nombre;
        };
        //---------------------------------------------------------

        Yii::import('ext.phpmailer.JPhpMailer');
        $mail = new JPhpMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.soptravi.net';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@soptravi.net';
        $mail->Password = 'Soptravi123';
        $mail->SetFrom('info@soptravi.net', 'SISOCS');
        $mail->Subject = 'SISOCS: Accion requerida';
        $mail->AltBody = 'Tiene una nueva revision que realizar,  ';
        $mail->MsgHTML('Tiene una nueva solicitud, para trabajar en la misma puede dar clic <a href="http://soptravi.net/sisocs/index.php?r='.$ficha.'/update&id='.$id.'" target="_blank">aqui</a>');
        $mail->AddAddress($correo, $nombre);
        $mail->Send();
        echo '
			<script type="text/javascript">
			alert("Envio Correo!");
			</script>
			';
    }

    /*
       public function ListaEstados()
    {
        $dat= Estado::model()->findAll();
        $list = CHtml::listData($dat,'estado', 'estado');
        return $list ;
    }
    */

    public function linkhttp($l)
    {
        if (CASE_LOWER(substr($l, 0, 4))=="http") {
            //return  '<a href='.$l.'>'.$l.'</a>';
            return $l;
        } else {/*
        $AttPath = Yii::app()->Controller->getParameter('AttPath');
        $path = Yii::getPathOfAlias($AttPath);

        $CountryCode = Yii::app()->Controller->getParameter('countryCode');
        $path = Yii::getPathOfAlias("$AttPath.$CountryCode");

        $ORG_ID = Yii::app()->Controller->getParameter('ORG_ID');
        $path = Yii::getPathOfAlias("$AttPath.$CountryCode.$ORG_ID");

        $base = "$AttPath.$CountryCode.$ORG_ID";*/

            //return  '<a href='.Yii::app()->baseUrl . '/images/'.$l.'>'.Yii::app()->baseUrl . '/images/'.$l.'</a>';
            return Yii::app()->baseUrl . $l;
        }
    }
}
