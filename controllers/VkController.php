<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 19.11.2018
 * Time: 16:24
 */

namespace app\controllers;

use app\models\VkAccountsPhotoSizes;
use Yii;
use yii\web\Controller;
use app\models\VkGroups;
use app\models\VkGroupContacts;
use app\models\VkGroupCoverImages;
use app\models\VkGroupLinks;
use yii\data\ActiveDataProvider;
use app\models\VkAccounts;

// модель сбора постов за день
use app\models\VkMonitoringDay;

class VkController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    //******************работа с группами********************\\
    public function actionGroup_settings(){
        $dataProvider = new ActiveDataProvider([
            'query' => VkGroups::find(),
            'pagination' => [
                'pageSize' => 20,
                'forcePageParam' => false,
                'pageSizeParam' => false,
            ],
        ]);
        $groups = VkGroups::find()->asArray()->all();
        return $this->render('group_settings', [
            'dataProvider' => $dataProvider,
            'groups' => $groups,
        ]);
    }

    public function actionAdd_group()
    {
        $labels = new VkGroups();
        if ($labels->load(Yii::$app->request->post())) {
            $input = Yii::$app->request->post();
            if ($input['VkGroups']['url']) {
                $explode_url = parse_url($input['VkGroups']['url']);
                $group_ids = substr($explode_url['path'], 1);

                //****************API VK***************\\
                $fields = ['city', 'country', 'place', 'description', 'wiki_page', 'market', 'members_count', 'counters', 'start_date', 'finish_date', 'can_post', 'can_see_all_posts', 'activity', 'status', 'contacts', 'links', 'fixed_post', 'verified', 'site', 'ban_info', 'cover'];

                $request_params = [
                    'group_ids' => $group_ids,
                    'fields' => implode(',', $fields),
                    'v' => '5.88',
                    'access_token' => '18b4f2473ede6221b51759dd1fbd88f54a8e6d3f857cb8ce591da8f0e5808b200a97f97855beb334aee15'
                ];

                $url = 'https://api.vk.com/method/groups.getById?' . http_build_query($request_params);
                $result = file_get_contents($url);

                $result = json_decode($result, true);
                $result = $result['response'][0];
                //***************конец API VK************\\

                $test_id = VkGroups::find()->where(['group_id' => $result['id']])->one();

                if (!$test_id) {
                    $labels->group_id = $result['id'];
                    $labels->name = $result['name'];
                    $labels->screen_name = $result['screen_name'];
                    $labels->is_closed = $result['is_closed'];
                    $labels->type = $result['type'];
                    $labels->city = $result['city']['title'];
                    $labels->country = $result['country']['title'];
                    $labels->description = $result['description'];
                    $labels->members_count = $result['members_count'];
                    $labels->counters_photos = $result['counters']['photos'];
                    $labels->counters_albums = $result['counters']['albums'];
                    $labels->counters_topics = $result['counters']['topics'];
                    $labels->counters_videos = $result['counters']['videos'];
                    $labels->counters_audios = $result['counters']['audios'];
                    $labels->counters_market = $result['counters']['market'];
                    $labels->activity = $result['activity'];
                    $labels->status = $result['status'];
                    $labels->fixed_post = $result['fixed_post'];
                    $labels->verified = $result['verified'];
                    $labels->site = $result['site'];
                    $labels->cover_enabled = $result['cover']['enabled'];
                    $labels->photo_50 = $result['photo_50'];
                    $labels->photo_100 = $result['photo_100'];
                    $labels->photo_200 = $result['photo_200'];
                    $labels->url = $input['VkGroups']['url'];
                    $labels->save();

                    if ($result['contacts']) {
                        foreach ($result['contacts'] as $contact) {
                            $contacts = new VkGroupContacts();
                            $contacts->group_id = $result['id'];
                            $contacts->user_id = $contact['user_id'];
                            $contacts->desc = $contact['desc'];
                            $contacts->phone = $contact['phone'];
                            $contacts->email = $contact['email'];
                            $contacts->save();
                        }
                    }

                    if ($result['cover']['images']) {
                        foreach ($result['cover']['images'] as $image) {
                            $cover = new VkGroupCoverImages();
                            $cover->group_id = $result['id'];
                            $cover->url = $image['url'];
                            $cover->width = $image['width'];
                            $cover->height = $image['height'];
                            $cover->save();
                        }
                    }

                    if ($result['links']) {
                        foreach ($result['links'] as $link) {
                            $links = new VkGroupLinks();
                            $links->group_id = $result['id'];
                            $links->url = $link['url'];
                            $links->edit_title = $link['edit_title'];
                            $links->name = $link['name'];
                            $links->desc = $link['desc'];
                            $links->photo_50 = $link['photo_50'];
                            $links->photo_100 = $link['photo_100'];
                            $links->save();
                        }
                    }

                    return $this->render('add_group', [
                        'group_info' => $result,
                        'labels' => $labels,
                    ]);
                } else {
                    Yii::$app->session->setFlash('success', "Группа уже есть");
                    return $this->redirect(['/vk/group_settings']);
                }
            } elseif ($input['VkGroups']['name']) {
                if ($input['VkGroups']['name'] === 'DELETE') {
                    $this->deleteGroup($input['VkGroups']['group_id']);
                    return $this->redirect(['/vk/group_settings']);
                } else {
                    Yii::$app->session->setFlash('success', "Группа \"{$input['VkGroups']['name']}\" добавлена");
                    return $this->redirect(['/vk/group_settings']);
                }
            }
        }
        return $this->render('add_group', [
            'labels' => $labels,
        ]);
    }

    public function actionDelete_group($group_id)
    {
        $this->deleteGroup($group_id);
        $this->redirect(['/vk/group_settings']);
    }

    private function deleteGroup($group_id)
    {
        $delete = VkGroups::find()->where(['group_id' => $group_id])->one();
        $delete->delete();
        VkGroupContacts::deleteAll(['group_id' => $group_id]);
        VkGroupCoverImages::deleteAll(['group_id' => $group_id]);
        VkGroupLinks::deleteAll(['group_id' => $group_id]);
    }

    public function actionDelete_group_by_id($id){
        $delete = VkGroups::find()->select('group_id')->where(['id' => $id])->one();
        $this->deleteGroup($delete);
    }

    //**********************конец работы с группами*********************\\

    //**********************работа с аккаунтами*************************\\
    public function actionAccount_settings(){
        $dataProvider = new ActiveDataProvider([
            'query' => VkAccounts::find(),
            'pagination' => [
                'pageSize' => 20,
                'forcePageParam' => false,
                'pageSizeParam' => false,
            ],
        ]);
        $accounts = VkAccounts::find()->asArray()->all();
        return $this->render('account_settings', [
            'dataProvider' => $dataProvider,
            'accounts' => $accounts,
        ]);
    }

    public function actionAdd_account(){
        $labels = new VkAccounts();
        if ($labels->load(Yii::$app->request->post())) {
            $input = Yii::$app->request->post();
            if ($input['VkAccounts']['url']) {
                $explode_url = parse_url($input['VkAccounts']['url']);
                $account_ids = substr($explode_url['path'], 1);

                //****************API VK***************\\
                $fields = ['photo_id', 'verified', 'sex', 'bdate', 'city', 'country', 'home_town', 'has_photo', 'photo_50', 'photo_100', 'photo_200_orig', 'photo_200', 'photo_400_orig', 'photo_max', 'photo_max_orig', 'online', 'domain', 'has_mobile', 'contacts', 'site', 'education', 'universities', 'schools', 'status', 'last_seen', 'followers_count', 'common_count', 'occupation', 'nickname', 'relatives', 'relation', 'personal', 'connections', 'exports', 'activities', 'interests', 'music', 'movies', 'tv', 'books', 'games', 'about', 'quotes', 'can_post', 'can_see_all_posts', 'can_see_audio', 'can_write_private_message', 'can_send_friend_request', 'is_favorite', 'is_hidden_from_feed', 'timezone', 'screen_name', 'maiden_name', 'crop_photo', 'is_friend', 'friend_status', 'career', 'military', 'blacklisted', 'blacklisted_by_me'];

                $request_params = [
                    'user_ids' => $account_ids,
                    'fields' => implode(',', $fields),
                    'name_case' => 'nom',
                    'v' => '5.92',
                    'access_token' => '18b4f2473ede6221b51759dd1fbd88f54a8e6d3f857cb8ce591da8f0e5808b200a97f97855beb334aee15'
                ];

                $url = 'https://api.vk.com/method/users.get?' . http_build_query($request_params);
                $result = file_get_contents($url);

                $result = json_decode($result, true);
                $result = $result['response'][0];
//                debug($result);
                //***************конец API VK************\\

                $test_id = VkAccounts::find()->where(['account_id' => $result['id']])->one();

                if (!$test_id) {
                    $labels->account_id = $result['id'];
                    $labels->first_name = $result['first_name'];
                    $labels->last_name = $result['last_name'];
                    $labels->is_closed = $result['is_closed'];
                    $labels->sex = $result['sex'];
                    $labels->nickname = $result['nickname'];
                    $labels->maiden_name = ($result['maiden_name']) ? $result['maiden_name'] : NULL;                                              //?
                    $labels->domain = $result['domain'];
                    $labels->screen_name = $result['screen_name'];
                    $labels->bdate = ($result['bdate']) ? $result['bdate'] : NULL;                                                                //?
                    $labels->city = ($result['city']['title']) ? $result['city']['title'] : NULL;                                                 //?
                    $labels->country = ($result['country']['title']) ? $result['country']['title'] : NULL;                                        //?
                    $labels->photo_50 = $result['photo_50'];
                    $labels->photo_100 = $result['photo_100'];
                    $labels->photo_200 = $result['photo_200'];
                    $labels->photo_max = $result['photo_max'];
                    $labels->photo_200_orig = $result['photo_200_orig'];
                    $labels->photo_400_orig = $result['photo_400_orig'];
                    $labels->photo_max_orig = $result['photo_max_orig'];
                    $labels->photo_id = ($result['photo_id']) ? $result['photo_id'] : NULL;                                                       //?
                    $labels->online = $result['online'];
                    $labels->can_post = $result['can_post'];
                    $labels->can_see_all_posts = $result['can_see_all_posts'];
                    $labels->can_see_audio = $result['can_see_audio'];
                    $labels->can_write_private_message = $result['can_write_private_message'];
                    $labels->can_send_friend_request = $result['can_send_friend_request'];
                    $labels->facebook = ($result['facebook']) ? $result['facebook'] : NULL;                                                       //?
                    $labels->facebook_name = ($result['facebook_name']) ? $result['facebook_name'] : NULL;                                        //?
                    $labels->twitter = ($result['twitter']) ? $result['twitter'] : NULL;                                                          //?
                    $labels->instagram = ($result['instagram']) ? $result['instagram'] : NULL;                                                    //?
                    $labels->site = ($result['site']) ? $result['site'] : NULL;                                                                   //?
                    $labels->status = $result['status'];
                    $labels->last_seen_time = $result['last_seen']['time'];
                    $labels->last_seen_platform = $result['last_seen']['platform'];
                    $labels->crop_photo_id = ($result['crop_photo']['photo']['id']) ? $result['crop_photo']['photo']['id'] : NULL;                //?
                    $labels->crop_photo_text = ($result['crop_photo']['photo']['text']) ? $result['crop_photo']['photo']['text'] : NULL;          //?
                    $labels->crop_photo_date = ($result['crop_photo']['photo']['date']) ? $result['crop_photo']['photo']['date'] : NULL;          //?
                    $labels->crop_photo_post_id = ($result['crop_photo']['photo']['post_id']) ? $result['crop_photo']['photo']['post_id'] : NULL; //?
                    $labels->verified = $result['verified'];
                    $labels->followers_count = ($result['followers_count']) ? $result['followers_count'] : NULL;                                  //?
                    $labels->occupation_type = ($result['occupation']['type']) ? $result['occupation']['type'] : NULL;                            //?
                    $labels->occupation_name = ($result['occupation']['name']) ? $result['occupation']['name'] : NULL;                            //?
                    $labels->url = $input['VkAccounts']['url'];
                    $labels->save();

                    if ($result['crop_photo']['photo']['sizes']){
                        foreach ($result['crop_photo']['photo']['sizes'] as $size){
                            $sizes = new VkAccountsPhotoSizes();
                            $sizes->account_id = $result['id'];
                            $sizes->type = $size['type'];
                            $sizes->url = $size['url'];
                            $sizes->width = $size['width'];
                            $sizes->height = $size['height'];
                            $sizes->save();
                        }
                    }

                    return $this->render('add_group', [
                        'account_info' => $result,
                        'labels' => $labels,
                    ]);
                } else {
                    Yii::$app->session->setFlash('success', "Аккаунт уже есть");
                    return $this->redirect(['/vk/account_settings']);
                }
            } elseif ($input['VkAccounts']['name']) {
                if ($input['VkGroups']['name'] === 'DELETE') {
                    $this->deleteAccount($input['VkGroups']['account_id']);
                    return $this->redirect(['/vk/group_settings']);
                } else {
                    Yii::$app->session->setFlash('success', "Аккаунт \"{$input['VkGroups']['name']}\" добавлен");
                    return $this->redirect(['/vk/account_settings']);
                }
            }
        }
        return $this->render('add_account', [
            'labels' => $labels,
        ]);
    }


    public function actionDelete_account($account_id)
    {
        $this->deleteAccount($account_id);
        $this->redirect(['/vk/account_settings']);
    }

    private function deleteAccount($account_id){
        $delete = VkAccounts::find()->where(['account_id' => $account_id])->one();
        $delete->delete();
        VkAccountsPhotoSizes::deleteAll(['account_id' => $account_id]);
    }
    
    
    
    // мониторинг за день
    public function actionMonitoringDay(){
        // сбор постов
        if(Yii::$app->request->get('par') == 'start'){
            // создание объекта класса VkMonitoringDay
            $object_day = new VkMonitoringDay();    
            // вызов главной функции модели
            $object_day->main();
            // посты
            $posts_day = $object_day->arr_posts;
            // attachments
            $posts_attach = $object_day->arr_attach; //arr_attach
            // ответ
            $answer = $object_day->answer;
            
            return $this->render('monitoring_day',['par'=>'start', 
                                                   //'id_group'=>$id_group,
                                                   'posts_day'=>$posts_day,
                                                   //'answer'=>$answer,
                                                   'answer'=>$object_day->answer,
                                                   'posts_attach'=>$posts_attach,
                                                   'type_group'=>$object_day->arr_type_group // массив с типом группы (сообщества)
                                                  ]);   
        // просмотр собранных постов
        }elseif(Yii::$app->request->get('par') == 'view'){
            // создание объекта класса VkMonitoringDay
            $object_day = new VkMonitoringDay();
            // вызов функции для извлечения постов за конкретный день
            $object_day->select_posts_day();
            return $this->render('monitoring_day',['par'=>'view', 
                                                   'posts_day'=>$object_day->arr_posts_for_day,
                                                  ]); 
        }else{
            return $this->render('monitoring_day');    
        }
        
        
        
    }
    
    
    
    
    
}