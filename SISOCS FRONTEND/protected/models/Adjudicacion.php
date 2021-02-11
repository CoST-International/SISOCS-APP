<?php

/**
 * This is the model class for table "{{adjudicacion}}".
 *
 * The followings are the available columns in table '{{adjudicacion}}':
 * @property integer $idAdjudicacion
 * @property string $idCalificacion
 * @property string $numproceso
 * @property integer $nparticipantes
 * @property double $costoesti
 * @property string $actaaper
 * @property string $informeacta
 * @property string $resoladju
 * @property string $estado
 * @property string $otro
 * @property string $fechapublicado
 * @property string $fechacreacion
 * @property integer $idMetodoAdjudicacion
 */
class Adjudicacion extends CActiveRecord {
    public $image1, $image2, $image3, $image4;


    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{adjudicacion}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(
                'idCalificacion, idMetodoAdjudicacion, fecha_creacion',
                'required'
            ),
            array(
                'idCalificacion, nparticipantes, idMetodoAdjudicacion, usuario_creacion, usuario_publicacion',
                'numerical',
                'integerOnly' => true
            ),
            array(
                'costoesti',
                'numerical'
            ),
            array(
                'numproceso',
                'length',
                'max' => 60
            ),
            array(
                'actaaper, informeacta, resoladju, otro',
                'length',
                'max' => 255
            ),
            array(
                'estado',
                'length',
                'max' => 25
            ),
            array(
                'fecha_publicacion',
                'safe'
            ),

