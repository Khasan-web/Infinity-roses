<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;
use app\models\Product;
use app\models\Cart;
use app\models\Order;
use app\models\OrderItems;

class CartController extends AppController {

    public function actionView() {
        $hits = Product::find()->where(['hit' => '1'])->all();
        $name = getLang('name');
        $session = Yii::$app->session;
        $session->open();

        $order = new Order();
        if ($order->load(Yii::$app->request->post())) {
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];
            if ($order->save()) {
                $this->saveOrderItem($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', Yii::t('app', 'Order successfully accepted, manager will contact with you soon'));
                if ($order->email) {
                    Yii::$app->mailer->compose('order', compact('session'))
                    ->setFrom([Yii::$app->params['adminEmail'] => 'Infinity roses'])
                    ->setTo($order->email)
                    ->setSubject("List of products | Infinity roses")
                    ->send();
                }
                // Send to admin
                // Yii::$app->mailer->compose('order', compact('session'))
                // ->setFrom(['info@infinityroses.uz' => 'Infinity roses'])
                // ->setTo($order->email)
                // ->setSubject("Order from $order->name | Infinity roses")
                // ->send();
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Please fill out all required fileds in form'));
            }
        }
        $this->setMeta(Yii::t('app', 'Your Cart'));
        return $this->render('view', compact('session', 'order', 'hits', 'name'));
    }

    public function actionAdd() {
        $id = Yii::$app->request->get('id');
        $data = Yii::$app->request->get('data');
        $product = Product::findOne($id);
        if (empty($product)) {
            return false;
        }
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        if (empty($data['accessories'])) {
            $data['accessories']['parfume'] = false;
            $data['accessories']['chocolate'] = false;
        }
        if (empty($data['vase'])) {
            $data['vase'] = false;
        }
        $cart->addToCart($product, $data['size'], $data['color'], $data['accessories'], $data['vase']);
        // name of accessories will be added after they will be in the db

        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionClear() {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionShowCart() {
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionDelItem() {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->delItem($id);
        $this->layout = false;
        return $this->render('cart-modal', compact('session', 'lang'));
    }

    protected function saveOrderItem($items, $order_id) {
        foreach ($items as $item) {
            $order_items = new OrderItems;
            $order_items->product_id = $item['id'];
            $order_items->order_id = $order_id;
            $order_items->name = $item['name'];
            $order_items->size = $item['size'];
            $order_items->color = $item['color'];
            $order_items->parfume = $item['parfume'] == false ? null : $item['parfume'];
            $order_items->chocolate = $item['chocolate'] == false ? null : $item['chocolate'];
            $order_items->price = $item['price'];
            $order_items->vase = $item['vase'] != false ? '1' : '0';
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['price'] * $item['qty'];
            $order_items->save();
        }
    }

}
