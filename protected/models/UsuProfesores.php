<?php
/************************************************************************/ 
/* Nombre del archivo	: UsuProfesores.php           
/* Fecha de creación	: 06/04/2014          
/* Descripción			: Modelo de Vista en la BD para accesar a todos los usuarios Profesores
/***********************************************************************/
/**
 * This is the model class for table "usu_profesores".
 *
 * The followings are the available columns in table 'usu_profesores':
 * @property string $PER_RUT
 * @property string $USU_PASSWORD
 * @property string $PER_ROLE
 * @property string $PER_NOMBRE
 */
class UsuProfesores extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usu_profesores';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PER_RUT, USU_PASSWORD, PER_ROLE, PER_NOMBRE', 'required'),
			array('PER_RUT, PER_ROLE', 'length', 'max'=>12),
			array('USU_PASSWORD', 'length', 'max'=>30),
			array('PER_NOMBRE', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('PER_RUT, USU_PASSWORD, PER_ROLE, PER_NOMBRE', 'safe', 'on'=>'search'),
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
			'PER_RUT' => 'Per Rut',
			'USU_PASSWORD' => 'Usu Password',
			'PER_ROLE' => 'Per Role',
			'PER_NOMBRE' => 'Per Nombre',
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

		$criteria->compare('PER_RUT',$this->PER_RUT,true);
		$criteria->compare('USU_PASSWORD',$this->USU_PASSWORD,true);
		$criteria->compare('PER_ROLE',$this->PER_ROLE,true);
		$criteria->compare('PER_NOMBRE',$this->PER_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsuProfesores the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
