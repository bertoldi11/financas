<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property integer $idUsuario
 * @property string $nome
 * @property string $email
 * @property string $senha
 * @property string $dtCriacao
 * @property string $dtAlteracao
 *
 * The followings are the available model relations:
 * @property Cartaocredito[] $cartaocreditos
 * @property Conta[] $contas
 * @property Movimentacao[] $movimentacaos
 */
class Usuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome, email, senha, dtCriacao', 'required'),
			array('nome', 'length', 'max'=>60),
			array('email', 'length', 'max'=>80),
			array('senha', 'length', 'max'=>64),
			array('dtAlteracao', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idUsuario, nome, email, senha, dtCriacao, dtAlteracao', 'safe', 'on'=>'search'),
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
			'cartaocreditos' => array(self::HAS_MANY, 'Cartaocredito', 'idUsuario'),
			'contas' => array(self::HAS_MANY, 'Conta', 'idUsuario'),
			'movimentacaos' => array(self::HAS_MANY, 'Movimentacao', 'idUsuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idUsuario' => 'Id Usuario',
			'nome' => 'Nome',
			'email' => 'Email',
			'senha' => 'Senha',
			'dtCriacao' => 'Dt Criacao',
			'dtAlteracao' => 'Dt Alteracao',
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

		$criteria->compare('idUsuario',$this->idUsuario);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('senha',$this->senha,true);
		$criteria->compare('dtCriacao',$this->dtCriacao,true);
		$criteria->compare('dtAlteracao',$this->dtAlteracao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
