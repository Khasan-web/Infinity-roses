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
        if (Yii::$app->language == 'en') {
            $lang = 0;
        } else if (Yii::$app->language == 'ru') {
            $lang = 1;
        }
        $name = 'name_' . Yii::$app->language;
        $description = 'description_' . Yii::$app->language;
        $events = Events::find()->all();
        // get hits
        if (Yii::$app->cache->get('hits')) {
            $hits = Yii::$app->cache->get('hits');
        } else {
            $hits = Product::find()->where(['hit' => '1'])->with('category')->all();
            Yii::$app->cache->set('hits', $hits, 300);
        }
        $this->setMeta("Home", "keys", "desc");
        return $this->render('index', compact('hits', 'lang', 'name', 'description', 'events'));
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
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        $this->setMeta("Contact", "keys", "desc");
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $this->setMeta("About Us", "keys", "desc");
        return $this->render('about');
    }

    public function actionCategory() {
        $this->setMeta("CatName", "keys", "desc");
        return $this->render('category', compact('bgNav'));
    }
}
