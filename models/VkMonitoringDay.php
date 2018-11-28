<?php

namespace app\models;

use Yii;
use yii\base\Model;

use GuzzleHttp\Client; // подключаем Guzzle

class VkMonitoringDay extends Model{
   
    public $id_connect_DB;      // идентификатор подключения БД
    public $arr_id_group=[];    // массив для хранения id групп
    
    public $var_temp=[];
    public $answer;    
    
    
     // конструктор класса
    public function __construct(){
        // создание подключения к БД
        $this->id_connect_DB = Yii::$app->db;    
    }
    
    // функция для использования библиотеки curl
	function curl_get ($url, $referer = 'http://google.com'){
		$ch = curl_init();// инициализируем curl
		// задаем параметры (опции) curl 
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; rv:42.0) Gecko/20100101 Firefox/42.0');
		curl_setopt($ch, CURLOPT_REFERER,$referer);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true); // результат работы curl возвращается, а не выводиться
		//  выполняем запрос curl
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
    
    // функция подключения к БД
    
    
    // главная функция
    function main(){
        
    }
    
    // функция получения id групп для мониторинга
    function get_id_group(){
        //запрос
        $query = 'SELECT group_id FROM vk_groups';
        $this->arr_id_group=$this->id_connect_DB->createCommand($query)->queryAll();
        return $this->arr_id_group;
    }
    
    // получение постов
    function get_posts_day(){
        for($i=0; $i<count($this->arr_id_group); $i++){
            // запрос 
            $this->answer = $this->curl_get("https://api.vk.com/method/wall.get?owner_id=-{$this->arr_id_group[$i]['group_id']}&count=1&offset=1&filter=owner&extended=1&v=5.69&access_token=33be01cf14cf4e807b075601e45972657fd2c7fd532da9e20a1b641f85b6c4a4bb22ff38b71167321b02b");
            
            
            
            //file_put_contents('111.txt',serialize(json_decode($answer,true)));
            
            array_push($this->var_temp, json_decode($this->answer,true));
            
            // определяем дату поста
            
            
            
            
            
    
    //echo $ans.'<br>';
    
    //echo '<pre>'.print_r(json_decode($ans,true),true).'</pre>';
            
            
            
            
        }
        return $this->var_temp;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}