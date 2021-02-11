<?php

/**
 * This is the model class for table "{{lenders_suppliers}}".
 *
 * The followings are the available columns in table '{{lenders_suppliers}}':
 * @property integer $id
 * @property integer $idContratacion
 * @property integer $shareholder_id
 * @property string $shareholder_name
 * @property string $votingRights
 * @property string $votingRightsDetails
 * @property double $shareholding
 *
 * The followings are the available model relations:
 * @property Contratacion $idContratacion0
 */
class LendersSuppliers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{lenders_suppliers}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idContratacion, shareholder_id, shareholder_name, votingRights, votingRightsDetails, shareholding', 'required'),
			array('idContratacion, shareholder_id', 'numerical', 'integerOnly'=>true),
			array('shareholding', 'numerical'),
			array('shareholder_name, votingRights, votingRightsDetails', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idContratacion, shareholder_id, shareholder_name, votingRights, votingRightsDetails, shareholding', 'safe', 'on'=>'search'),
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
			'shareholder_id' => 'Accionista',
			'shareholder_name' => 'Nombre de Accionista',
			'votingRights' => 'Derechos de Voto',
			'votingRightsDetails' => 'Detalles de Derecho de Voto',
			'shareholding' => 'Accionado',
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
		$criteria->compare('shareholder_id',$this->shareholder_id);
		$criteria->compare('shareholder_name',$this->shareholder_name,true);
		$criteria->compare('votingRights',$this->votingRights,true);
		$criteria->compare('votingRightsDetails',$this->votingRightsDetails,true);
		$criteria->compare('shareholding',$this->shareholding);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LendersSuppliers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
