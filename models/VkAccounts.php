<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 27.11.2018
 * Time: 12:21
 */

namespace app\models;


use yii\db\ActiveRecord;

class VkAccounts extends ActiveRecord{
    public function attributeLabels(){
        return [
            'url' => 'Ссылка на аккаунт',
        ];
    }
}