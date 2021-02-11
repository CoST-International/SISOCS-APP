<?php
    
    /**
        * This is the model class for table "{{contratacion}}".
        *
        * The followings are the available columns in table '{{contratacion}}':
        * @property string $idContratacion
        * @property string $idAdjudicacion
        * @property integer $idEntidad
        * @property integer $idoferente
        * @property double $precio
        * @property double $precio2
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
			array('idAdjudicacion, precio2', 'required'),
			array('idAdjudicacion, idEntidad, idoferente', 'numerical', 'integerOnly'=>true),
			array('precio, precio2', 'numerical'),
			array('fechainicio, fechafinal, fecharecibido, fechacreacion', 'length', 'max'=>10),
			array('duracioncontrato', 'length', 'max'=>65),
			array('documentocontra', 'length', 'max'=>254),
			array('regante, espeplanos, otro', 'length', 'max'=>150),
			array('estado', 'length', 'max'=>25),
			array('ncontrato', 'length', 'max'=>20),
			array('titulocontrato', 'length', 'max'=>500),
			array('alcances', 'safe'),
            
            array('image1, image2, image3, image4', 'file', 'types' => 'jpg, png, pdf, doc, docx, txt, xlsx, xls', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 200, 'tooLarge' => 'El archivo es mas largo de 200MB, por favor seleccione un archivo mas pequeño.'), 
            
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('image1, image2, image3, image4, idContratacion, idAdjudicacion, idEntidad, idoferente, precio, precio2, alcances, fechainicio, fechafinal, duracioncontrato, documentocontra, regante, espeplanos, estado, otro, ncontrato, titulocontrato, fecharecibido, fechacreacion', 'safe', 'on'=>'search', 'on'=>'insert', 'on'=>'update'),
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
			'idoferente' => 'Consultor / Firma Contratada',
			'precio' => 'Precio Total del Contrato (Lempiras)',
			'precio2' => 'Precio Total del Contrato (USD)',
			'alcances' => 'Alcances de Trabajo en el Contrato',
			'fechainicio' => 'Fecha de Inicio',
			'fechafinal' => 'Fecha de Finalización',
			'duracioncontrato' => 'Duración del Contrato',
			'documentocontra' => 'Documento de Contrato y Condiciones',
			'regante' => 'Registro, Antecedentes e Información del Consultor o Propietario(s) de la Firma Contratada',
			'espeplanos' => 'Especificaciones y Planos del Proyecto a Ejecutar Cuando Corresponda.',
			'estado' => 'Estado',
			'otro' => 'Otro',
			'ncontrato' => 'Número del Contrato',
			'titulocontrato' => 'Titulo del Contrato',
            'fecharecibido'=>'Fecha en que Recibió la Información',
			'fechacreacion'=>'Fecha de Creación de la Ficha'
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
            $criteria->compare('idoferente',$this->idoferente);
            $criteria->compare('precio',$this->precio);
            $criteria->compare('precio2',$this->precio);
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
            $criteria->compare('fechacreacion',$this->fechacreacion,true);
            
            if (!Yii::app()->user->isSuperAdmin) {
                $criteria->addSearchCondition('estado', 'BORRADOR', true, 'AND');
            } 
            
            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
            ));
            
            
            /* if (Yii::app()->user->isSuperAdmin) {
                return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,//array('condition'=>'estado ="PUBLICADO"',),//
                ));
            } else {
                return new CActiveDataProvider($this, array(
                'criteria'=>array('condition'=>'estado ="BORRADOR"',),//
                ));
            }  */
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
        
        public function listaEstados()
        {
            $dat= Estado::model()->findAll();
            $list = CHtml::listData($dat,'estado', 'estado');
            return $list ;
        }
        
        public function listaAdjudicacion()
        {
            $dat= Adjudicacion::model()->findAll();
            $list = CHtml::listData($dat,'idAdjudicacion','idAdjudicacion');
            return $list ;  
        }
        
        public function listaEmpresas()
        {
            $dat= Empresa::model()->findAll();
            $list = CHtml::listData($dat,'idempresa', 'nombre_empresa');
            return $list ;
        }
    }
