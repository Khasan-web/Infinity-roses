<?php

namespace app\controllers;
use yii\web\Controller;
use yii\helpers\Url;

class AppController extends Controller {

    protected function setMeta($title = null, $keywords = null, $description = null, $img = null) {
        $this->view->title = $title . ' | Infinity Roses';
        $this->view->registerMetaTag(["name" => "keywords", "content" => "$keywords"]);
        $this->view->registerMetaTag(["name" => "description", "content" => "$description"]);
        // social networks
        $this->view->registerMetaTag(['name' => "og:title", 'content' => "$title"]);
        $this->view->registerMetaTag(['name' => "og:description", 'content' => "$description"]);
        $this->view->registerMetaTag(['name' => "og:image", 'content' => "$img"]);
        $this->view->registerMetaTag(['name' => "og:url", 'content' => '' . Url::base(true) . Url::current() . '']);
        $this->view->registerMetaTag(['name' => "twitter:card", 'content' => "summary_large_image"]);
        $this->view->registerMetaTag(['name' => "twitter:title", 'content' => "$title"]);
        $this->view->registerMetaTag(['name' => "twitter:description", 'content' => "$description"]);
        $this->view->registerMetaTag(['name' => "twitter:image", 'content' => "$img"]);
    }

}


?>