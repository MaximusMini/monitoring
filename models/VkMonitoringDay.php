<?php

namespace app\models;

use Yii;
use yii\base\Model;

use GuzzleHttp\Client; // подключаем Guzzle

class VkMonitoringDay extends Model{
   
    public $id_connect_DB;              // идентификатор подключения БД
    public $arr_id_group=[];            // массив для хранения id групп
    public $arr_type_group=[];          // массив для хранения типа групп
    
    public $arr_posts=[];               // массив с данными о постах
    public $arr_attach=[];              // массии с данными об attachnments
    
    public $arr_posts_for_day=[];       // массив для хранения постов за конкретный день
    
    public $now_date;                   // дата действующего дня
    
    public $answer;    
    public $id_group_post;              // id поста, по которому пост идентифицируется в БД
    
     // конструктор класса
    public function __construct(){
        // создание подключения к БД
        $this->id_connect_DB = Yii::$app->db;
        // дата действующего дня
        $this->now_date = date("d.m.Y",time());
        
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
        $this->get_group_type();                   // получение типа групп
        //$this->get_posts_day();                  // получение постов
        $this->get_posts();                        // получение постов
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
    function get_posts(){
        for($i=0; $i<count($this->arr_id_group); $i++){
            $this->get_posts_day($this->now_date, $this->arr_id_group[$i]['group_id']);    
        }
    }
    
    // получение постов
    function get_posts_day_(){
        // очистка таблицы vk_posts
            //$query_TRUNCATE="TRUNCATE TABLE vk_posts";
        //$this->id_connect_DB->createCommand($query_TRUNCATE)->execute();
        for($i=0; $i<count($this->arr_id_group); $i++){
            // запрос 
            $this->answer = $this->curl_get("https://api.vk.com/method/wall.get?owner_id=-{$this->arr_id_group[$i]['group_id']}&count=20&offset=0&filter=owner&extended=1&v=5.69&access_token=33be01cf14cf4e807b075601e45972657fd2c7fd532da9e20a1b641f85b6c4a4bb22ff38b71167321b02b");
            /*
            запись запроса в файл
            */
             file_put_contents('request_api.txt',
                                  "https://api.vk.com/method/wall.get?owner_id=-{$this->arr_id_group[$i]['group_id']}&count=3&offset=0&filter=owner&extended=1&v=5.69&access_token=33be01cf14cf4e807b075601e45972657fd2c7fd532da9e20a1b641f85b6c4a4bb22ff38b71167321b02b"."\n------------------------------------\n", 
                                  FILE_APPEND
                                  );
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
                // возврат на исходную в случае ошибки
                $i=$i-1;continue;
            }
            // добавление данных в массив
            array_push($this->arr_posts, $answer_arr);
            // обход записей
            for($j=0; $j<count($answer_arr['response']['items']); $j++){
                // запись лога об успешном запросе
                file_put_contents('logs/success_wall.get.log',
                                  'success method:wall.get '.date('d.m.Y G:i:s').' -|- '.
                                  'id_group='.$this->arr_id_group[$i]['group_id'].
                                  ' id_post='.$answer_arr['response']['items'][$j]['id']."\n",
                                  FILE_APPEND
                                  );
                // проверка наличия записи о посте в БД - если нету => записать
                file_put_contents('logs/success_wall.get.log',
                                  'SELECT * FROM vk_posts WHERE id_group_post=\''.$this->arr_id_group[$i]['group_id'].'_'.$answer_arr['response']['items'][$j]['id'].'\''."\n",
                                  FILE_APPEND
                                  );
                if($this->id_connect_DB->createCommand('SELECT * FROM vk_posts WHERE id_group_post=\''.$this->arr_id_group[$i]['group_id'].'_'.$answer_arr['response']['items'][$j]['id'].'\'')->queryAll() == null){
                    // проверка поста на закрепленность
                    if($answer_arr['response']['items'][$j]['is_pinned'] == null){
                        $is_pinned = 0;}else{$is_pinned = 1;}
                    // id поста, по которому пост идентифицируется в БД
                    $this->id_group_post = $this->arr_id_group[$i]['group_id'].'_'.$answer_arr['response']['items'][$j]['id'];
                    // формирование запроса на добавление информации о посте
                    $query_INSERT="INSERT INTO vk_posts(id_group_post, id_post, id_group, is_pinned, count, date_unix, date_post, time_post, text_post) VALUES (
                            '{$this->id_group_post}',
                            {$answer_arr['response']['items'][$j]['id']},
                            {$this->arr_id_group[$i]['group_id']},
                            {$is_pinned},
                            {$answer_arr['response']['count']},
                            {$answer_arr['response']['items'][$j]['date']},
                            '".date('d.m.Y',$answer_arr['response']['items'][$j]['date'])."',
                            '".date('G:i',$answer_arr['response']['items'][$j]['date'])."',
                            '".str_replace("'","\'",$answer_arr['response']['items'][$j]['text'])."')";
                    // текстовый вид запроса
                    // file_put_contents('query_INSERT.txt',$query_INSERT."\n",FILE_APPEND);
                    // запись в БД информации о посте
                    $this->id_connect_DB->createCommand($query_INSERT)->execute();
                    
                    
                    
                    
                    // проверка attachments к посту
                    if($answer_arr['response']['items'][$j]['attachments'] != null){
                        $this->arr_attach["{$this->arr_id_group[$i]['group_id']}_{$answer_arr['response']['items'][$j]['id']}"] = $answer_arr['response']['items'][$j]['attachments'];
                        /*
                        file_put_contents('attach.txt',
                                  serialize($answer_arr['response']['items'][$j]['attachments'])."\n------------------------------------\n",
                                  //$answer_arr['response']['items'][$j]['date'],  
                                  FILE_APPEND
                                  );
                        */
                        foreach($answer_arr['response']['items'][$j]['attachments'] as $attach){
                            // определить тип attachments и применить соответствующую функцию
                            if($attach['type'] == 'photo'){
                                $this->insert_attach_photo($attach['photo'], $this->id_group_post);        
                            }  
                        }
                    }
                }    
            }
            
            
        }// for($i=0; $i<count($this->arr_id_group)
        return $this->arr_posts;
    }
    
    // получение постов
    function get_posts_day($day, $id_group){
        // запись лога
        file_put_contents('logs/get_posts_day.txt',$day.' id_group:'.$id_group."\n",FILE_APPEND);
        // обход постов
        for($i=0; ; $i++){
            // запрос
            $request = "https://api.vk.com/method/wall.get?owner_id=-{$id_group}&count=1&offset={$i}&filter=owner&extended=1&v=5.69&access_token=33be01cf14cf4e807b075601e45972657fd2c7fd532da9e20a1b641f85b6c4a4bb22ff38b71167321b02b";
            $this->answer = $this->curl_get($request);
            /*
            запись запроса в файл */
            
             file_put_contents('request_api.txt',
                                  "https://api.vk.com/method/wall.get?owner_id=-{$id_group}&count=1&offset={$i}&filter=owner&extended=1&v=5.69&access_token=33be01cf14cf4e807b075601e45972657fd2c7fd532da9e20a1b641f85b6c4a4bb22ff38b71167321b02b".
                                  "\n------------------------------------\n", 
                                  FILE_APPEND
                                  );
            
            // преобразование ответа в массив
            $answer_arr = json_decode($this->answer,true);
            // проверка наличия ошибки при запросе
            if(isset($answer_arr['error'])){
                // запись лога об ошибке
                file_put_contents('logs/error_wall.get.log',
                                 'error method:wall.get '.date('d.m.Y G:i:s').
                                 ' id_group='.$id_group.
                                 ' error_code='.$answer_arr['error']['error_code'].
                                 ' error_msg='.$answer_arr['error']['error_msg']."\n"
                                 ,FILE_APPEND
                                 );
                
                file_put_contents('logs/sss.log',
                                  "ERROR============== \n".
                                  $day."\n".
                                  "{$request} \n".
                                  $answer_arr['error']['error_msg']."\n".
                                  "-------------------------------\n"
                                  ,
                                  FILE_APPEND
                                  );
                // возврат на исходную в случае ошибки
                $i=$i-1;continue;
            }
            // проверка даты поста на соотвествие действующему дню
            $post_day = date("d.m.Y",$answer_arr['response']['items'][0]['date']); // дата поста
            // проверка поста на закрепленность
            if($answer_arr['response']['items'][0]['is_pinned'] == null){
                $is_pinned = 0;}else{$is_pinned = 1;
            }
            if($day == $post_day){ // если дата соотвествует, данные о посте заносятся в таблицу vk_posts
                // проверка наличия записи о посте в БД - если нету => записать
                 if($this->id_connect_DB->createCommand('SELECT * FROM vk_posts WHERE id_group_post=\''.$id_group.'_'.$answer_arr['response']['items'][0]['id'].'\'')->queryAll() == null){

                    // id поста, по которому пост идентифицируется в БД
                    $this->id_group_post = $id_group.'_'.$answer_arr['response']['items'][0]['id'];
                    // проверка наличия количества о просмотре поста
                    if($answer_arr['response']['items'][0]['views']['count'] == null){
                        $posts_views = 0;    
                    }else{
                        $posts_views = $answer_arr['response']['items'][0]['views']['count'];     
                    }
                    // формирование ссылки на пост
                    /*ссылка на пост группы*/    
                    if($this->arr_type_group[$id_group] == 'group'){
                        $link_post = "https://vk.com/club{$id_group}?w=wall-{$id_group}_{$answer_arr['response']['items'][0]['id']}";    
                    } 
                    /* ссылка на пост публичной страницы*/ 
                    if($this->arr_type_group[$id_group]== 'page'){
                        $link_post = "https://vk.com/public{$id_group}?w=wall-{$id_group}_{$answer_arr['response']['items'][0]['id']}";    
                    }  
                    // формирование запроса на добавление информации о посте
                    $query_INSERT="INSERT INTO vk_posts(id_group_post, id_post, id_group, link_post, is_pinned, count, date_unix, date_post, time_post, text_post, comments, likes, reposts, views) VALUES (
                            '{$this->id_group_post}',
                            {$answer_arr['response']['items'][0]['id']},
                            {$id_group},
                            '{$link_post}',
                            {$is_pinned},
                            {$answer_arr['response']['count']},
                            {$answer_arr['response']['items'][0]['date']},
                            '".date('d.m.Y',$answer_arr['response']['items'][0]['date'])."',
                            '".date('G:i',$answer_arr['response']['items'][0]['date'])."',
                            '".str_replace("'","\'",$answer_arr['response']['items'][0]['text'])."',
                            {$answer_arr['response']['items'][0]['comments']['count']},
                            {$answer_arr['response']['items'][0]['likes']['count']},
                            {$answer_arr['response']['items'][0]['reposts']['count']},
                            {$answer_arr['response']['items'][0]['views']['count']}
                            )"; 
                   
                // запись лога об успешном запросе SELECT COUNT(DISTINCT id_group) FROM vk_posts
                file_put_contents('logs/sss.log',
                                  "success \n".
                                  "сравнение дней ".$day." = ".$post_day."\n".
                                  "{$request} \n".
                                  str_replace("\n",'',$query_INSERT)."\n".
                                  "-------------------------------\n"
                                  ,
                                  FILE_APPEND
                                  );
                // запись в БД информации о посте
                $this->id_connect_DB->createCommand($query_INSERT)->execute();
                }
            }elseif($is_pinned == 1){
                file_put_contents('logs/sss.log',
                                  "danger \n".
                                  "сравнение дней ".$day." = ".$post_day."\n".
                                  "{$request} \n".
                                  str_replace("\n",'',$query_INSERT)."\n".
                                  "-------------------------------\n"
                                  ,
                                  FILE_APPEND
                                  );
                continue;
            }else{
                //return $this->answer = $answer_arr;
                file_put_contents('logs/sss.log',
                                  "error \n".
                                  "сравнение дней ".$day." = ".$post_day."\n".
                                  "{$request} \n".
                                  "-------------------------------\n"
                                  ,
                                  FILE_APPEND
                                  );
                return;
            }/*$day == $post_day*/

                    
                    // проверка attachments к посту
                    if($answer_arr['response']['items'][0]['attachments'] != null){
//                        $this->arr_attach["{$this->arr_id_group[$i]['group_id']}_{$answer_arr['response']['items'][$j]['id']}"] = $answer_arr['response']['items'][$j]['attachments'];
//                        /*
//                        file_put_contents('attach.txt',
//                                  serialize($answer_arr['response']['items'][$j]['attachments'])."\n------------------------------------\n",
//                                  //$answer_arr['response']['items'][$j]['date'],  
//                                  FILE_APPEND
//                                  );
//                        */
//                        foreach($answer_arr['response']['items'][$j]['attachments'] as $attach){
//                            // определить тип attachments и применить соответствующую функцию
//                            if($attach['type'] == 'photo'){
//                                $this->insert_attach_photo($attach['photo'], $this->id_group_post);        
//                            }  
//                        }
                    }/*if($answer_arr['response']['items'][$j]['attachments'] != null){*/
                
                }/* for($i=0; $i<count($this->arr_id_group); $i++) */
         
                //return $this->answer = $answer_arr;
                return;
            } /* function get_posts_day_2 */
    
    
    
    // функция последовательного получения постов
    function get_one_post($id_group){
        for($i=0; ; $i++){
            // запрос
            $this->answer = $this->curl_get("https://api.vk.com/method/wall.get?owner_id=-{$id_group}&count=1&offset={$i}&filter=owner&extended=1&v=5.69&access_token=33be01cf14cf4e807b075601e45972657fd2c7fd532da9e20a1b641f85b6c4a4bb22ff38b71167321b02b");
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
                    // возврат на исходную в случае ошибки
                    $i=$i-1;continue;
                }
        }	
    }
    
    
    //извлечение постов в БД за конкретный день
    function select_posts_day(){
        // определение текущей даты
        $now_day = date("d.m.Y",time());
        // формирование запроса для выборки из БД
        $query_posts = "SELECT * FROM vk_posts WHERE date_post='{$now_day}' ORDER BY date_unix DESC";
        // запрос к БД
        $this->arr_posts_for_day=$this->id_connect_DB->createCommand($query_posts)->queryAll();
        /*запись в файл полученного массива
        
         file_put_contents('select_posts_day.txt',
                            json_encode($this->arr_posts_for_day).
                            "\n------------------------------------\n", 
                            FILE_APPEND
                            );
        */
    }
    
    // запись в БД информации об attachments type => photo
    function insert_attach_photo($arr_photo, $id_group_post){
                        /*
                        file_put_contents('attach_photo.txt',
                                  //serialize($arr_photo)."\n------------------------------------\n",
                                  $arr_photo['photo_604']."\n------------------------------------\n", 
                                  FILE_APPEND
                                  );
                         */
        
        // формирование запроса на добавление информации об attachments к посту
        $query_INSERT="INSERT INTO `vk_attachments` (`id_group_post`, `id_photo`, `album_id`, `owner_id`, `photo_1280`, `date_unix`, `date`, `time`)                 VALUES(
                        '{$id_group_post}',
                        {$arr_photo['id']},
                        {$arr_photo['album_id']},
                        {$arr_photo['owner_id']},
                        '".$arr_photo['photo_604']."',
                        {$arr_photo['date']},
                        '".date('d.m.Y',$arr_photo['date'])."',
                        '".date('G:i',$arr_photo['date'])."'
                        )";
        
        
       // запись в БД
        $this->id_connect_DB->createCommand($query_INSERT)->execute(); 
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}