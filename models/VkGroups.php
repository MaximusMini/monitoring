<?php

namespace app\models;

use yii\db\ActiveRecord;

class VkGroups extends ActiveRecord{
    public function attributeLabels(){
        return [
            'url' => 'Адрес группы',
        ];
    }
}