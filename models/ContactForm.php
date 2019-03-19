<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $phone;
    public $email;
    public $message;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'message'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose('contact', [
                'name' => $this->name,
                'email' => $this->email,
                'message' => $this->message,
                ])
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject('Mail from contact form | Infinity roses')
                ->setTextBody($this->message)
                ->send();

            return true;
        }
        return false;
    }
}
