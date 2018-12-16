<?php

use yii\helpers\Url;

$this->title = ('Мониторинг за день');
// подключение JS файла
$this->registerJsFile('web/js/VK/monitoring_day.js',['depends' => ['app\assets\AppAsset']]);
?>

<div class="container">   
    <h3>
        Мониторинг за день
        <?=date("d.m.Y",time())?>
    </h3>
    <a href="<?= Url::to(['monitoring-day', 'par'=>'start']); ?>" class="btn btn-danger">Собрать посты</a>
    <a href="<?= Url::to(['monitoring-day', 'par'=>'view']); ?>" class="btn btn-success">Смотреть собранные</a>
</div>

<?php/* РЕЗУЛЬТАТЫ СБОРА ПОСТОВ*/?>
<?php if($par == 'start'):?>
    <div class="container" id="results-monitoring">
    <h4>Результат мониторинга</h4>
    
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading">
                <button class="btn btn-info" data-toggle="collapse" data-target="#hide-me">Массив</button>             
            </div>
            <div class="panel-body collapse" id="hide-me">
                <?php /*echo '<pre>'.print_r($posts_attach,true).'</pre>' */?>
                <?php echo '<pre>'.print_r($answer,true).'</pre>'/**/?>
                <?php /*echo '<pre>'.print_r($posts_day,true).'</pre>' */?>
                <?php /*echo '<pre>'.print_r($type_group,true).'</pre>'*/?>
            </div>
        </div>
    </div>
    

    <?php/* ВЫВОД ОСНОВНОГО КОНТЕНТА - НАЧАЛО*/?>
    <div class="row">
        <div class="col-lg-8">
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
                            <!--Логотип-->
					        <div class="col-lg-2">
                                <img class="img-circle" src="<?=$post['response']['groups'][0]['photo_100']?>" width="70px" alt="">    
					        </div>
                            <!--Название группы-->
                            <div class="col-lg-10">
                                <a href="<?='https://vk.com/club'.substr($post['response']['items'][0]['owner_id'],1)?>" target="_blank">
                                    <span><strong><?=$post['response']['groups'][0]['name'] ?></strong></span>
                                </a>
                                <br>
                                <!--дата поста-->
                                <span class="text-muted"><?=date("d.m.Y G:i",$item['date'])?></span>
                                <br>
                                <!--ссылка на пост-->
                                <?php if($type_group[substr($item['owner_id'],1)] == 'group' ): ?>
                                <?php /*ссылка на пост группы*/  ?>
                                    <span class="text-warning"><a href="<?='https://vk.com/club'.substr($post['response']['items'][0]['owner_id'],1).'?w=wall'.$post['response']['items'][0]['owner_id'].'_'.$item['id']?>" target="_blank">ссылка на пост</a></span>
                                <?php endif;?>
                                <?php if($type_group[substr($item['owner_id'],1)] == 'page' ): ?>
                                <?php /* ссылка на пост публичной страницы*/ ?>
                                    <span class="text-warning"><a href="<?='https://vk.com/public'.substr($post['response']['items'][0]['owner_id'],1).'?w=wall'.$post['response']['items'][0]['owner_id'].'_'.$item['id']?>" target="_blank">ссылка на пост</a></span>
                                <?php endif;?>    
					        </div>
					    </div> <!--class="panel-heading"-->
                    </div><!--class="panel-heading"-->
					<div class="panel-body" style="font-family: -apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,sans-serif">
                        <!--Текст поста-->    
					    <?php $text=nl2br($item['text'])?>
                        <?=mb_strimwidth($text, 0, 350, "...")?>
                        <!--Attachment -->
					</div><!--class="panel-body"-->
				</div><!--class="panel panel-info"-->
            <?php endforeach; /*foreach($post['response']['items'] as $item):*/?>       
        <?php endforeach; /*foreach($posts_day as $post):*/?>
        </div>   <!--class="col-lg-8"-->
    </div><!--class="row"-->
    <?php/* ВЫВОД ОСНОВНОГО КОНТЕНТА - КОНЕЦ*/?>
    
    </div><!--    id="results-monitoring"-->
    
    <?php/*кнопка возврата наверх страницы*/?>
    <button id="toTop" > ^ Наверх </button>
    
