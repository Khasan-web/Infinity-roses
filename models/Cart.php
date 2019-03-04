<?php
namespace app\models;
use Yii;
use yii\db\ActiveRecord;
class Cart extends ActiveRecord {
    
    public function addToCart($product, $size, $color, $accessories) {
        $priceFromSize = 'price_' . $size;
        $i = count($_SESSION['cart']);
        if ($i != 0) {
            for ($id = 0; $id <= $i; $id++) {
                if ($_SESSION['cart'][$id]['id'] == $product->id && $_SESSION['cart'][$id]['name'] == $product->name && $_SESSION['cart'][$id]['size'] == $size && $_SESSION['cart'][$id]['parfume'] == $accessories['parfume'] && $_SESSION['cart'][$id]['chocolate'] == $accessories['chocolate'] && $_SESSION['cart'][$id]['color'] == $color['color']) {
                    $_SESSION['cart'][$id]['qty'] += 1;
                    break;
                }
                if ($id == $i) {
                    $_SESSION['cart'][$i] = [
                        'id' => $product->id,
                        'qty' => 1,
                        'name' => $product->name,
                        'price' => $product->price, // not correct, also size!
                        // 'price' => $product->$priceFromSize // after you will add true db structure
                        'img' => $color['img'],
                        'size' => $size,
                        'color' => $color['color'],
                        'parfume' => $accessories['parfume'], // if accessories will not be important set them in condition
                        'chocolate' => $accessories['chocolate'],
                    ];
                    break;
                }
            }
        } else {
            $_SESSION['cart'][$i] = [
                'id' => $product->id,
                'qty' => 1,
                'name' => $product->name,
                'price' => $product->price, // not correct, also size!
                'img' => $color['img'],
                'size' => $size,
                'color' => $color['color'],
                'parfume' => $accessories['parfume'], // if accessories will not be important set them in condition
                'chocolate' => $accessories['chocolate'],
            ];
        }
    $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + 1 : 1;
    $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $product->price : $product->price;
    }
    public function delItem($id) {
        $productIndex;
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