            array(
                'image1, image2, image3, image4',
                'file',
                'types' => 'jpg, png, pdf, doc, docx, txt, xlsx, xls',
                'allowEmpty' => true,
                'maxSize' => 1024 * 1024 * 200,
                'tooLarge' => 'El archivo es mas largo de 200MB, por favor seleccione un archivo mas pequeño.'
            ),

            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'currency, image1, image2, image3, image4, idMetodoAdjudicacion, idAdjudicacion, idCalificacion, numproceso, nomprocesoproyecto, nconsulnac, nparticipantes, costoesti, estadoproceso, actaaper, informeacta, resoladju, estado, otro, numfirmasnac, numfimasinter, numconsulcorta, fecha_publicacion, fecha_creacion',
                'safe',
                'on' => 'search,published'
            )
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'currency' => array(
                self::BELONGS_TO,
                'Currency',
                'id'
            ),
            'idCalificacion0' => array(
                self::BELONGS_TO,
                'Calificacion',
                'idCalificacion'
            ),
            'idMetodoAdjudicacion0' => array(
                self::BELONGS_TO,
                'MetodoAdjudicacion',
                'idMetodoAdjudicacion'
            ),
            'contratacions' => array(
                self::HAS_MANY,
                'Contratacion',
                'idAdjudicacion'
            )
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idAdjudicacion' => 'Id Adjudicación',
            'idCalificacion' => 'Id Calificación',
            'idMetodoAdjudicacion' => 'Metodo de adjudicación',
            'nparticipantes' => 'Número de empresas o individuos participantes',
            //'nparticipantes' => 'Número de Consultores Internacionales',
            'costoesti' => 'Estimación del costo del contrato en Lps.',
            'actaaper' => 'Acta de Apertura de las Ofertas',
            'informeacta' => 'Informe y Acta de Recomendación',
            'resoladju' => 'Resolución de la Adjudicación',
            'estado' => 'Estado',
            'otro' => 'Otro',
            //'fechapublicado'=>'Fecha de publicación',
            'fecha_creacion' => 'Fecha de creación',
            'usuario_publicacion' => 'Usuario Publicacion',
            'fecha_publicacion' => 'Fecha Publicacion',
            'usuario_publicacion' => 'Usuario Publicacion',
            'currency' => 'Moneda'
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('idAdjudicacion', $this->idAdjudicacion, true);
        $criteria->compare('idCalificacion', $this->idCalificacion, true);
        $criteria->compare('nparticipantes', $this->nparticipantes);
        //$criteria->compare('idMetodoAdjudicacion',$this->idMetodoAdjudicacion,true);
        $criteria->compare('numproceso', $this->numproceso, true);
        // $criteria->compare('nparticipantes',$this->nparticipantes);
        $criteria->compare('costoesti', $this->costoesti);
        $criteria->compare('actaaper', $this->actaaper, true);
        $criteria->compare('informeacta', $this->informeacta, true);
        $criteria->compare('resoladju', $this->resoladju, true);
        $criteria->compare('estado', $this->estado, true);
        $criteria->compare('otro', $this->otro, true);
        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);
        $criteria->compare('usuario_publicacion', $this->usuario_publicacion);

        if (!Yii::app()->user->isSuperAdmin) {
            $criteria->addSearchCondition('t.usuario_creacion', Yii::app()->user->id, true, 'AND');
            $criteria->addSearchCondition('t.estado', 'BORRADOR', true, 'AND');
            if (Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
                $criteria->addSearchCondition('t.estado', 'REVISIÓN', true, 'OR');
            }

        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.idAdjudicacion DESC'
            )
        ));
    }


    public function published() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('idAdjudicacion', $this->idAdjudicacion, true);
        $criteria->compare('idCalificacion', $this->idCalificacion, true);
        $criteria->compare('nparticipantes', $this->nparticipantes);
        $criteria->compare('costoesti', $this->costoesti,true);
        $criteria->compare('numproceso', $this->numproceso, true);

        $criteria->addSearchCondition('t.estado', 'PUBLICADO', true, 'AND');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.idAdjudicacion DESC'
            ),'pagination'=>false
        ));
    }


    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Adjudicacion the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function listaEstados() {
        $criteria            = new CDbCriteria;
        $criteria->condition = '1';
        if (!Yii::app()->user->isSuperAdmin) {
            if (!Yii::app()->user->isInRole(Yii::app()->user->id, 'Publicador')) {
                $criteria->condition = "(estado = 'BORRADOR' OR estado = 'REVISION' OR estado = 'REVISÓN')";
            }
        }

        $dat  = Estado::model()->findAll($criteria);
        $list = CHtml::listData($dat, 'estado', 'estado');
        return $list;
    }

    public function listaContrataciones($id) {

        $dat = Contratacion::model()->findAll('idAdjudicacion=\'' . $id . '\'');

        //$list = CHtml::listData($dat, 'idContratacion', 'ncontrato');
        // return $list;


        //$dat = Calificacion::model()->findAll('idCalificacion=\''.$idCreate.'\'');
        //$list = CHtml::listData($dat, 'idProyecto', 'nombre_proyecto');

        $list = array();

        foreach ($dat as $row) {
            $list[$row->idContratacion] = '(' . substr(str_pad($row->idContratacion, 10, ' ', STR_PAD_LEFT), 0, 10) . ') ' . $row->ncontrato;
        }

        return $list;


    }

    public static function listaMetodAdjidicacion() {
        $dat  = MetodoAdjudicacion::model()->findAll();
        $list = Chtml::listData($dat, 'idMetodoAdjudicacion', 'nombre');
        return $list;
    }

    public function listaCalificacionID($idCreate) {

        $dat = Calificacion::model()->findAll('idCalificacion=\'' . $idCreate . '\'');
        //$list = CHtml::listData($dat, 'idProyecto', 'nombre_proyecto');

        $list = array();

        foreach ($dat as $row) {
            $list[$row->idCalificacion] = '(' . substr(str_pad($row->idCalificacion, 10, ' ', STR_PAD_LEFT), 0, 10) . ') ' . $row->numproceso;
        }

        return $list;

    }

    public function listaCurrency() {
        /*$dat= Calificacion::model()->findAll();
        $list = CHtml::listData($dat,'idCalificacion','numproceso');
        return $list ; */

        $dat  = Currency::model()->findAll(array(
            'order' => 'idCurrency ASC'
        ));
        $list = array();

        foreach ($dat as $row) {
            $list[$row->idCurrency] = '(' . substr(str_pad($row->idCurrency, 10, ' ', STR_PAD_LEFT), 0, 10) . ') ' . $row->moneda;
        }

        return $list;
    }


    public function listaCalificacion() {
        /*$dat= Calificacion::model()->findAll();
        $list = CHtml::listData($dat,'idCalificacion','numproceso');
        return $list ; */

        $dat  = Calificacion::model()->findAll(array(
            'order' => 'idCalificacion ASC'
        ));
        $list = array();

        foreach ($dat as $row) {
            $list[$row->idCalificacion] = '(' . substr(str_pad($row->idCalificacion, 10, ' ', STR_PAD_LEFT), 0, 10) . ') ' . $row->numproceso;
        }

        return $list;
    }

    public function Usuario($id) {
        $nameUser = "";
        if ($id == 0) {
            $nameUser = "NO Asignado";
        } else {
            try {
                $usuario  = Yii::app()->user->um->loadUserById($id);
                $nameUser = $usuario->username;
            }
            catch (Exception $ex) {
                $nameUser = "No Asignado";
            }
        }

        return $nameUser;
    }
}
