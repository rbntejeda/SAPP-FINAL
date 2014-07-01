<?php

/**
 * This is the model class for table "convenios".
 *
 * The followings are the available columns in table 'convenios':
 * @property string $EMP_NOMBRE
 * @property string $EMP_RUT
 * @property string $CON_ID
 * @property string $EMP_ID
 * @property string $CON_ESTADO
 * @property string $CON_DESCRIPCION
 * @property string $CON_INGRESO
 * @property string $CON_TERMINO
 */
class Convenios extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'convenios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CON_ESTADO, CON_DESCRIPCION, CON_INGRESO, CON_TERMINO', 'required'),
			array('EMP_NOMBRE', 'length', 'max'=>60),
			array('EMP_RUT', 'length', 'max'=>12),
			array('CON_ID, EMP_ID, CON_ESTADO', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('EMP_NOMBRE, EMP_RUT, CON_ID, EMP_ID, CON_ESTADO, CON_DESCRIPCION, CON_INGRESO, CON_TERMINO', 'safe', 'on'=>'search'),
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
			'EMP_NOMBRE' => 'Emp Nombre',
			'EMP_RUT' => 'Emp Rut',
			'CON_ID' => 'Con',
			'EMP_ID' => 'Emp',
			'CON_ESTADO' => 'Con Estado',
			'CON_DESCRIPCION' => 'Con Descripcion',
			'CON_INGRESO' => 'Con Ingreso',
			'CON_TERMINO' => 'Con Termino',
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

		$criteria->compare('EMP_NOMBRE',$this->EMP_NOMBRE,true);
		$criteria->compare('EMP_RUT',$this->EMP_RUT,true);
		$criteria->compare('CON_ID',$this->CON_ID,true);
		$criteria->compare('EMP_ID',$this->EMP_ID,true);
		$criteria->compare('CON_ESTADO',$this->CON_ESTADO,true);
		$criteria->compare('CON_DESCRIPCION',$this->CON_DESCRIPCION,true);
		$criteria->compare('CON_INGRESO',$this->CON_INGRESO,true);
		$criteria->compare('CON_TERMINO',$this->CON_TERMINO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Convenios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
