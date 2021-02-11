<?php
    
    /**
        * This is the model class for table "{{adjudicacion}}".
        *
        * The followings are the available columns in table '{{adjudicacion}}':
        * @property integer $idAdjudicacion
        * @property string $idCalificacion
        * @property string $numproceso
        * @property string $nomprocesoproyecto
        * @property string $nconsulnac
        * @property string $nconsulinter
        * @property double $costoesti
        * @property string $estadoproceso
        * @property string $actaaper
        * @property string $informeacta
        * @property string $resoladju
        * @property string $estado
        * @property string $otro
        * @property string $numfirmasnac
        * @property string $numfimasinter
        * @property string $numconsulcorta
        * @property string $fecharecibido
        * @property string $fechacreacion
    */
    class Adjudicacion extends CActiveRecord
    {
        public $image1, $image2, $image3, $image4;
        
        
        /**
            * @return string the associated database table name
        */
        public function tableName()
        {
            return '{{adjudicacion}}';
        }
        
        /**
            * @return array validation rules for model attributes.
        */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
			array('idCalificacion', 'required'),
			array('costoesti', 'numerical'),
			array('idCalificacion, fecharecibido, fechacreacion', 'length', 'max'=>10),
			array('numproceso', 'length', 'max'=>60),
			array('nomprocesoproyecto', 'length', 'max'=>500),
			array('nconsulnac, nconsulinter, numfirmasnac, numfimasinter, numconsulcorta', 'length', 'max'=>50),
			array('estadoproceso, estado', 'length', 'max'=>25),
			array('actaaper', 'length', 'max'=>250),
			array('informeacta, resoladju', 'length', 'max'=>255),
			array('otro', 'length', 'max'=>150),
            
            array('image1, image2, image3, image4', 'file', 'types' => 'jpg, png, pdf, doc, docx, txt, xlsx, xls', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 200, 'tooLarge' => 'El archivo es mas largo de 200MB, por favor seleccione un archivo mas pequeño.'),
            
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('image1, image2, image3, image4, idAdjudicacion, idCalificacion, numproceso, nomprocesoproyecto, nconsulnac, nconsulinter, costoesti, estadoproceso, actaaper, informeacta, resoladju, estado, otro, numfirmasnac, numfimasinter, numconsulcorta, fecharecibido, fechacreacion', 'safe', 'on'=>'search'),
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
			'idCalificacion0' => array(self::BELONGS_TO, 'Calificacion', 'idCalificacion'),
			'contratacions' => array(self::HAS_MANY, 'Contratacion', 'idAdjudicacion'),
            );
        }
        
        /**
            * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
            return array(
			'idAdjudicacion' => 'Id Adjudicación',
			'idCalificacion' => 'Id Calificación',
			'numproceso' => 'Número del Proceso',
			'nomprocesoproyecto' => 'Nombre del Proceso',
			'nconsulnac' => 'Número de Consultores Nacionales',
			'nconsulinter' => 'Número de Consultores Internacionales',
			'costoesti' => 'Monto Estimado del Proceso en Lempiras',
			'estadoproceso' => 'Estatus del Proceso',
			'actaaper' => 'Acta de Apertura de las Ofertas',
			'informeacta' => 'Informe y Acta de Recomendación',
			'resoladju' => 'Resolución de la Adjudicación',
			'estado' => 'Estado',
			'otro' => 'Otro',
			'numfirmasnac' => 'Número de Firmas Nacionales que Licitaron',
			'numfimasinter' => 'Número de Firmas Internacionales que Licitaron',
			'numconsulcorta' => 'Número de Consultores Lista Corta',
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
            
            $criteria->compare('idAdjudicacion',$this->idAdjudicacion,true);
            $criteria->compare('idCalificacion',$this->idCalificacion,true);
            $criteria->compare('numproceso',$this->numproceso,true);
            $criteria->compare('nomprocesoproyecto',$this->nomprocesoproyecto,true);
            $criteria->compare('nconsulnac',$this->nconsulnac);
            $criteria->compare('nconsulinter',$this->nconsulinter);
            $criteria->compare('costoesti',$this->costoesti);
            $criteria->compare('estadoproceso',$this->estadoproceso,true);
            $criteria->compare('actaaper',$this->actaaper,true);
            $criteria->compare('informeacta',$this->informeacta,true);
            $criteria->compare('resoladju',$this->resoladju,true);
            $criteria->compare('estado',$this->estado,true);
            $criteria->compare('otro',$this->otro,true);
            $criteria->compare('numfirmasnac',$this->numfirmasnac);
            $criteria->compare('numfimasinter',$this->numfimasinter);
            $criteria->compare('numconsulcorta',$this->numconsulcorta);
            
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
            * @return Adjudicacion the static model class
        */
        public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }
        
        public function listaEstadospro()
        {
            $dat= Estadoproceso::model()->findAll();
            $list = CHtml::listData($dat,'estadoproceso', 'estadoproceso');
            return $list ;
        }
        public function listaEstados()
        {
            $dat= Estado::model()->findAll();
            $list = CHtml::listData($dat,'estado','estado');
            return $list ;  
        }
        
        public function listaCalificacion()
        {
            $dat= Calificacion::model()->findAll();
            $list = CHtml::listData($dat,'idCalificacion','numproceso');
            return $list ;  
        }
    }
