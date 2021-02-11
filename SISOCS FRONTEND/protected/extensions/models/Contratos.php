<?php
    
    /**
        * This is the model class for table "{{contratos}}".
        *
        * The followings are the available columns in table '{{contratos}}':
        * @property string $idContratos
        * @property string $idContratacion
        * @property string $estatuscontrato
        * @property integer $nmodifica
        * @property string $fecha
        * @property string $tipomodifica
        * @property string $justimodcontrato
        * @property double $precioactual
        * @property string $fechatercontra
        * @property string $alcanceactucontrato
        * @property string $detallesreadju
        * @property string $prograini
        * @property string $adendas
        * @property string $prograactu
        * @property string $estado
        * @property string $otro
        *
        * The followings are the available model relations:
        * @property Historico[] $csHistoricos
        * @property Contratacion $idContratacion0
    */
    class Contratos extends CActiveRecord
    {
        public $titulo_contrato;
        public $image1, $image2, $image3, $image4;
        
        /**
            * @return string the associated database table name
        */
        public function tableName()
        {
            return '{{contratos}}';
        }
        
        /**
            * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
			array('idContratacion', 'required'),
			array('nmodifica', 'numerical', 'integerOnly'=>true),
			array('precioactual', 'length', 'max'=>45),
			array('idContratacion', 'length', 'max'=>10),
			array('estatuscontrato', 'length', 'max'=>45),
			array('fecha', 'length', 'max'=>12),
			array('tipomodifica', 'length', 'max'=>50),
			array('prograini, adendas, prograactu, otro', 'length', 'max'=>150),
			array('estado', 'length', 'max'=>25),
			array('justimodcontrato, fechatercontra, alcanceactucontrato, detallesreadju', 'safe'),
            array('fecharecibido','length', 'max'=>10),
            
            array('image1, image2, image3, image4', 'file', 'types' => 'jpg, png, pdf, doc, docx, txt, xlsx, xls', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 200, 'tooLarge' => 'El archivo es mas largo de 200MB, por favor seleccione un archivo mas pequeño.'),
            
            
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('image1, image2, image3, image4, titulo_contrato, idContratos, idContratacion, estatuscontrato, nmodifica, fecha, tipomodifica, justimodcontrato, precioactual, fechatercontra, alcanceactucontrato, detallesreadju, prograini, adendas, prograactu, estado, otro', 'safe', 'on'=>'search'),
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
			'csHistoricos' => array(self::MANY_MANY, 'Historico', '{{contrato_historico}}(idcontrato, idhistorico)'),
			'idContratacion0' => array(self::BELONGS_TO, 'Contratacion', 'idContratacion'),
			'idEstatus0'=>array(self::BELONGS_TO,'Estadosgestcontra','estatuscontrato'),
            );
        }
        
        /**
            * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
			'idContratos' => 'Id Contrato / Modificación',
			'idContratacion' => 'Id Contratacion ',
			'estatuscontrato' => 'Estatus del Contrato',
			'nmodifica' => 'Número de Modificación',
			'fecha' => 'Fecha de Modificación del Contrato',
			'tipomodifica' => 'Tipo de Modificación al Contrato',
			'justimodcontrato' => 'Justificación de la Modificación al Contrato',
			'precioactual' => 'Precio Actualizado del Contrato en Lempiras',
			'fechatercontra' => 'Fecha Actualizada de Terminación del Contrato',
			'alcanceactucontrato' => 'Alcance Actualizado del Proyecto',
			'detallesreadju' => 'Detalle de Re-adjudicacion al Contratista si los Hubieren',
			'prograini' => 'Programa Inicial de Trabajo Presentado a la Firma del Contrato',
			'adendas' => 'Adendas a los Contratos Debidamente Suscritas',
			'prograactu' => 'Programa Actualizado de Trabajo',
			'estado' => 'Estado',
			'otro' => 'Otro',
            'fecharecibido'=>'Fecha en que Recibió la Información',
            'fechacreacion'=>'Fecha de Creación de la Ficha',
            
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
            
            $criteria->with = array(
            'idContratacion0' => array('alias'=> 'idContratacion0', 'together' => true, )
            );
            $criteria->together = true;
            $criteria->compare( 'idContratacion0.titulocontrato', $this->titulo_contrato, true ); // related field new
            
            $criteria->compare('idContratos',$this->idContratos,true);
            $criteria->compare('idContratacion',$this->idContratacion,true);
            $criteria->compare('estatuscontrato',$this->estatuscontrato,true);
            $criteria->compare('nmodifica',$this->nmodifica);
            $criteria->compare('fecha',$this->fecha,true);
            $criteria->compare('tipomodifica',$this->tipomodifica,true);
            $criteria->compare('justimodcontrato',$this->justimodcontrato,true);
            $criteria->compare('precioactual',$this->precioactual);
            $criteria->compare('fechatercontra',$this->fechatercontra,true);
            $criteria->compare('alcanceactucontrato',$this->alcanceactucontrato,true);
            $criteria->compare('detallesreadju',$this->detallesreadju,true);
            $criteria->compare('prograini',$this->prograini,true);
            $criteria->compare('adendas',$this->adendas,true);
            $criteria->compare('prograactu',$this->prograactu,true);
            $criteria->compare('estado',$this->estado,true);
            $criteria->compare('otro',$this->otro,true);
            
            if (!Yii::app()->user->isSuperAdmin) {
                $criteria->addSearchCondition('t.estado', 'BORRADOR', true, 'AND');
            }
            
            return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            ));
        }
        
        /**
            * Returns the static model of the specified AR class.
            * Please note that you should have this exact method in all your CActiveRecord descendants!
            * @param string $className active record class name.
            * @return Contratos the static model class
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
        /*public function listaEstadocontrato()
            {
            $dat= Estadocontrato::model()->findAll();
            $list = CHtml::listData($dat,'idcs_estadocontrato', 'idcs_estadocontrato');
            return $list ;
        }*/
        
        public function listaEstatusContrato()
        {
            $dat = Estadosgestcontra::model()->findAll();
            $list = CHtml::listData($dat, 'codigo', 'descripcion');
            return $list;
        }
        
        public function listaContratacion()
        {
            $dat= Contratacion::model()->findAll();
            $list = CHtml::listData($dat,'idContratacion', 'titulocontrato');
            return $list ;
        }
    }
