<?php

    /**
        * This is the model class for table "{{contratacion}}".
        *
        * The followings are the available columns in table '{{contratacion}}':
        * @property string $idContratacion
        * @property string $idAdjudicacion
        * @property integer $idEntidad
        * @property integer $idoferente
        * @property double $precioLPS
        * @property double $precioUSD
        * @property string $alcances
        * @property string $fechainicio
        * @property string $fechafinal
        * @property string $duracioncontrato
        * @property string $documentocontra
        * @property string $regante
        * @property string $espeplanos
        * @property string $estado
        * @property string $otro
        * @property string $ncontrato
        * @property string $titulocontrato
        *
        * The followings are the available model relations:
        * @property Adjudicacion $idAdjudicacion0
        * @property Contratos[] $contratoses
    */
    class Contratacion extends CActiveRecord
    {
        public $image1, $image2, $image3, $image4;

        /**
            * @return string the associated database table name
        */
        public function tableName()
        {
            return '{{contratacion}}';
        }

        /**
            * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
			array('idAdjudicacion, fecha_creacion', 'required'),
			array('idAdjudicacion, idEntidad,  usuario_creacion, usuario_publicacion', 'numerical', 'integerOnly'=>true),
			array('precioLPS, precioUSD', 'numerical'),
			array('fechainicio, fechafinal', 'length', 'max'=>10),
			array('duracioncontrato', 'length', 'max'=>65),
			array('documentocontra, regante, espeplanos', 'length', 'max'=>254),
			array('otro', 'length', 'max'=>150),
			array('ncontrato', 'length', 'max'=>20),
			array('titulocontrato', 'length', 'max'=>500),
			array('estado', 'length', 'max'=>25),
			array('alcances, fecha_publicacion', 'safe'),

            array('image1, image2, image3, image4', 'file', 'types' => 'jpg, png, pdf, doc, docx, txt, xlsx, xls', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 200, 'tooLarge' => 'El archivo es mas largo de 200MB, por favor seleccione un archivo mas pequeño.'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('image1, image2, image3, image4, idContratacion, idAdjudicacion, idEntidad,  precioLPS, precioUSD, alcances, fechainicio, fechafinal, duracioncontrato, documentocontra, regante, espeplanos, estado, otro, ncontrato, titulocontrato, fecha_publicacion, fecha_creacion', 'safe', 'on'=>'search', 'on'=>'insert', 'on'=>'update'),
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
			'idAdjudicacion0' => array(self::BELONGS_TO, 'Adjudicacion', 'idAdjudicacion'),
			'contratoses' => array(self::HAS_MANY, 'Contratos', 'idContratacion'),
			'idEntidad0'=>array(self::BELONGS_TO,'Entes','idEntidad'),
		);
        }

        /**
            * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
			'idContratacion' => 'Id de Contratación',
			'idAdjudicacion' => 'Id de Adjudicación',
			'idEntidad' => 'Entidad de Administración de Contrato',
			'precioLPS' => 'Precio total del Contrato en Lps',
			'precioUSD' => 'Precio total del Contrato en USD', 
			'alcances' => 'Alcances de Trabajo en el Contrato',
			'fechainicio' => 'Fecha de Inicio',
			'fechafinal' => 'Fecha de Finalización',
			'duracioncontrato' => 'Duración del Contrato',
			'documentocontra' => 'Documento de Contrato y Condiciones',
			'regante' => 'Registro, Antecedentes e Información del Consultor o Propietario(s) de la Firma Contratada',
			'espeplanos' => 'Especificaciones y Planos de las Obras',
			'estado' => 'Estado',
			'otro' => 'Otro',
			'ncontrato' => 'Número del Contrato',
			'titulocontrato' => 'Titulo del Contrato',
                        'fecha_publicacion'=>'Fecha de publicación',
                        'usuario_publicacion' => 'Usuario Publicacion',
			'fecha_creacion'=>'Fecha de Creación',
                        'usuario_creacion' => 'Usuario Creacion',
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
            $criteria->compare('idContratacion',$this->idContratacion,true);
            $criteria->compare('idAdjudicacion',$this->idAdjudicacion,true);
            $criteria->compare('idEntidad',$this->idEntidad);
            $criteria->compare('precioLPS',$this->precioLPS);
            $criteria->compare('precioUSD',$this->precioUSD);
            $criteria->compare('alcances',$this->alcances,true);
            $criteria->compare('fechainicio',$this->fechainicio,true);
            $criteria->compare('fechafinal',$this->fechafinal,true);
            $criteria->compare('duracioncontrato',$this->duracioncontrato,true);
            $criteria->compare('documentocontra',$this->documentocontra,true);
            $criteria->compare('regante',$this->regante,true);
            $criteria->compare('espeplanos',$this->espeplanos,true);
            $criteria->compare('estado',$this->estado,true);
            $criteria->compare('otro',$this->otro,true);
            $criteria->compare('ncontrato',$this->ncontrato,true);
            $criteria->compare('titulocontrato',$this->titulocontrato,true);
            $criteria->compare('fecha_publicacion',$this->fecha_publicacion,true);
            $criteria->compare('usuario_creacion',$this->usuario_creacion);

            if (!Yii::app()->user->isSuperAdmin) {
                $criteria->addSearchCondition('estado', 'BORRADOR', true, 'AND');
            }

            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
            ));
        }

        /**
            * Returns the static model of the specified AR class.
            * Please note that you should have this exact method in all your CActiveRecord descendants!
            * @param string $className active record class name.
            * @return Contratacion the static model class
        */
        public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }

	public function listaGesContra($id){


        $dat = Contratos::model()->findAll('idContratacion=\''.$id.'\'');
        if(count($dat)==0){
            $dat = Contratos::model()->findAll();
        }
        $list = CHtml::listData($dat, 'idContratos', 'idContratacion0.titulocontrato');
        return $list;
    }

        public function listaEstados()
        {
            $dat= Estado::model()->findAll();
            $list = CHtml::listData($dat,'estado', 'estado');
            return $list ;
        }

        public function listaAdjudicacion()
        {
            $dat = Adjudicacion::model()->findAll(array('order' => 'idAdjudicacion ASC'));
            $list = array();

            foreach ($dat as $row) {
            	$list[$row->idAdjudicacion] = '('.substr(str_pad($row->idAdjudicacion,10,' ',STR_PAD_LEFT),0,10).') '.$row->numproceso;
            }

            return $list ;
        }


		public function listaAdjudicacionID()
        {

						$dat = Adjudicacion::model()->findAll('idAdjudicacion=\''.$idCreate.'\'');
				//$list = CHtml::listData($dat, 'idProyecto', 'nombre_proyecto');

			$list = array();

            foreach ($dat as $row) {
            	$list[$row->idAdjudicacion] = '('.substr(str_pad($row->idAdjudicacion,10,' ',STR_PAD_LEFT),0,10).') '.$row->numproceso;
            }

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
