<?php
namespace app\models;
use Yii;
use yii\db\ActiveRecord;
class Cart extends ActiveRecord {
    
    public function addToCart($product, $size, $color, $accessories, $vase = false) {
        $cart_count = 0;
        $cart_count = count($_SESSION['cart']);
        $new = true;
        if ($cart_count > 1) {
            for ($id = 0; $id <= $cart_count; $id++) {
                if ($_SESSION['cart'][$id]['id'] == $product->id && 
                    $_SESSION['cart'][$id]['name'] == $product->name && 
                    $_SESSION['cart'][$id]['size'] == $size['selected_size'] && 
                    $_SESSION['cart'][$id]['parfume'] == $accessories['parfume'] && 
                    $_SESSION['cart'][$id]['chocolate'] == $accessories['chocolate'] && 
                    $_SESSION['cart'][$id]['color'] == $color['color'] &&
                    $_SESSION['cart'][$id]['vase'] == $vase)
                {

                    $_SESSION['cart'][$id]['qty'] += 1;
                    $new = false;
                    break;

                }
            }
            if ($new) {
                $_SESSION['cart'][$cart_count] = [
                    'id' => $product->id,
                    'qty' => 1,
                    'name' => $product->name,
                    'price' => $size['price'],
                    'img' => $color['img'],
                    'size' => $size['selected_size'],
                    'color' => $color['color'],
                    'parfume' => empty($accessories) ? $accessories['parfume'] : false, // if accessories will not be important set them in condition
                    'chocolate' => empty($accessories) ? $accessories['chocolate'] : false,
                    'vase' => $vase,
                ];
            }

        } else {
            $_SESSION['cart'][$cart_count] = [
                'id' => $product->id,
                'qty' => 1,
                'name' => $product->name,
                'price' => $size['price'],
                'img' => $color['img'],
                'size' => $size['selected_size'],
                'color' => $color['color'],
                'parfume' => empty($accessories) ? $accessories['parfume'] : false, // if accessories will not be important set them in condition
                'chocolate' => empty($accessories) ? $accessories['chocolate'] : false,
                'vase' => $vase,
            ];
        }
    $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + 1 : 1;
    $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $size['price'] : $size['price'];
    }
    public function delItem($id) {
        $productIndex = false;
        for ($i = 0; $i < count($_SESSION['cart']); $i++) {
            if ($_SESSION['cart'][$i]['id'] != $id && $i == count($_SESSION['cart']) - 1) {
                return false;
            }
            if ($_SESSION['cart'][$i]['id'] == $id) {
                $productIndex = $i;
            }
        }
        $qtyMinus = $_SESSION['cart'][$productIndex]['qty'];
        $sumMinus = $_SESSION['cart'][$productIndex]['qty'] * $_SESSION['cart'][$productIndex]['price'];
        $_SESSION['cart.qty'] -= $qtyMinus;
        $_SESSION['cart.sum'] -= $sumMinus;
        unset($_SESSION['cart'][$productIndex]);
    }
}
?>