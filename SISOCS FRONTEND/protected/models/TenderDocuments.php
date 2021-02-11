<?php

/**
 * This is the model class for table "{{tender_documents}}".
 *
 * The followings are the available columns in table '{{tender_documents}}':
 * @property integer $id
 * @property integer $idCalificacion
 * @property string $documentType
 * @property string $title
 * @property string $description
 * @property integer $pageStart
 * @property integer $pageEnd
 * @property string $url
 * @property string $datePublished
 * @property string $dateModified
 * @property string $accessDetails
 *
 * The followings are the available model relations:
 * @property Calificacion $idCalificacion0
 */
class TenderDocuments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $uploadDocument;
	public function tableName()
	{
		return '{{tender_documents}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCalificacion, documentType, title, url', 'required'),
			array('idCalificacion, pageStart, pageEnd', 'numerical', 'integerOnly'=>true),
			array('documentType, title, url, accessDetails', 'length', 'max'=>255),
			array('description, datePublished, dateModified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('uploadDocument', 'file', 'types' => 'jpg, png, pdf, doc, docx, txt, xlsx, xls', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 200, 'tooLarge' => 'El archivo es mas largo de 200MB, por favor seleccione un archivo mas pequeño.'),

			array('id, idCalificacion, documentType, title, description, pageStart, pageEnd, url, datePublished, dateModified, accessDetails', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idCalificacion' => 'Id Calificacion',
			'documentType' => 'Tipo de Documento',
			'title' => 'Título',
			'description' => 'Descripción',
			'url' => 'Url',
			'pageStart' => 'Página Inicial',
			'pageEnd' => 'Página Final',
			'datePublished' => 'Fecha de Publicación',
			'dateModified' => 'Fecha de Modificación',
			'accessDetails' => 'Detalles de Acceso',
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
		$criteria->compare('idCalificacion',$this->idCalificacion);
		$criteria->compare('documentType',$this->documentType,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('pageStart',$this->pageStart);
		$criteria->compare('pageEnd',$this->pageEnd);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('datePublished',$this->datePublished,true);
		$criteria->compare('dateModified',$this->dateModified,true);
		$criteria->compare('accessDetails',$this->accessDetails,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TenderDocuments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
