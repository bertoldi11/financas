<?php

/**
 * This is the model class for table "movimentacao".
 *
 * The followings are the available columns in table 'movimentacao':
 * @property integer $idMovimentacao
 * @property integer $idConta
 * @property integer $idFormaPgto
 * @property integer $idUsuario
 * @property integer $idFatura
 * @property string $data
 * @property double $valor
 *
 * The followings are the available model relations:
 * @property Conta $idConta0
 * @property Fatura $idFatura0
 * @property Formapgto $idFormaPgto0
 * @property Usuario $idUsuario0
 */
class Movimentacao extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'movimentacao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idConta, idFormaPgto, idUsuario, data, valor', 'required'),
			array('idConta, idFormaPgto, idUsuario, idFatura', 'numerical', 'integerOnly'=>true),
			array('valor', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idMovimentacao, idConta, idFormaPgto, idUsuario, idFatura, data, valor', 'safe', 'on'=>'search'),
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
			'idConta0' => array(self::BELONGS_TO, 'Conta', 'idConta'),
			'idFatura0' => array(self::BELONGS_TO, 'Fatura', 'idFatura'),
			'idFormaPgto0' => array(self::BELONGS_TO, 'Formapgto', 'idFormaPgto'),
			'idUsuario0' => array(self::BELONGS_TO, 'Usuario', 'idUsuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idMovimentacao' => 'Id Movimentacao',
			'idConta' => 'Conta',
			'idFormaPgto' => 'Forma Pagamento',
			'idUsuario' => 'Id Usuario',
			'idFatura' => 'Id Fatura',
			'data' => 'Data',
			'valor' => 'Valor',
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

		$criteria->compare('idMovimentacao',$this->idMovimentacao);
		$criteria->compare('idConta',$this->idConta);
		$criteria->compare('idFormaPgto',$this->idFormaPgto);
		$criteria->compare('idUsuario',$this->idUsuario);
		$criteria->compare('idFatura',$this->idFatura);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('valor',$this->valor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Movimentacao the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