<?php endif /*if($par == 'start')*/;?>

<!--==========================================================================-->

<?php/* ВЫВОД СОБРАННЫХ ПОСТОВ*/?>
<?php if($par == 'view'):?>
    <div class="container" id="view-monitoring">
    <h4>Собранные посты</h4>
    
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading">
                <button class="btn btn-info" data-toggle="collapse" data-target="#hide-me">Массив</button>             
            </div>
            <div class="panel-body collapse" id="hide-me">
                <?php /*echo '<pre>'.print_r($posts_attach,true).'</pre>' */?>
                <?php /*echo '<pre>'.print_r($id_group,true).'</pre>'*/?>
                <?php echo '<pre>'.print_r($posts_day,true).'</pre>' /**/?>
                <?php /*echo '<pre>'.print_r($type_group,true).'</pre>'*/?>
            </div>
        </div>
    </div>
    

    <?php/* ВЫВОД ОСНОВНОГО КОНТЕНТА - НАЧАЛО*/?>
    <div class="row">
            <?php foreach($posts_day as $item):?>   
                <div class="panel panel-info">
					<!--Название группы & логотип-->
					<div class="panel-heading">
					    <div class="row">
                            <!--Логотип-->
					        <div class="col-lg-2">
                                <img class="img-circle" src="<?=$post['response']['groups'][0]['photo_100']?>" width="70px" alt="">    
					        </div>
                            <!--Название группы-->
                            <div class="col-lg-10">
                                <a href="<?='https://vk.com/club'.$item['id_group']?>" target="_blank">
                                    <span><strong><?="Имя группы" ?></strong></span>
                                </a>
                                <br>
                                <!--дата поста-->
                                <span class="text-muted"><?=$item['date_post'].' '.$item['time_post']?></span>
                                <br>
                                <!--ссылка на пост-->
                                <?php if($type_group[substr($item['owner_id'],1)] == 'group' ): ?>
                                <?php /*ссылка на пост группы*/  ?>
                                    <span class="text-warning"><a href="<?='https://vk.com/club'.substr($post['response']['items'][0]['owner_id'],1).'?w=wall'.$post['response']['items'][0]['owner_id'].'_'.$item['id']?>" target="_blank">ссылка на пост</a></span>
                                <?php endif;?>
                                <?php if($type_group[substr($item['owner_id'],1)] == 'page' ): ?>
                                <?php /* ссылка на пост публичной страницы*/ ?>
                                    <span class="text-warning"><a href="<?='https://vk.com/public'.substr($post['response']['items'][0]['owner_id'],1).'?w=wall'.$post['response']['items'][0]['owner_id'].'_'.$item['id']?>" target="_blank">ссылка на пост</a></span>
                                <?php endif;?>    
					        </div>
					    </div> <!--class="panel-heading"-->
                    </div><!--class="panel-heading"-->
					<div class="panel-body" style="font-family: -apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,sans-serif">
                        <!--Текст поста-->    
					    <?php $text=nl2br($item['text_post'])?>
                        <?=mb_strimwidth($text, 0, 350, "...")?>
                        <!--Attachment -->
					</div><!--class="panel-body"-->
				</div><!--class="panel panel-info"-->
            <?php endforeach; /*foreach($post['response']['items'] as $item):*/?>    
    </div><!--class="row"-->
    <?php/* ВЫВОД ОСНОВНОГО КОНТЕНТА - КОНЕЦ*/?>
    </div><!--    id="view-monitoring"-->
    
    <?php/*кнопка возврата наверх страницы*/?>
    <button id="toTop" > ^ Наверх </button>
<?php endif /*if($par == 'view')*/;?>



