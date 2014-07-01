<?php

/**
 * This is the model class for table "evalua".
 *
 * The followings are the available columns in table 'evalua':
 * @property string $EVA_ID
 * @property string $PRA_ID
 * @property string $EMP_ID
 * @property string $REP_ID
 * @property string $EVA_VIGENCIA
 *
 * The followings are the available model relations:
 * @property Practica $pRA
 * @property Empresa $eMP
 * @property Representante $rEP
 */
class Evalua extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'evalua';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PRA_ID, EMP_ID, REP_ID, EVA_VIGENCIA', 'required'),
			array('PRA_ID, EMP_ID, REP_ID', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('EVA_ID, PRA_ID, EMP_ID, REP_ID, EVA_VIGENCIA', 'safe', 'on'=>'search'),
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
			'pRA' => array(self::BELONGS_TO, 'Practica', 'PRA_ID'),
			'eMP' => array(self::BELONGS_TO, 'Empresa', 'EMP_ID'),
			'rEP' => array(self::BELONGS_TO, 'Representante', 'REP_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'EVA_ID' => 'Eva',
			'PRA_ID' => 'Pra',
			'EMP_ID' => 'Emp',
			'REP_ID' => 'Rep',
			'EVA_VIGENCIA' => 'Eva Vigencia',
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

		$criteria->compare('EVA_ID',$this->EVA_ID,true);
		$criteria->compare('PRA_ID',$this->PRA_ID,true);
		$criteria->compare('EMP_ID',$this->EMP_ID,true);
		$criteria->compare('REP_ID',$this->REP_ID,true);
		$criteria->compare('EVA_VIGENCIA',$this->EVA_VIGENCIA,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Evalua the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
