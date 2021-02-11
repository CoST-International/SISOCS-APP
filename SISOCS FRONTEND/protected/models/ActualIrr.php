<?php

/**
 * This is the model class for table "{{actual_irr}}".
 *
 * The followings are the available columns in table '{{actual_irr}}':
 * @property integer $id
 * @property integer $idContratacion
 * @property string $title
 * @property integer $period_durationInDays
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Contratacion $idContratacion0
 */
class ActualIrr extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{actual_irr}}';
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
			array('idContratacion, period_durationInDays', 'numerical', 'integerOnly'=>true),
			array('title, description', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idContratacion, title, period_durationInDays, description', 'safe', 'on'=>'search'),
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
			'idContratacion0' => array(self::BELONGS_TO, 'Contratacion', 'idContratacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idContratacion' => 'Id Contratacion',
			'title' => 'Titulo',
			'period_durationInDays' => 'Duración de Periodo en Años',
			'description' => 'Descripción',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('idContratacion',$this->idContratacion);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('period_durationInDays',$this->period_durationInDays);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActualIrr the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
