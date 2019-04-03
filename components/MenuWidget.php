<?php

namespace app\components;
use yii\base\Widget;
use app\models\Category;
use Yii;

class MenuWidget extends Widget {

    public $tpl;
    public $model;
    public $data; // simply array
    public $tree; // array as tree where we can see what products every category has
    public $menuHtml; 

    public function init() {
        parent::init();
        if ($this->tpl === null) {
            $tpl = 'select-product';
        }
        $this->tpl .= '.php';
    }

    public function run() {
        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
        return $this->menuHtml;
    }

    protected function getTree() {
        $tree = [];
        foreach ($this->data as $id=>&$node) {
            if (!isset($node['parent_id'])) {
                $tree[$id] = &$node;
            } else {
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
            }
        }
        return $tree;
    }

    protected function getMenuHtml($tree, $tab = '') {
        $str = ''; // ready html code
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category, $tab);
        }
        return $str;
    }

    protected function catToTemplate($category, $tab) {
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->tpl;
        return ob_get_clean();
    }

}


?>