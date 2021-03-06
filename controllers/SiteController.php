<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\components\Navbar;
use app\models\Product;
use app\models\Events;
use app\models\Gallery;
use app\models\Background;

class SiteController extends AppController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }
    

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {   
        $name = getLang('name');
        $description = getLang('description');
        $title = getLang('title');

        // caching events
        if (Yii::$app->cache->exists('events')) {
            $events = Yii::$app->cache->get('events');
        } else {
            $events_cache = Events::find()->all();
            Yii::$app->cache->set('events', $events_cache, 60);
            $events = $events_cache;
        }
        // end caching events

        // caching gallery
        if (Yii::$app->cache->exists('gallery')) {
            $gallery = Yii::$app->cache->get('gallery');
        } else {
            $gallery_cache = Gallery::find()->asArray()->limit(6)->all();
            Yii::$app->cache->set('gallery', $gallery_cache, 60);
            $gallery = $gallery_cache;
        }
        // end caching gallery

        // caching background
        if (Yii::$app->cache->exists('background')) {
            $background = Yii::$app->cache->get('background');
        } else {
            $background_cache = Background::find()->asArray()->where(['position' => 'home'])->one();
            Yii::$app->cache->set('background', $background_cache, 60);
            $background = $background_cache;
        }
        // end caching background

        // caching hits
        if (Yii::$app->cache->exists('hits')) {
            $hits = Yii::$app->cache->get('hits');
        } else {
            $hits_cache = Product::find()->where(['hit' => '1'])->with('category')->limit(4)->all();
            Yii::$app->cache->set('hits', $hits_cache, 60);
            $hits = $hits_cache;
        }
        // end caching hits
 
        $this->setMeta(null, "Delivery flowers in Tashkent,Roses in Tashkent,Цветы в Ташкенте, Розы в Ташкенте, Доставка роз в Ташкенте, Роза доставка, Цветы доставка, Букеты в ташкенте, Где продаются розы, Самые лучшие розы, Инфинити розы, Atirgullar, Atir gullar Toshkent, Gul Toshkent", "Delivery flowers in Tashkent Цветы в Ташкенте", '/web/img/mail-header.jpg');
        $this->view->title = 'Infinity Roses';
        return $this->render('index', compact('hits', 'lang', 'name', 'description', 'events', 'gallery', 'background', 'title'));
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        $this->setMeta("Login", "keys", "desc");
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        $description = getLang('description');
        $title = getLang('title');
        $background = Background::find()->asArray()->where(['position' => 'contact'])->one();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        $this->setMeta(Yii::t('app', 'Contact Us'));
        return $this->render('contact', compact('model', 'title', 'background', 'description'));
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $this->setMeta(Yii::t('app', 'About Us'), "Delivery flowers in Tashkent,Roses in Tashkent,Цветы в Ташкенте, Розы в Ташкенте, Доставка роз в Ташкенте, Роза доставка, Цветы доставка, Букеты в ташкенте, Где продаются розы, Самые лучшие розы, Инфинити розы, Atirgullar, Atir gullar Toshkent, Gul Toshkent", "Delivery flowers in Tashkent Цветы в Ташкенте", '/web/img/mail-header.jpg');
        return $this->render('about');
    }

    public function actionTermsConditions() {
        $this->setMeta("Terms and conditions");
        return $this->render('terms-conditions');
    }
}
