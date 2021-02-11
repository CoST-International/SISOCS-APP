<?php

/**
 * This is the model class for table "{{municipio}}".
 *
 * The followings are the available columns in table '{{municipio}}':
 * @property integer $idMunicipio
 * @property string $idDepartamento
 * @property string $municipio
 */
class Municipio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{municipio}}';
	}

	public function primaryKey()
	{
        return array('idMunicipio', 'idDepartamento');
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		    array('idMunicipio, idDepartamento', 'ECompositeUniqueValidator', 'attributesToAddError'=>'idMunicipio', 'on' => 'insert,update', 'message' => '{attribute}:{value_idMunicipio} Ya existe para este departamento!'),
			array('idDepartamento', 'length', 'max'=>2),
			array('idMunicipio', 'length', 'max'=>3),
			array('municipio', 'length', 'max'=>85),
			array('municipio','unique', 'message'=>'Este municipio ya existe, por favor ingresar uno nuevo.'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idMunicipio, idDepartamento, municipio', 'safe', 'on'=>'search'),
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
		'FK_idDepartamento' => array(self::BELONGS_TO, 'Departamento', 'idDepartamento'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idMunicipio' => 'Código del Municipio',
			'idDepartamento' => 'Departamento',
			'municipio' => 'Nombre del Municipio',
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

		$criteria->compare('idMunicipio',$this->idMunicipio);
		$criteria->compare('idDepartamento',$this->idDepartamento,true);
		$criteria->compare('municipio',$this->municipio,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function searchProyectoMunicipio()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria   = Yii::app()->db->createCommand('SELECT m.municipio,pm.beneficio FROM cs_proyecto_municipio pm JOIN cs_municipio m ON m.idMunicipio=pm.idMunicipio and m.idDepartamento=pm.idDepartamento WHERE pm.idProyecto=881')->queryAll();
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Municipio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function listaDepartamentos()
        {
            $dat= Departamento::model()->findAll();
             $list = CHtml::listData($dat,'idDepartamento','departamento');
            return $list ;
        }
}
