<?php

namespace app\modules\admin\controllers;

use app\models\User;
use yii\web\UploadedFile;
use Yii;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AppAdminController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->setMeta('Dashboard');
        return $this->render('index');
    }

    public function actionProfile () {
        $user = User::find()->one();
        if ($user->load(Yii::$app->request->post())) {
            $password = Yii::$app->security->generatePasswordHash($user->newPassword);
            $user->password = $password;
            $user->save();
            $user->image = UploadedFile::getInstance($user, 'image');
            if ($user->image) {
                $user->upload();
            }
            unset($model->image);
            if ($user->newPassword) {
                Yii::$app->user->logout();
                return $this->redirect(Yii::$app->request->referrer);
            }
        }

        $this->setMeta('Profile');
        return $this->render('profile', compact('user'));
    }
}
