<?php
/**
 * This is the model class for table "{{inicio_ejecucion}}".
 *
 * The followings are the available columns in table '{{inicio_ejecucion}}':
 * @property integer $idInicioEjecucion
 * @property integer $idContratacion
 * @property integer $idContacto
 * @property string $fecha_inicio
 * @property string $estado
 * @property string $fecha_creacion
 * @property string $usercreacion
 * @property string $fechapublicado
 * @property string $usuariopublicado
 * @property string programainicial
 * @property double $vartiempo
 * @property double $varprecio
 * @property integer $idEstadoContrato
 */
class GestionAvances extends CActiveRecord

{
    public $titulo_contrato;

    /**
     * @return string the associated database table name
     */
    public

    function tableName()
    {
        return '{{inicio_ejecucion}}';
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

            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.

            array(
                'titulo_contrato, idInicioEjecucion, idAvances, idContratacion, fecha_inicio',
                'safe',
                'on' => 'edit, post, search, notFinalized'
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

        /*return array(
        'idContacto0' => array(self::BELONGS_TO, 'Contactos', 'idContacto'),
        'contratacion0' => array(self::BELONGS_TO, 'Contratacion', 'idContratacion'),
        'estado0' => array(self::BELONGS_TO, 'Estado', 'estado'),
        );*/
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
    public

    function attributeLabels()
    {
        return array(
            'idInicioEjecucion' => 'Código de Ejecución',
            'idContratacion' => 'Número de Contrato',
            'fecha_inicio' => 'Fecha de Orden de Inicio',
            'vartiempo' => 'Variacion del contrato en tiempo',
            'varprecio' => 'Variacion del contrato en precio'
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

        $criteria = new CDbCriteria;
        $criteria->with = array(
            'idContratacion0' => array(
                'alias' => 'idContratacion0',
                'together' => true,
            )
        );
        $criteria->together = true;
        $criteria->compare('idContratacion0.titulocontrato', $this->titulo_contrato, true); // related field new
        $criteria->compare('idInicioEjecucion', $this->idInicioEjecucion,true);
        $criteria->compare('idContratacion', $this->idContratacion,true);
        $criteria->compare('fecha_inicio', $this->fecha_inicio,true);

        if (!Yii::app()->user->isSuperAdmin) {
            $criteria->addSearchCondition('t.usuario_creacion', Yii::app()->user->id, true, 'AND');
            $criteria->addSearchCondition('t.estado', 'BORRADOR', true, 'AND');
            if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
                $criteria->addSearchCondition('t.estado', 'REVISIÓN', true, 'OR');
            }

        }
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>array(
              'defaultOrder'=>'t.idInicioEjecucion DESC',
            ),'pagination'=>false
        ));


    }

    public function notFinalized()
    {

        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->with = array(
            'idContratacion0' => array(
                'alias' => 'idContratacion0',
                'together' => true,
            )
        );
        $criteria->condition = "idInicioEjecucion not in (select DISTINCT(idInicioEjecucion) from cs_final_ejecucion)";
        $criteria->together = true;
        $criteria->compare('idContratacion0.titulocontrato', $this->titulo_contrato, true); // related field new
        $criteria->compare('idInicioEjecucion', $this->idInicioEjecucion,true);
        $criteria->compare('idContratacion', $this->idContratacion,true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>array(
              'defaultOrder'=>'t.idInicioEjecucion DESC',
            ),'pagination'=>false
        ));


    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return InicioEjecucion the static model class
     */
    public static

    function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
