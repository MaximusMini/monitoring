<?php

namespace app\models;

use Yii;
use yii\base\Model;

use GuzzleHttp\Client; // подключаем Guzzle

class VkMonitoringDay extends Model{
   
    public $id_connect_DB;              // идентификатор подключения БД
    public $arr_id_group=[];            // массив для хранения id групп
    public $arr_type_group=[];          // массив для хранения типа групп
    
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
    
    // главная функция
    function main(){
        $this->get_id_group();                     // получение id групп для мониторинга
        $this->get_group_type();                    // получение типа групп
        $this->get_posts_day();
    }
    
    // функция получения id групп для мониторинга
    function get_id_group(){
        //запрос
        $query = 'SELECT group_id FROM vk_groups';
        $this->arr_id_group=$this->id_connect_DB->createCommand($query)->queryAll();
        return $this->arr_id_group;
    }
    
    // функция получения типа группы
    function get_group_type(){
        for($i=0; $i<count($this->arr_id_group); $i++){
            // запрос для получения типа группы
            $type_group = json_decode(file_get_contents('https://api.vk.com/method/groups.getById?group_id='.$this->arr_id_group[$i]['group_id'].'&fields=type&v=5.92&access_token=33be01cf14cf4e807b075601e45972657fd2c7fd532da9e20a1b641f85b6c4a4bb22ff38b71167321b02b'),true)['response'][0]['type'];
            $this->arr_type_group[$this->arr_id_group[$i]['group_id']] = $type_group; 
        }
        return;
    } 
    
    // получение постов
    function get_posts_day(){
        // очистка таблицы vk_posts
        $query_TRUNCATE="TRUNCATE TABLE vk_posts";
        $this->id_connect_DB->createCommand($query_TRUNCATE)->execute();
        for($i=0; $i<count($this->arr_id_group); $i++){
            // запрос 
            $this->answer = $this->curl_get("https://api.vk.com/method/wall.get?owner_id=-{$this->arr_id_group[$i]['group_id']}&count=1&offset=1&filter=owner&extended=1&v=5.69&access_token=33be01cf14cf4e807b075601e45972657fd2c7fd532da9e20a1b641f85b6c4a4bb22ff38b71167321b02b");
            // преобразование ответа в массив
            $answer_arr = json_decode($this->answer,true);
            // проверка наличия ошибки при запросе
            if(isset($answer_arr['error'])){
                // запись лога об ошибке
                file_put_contents('logs/error_wall.get.log',
                                 'error method:wall.get '.date('d.m.Y G:i:s').
                                 ' id_group='.$this->arr_id_group[$i]['group_id'].
                                 ' error_code='.$answer_arr['error']['error_code'].
                                 ' error_msg='.$answer_arr['error']['error_msg']."\n"
                                 ,FILE_APPEND
                                 );
                // возврат на исходную
                $i=$i-1;continue;
                
            }
            // добавление данных в массив
            array_push($this->var_temp, json_decode($this->answer,true));
            // запись лога об успешном запросе
            file_put_contents('logs/success_wall.get.log',
                              'success method:wall.get '.date('d.m.Y G:i:s').' -|- '.
                              'id_group='.$this->arr_id_group[$i]['group_id']."\n",
                              FILE_APPEND
                              );
            
            // запись данных о посте в БД
            /*
            id_post			id поста                            $answer_arr[0]['response']['items'][0]['id']
            id_group		id группы                           $this->arr_id_group[$i]['group_id']
            count			количество записей в группе         $answer_arr[0]['response']['count']
            date_post       дата поста                          date("d.m.Y",$answer_arr[0]['response']['items'][0]['date'])
            time_post       время поста                         date("G:i",$answer_arr[0]['response']['items'][0]['date'])
            text_post       текст поста                         $answer_arr[0]['response']['items'][0]['text']
            */
            
            $query_INSERT="INSERT INTO vk_posts(id_post, id_group, count, date_post, time_post, text_post) VALUES (
                        {$answer_arr[0]['response']['items'][0]['id']},
                        {$this->arr_id_group[$i]['group_id']},
                        {$answer_arr[0]['response']['count']},
                        {date('d.m.Y',$answer_arr[0]['response']['items'][0]['date'])},
                        {date('G:i',$answer_arr[0]['response']['items'][0]['date'])},
                        {$answer_arr[0]['response']['items'][0]['text']})";
            file_put_contents('query_INSERT.txt',$query_INSERT,FILE_APPEND);
            $this->id_connect_DB->createCommand($query_INSERT)->execute();
           
            
            /*
            
            "INSERT INTO vk_posts(id_post, id_group, count, date_post, time_post, text_post) VALUES (
                        {$answer_arr[0]['response']['items'][0]['id']},
                        {$this->arr_id_group[$i]['group_id']},
                        {$answer_arr[0]['response']['count']},
                        {date("d.m.Y",$answer_arr[0]['response']['items'][0]['date'])},
                        {date("G:i",$answer_arr[0]['response']['items'][0]['date'])},
                        {$answer_arr[0]['response']['items'][0]['text']})";
            
            
            'INSERT INTO stat_penalty (id_team, name , penalty_time, penalty_time_home, penalty_time_guest, penalty_time_average, penalty_time_average_home, penalty_time_average_guest) VALUES ('.$id_team.',\''.$name.'\','.$stat_team['penalty_time'].','.$stat_team['penalty_time_home'].','.$stat_team['penalty_time_guest'].','.str_replace(',','.',$stat_team['penalty_time_average']).','.str_replace(',','.',$stat_team['penalty_time_average_home']).','.str_replace(',','.',$stat_team['penalty_time_average_guest']).')';
        // добавление данных в БД
            
            */
            
            
        }// for($i=0; $i<count($this->arr_id_group)
        return $this->var_temp;
    }
    
    //запись постов в БД
    function insert_posts_DB(){
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}