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
 * @property string $razonesCambiosPresupuesto
 * @property integer $idInicioEjecucion
 * @property integer $usuario_creacion
 * @property string $fecha_creacion
 * @property string $estado
 * @property integer $usuario_publicacion
 * @property string $fecha_publicacion
 *
 * The followings are the available model relations:
 * @property InicioEjecucion $idInicioEjecucion0
 */
class FinalEjecucion extends CActiveRecord

{
    public $titulo_contrato;
    public $numero_contrato;

    /**
     * @return string the associated database table name
     */
    public

    function tableName()
    {
        return '{{final_ejecucion}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public

    function rules()
    {

        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.

        return array(
            array(
                'costoFinalizacion, alcanceFinalizacion, fechaFinalizacion, idInicioEjecucion, usuario_creacion, fecha_creacion, estado',
                'required'
            ) ,
            array(
                'idInicioEjecucion, usuario_creacion, usuario_publicacion',
                'numerical',
                'integerOnly' => true
            ) ,
            array(
                'costoFinalizacion',
                'numerical'
            ) ,
            array(
                'adj_documentoGarantia',
                'length',
                'max' => 252
            ) ,
            array(
                'adj_actaRecepcion, adj_informesEvaluacion, adj_informeDisconformidad, adj_informeAseguramientoCalidad, razonesCambios, razonesCambiosPresupuesto',
                'length',
                'max' => 250
            ) ,
            array(
                'estado',
                'length',
                'max' => 20
            ) ,

            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.

            array(
                'idFinalizacion, costoFinalizacion, alcanceFinalizacion, fechaFinalizacion, adj_documentoGarantia, adj_actaRecepcion, adj_informesEvaluacion, adj_informeDisconformidad, adj_informeAseguramientoCalidad, razonesCambios, razonesCambiosPresupuesto, idInicioEjecucion, usuario_creacion, fecha_creacion, estado, fecha_creacion, fecha_publicacion',
                'safe',
                'on' => 'search'
            ) ,
        );
    }

    /**
     * @return array relational rules.
     */
    public

    function relations()
    {

        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.

	return array(
            'idInicioEjecucion0' => array(
                self::BELONGS_TO,
                'InicioEjecucion',
                'idInicioEjecucion'
            ) ,
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public

    function attributeLabels()
    {
        return array(
            'idFinalizacion' => 'Id Finalizacion',
            'costoFinalizacion' => 'Costo Finalizacion',
            'alcanceFinalizacion' => 'Alcance Finalizacion',
            'fechaFinalizacion' => 'Fecha Finalizacion',
            'adj_documentoGarantia' => 'Adj Documento Garantia',
            'adj_actaRecepcion' => 'Adj Acta Recepcion',
            'adj_informesEvaluacion' => 'Adj Informes Evaluacion',
            'adj_informeDisconformidad' => 'Adj Informe Disconformidad',
            'adj_informeAseguramientoCalidad' => 'Adj Informe Aseguramiento Calidad',
            'razonesCambios' => 'Razones Cambios en el Proyecto',
            'razonesCambiosPresupuesto' => 'Razones de Cambios en el Presupuesto',
            'idInicioEjecucion' => 'Id Implementacion',
            'usuario_creacion' => 'Usuario Creacion',
            'fecha_creacion' => 'Fecha Creacion',
            'estado' => 'Estado',
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
    $criteria->compare('estado',$this->estado,true);
    return new CActiveDataProvider($this, array(
    'criteria'=>$criteria,
    ));
    }*/
    /*public function search()
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
    }*/
    public

    function search()
    {

        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->compare('idFinalizacion', $this->idFinalizacion, true);
        $criteria->compare('alcanceFinalizacion', $this->alcanceFinalizacion, true);
        $criteria->compare('costoFinalizacion', $this->costoFinalizacion, true);
        $criteria->compare('costoFinalizacion', $this->costoFinalizacion, true);
        $criteria->compare('idInicioEjecucion', $this->idInicioEjecucion, true);
        /*$criteria->compare('idInicioEjecucion',$this->idInicioEjecucion,true);
        $criteria->compare('porcent_programado',$this->porcent_programado,true);
        $criteria->compare('finan_programado',$this->finan_programado,true);
        $criteria->compare('porcent_real',$this->porcent_real,true);
        $criteria->compare('finan_real',$this->finan_real,true);
        $criteria->compare('estado',$this->estado,true);  */

        // $criteria->order = 't.idFinalizacion ASC';

        if (!Yii::app()->user->isSuperAdmin) {
            $criteria->addSearchCondition('t.usuario_creacion', Yii::app()->user->id, true, 'AND');
            $criteria->addSearchCondition('t.estado', 'BORRADOR', true, 'AND');
            if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
                $criteria->addSearchCondition('t.estado', 'REVISIÃ“N', true, 'OR');
            }
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.idFinalizacion DESC',
            ) ,'pagination'=>false
        ));
    }


    public

    function listaEstados()
    {
        $criteria = new CDbCriteria;
        $criteria->condition = '1';
        if (!Yii::app()->user->isSuperAdmin) {
            if (!Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
                $criteria->condition = "(estado = 'BORRADOR' OR estado = 'REVISION' OR estado = 'REVISÃ“N')";
            }
        }

        $dat = Estado::model()->findAll($criteria);
        $list = CHtml::listData($dat, 'estado', 'estado');
        return $list;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return FinalEjecucion the static model class
     */
    public static

    function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
