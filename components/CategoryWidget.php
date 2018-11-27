<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 24.10.2018
 * Time: 16:24
 */

namespace app\components;
use app\models\Categories;
use yii\base\Widget;
use Yii;

class CategoryWidget extends Widget{

    public $name;
    public $data;
    public $tree;
    public $menuHtml;

    public function init(){
        parent::init();
        if ($this->name === null){
            $this->name = 'menu';
        }
        $this->name .= '.php';
    }

    public function run(){
        $menu = Yii::$app->cache->get('menu');
        if ($menu && $this->name === 'menu.php'){
            return $menu;
        } elseif ($this->name === 'select.php'){
            $this->data = Categories::find()->indexBy('id')->asArray()->all();
            $this->tree = $this->getTree();
            $this->menuHtml = $this->getMenuHtml($this->tree);
            return $this->menuHtml;
        } else {
            $this->data = Categories::find()->indexBy('id')->asArray()->all();
            $this->tree = $this->getTree();
            $this->menuHtml = $this->getMenuHtml($this->tree);
            Yii::$app->cache->set('menu', $this->menuHtml, 3600);
            return $this->menuHtml;
        }
    }

    protected function getTree(){
        $tree = [];
        foreach ($this->data as $id => &$node){
            if (!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
        }
        return $tree;
    }

    protected function getMenuHtml($tree){
        $str = '';
        foreach ($tree as $category){
            $str .= $this->catToTemplate($category);
//            echo $str;
        }
        return $str;
    }

    protected function catToTemplate($category){
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->name;
        return ob_get_clean();
    }

}