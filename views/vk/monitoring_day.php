<?php

use yii\helpers\Url;

$this->title = ('Мониторинг за день');

?>

<div class="container">   
    <h3>Мониторинг за день</h3>
    <a href="<?= Url::to(['monitoring-day', 'par'=>'start']); ?>" class="btn btn-success">Начать</a>
</div>


<?php if($par == 'start'):?>
    <div class="container" id="results-monitoring">
    <h4>Результат мониторинга</h4>
    
    <?php /*echo '<pre>'.print_r($id_group,true).'</pre>'*/?>
    <?php echo '<pre>'.print_r($posts_day,true).'</pre>' /**/?>
    
    <?php /*echo '<pre>'.print_r($type_group,true).'</pre>'*/?>
    
    <div class="row">
        <?php foreach($posts_day as $post):?> 
            <?php /*проверка на наличие ошибки при запросе - error_code 6*/
                if($post['error']){
                    echo '<pre>'.print_r($post,true).'</pre>'; 
                    echo '<h4 style="color:red;"><strong>Ошибка запроса</strong></h4>';
                    echo '<a href="https://vk.com/club'.substr($post['error']['request_params'][2]['value'],1).'" target="_blank">группа</a>';
                    continue;
                }//if($post['error'])
            ?>
            <?php /*при успешном запросе*/?>
            <?php foreach($post['response']['items'] as $item):?>   
                <div class="panel panel-info">
					<!--Название группы & логотип-->
					<div class="panel-heading">
					    <div class="row">
					        <div class="col-lg-1">
					            <!--Логотип-->
                                <img class="img-circle" src="<?=$post['response']['groups'][0]['photo_100']?>" width="70px" alt="">    
					        </div>
					        <div class="col-lg-11">
                                <!--Название группы-->
                                <a href="<?='https://vk.com/club'.substr($post['response']['items'][0]['owner_id'],1)?>" target="_blank"><span><strong><?=$post['response']['groups'][0]['name'] ?></strong></span></a>
                                <br>
                                <!--дата поста-->
                                <span class="text-muted"><?=date("d.m.Y G:i",$item['date'])?></span>
                                <br>
                                <!--ссылка на пост-->
                                <?php if($type_group[substr($post['response']['items'][0]['owner_id'],1)] == 'group' ): ?>
                                <?php /*ссылка на пост группы*/  ?>
                                    <span class="text-warning"><a href="<?='https://vk.com/club'.substr($post['response']['items'][0]['owner_id'],1).'?w=wall'.$post['response']['items'][0]['owner_id'].'_'.$post['response']['items'][0]['id']?>" target="_blank">ссылка на пост</a></span>
                                <?php endif;?>
                                <?php if($type_group[substr($post['response']['items'][0]['owner_id'],1)] == 'page' ): ?>
                                <?php /* ссылка на пост публичной страницы*/ ?>
                                    <span class="text-warning"><a href="<?='https://vk.com/public'.substr($post['response']['items'][0]['owner_id'],1).'?w=wall'.$post['response']['items'][0]['owner_id'].'_'.$post['response']['items'][0]['id']?>" target="_blank">ссылка на пост</a></span>
                                <?php endif;?>    
					        </div>
					    </div> <!--class="panel-heading"-->
                    </div><!--class="panel-heading"-->
					<div class="panel-body">
                        <!--Текст поста-->    
					    <?=str_replace('💪🏻','',$item['text'])?> 
					</div><!--class="panel-body"-->
				</div><!--class="panel panel-info"-->
            <?php endforeach;?>       
        <?php endforeach; /*foreach($posts_day as $post):*/?>  
    </div>
    </div><!--    id="results-monitoring"-->
<?php endif /*if($par == 'start')*/;?>