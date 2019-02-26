<?php

use yii\helpers\Url;

?>

<li class="dropdown"><a data-hover="dropdown" href="#" class="dropdown-toggle"><i class="fa fa-bell fa-fw"></i><span class="badge badge-green"><?= count($orders)?></span></a>
    <ul class="dropdown-menu dropdown-alerts">
        <li><p>You have <?= count($orders)?> new orders</p></li>
        <li>
            <div class="dropdown-slimscroll">
                <ul>
                    <?php foreach ($orders as $order):?>
                        <?php 
                            $date = strtotime($order['created_at']);
                            $d = date('d/m/Y', $date);
                            $h = date('h:m', $date);
                        ?>
                        <li><a href="<?= Url::to(['order/view', 'id' => $order['id']])?>"><span class="label label-blue"><i class="fa fa-comment"></i></span><?= $order['name']?><span class="pull-right text-muted small"><?= $d?> | <?= $h?></span></a></li>
                    <?php endforeach;?>
                </ul>
            </div>
        </li>
        <li class="last"><a href="<?= Url::to(['order/'])?>" class="text-right">See all orders</a></li>
    </ul>
</li>