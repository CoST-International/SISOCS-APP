<?php

/**
 * This is the model class for table "{{calificacion}}".
 *
 * The followings are the available columns in table '{{calificacion}}':
 * @property integer $idCalificacion
 * @property integer $idProyecto
 * @property string $numproceso
 * @property string $nomprocesoproyecto
 * @property integer $idEnte
 * @property integer $idFuncionario
 * @property string $proceseval
 * @property string $invitainter
 * @property string $basespreca
 * @property string $resolucion
 * @property string $convocainvi
 * @property string $tdr
 * @property string $aclaraciones
 * @property string $actarecpcion
 * @property string $fechapublicado
 * @property string $tipocontrato
 * @property string $estado
 * @property string $otro
 * @property integer $idmetodo
 * @property string $fechacreacion
 * @property integer $idTipoContrato

 * @property string $contract_startDate
 * @property string $award_startDate
 * @property string $enquiry_startDate
 * @property string $tender_startDate
 * @property string $contract_endDate
 * @property string $award_endDate
 * @property string $enquiry_endDate
 * @property string $tender_endDate
 * @property string $contract_maxExtentDate
 * @property string $award_maxExtentDate
 * @property string $enquiry_maxExtentDate
 * @property string $tender_maxExtentDate
 * @property string $contract_durationInDays
 * @property string $award_durationInDays
 * @property string $enquiry_durationInDays
 * @property string $tender_durationInDays
 *
 * The followings are the available model relations:
 * @property Funcionarios $idFuncionario0
 * @property Entes $idEnte0
 * @property Metodo $idmetodo0
 * @property Tipocontrato $idTipoContrato0
 * @property Oferente[] $csOferentes
 */
