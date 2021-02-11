<?php
    
    /**
        * This is the model class for table "{{programa}}".
        *
        * The followings are the available columns in table '{{programa}}':
        * @property string $idPrograma
        * @property string $programa
        * @property string $BIP
        * @property string $nombreprograma
        * @property string $entes
        * @property string $idFuncionario
        * @property string $idRol
        * @property string $idSector
        * @property string $idSubSector
        * @property string $descripcion
        * @property double $costoesti
        * @property string $fechaapro
        * @property string $cartaconvenio
        * @property string $otro1
        * @property string $planope
        * @property string $presupuesto
        * @property string $perfildelprogra
        * @property string $otro2
        * @property string $fechacreacion
        * @property string $estado
        *
        * The followings are the available model relations:
        * @property Funcionarios $idFuncionario0
        * @property Rol $idRol0
        * @property Sector $idSector0
        * @property Subsector $idSubSector0
        * @property Fuentesfinan[] $csFuentesfinans
        * @property Proposito[] $csPropositos
        * @property Ubicacionvial[] $csUbicacionvials
        * @property Proyecto[] $proyectos
    */
    class Programa extends CActiveRecord
    {
        public $image1, $image2, $image3, $image4, $image5, $image6;
        
        /**
            * @return string the associated database table name
        */
        public function tableName()
        {
            return '{{programa}}';
        }
        
        /**
            * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
			array('programa', 'required'),
			array('costoesti', 'numerical'),
			array('programa, BIP', 'length', 'max'=>20),
			array('nombreprograma', 'length', 'max'=>255),
			array('ubicacion', 'length', 'max'=>500),
			array('entes', 'length', 'max'=>15),
            array('idFuncionario', 'length', 'max'=>45),
			array('idRol, idSector, idSubSector', 'length', 'max'=>10),
			array('descripcion', 'length', 'max'=>900),
			//array('cartaconvenio, otro1, planope, presupuesto, perfildelprogra, otro2', 'length', 'max'=>150),
			array('estado', 'length', 'max'=>25),
			array('fechaapro, fechacreacion', 'safe'),
            array('moneda','length', 'max'=>25),
            array('fecharecibido','length', 'max'=>10),
            
            array('image1, image2, image3, image4, image5, image6', 'file', 'types' => 'jpg, png, pdf, doc, docx, txt, xlsx, xls', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 200, 'tooLarge' => 'El archivo es mas largo de 200MB, por favor seleccione un archivo mas pequeño.'),
            
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('image1, image2, image3, image4, image5, image6, idPrograma, programa, BIP, nombreprograma,ubicacion, entes, idFuncionario, idRol, idSector, idSubSector, descripcion, costoesti, fechaapro, cartaconvenio, otro1, planope, presupuesto, perfildelprogra, otro2, fechacreacion,fecharecibido, estado', 'safe', 'on'=>'search'),
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
			'idFuncionario0' => array(self::BELONGS_TO, 'Funcionarios', 'idFuncionario'),
			'idRol0' => array(self::BELONGS_TO, 'Rol', 'idRol'),
			'idSector0' => array(self::BELONGS_TO, 'Sector', 'idSector'),
			'idSubSector0' => array(self::BELONGS_TO, 'Subsector', 'idSubSector'),
			'csFuentesfinans' => array(self::MANY_MANY, 'Fuentesfinan', '{{programa_fuente}}(idPrograma, idFuente)'),
			'csPropositos' => array(self::MANY_MANY, 'Proposito', '{{programa_proposito}}(idprograma, idproposito)'),
			'csUbicacionvials' => array(self::MANY_MANY, 'Ubicacionvial', '{{programa_ubicacion}}(idprograma, idubicacion)'),
			'proyectos' => array(self::HAS_MANY, 'Proyecto', 'idPrograma'),
			'entes0' => array(self::BELONGS_TO, 'Entes', 'entes'),
            );
        }
        
        /**
            * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
			'idPrograma' => 'Id Programa',
			'programa' => 'Código del programa',
			'BIP' => 'BIP',
			'nombreprograma' => 'Nombre del programa',
			'ubicacion' => 'Ubicación',
			'entes' => 'Ente resposable',
			'idFuncionario' => 'Funcionario responsable del programa',
			'idRol' => 'Rol',
			'idSector' => 'Sector',
			'idSubSector' => 'Sub sector vial',
			'descripcion' => 'Descripción detallada del programa y alcances',
			'costoesti' => 'Presupuesto aprobado del programa',
			'fechaapro' => 'Fecha de aprobación del presupuesto del programa(día-mes-año)',
			'cartaconvenio' => 'Carta convenio de crédito o de fondos no reembolsables, incluyendo perfil del programa y presupuesto',
			'otro1' => 'Otro',
			'planope' => 'Plan operativo anual del órgano responsable del programa',
			'presupuesto' => 'Presupuesto aprobado',
			'perfildelprogra' => 'Perfil del programa',
			'otro2' => 'Otro2',
			'fechacreacion' => 'Fecha de creación de la Ficha',
			'fecharecibido'=>'Fecha en que recibió la información',
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
            $criteria->compare('idPrograma',$this->idPrograma,true);
            $criteria->compare('programa',$this->programa,true);
            $criteria->compare('BIP',$this->BIP,true);
            $criteria->compare('nombreprograma',$this->nombreprograma,true);
            $criteria->compare('ubicacion',$this->ubicacion,true);
            $criteria->compare('entes',$this->entes,true);
            $criteria->compare('idFuncionario',$this->idFuncionario,true);
            $criteria->compare('idRol',$this->idRol,true);
            $criteria->compare('idSector',$this->idSector,true);
            $criteria->compare('idSubSector',$this->idSubSector,true);
            $criteria->compare('descripcion',$this->descripcion,true);
            $criteria->compare('costoesti',$this->costoesti);
            $criteria->compare('fechaapro',$this->fechaapro,true);
            $criteria->compare('cartaconvenio',$this->cartaconvenio,true);
            $criteria->compare('otro1',$this->otro1,true);
            $criteria->compare('planope',$this->planope,true);
            $criteria->compare('presupuesto',$this->presupuesto,true);
            $criteria->compare('perfildelprogra',$this->perfildelprogra,true);
            $criteria->compare('otro2',$this->otro2,true);
            $criteria->compare('fechacreacion',$this->fechacreacion,true);
            $criteria->compare('estado',$this->estado,true);
            $criteria->compare('idFuncionario0.nombre',$this->estado,true);
            
            
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
                }else{
                return new CActiveDataProvider($this, array(
                'criteria'=>array('condition'=>'estado ="BORRADOR"',),//
                ));
            } */
        }
        
        /**
            * Returns the static model of the specified AR class.
            * Please note that you should have this exact method in all your CActiveRecord descendants!
            * @param string $className active record class name.
            * @return Programa the static model class
        */
        public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }
        
        public function listaFuncionarios()
        {
            $dat= Funcionarios::model()->findAll();
            $list = CHtml::listData($dat,'idfuncionario', 'nombre');
            return $list ;
        }
        
        
        public function listaEstados()
        {
            $dat= Estado::model()->findAll();
            $list = CHtml::listData($dat,'estado', 'estado');
            return $list ;
        }
        
        public function listaFuentes()
        {
            $dat=  Fuentesfinan::model()->findAll();
            $list = CHtml::listData($dat,'id','fuente');
            return $list ;  
        }
        
        public function listaEntes()
        {
            $dat= Entes::model()->findAll();
            $list = CHtml::listData($dat,'idente', 'descripcion');
            return $list ;
        }
        
        public function listaPropositos()
        {
            $dat= Proposito::model()->findAll();
            $list = CHtml::listData($dat,'idproposito', 'proposito');
            return $list ;
        }
        
        public function listaSector()
        {
            $dat= Sector::model()->findAll();
            $list = CHtml::listData($dat,'idsector', 'sector');
            return $list ;
        }
        
        public function listaSubSector()
        {
            $dat= Subsector::model()->findAll();
            $list = CHtml::listData($dat,'idSubSector', 'subsector');
            return $list ;
        }
        
        public function listaMoneda()
        {
            $dat= Monedas::model()->findAll();
            $list = CHtml::listData($dat,'moneda', 'moneda');
            return $list ;
        }
        
        public function listaRol()
        {
            $dat= Rol::model()->findAll();
            $list = CHtml::listData($dat,'idrol', 'rol');
            return $list ;
        }
        
        public function nombreFuente($p) {
            $dt=  Fuentesfinan::model()->findPk($p);
            return $dt->fuente;
        }
        
        
    }
