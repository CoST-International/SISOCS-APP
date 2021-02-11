<?php

/**
 * This is the model class for table "{{parties}}".
 *
 * The followings are the available columns in table '{{parties}}':
 * @property integer $id
 * @property string $legalName
 * @property string $uri
 * @property string $streetAddress
 * @property string $locality
 * @property string $region
 * @property string $countryName
 * @property string $contactPoint_name
 * @property string $contactPoint_email
 * @property string $contactPoint_telephone
 * @property string $roles
 *
 * The followings are the available model relations:
 * @property BudgetBreakdown[] $budgetBreakdowns
 * @property ContractsOrganizationDetails[] $contractsOrganizationDetails
 * @property ContractsSignatories[] $contractsSignatories
 * @property PreferredBidders[] $preferredBidders
 */
class Parties extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{parties}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('legalName', 'required'),
			array('legalName, uri, streetAddress, locality, region, contactPoint_name, contactPoint_email, contactPoint_telephone, roles', 'length', 'max'=>255),
			array('countryName', 'length', 'max'=>80),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, legalName, uri, streetAddress, locality, region, countryName, contactPoint_name, contactPoint_email, contactPoint_telephone, roles', 'safe', 'on'=>'search'),
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
			'budgetBreakdowns' => array(self::HAS_MANY, 'BudgetBreakdown', 'sourceParty_id'),
			'contractsOrganizationDetails' => array(self::HAS_MANY, 'ContractsOrganizationDetails', 'parties_id'),
			'contractsSignatories' => array(self::HAS_MANY, 'ContractsSignatories', 'parties_id'),
			'preferredBidders' => array(self::HAS_MANY, 'PreferredBidders', 'parties_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'legalName' => 'Legal Name',
			'uri' => 'Uri',
			'streetAddress' => 'Street Address',
			'locality' => 'Locality',
			'region' => 'Region',
			'countryName' => 'Country Name',
			'contactPoint_name' => 'Contact Point Name',
			'contactPoint_email' => 'Contact Point Email',
			'contactPoint_telephone' => 'Contact Point Telephone',
			'roles' => 'Roles',
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
		$criteria->compare('legalName',$this->legalName,true);
		$criteria->compare('uri',$this->uri,true);
		$criteria->compare('streetAddress',$this->streetAddress,true);
		$criteria->compare('locality',$this->locality,true);
		$criteria->compare('region',$this->region,true);
		$criteria->compare('countryName',$this->countryName,true);
		$criteria->compare('contactPoint_name',$this->contactPoint_name,true);
		$criteria->compare('contactPoint_email',$this->contactPoint_email,true);
		$criteria->compare('contactPoint_telephone',$this->contactPoint_telephone,true);
		$criteria->compare('roles',$this->roles,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Parties the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
