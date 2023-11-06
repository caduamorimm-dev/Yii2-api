<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules() // diz quais sao as regras da tabela User
    {
        return [
            [['full_name', 'email', 'password'], 'required'],
            [['full_name'], 'string', 'max' => 255],
            [['email'], 'email'],
            ['email', 'unique', 'message' => 'This email is already being used.'],
        ];
    }

    public function getCompanies() 
    {
        return $this->hasMany(Company::class, ['created_by' => 'id']); //hasMany (tem varios ou tem varias empresas)
    }
}
