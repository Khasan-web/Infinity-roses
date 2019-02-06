<?php

namespace app\components;
use yii\base\Widget;
use Yii;

class Navbar extends Widget { 

    public $bg;
    public $navbar;

    public function init() {
        parent::init();
    }

    public function run() {
        $navbar = include __DIR__ . '\navbar\navbar.php';
        return $this->navbar;
    }

}