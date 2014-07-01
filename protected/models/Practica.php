<?php

/**
 * This is the model class for table "practica".
 *
 * The followings are the available columns in table 'practica':
 * @property string $PRA_ID
 * @property string $CAR_CODIGO
 * @property string $PER_ID
 * @property string $PRA_ESTPRACTICA
 * @property integer $PRA_ESTF1
 * @property integer $PRA_ESTF3
 * @property integer $PRA_ESTINFORME
 * @property string $PRA_EVAEMPRESA
 * @property string $PRA_EVAPROFESOR
 * @property string $PRA_DESCRIPCION
 * @property string $PRA_INICIO
 * @property string $PRA_TERMINO
 * @property string $PRA_TIPO
 *
 * The followings are the available model relations:
 * @property Bitacora[] $bitacoras
 * @property DocenteEncargado[] $docenteEncargados
 * @property Evalua[] $evaluas
 * @property Persona $pER
 * @property Persona $cARCODIGO
 */
class Practica extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'practica';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CAR_CODIGO, PER_ID, PRA_ESTPRACTICA, PRA_ESTF1, PRA_ESTF3, PRA_ESTINFORME, PRA_DESCRIPCION, PRA_INICIO, PRA_TIPO', 'required'),
			array('PRA_ESTF1, PRA_ESTF3, PRA_ESTINFORME', 'numerical', 'integerOnly'=>true),
			array('CAR_CODIGO, PER_ID', 'length', 'max'=>10),
			array('PRA_ESTPRACTICA', 'length', 'max'=>9),
			array('PRA_EVAEMPRESA, PRA_EVAPROFESOR', 'length', 'max'=>3),
			array('PRA_TIPO', 'length', 'max'=>1),
			//array('PRA_EVAPROFESOR,PRA_EVAEMPRESA', 'compare','operator'=>'<=','compareValue'=>7, 'message'=>'maximum is 90 which is North Pole'  ),
			//array('PRA_EVAPROFESOR,PRA_EVAEMPRESA', 'compare','operator'=>'>=','compareValue'=>2, 'message'=>'maximum is 90 which is North Pole' ),
			array('PRA_EVAPROFESOR,PRA_EVAEMPRESA','numerical', 'integerOnly'=>false, 'min'=>2,'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('PRA_ID, CAR_CODIGO, PER_ID, PRA_ESTPRACTICA, PRA_ESTF1, PRA_ESTF3, PRA_ESTINFORME, PRA_EVAEMPRESA, PRA_EVAPROFESOR, PRA_DESCRIPCION, PRA_INICIO, PRA_TERMINO, PRA_TIPO', 'safe', 'on'=>'search'),
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
			'bitacoras' => array(self::HAS_MANY, 'Bitacora', 'PRA_ID'),
			'docenteEncargados' => array(self::HAS_MANY, 'DocenteEncargado', 'PRA_ID'),
			'evaluas' => array(self::HAS_MANY, 'Evalua', 'PRA_ID'),
			'pER' => array(self::BELONGS_TO, 'Persona', 'PER_ID'),
			'cARCODIGO' => array(self::BELONGS_TO, 'Persona', 'CAR_CODIGO'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PRA_ID' => 'Práctica',
			'CAR_CODIGO' => 'Carrera',
			'PER_ID' => 'Rut de Alumno',
			'PRA_ESTPRACTICA' => 'Estado Practica',
			'PRA_ESTF1' => 'Pra Estf1',
			'PRA_ESTF3' => 'Pra Estf3',
			'PRA_ESTINFORME' => 'Pra Estinforme',
			'PRA_EVAEMPRESA' => 'Pra Evaempresa',
			'PRA_EVAPROFESOR' => 'Pra Evaprofesor',
			'PRA_DESCRIPCION' => 'Descripcion',
			'PRA_INICIO' => 'Inicio práctica',
			'PRA_TERMINO' => 'Termino práctica',
			'PRA_TIPO' => 'Tipo práctica',
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

		$criteria->compare('PRA_ID',$this->PRA_ID,true);
		$criteria->compare('CAR_CODIGO',$this->CAR_CODIGO,true);
		$criteria->compare('PER_ID',$this->PER_ID,true);
		$criteria->compare('PRA_ESTPRACTICA',$this->PRA_ESTPRACTICA,true);
		$criteria->compare('PRA_ESTF1',$this->PRA_ESTF1);
		$criteria->compare('PRA_ESTF3',$this->PRA_ESTF3);
		$criteria->compare('PRA_ESTINFORME',$this->PRA_ESTINFORME);
		$criteria->compare('PRA_EVAEMPRESA',$this->PRA_EVAEMPRESA,true);
		$criteria->compare('PRA_EVAPROFESOR',$this->PRA_EVAPROFESOR,true);
		$criteria->compare('PRA_DESCRIPCION',$this->PRA_DESCRIPCION,true);
		$criteria->compare('PRA_INICIO',$this->PRA_INICIO,true);
		$criteria->compare('PRA_TERMINO',$this->PRA_TERMINO,true);
		$criteria->compare('PRA_TIPO',$this->PRA_TIPO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Practica the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
