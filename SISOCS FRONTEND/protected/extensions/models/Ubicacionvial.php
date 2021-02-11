<?php

/**
 * This is the model class for table "{{ubicacionvial}}".
 *
 * The followings are the available columns in table '{{ubicacionvial}}':
 * @property string $region
 * @property string $tramo
 * @property string $ruta
 * @property string $departamento
 * @property string $codigo
 * @property string $idubicacion
 * @property string $clase
 *
 * The followings are the available model relations:
 * @property Programa[] $csProgramas
 * @property Proyecto[] $proyectos
 */
class Ubicacionvial extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ubicacionvial}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                    array('region','required'),
			array('region', 'length', 'max'=>25),
                    array('tramo','required'),
                    array('ruta','required'),
			array('tramo, ruta', 'length', 'max'=>5),
			array('departamento', 'length', 'max'=>3),
			array('codigo', 'length', 'max'=>20),
            array('clase', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('region, tramo, ruta, departamento, codigo, idubicacion', 'safe', 'on'=>'search'),
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
			'csProgramas' => array(self::MANY_MANY, 'Programa', '{{programa_ubicacion}}(idubicacion, idprograma)'),
			'proyectos' => array(self::HAS_MANY, 'Proyecto', 'idUbicacion'),
			'idRegion0' => array(self::BELONGS_TO, 'Region', 'region'),
			'idTramo0' => array(self::BELONGS_TO, 'Tramo', 'tramo'),
			'idDepartamento0' => array(self::BELONGS_TO, 'Departamento', 'departamento'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'region' => 'Región',
			'tramo' => 'Tramo',
			'ruta' => 'Ruta',
			'departamento' => 'Departamento',
			'codigo' => 'Código',
			'idubicacion' => 'Id Ubicación',
            'clase' => 'Clase',
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

		$criteria->compare('region',$this->region,true);
		$criteria->compare('tramo',$this->tramo,true);
		$criteria->compare('ruta',$this->ruta,true);
		$criteria->compare('departamento',$this->departamento,true);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('idubicacion',$this->idubicacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ubicacionvial the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function listaRegion()
        {
            $dat= Region::model()->findAll();
            $list = CHtml::listData($dat,'idregion','region');
            return $list ;  
        }
        public function listaDepartamentos()
        {
            $dat= Departamento::model()->findAll();
            $list = CHtml::listData($dat,'codigoDepto','departamento');
            return $list ;  
        }
         public function listaTramo()
        {
            $dat= Tramo::model()->findAll();
            $list = CHtml::listData($dat,'idtramo','tramo');
            return $list ;  
        }
        public function listaRutas()
        {
            $dat= Ruta::model()->findAll();
            $list = CHtml::listData($dat,'idruta','tramo');
            return $list ;  
        }
        
        public function listaClases()
        {
            $dat= Clase::model()->findAll();
            $list = CHtml::listData($dat,'idclase','clase');
            return $list ;  
        }
}
