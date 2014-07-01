<?php

/**
 * This is the model class for table "ofrece".
 *
 * The followings are the available columns in table 'ofrece':
 * @property string $OFR_ID
 * @property string $CAR_CODIGO
 * @property string $NOT_ID
 * @property string $OFR_INICIO
 * @property string $OFR_TERMINO
 * @property string $OFR_ESTADO
 *
 * The followings are the available model relations:
 * @property Carrera $cARCODIGO
 * @property Noticias $nOT
 */
class Ofrece extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ofrece';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CAR_CODIGO, NOT_ID, OFR_INICIO, OFR_TERMINO, OFR_ESTADO', 'required','message'=>'{attribute} no puede quedar en blanco.'),
			array('CAR_CODIGO, NOT_ID', 'length', 'max'=>10),
			array(		
                  'OFR_INICIO',
                  'compare',
                  'compareAttribute'=>'OFR_TERMINO',
                  'operator'=>'<=', 
                  'allowEmpty'=>false , 
                  'message'=>'{attribute} no puede ser mayor que la fecha de término "{compareValue}".',
                  'on'=>'create',
                ),
			array(		
                  'OFR_INICIO',
                  'compare',
                  'compareValue'=>date("Y-m-d"),
                  'operator'=>'>=', 
                  'allowEmpty'=>false , 
                  'message'=>'{attribute} no puede ser menor que la fecha de hoy "{compareValue}".',
                  'on'=>'create',
                ),
			array(		
                  'OFR_TERMINO',
                  'compare',
                  'compareValue'=>date('Y-m-d', strtotime(' + 1 year')),
                  'operator'=>'<=', 
                  'allowEmpty'=>false , 
                  'message'=>'{attribute} no puede ser mayor a un año "{compareValue}".',
                  'on'=>'create',
                ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('OFR_ID, CAR_CODIGO, NOT_ID, OFR_INICIO, OFR_TERMINO, OFR_ESTADO', 'safe', 'on'=>'search'),
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
			'cARCODIGO' => array(self::BELONGS_TO, 'Carrera', 'CAR_CODIGO'),
			'nOT' => array(self::BELONGS_TO, 'Noticias', 'NOT_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'OFR_ID' => 'Ofr',
			'CAR_CODIGO' => 'Carrera',
			'NOT_ID' => 'Noticia',
			'OFR_INICIO' => 'Fecha Inicio',
			'OFR_TERMINO' => 'Fecha Término',
			'OFR_ESTADO' => 'Estado',
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

		$criteria->compare('OFR_ID',$this->OFR_ID,true);
		$criteria->compare('CAR_CODIGO',$this->CAR_CODIGO,true);
		$criteria->compare('NOT_ID',$this->NOT_ID,true);
		$criteria->compare('OFR_INICIO',$this->OFR_INICIO,true);
		$criteria->compare('OFR_TERMINO',$this->OFR_TERMINO,true);
		$criteria->compare('OFR_ESTADO',$this->OFR_ESTADO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ofrece the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
