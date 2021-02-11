<?php

/**
 * This is the model class for table "{{subsector}}".
 *
 * The followings are the available columns in table '{{subsector}}':
 * @property string $idSubSector
 * @property string $idSector
 * @property string $subsector
 *
 * The followings are the available model relations:
 * @property Programa[] $programas
 * @property Sector $idSector0
 */
class Subsector extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{subsector}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idSector', 'length', 'max'=>10),
			array('subsector', 'length', 'max'=>65),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idSubSector, idSector, subsector', 'safe', 'on'=>'search'),
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
			'programas' => array(self::HAS_MANY, 'Programa', 'idSubSector'),
			'idSector0' => array(self::BELONGS_TO, 'Sector', 'idSector'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idSubSector' => 'Sub Sector',
			'idSector' => 'Sector',
			'subsector' => 'Subsector',
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

		$criteria->compare('idSubSector',$this->idSubSector,true);
		$criteria->compare('idSector',$this->idSector,true);
		$criteria->compare('subsector',$this->subsector,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Subsector the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function listaSector()
        {
            $dat= Sector::model()->findAll();
            $list = CHtml::listData($dat,'idsector', 'sector');
            return $list ;
        }
}

