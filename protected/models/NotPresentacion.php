<?php

/**
 * This is the model class for table "not_presentacion".
 *
 * The followings are the available columns in table 'not_presentacion':
 * @property string $CAR_NOMBRE
 * @property string $CAR_SIGLA
 * @property string $NOT_TITULO
 * @property string $NOT_CONTENIDO
 * @property string $OFR_INICIO
 */
class NotPresentacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'not_presentacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CAR_NOMBRE, CAR_SIGLA, NOT_TITULO, NOT_CONTENIDO, OFR_INICIO', 'required'),
			array('CAR_NOMBRE, NOT_TITULO', 'length', 'max'=>100),
			array('CAR_SIGLA', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CAR_NOMBRE, CAR_SIGLA, NOT_TITULO, NOT_CONTENIDO, OFR_INICIO', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CAR_NOMBRE' => 'Car Nombre',
			'CAR_SIGLA' => 'Car Sigla',
			'NOT_TITULO' => 'Not Titulo',
			'NOT_CONTENIDO' => 'Not Contenido',
			'OFR_INICIO' => 'Ofr Inicio',
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

		$criteria->compare('CAR_NOMBRE',$this->CAR_NOMBRE,true);
		$criteria->compare('CAR_SIGLA',$this->CAR_SIGLA,true);
		$criteria->compare('NOT_TITULO',$this->NOT_TITULO,true);
		$criteria->compare('NOT_CONTENIDO',$this->NOT_CONTENIDO,true);
		$criteria->compare('OFR_INICIO',$this->OFR_INICIO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NotPresentacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
