<?php

/**
 * This is the model class for table "usu_alumnos".
 *
 * The followings are the available columns in table 'usu_alumnos':
 * @property string $PER_ID
 * @property string $PER_RUT
 * @property string $PER_NOMBRE
 * @property string $PER_CORREO
 * @property string $PER_TELEFONO
 */
class UsuAlumnos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usu_alumnos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PER_ID, PER_RUT, PER_NOMBRE', 'required'),
			array('PER_ID', 'length', 'max'=>10),
			array('PER_RUT', 'length', 'max'=>12),
			array('PER_NOMBRE', 'length', 'max'=>60),
			array('PER_CORREO', 'length', 'max'=>40),
			array('PER_TELEFONO', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('PER_ID, PER_RUT, PER_NOMBRE, PER_CORREO, PER_TELEFONO', 'safe', 'on'=>'search'),
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
			'PER_ID' => 'Per',
			'PER_RUT' => 'Per Rut',
			'PER_NOMBRE' => 'Per Nombre',
			'PER_CORREO' => 'Per Correo',
			'PER_TELEFONO' => 'Per Telefono',
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

		$criteria->compare('PER_ID',$this->PER_ID,true);
		$criteria->compare('PER_RUT',$this->PER_RUT,true);
		$criteria->compare('PER_NOMBRE',$this->PER_NOMBRE,true);
		$criteria->compare('PER_CORREO',$this->PER_CORREO,true);
		$criteria->compare('PER_TELEFONO',$this->PER_TELEFONO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsuAlumnos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