class Calificacion extends CActiveRecord
{
	public $image1, $image2, $image3, $image4, $image5, $image6, $image7, $image8, $image9;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{calificacion}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idProyecto, fecha_creacion', 'required'),
			array('idProyecto, idEnte, idUnidad, idFuncionario, idRol, idTipoContrato, idMetodo, usuario_creacion, usuario_publicacion', 'numerical', 'integerOnly'=>true),
			array('numproceso', 'length', 'max'=>25),
			array('nomprocesoproyecto', 'length', 'max'=>2000),
			array('proceseval', 'length', 'max'=>100),
			array('invitainter, resolucion, convocainvi, aclaraciones', 'length', 'max'=>254),
			array('basespreca, tdr, actarecpcion, otro', 'length', 'max'=>150),
			array('estado', 'length', 'max'=>25),
			array('fecha_publicacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
		array('image1, image2, image3, image4, image5, image6, image7, image8, image9,idCalificacion, idProyecto, numproceso, nomprocesoproyecto, idEnte, idUnidad, idFuncionario, idRol, proceseval, invitainter, basespreca, resolucion, convocainvi, tdr, aclaraciones, actarecpcion, idTipoContrato, idMetodo, otro, estado, usuario_creacion, fecha_creacion, usuario_publicacion, fecha_publicacion, contract_startDate, award_startDate, enquiry_startDate, tender_startDate, contract_endDate, award_endDate, enquiry_endDate, tender_endDate, contract_maxExtentDate, award_maxExtentDate, enquiry_maxExtentDate, tender_maxExtentDate, contract_durationInDays, award_durationInDays, enquiry_durationInDays, tender_durationInDays', 'safe'/*, 'on'=>'search'*/),
                        array('image1, image2, image3, image4, image5, image6, image7, image8, image9', 'file', 'types' => 'jpg, png, pdf, doc, docx, txt, xlsx, xls', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 200, 'tooLarge' => 'El archivo es mas largo de 200MB, por favor seleccione un archivo mas pequeño.'),

                    );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'adjudicacions' => array(self::HAS_MANY, 'Adjudicacion', 'idCalificacion'),
			'idFuncionario0' => array(self::BELONGS_TO, 'Funcionarios', 'idFuncionario'),
			'idEnte0' => array(self::BELONGS_TO, 'Entes', 'idEnte'),
			'idMetodo0' => array(self::BELONGS_TO, 'Metodo', 'idMetodo'),
			'idProyecto0' => array(self::BELONGS_TO, 'Proyecto', 'idProyecto'),
			'idTipoContrato0' => array(self::BELONGS_TO, 'Tipocontrato', 'idTipoContrato'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idCalificacion' => 'Codigo',
			'idProyecto' => 'Proyecto',
			'numproceso' => 'Numero del Proceso',
			'nomprocesoproyecto' => 'Nombre del Proceso',
			'idEnte' => 'Entidad de adquisición (Unidad Ejecutora)',
			'idUnidad' => 'Unidad Responsable',
			'idFuncionario' => 'Funcionario responsable',
			'idRol' => 'Rol',
			'proceseval' => 'Proceso de Evaluacion',
			'invitainter' => 'Invitación a los interesados para participar en el proceso de calificacion para la ejecucion del proyecto o en la calificacion para el concurso para la supervicion de obras',
			'basespreca' => 'Bases de Precalificación o Calificación',
			'resolucion' => 'Resolución declarando la precalificación',
			'convocainvi' => 'Convocatoria o invitación a licitar o concursar',
			'tdr' => 'Pliego de Condiciones o Bases del Concurso (TdR)',
			'aclaraciones' => 'Aclaraciones o Enmiendas al Pliego de Condiciones',
			'actarecpcion' => 'Acta de recepción/ presentación de ofertas',
			'idTipoContrato' => 'Tipo de Contrato',
			'idMetodo' => 'Tipo de Adquisición',
			'otro' => 'Otro',
			'estado' => 'Estado',
			'usuario_creacion' => 'Usuario Creacion',
			'fecha_creacion' => 'Fecha Creacion',
			'usuario_publicacion' => 'Usuario Publicacion',
			'fecha_publicacion' => 'Fecha de publicación',
			'contract_startDate'=> 'Fecha de Inicio del Contrato',
			'contract_endDate'=>'Fecha Final del Contrato',
			'award_startDate'=>'Fecha de Inicio de la Adjudicación',
			'enquiry_startDate'=>'Fecha de Inicio Para Pedir Informe',
			'enquiry_endDate'=>'Fecha Final Para Pedir Informe',
			'tender_startDate'=>'Fecha de Inicico de la Calificación',
			'tender_endDate'=>'Fecha Final de la Calificación',
			'contract_maxExtentDate'=>'Fecha Extendida del Contrato',
			'contract_durationInDays'=>'Duración en Días del Contrato',
			'award_maxExtentDate'=>'Fecha Extendida de la Adjudicación',
			'award_durationInDays'=>'Duración en Días de la Adjudicación',
			'enquiry_maxExtentDate'=>'Fecha Extendida Para Pedir Informe`',
			'enquiry_durationInDays'=>'Duración en Días Para Pedir Informe',
			'tender_maxExtentDate'=>'Fecha Extendida de la Calificación`',
			'tender_durationInDays'=>'Duración en Días de la Calificación',

			'award_endDate'=>'Fecha Final de la Adjudicación'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idCalificacion',$this->idCalificacion);
		$criteria->compare('idProyecto',$this->idProyecto);
		$criteria->compare('numproceso',$this->numproceso,true);
		$criteria->compare('nomprocesoproyecto',$this->nomprocesoproyecto,true);
		$criteria->compare('idEnte',$this->idEnte);
		$criteria->compare('idFuncionario',$this->idFuncionario);
        $criteria->compare('idUnidad',$this->idUnidad);
        $criteria->compare('idRol',$this->idRol);
		$criteria->compare('proceseval',$this->proceseval,true);
		$criteria->compare('invitainter',$this->invitainter,true);
		$criteria->compare('basespreca',$this->basespreca,true);
		$criteria->compare('resolucion',$this->resolucion,true);
		$criteria->compare('convocainvi',$this->convocainvi,true);
		$criteria->compare('tdr',$this->tdr,true);
		$criteria->compare('aclaraciones',$this->aclaraciones,true);
		$criteria->compare('actarecpcion',$this->actarecpcion,true);
		$criteria->compare('fecha_publicacion',$this->fecha_publicacion,true);
		//$criteria->compare('tipocontrato',$this->tipocontrato,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('otro',$this->otro,true);
		$criteria->compare('idMetodo',$this->idMetodo);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('idTipoContrato',$this->idTipoContrato);
        $criteria->compare('usuario_creacion',$this->usuario_creacion);
        $criteria->compare('usuario_publicacion',$this->usuario_publicacion);

        if (!Yii::app()->user->isSuperAdmin) {
            $criteria->addSearchCondition('t.usuario_creacion', Yii::app()->user->id, true, 'AND');
            $criteria->addSearchCondition('t.estado', 'BORRADOR', true, 'AND');
            if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
                $criteria->addSearchCondition('t.estado', 'REVISIÓN', true, 'OR');
            }

        }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array('defaultOrder'=>'t.idCalificacion DESC'),
			'pagination'=>false
		));
	}

	public function published()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idCalificacion',$this->idCalificacion,true);
		$criteria->compare('idProyecto',$this->idProyecto);
		$criteria->compare('numproceso',$this->numproceso,true);
		$criteria->compare('nomprocesoproyecto',$this->nomprocesoproyecto,true);
		$criteria->compare('idMetodo',$this->idMetodo);

        $criteria->addSearchCondition('t.estado', 'PUBLICADO', true, 'AND');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array('defaultOrder'=>'t.idCalificacion DESC'),
			'pagination'=>false
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Calificacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/***************************************************************************************************/
	/******************** CUSTOM FUNCTION **************************************************************/
	/***************************************************************************************************/


	public function listaProyectos()
	{
            /*
		$dat= Proyecto::model()->findAll();
		$list = CHtml::listData($dat,'idProyecto', 'nombre_proyecto');
		return $list ;
                */
            $dat = Proyecto::model()->findAll(array('order' => 'idProyecto ASC'));
            $list = array();

            foreach ($dat as $row) {
            	$list[$row->idProyecto] = '('.substr(str_pad($row->idProyecto,10,' ',STR_PAD_LEFT),0,10).') '.$row->nombre_proyecto;
            }

            return $list ;
	}

		public function listaProyectosID($idCreate)
	{
				$dat = Proyecto::model()->findAll('idProyecto=\''.$idCreate.'\'');
				//$list = CHtml::listData($dat, 'idProyecto', 'nombre_proyecto');

				 $list = array();

            foreach ($dat as $row) {
            	$list[$row->idProyecto] = '('.substr(str_pad($row->idProyecto,10,' ',STR_PAD_LEFT),0,10).') '.$row->nombre_proyecto;
            }

				return $list;


	}

        public function arregloBusqueda(){
            $proyectos=  Proyecto::model()->findAll();
            $arreglo=array();
            foreach ($proyectos as $proyecto){
                array_push($arreglo, $proyecto->nombre_proyecto);
            }
            //print_r($arreglo);
            return $arreglo;
        }

        public function listaRol(){
            $dat=  Rol::model()->findAll();
            $list = CHtml::listData($dat,'idRol', 'rol');
	    return $list ;
        }

				public function listaRolConsultado($idEnte){
            //$dat=  Rol::model()->findAll();
						$dat   = Yii::app()->db->createCommand('SELECT * FROM `cs_entes` WHERE idEnte ='.$idEnte)->queryAll();
            $list = CHtml::listData($dat,'idRol', 'rol');
	    return $list ;
        }

	public function listaEntes()
	{
		$dat= Entes::model()->findAll();
		$list = CHtml::listData($dat,'idEnte', 'descripcion');
		return $list ;
	}


	public function listaUnidad()
	{
		$dat= EntesUnidad::model()->findAll();
		$list = CHtml::listData($dat,'idUnidad', 'nombre');
		return $list ;
	}

	 public function listaAdjudicaciones($id){

        $dat = Adjudicacion::model()->findAll('idCalificacion=\''.$id.'\'');

		            $list = array();

            foreach ($dat as $row) {
            	$list[$row->idAdjudicacion] = '('.substr(str_pad($row->idAdjudicacion,10,' ',STR_PAD_LEFT),0,10).') '.$row->numproceso;
            }



        //if(count($dat)==0){
          //  $dat = Adjudicacion::model()->findAll();
        //}
       //$list = CHtml::listData($dat, 'idAdjudicacion', 'numproceso');
        return $list;
    }


	public function listaFuncionarios()
	{
		$dat= Funcionarios::model()->findAll();
		$list = CHtml::listData($dat,'idFuncionario', 'nombre');
		return $list ;
	}

	public function listaTipocontrato()
	{
		$dat= Tipocontrato::model()->findAll();
		$list = CHtml::listData($dat,'idTipoContrato','contrato');
		return $list ;
	}

	public function listaMetodo()
	{
		$dat= Metodo::model()->findAll();
		$list = CHtml::listData($dat,'idMetodo', 'adquisicion');
		return $list ;
	}

	public function listaEstados() {
		$criteria = new CDbCriteria;
		$criteria->condition = '1';
		if (!Yii::app()->user->isSuperAdmin) {
			if (!Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
				$criteria->condition = "(estado = 'BORRADOR' OR estado = 'REVISION' OR estado = 'REVISÓN')";
			}
		}

		$dat = Estado::model()->findAll($criteria);
		$list = CHtml::listData($dat, 'estado', 'estado');
		return $list;
	}

    public function Usuario($id){
      $nameUser="";
      if($id==0){
          $nameUser="NO Asignado";
      }else{
          try{
          $usuario = Yii::app()->user->um->loadUserById($id);
          $nameUser=$usuario->username;
      }catch(Exception $ex){
          $nameUser="No Asignado";
      }
      }

      return $nameUser ;
  }
}
