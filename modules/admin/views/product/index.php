<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\AdminTitle;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= AdminTitle::widget(['title' => $this->title])?>
<div class="product-index page-content">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="table-responsive">
        <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            [
                'attribute' => 'category_id',
                'value' => function ($data) {
                    return "<a href='" . Url::to(['category/view', 'id' => $data->category->id]) . "'>" . $data->category->name_en ."</a>";
                },
                'format' => 'html',
            ],
            'keywords',
            [
                'attribute' => 'hit',
                'value' => function ($data) {
                    return !$data->hit ? '<span class="text-danger"><i class="fa fa-times"></i></span>' : '<span class="text-success"><i class="fa fa-check"></i></span>';
                },
                'format' => 'html',
                'label' => 'Hit 1 | 0',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'headerOptions' => ['style' => 'width: 20%'],
                'contentOptions' => ['style' => 'text-align: center'],
                'buttons' => [
                    'view' => function ($url) {
                        return Html::a(
                            '<span class="btn btn-info btn-xs"><i class="fa fa-eye"></i>&nbsp;View</span>',
                            $url, 
                            [
                                'title' => 'View',
                                'data-pjax' => '0',
                            ]
                        );
                    },
                    'update' => function ($url) {
                        return Html::a(
                            '<span class="btn btn-default btn-xs"><i class="fa fa-edit"></i>&nbsp;Edit</span>',
                            $url, 
                            [
                                'title' => 'Update',
                                'data-pjax' => '0',
                            ]
                        );
                    },
                    'delete' => function ($url) {
                        return Html::a('<span class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>&nbsp;Delete</span>', $url, [
                                    'title' => Yii::t('app', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete?'),
                                    'data-method' => 'post', 'data-pjax' => '0',
                        ]);
                    }
                    
                ]
            ],
        ],
    ]); 
    Pjax::end();?>
    </div>
</div>