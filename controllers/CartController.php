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
        $session = Yii::$app->session;
        $session->open();
        $order = new Order();
        if ($order->load(Yii::$app->request->post())) {
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];
            if ($order->save()) {
                $this->saveOrderItem($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', 'Order successfuly accepted, manager will contact with you soon');
                Yii::$app->mailer->compose('order', compact('session'))
                ->setFrom(['info@infinityroses.uz' => 'Infinity roses'])
                ->setTo($order->email)
                ->setSubject("Order from $order->name | Infinity roses")
                ->send();
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('success', 'Error in order formalization');
            }
        }
        $this->setMeta('Cart | Infinity Roses');
        return $this->render('view', compact('session', 'order'));
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
        $cart->addToCart($product, $data['size'], $data['color'], $data['accessories']);
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
            $order_items->parfume = $item['parfume'];
            $order_items->chocolate = $item['chocolate'];
            $order_items->price = $item['price'];
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['price'] * $item['qty'];
            $order_items->save();

        }
    }

}

?>