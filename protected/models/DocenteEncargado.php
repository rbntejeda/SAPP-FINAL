<?php

/**
 * This is the model class for table "docente_encargado".
 *
 * The followings are the available columns in table 'docente_encargado':
 * @property string $DOC_ID
 * @property string $PER_ID
 * @property string $PRA_ID
 * @property string $DOC_VIGENCIA
 *
 * The followings are the available model relations:
 * @property Persona $pER
 * @property Practica $pRA
 */
class DocenteEncargado extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'docente_encargado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PER_ID, PRA_ID, DOC_VIGENCIA', 'required'),
			array('PER_ID, PRA_ID', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('DOC_ID, PER_ID, PRA_ID, DOC_VIGENCIA', 'safe', 'on'=>'search'),
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
			'pER' => array(self::BELONGS_TO, 'Persona', 'PER_ID'),
			'pRA' => array(self::BELONGS_TO, 'Practica', 'PRA_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'DOC_ID' => 'Doc',
			'PER_ID' => 'Per',
			'PRA_ID' => 'Pra',
			'DOC_VIGENCIA' => 'Doc Vigencia',
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

		$criteria->compare('DOC_ID',$this->DOC_ID,true);
		$criteria->compare('PER_ID',$this->PER_ID,true);
		$criteria->compare('PRA_ID',$this->PRA_ID,true);
		$criteria->compare('DOC_VIGENCIA',$this->DOC_VIGENCIA,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DocenteEncargado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
