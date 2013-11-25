<?php

/**
 * This is the model class for table "parcela".
 *
 * The followings are the available columns in table 'parcela':
 * @property integer $idParcela
 * @property integer $idCompasCartao
 * @property integer $idFatura
 * @property integer $parcela
 * @property string $valor
 * @property string $dataVenc
 *
 * The followings are the available model relations:
 * @property Compracartao $idCompasCartao0
 * @property Fatura $idFatura0
 */
class Parcela extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'parcela';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCompasCartao, parcela, valor, dataVenc', 'required'),
			array('idCompasCartao, idFatura, parcela', 'numerical', 'integerOnly'=>true),
			array('valor', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idParcela, idCompasCartao, idFatura, parcela, valor, dataVenc', 'safe', 'on'=>'search'),
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
			'idCompasCartao0' => array(self::BELONGS_TO, 'Compracartao', 'idCompasCartao'),
			'idFatura0' => array(self::BELONGS_TO, 'Fatura', 'idFatura'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idParcela' => 'Id Parcela',
			'idCompasCartao' => 'Id Compas Cartao',
			'idFatura' => 'Id Fatura',
			'parcela' => 'Parcela',
			'valor' => 'Valor',
			'dataVenc' => 'Data Venc',
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

		$criteria->compare('idParcela',$this->idParcela);
		$criteria->compare('idCompasCartao',$this->idCompasCartao);
		$criteria->compare('idFatura',$this->idFatura);
		$criteria->compare('parcela',$this->parcela);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('dataVenc',$this->dataVenc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Parcela the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
