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
    <?php echo '<pre>'.print_r($posts_day,true).'</pre>'?>
    
    <?php /*echo '<pre>'.print_r($answer,true).'</pre>'*/?>
    
    <div class="container">
        
    <?php foreach($posts_day as $post):?> 
        <?php foreach($post['response']['items'] as $item):?>   
        <div class="row">
            <p><img class="img-circle" src="<?=$post['response']['groups'][0]['photo_100'] ?>" alt="">
            <span><strong><?=$post['response']['groups'][0]['name'] ?></strong></span>
            </p>
            <span><?=$item['text']?></span>
            <!--            attachment-->
            <?php foreach($item['attachments'] as $post):?>
                
            <?php endforeach;?>
            <hr>
        </div>
        <?php endforeach;?>
    <?php endforeach;?>
        
    </div>



    </div>
<?php endif;?>