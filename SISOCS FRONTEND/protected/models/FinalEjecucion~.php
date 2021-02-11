<?php

/**
 * This is the model class for table "{{final_ejecucion}}".
 *
 * The followings are the available columns in table '{{final_ejecucion}}':
 * @property integer $idFinalizacion
 * @property double $costoFinalizacion
 * @property string $alcanceFinalizacion
 * @property string $fechaFinalizacion
 * @property string $adj_documentoGarantia
 * @property string $adj_actaRecepcion
 * @property string $adj_informesEvaluacion
 * @property string $adj_informeDisconformidad
 * @property string $adj_informeAseguramientoCalidad
 * @property string $razonesCambios
 * @property string $indicador1
 * @property string $indicador2
 * @property string $indicador3
 * @property string $indicador4
 * @property string $indicador5
 * @property string $indicador6
 * @property string $indicador7
 * @property string $indicador8
 * @property integer $idInicioEjecucion
 * @property integer $usuario_creacion
 * @property string $fecha_creacion
 */
class FinalEjecucion extends CActiveRecord
{
	public $image1, $image2, $image3, $image4, $image5;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{final_ejecucion}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('costoFinalizacion, alcanceFinalizacion, fechaFinalizacion, idInicioEjecucion, usuario_creacion, fecha_creacion', 'required'),
			array('idInicioEjecucion, usuario_creacion', 'numerical', 'integerOnly'=>true),
			array('costoFinalizacion', 'numerical'),
			array('adj_documentoGarantia', 'length', 'max'=>252),
			array('adj_actaRecepcion, adj_informesEvaluacion, adj_informeDisconformidad, adj_informeAseguramientoCalidad, razonesCambios', 'length', 'max'=>250),
			array('indicador1, indicador2, indicador3, indicador4, indicador5, indicador6, indicador7, indicador8', 'length', 'max'=>5),

			array('image1, image2, image3, image4, image5', 'file', 'types' => 'jpg, png, pdf, doc, docx, txt, xlsx, xls', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 200, 'tooLarge' => 'El archivo es mas largo de 200MB, por favor seleccione un archivo mas pequeño.'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('image1, image2, image3, image4, image5,idFinalizacion, costoFinalizacion, alcanceFinalizacion, fechaFinalizacion, adj_documentoGarantia, adj_actaRecepcion, adj_informesEvaluacion, adj_informeDisconformidad, adj_informeAseguramientoCalidad, razonesCambios, indicador1, indicador2, indicador3, indicador4, indicador5, indicador6, indicador7, indicador8, idInicioEjecucion, usuario_creacion, fecha_creacion, estado', 'safe', 'on'=>'search'),
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
				'avances' => array(
						self::HAS_MANY,
						'Avances',
						'idInicioEjecucion'
				) ,
				'desembolsosMontoses' => array(
						self::HAS_MANY,
						'DesembolsosMontos',
						'idInicioEjecucion'
				) ,

				// 'contratacion0' => array(self::BELONGS_TO, 'Contratacion', 'idContratacion'),

				'idContratacion0' => array(
						self::BELONGS_TO,
						'Contratacion',
						'idContratacion'
				) ,
				'garantiases' => array(
						self::HAS_MANY,
						'Garantias',
						'idInicioEjecucion'
				) ,
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idInicioEjecucion' => 'Código de Ejecución',
			'idContratacion' => 'Número de Contrato',
			'fecha_inicio' => 'Fecha de Orden de Inicio',
			'titulo_contrato' => 'Titulo del Contrato',
			'idFinalizacion' => 'Id Finalizacion',
			'costoFinalizacion' => 'Costo Finalizacion',
			'alcanceFinalizacion' => 'Alcance Finalizacion',
			'fechaFinalizacion' => 'Fecha Finalizacion',
			'adj_documentoGarantia' => 'Adj Documento Garantia',
			'adj_actaRecepcion' => 'Adj Acta Recepcion',
			'adj_informesEvaluacion' => 'Adj Informes Evaluacion',
			'adj_informeDisconformidad' => 'Adj Informe Disconformidad',
			'adj_informeAseguramientoCalidad' => 'Adj Informe Aseguramiento Calidad',
			'razonesCambios' => 'Razones Cambios',
			'indicador1' => 'Indicador1',
			'indicador2' => 'Indicador2',
			'indicador3' => 'Indicador3',
			'indicador4' => 'Indicador4',
			'indicador5' => 'Indicador5',
			'indicador6' => 'Indicador6',
			'indicador7' => 'Indicador7',
			'indicador8' => 'Indicador8',
			'idInicioEjecucion' => 'Id Implementacion',
			'usuario_creacion' => 'Usuario Creacion',
			'fecha_creacion' => 'Fecha Creacion',
			'estado' => 'Estado'
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
	/*public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idFinalizacion',$this->idFinalizacion);
		$criteria->compare('costoFinalizacion',$this->costoFinalizacion);
		$criteria->compare('alcanceFinalizacion',$this->alcanceFinalizacion,true);
		$criteria->compare('fechaFinalizacion',$this->fechaFinalizacion,true);
		$criteria->compare('adj_documentoGarantia',$this->adj_documentoGarantia,true);
		$criteria->compare('adj_actaRecepcion',$this->adj_actaRecepcion,true);
		$criteria->compare('adj_informesEvaluacion',$this->adj_informesEvaluacion,true);
		$criteria->compare('adj_informeDisconformidad',$this->adj_informeDisconformidad,true);
		$criteria->compare('adj_informeAseguramientoCalidad',$this->adj_informeAseguramientoCalidad,true);
		$criteria->compare('razonesCambios',$this->razonesCambios,true);
		$criteria->compare('indicador1',$this->indicador1,true);
		$criteria->compare('indicador2',$this->indicador2,true);
		$criteria->compare('indicador3',$this->indicador3,true);
		$criteria->compare('indicador4',$this->indicador4,true);
		$criteria->compare('indicador5',$this->indicador5,true);
		$criteria->compare('indicador6',$this->indicador6,true);
		$criteria->compare('indicador7',$this->indicador7,true);
		$criteria->compare('indicador8',$this->indicador8,true);
		$criteria->compare('idInicioEjecucion',$this->idInicioEjecucion);
		$criteria->compare('usuario_creacion',$this->usuario_creacion);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}*/

	public function search()
	{
			// @todo Please modify the following code to remove attributes that should not be searched.

			$criteria = new CDbCriteria;
			$criteria->with = array(
					'idContratacion0' => array(
							'alias' => 'idContratacion0',
							'together' => true,
					)
			);
			$criteria->together = true;
			$criteria->compare('idContratacion0.titulocontrato', $this->titulo_contrato, true); // related field new
			$criteria->compare('idInicioEjecucion', $this->idInicioEjecucion);
			$criteria->compare('idContratacion', $this->idContratacion);
			return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
					'sort'=>array(
						'defaultOrder'=>'t.idInicioEjecucion DESC',
					),
			));
	}
	/*public function listaEstados() {
		$criteria = new CDbCriteria;
		$criteria->condition = '1';
		if (!Yii::app()->user->isSuperAdmin) {
			if (!Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
				$criteria->condition = "(estado = 'BORRADOR' OR estado = 'REVISION' OR estado = 'REVISÓN')";
			}
		}*/



	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FinalEjecucion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

