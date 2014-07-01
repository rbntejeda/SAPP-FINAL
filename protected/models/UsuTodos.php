<?php
/************************************************************************/ 
/* Nombre del archivo	: UsuTodos.php           
/* Fecha de creación	: 06/04/2014          
/* Descripción			: Modelo de Vista en la BD para accesar a todos los usuarios actuales
/***********************************************************************/
/**
 * This is the model class for table "usu_todos".
 *
 * The followings are the available columns in table 'usu_todos':
 * @property string $PER_ID
 * @property string $PER_RUT
 * @property string $PER_NOMBRE
 * @property string $PER_ROLE
 * @property string $USU_ESTADO
 * @property string $USU_MODIFIED
 * @property string $USU_CREATE
 */
class UsuTodos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usu_todos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PER_ID, PER_RUT, PER_NOMBRE, PER_ROLE', 'required'),
			array('PER_ID', 'length', 'max'=>10),
			array('PER_RUT, PER_ROLE', 'length', 'max'=>12),
			array('PER_NOMBRE', 'length', 'max'=>60),
			array('USU_ESTADO', 'length', 'max'=>1),
			array('USU_MODIFIED, USU_CREATE', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('PER_ID, PER_RUT, PER_NOMBRE, PER_ROLE, USU_ESTADO, USU_MODIFIED, USU_CREATE', 'safe', 'on'=>'search'),
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
			'PER_ROLE' => 'Per Role',
			'USU_ESTADO' => 'Usu Estado',
			'USU_MODIFIED' => 'Usu Modified',
			'USU_CREATE' => 'Usu Create',
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
		$criteria->compare('PER_ROLE',$this->PER_ROLE,true);
		$criteria->compare('USU_ESTADO',$this->USU_ESTADO,true);
		$criteria->compare('USU_MODIFIED',$this->USU_MODIFIED,true);
		$criteria->compare('USU_CREATE',$this->USU_CREATE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsuTodos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
