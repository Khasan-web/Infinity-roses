<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\AdminTitle;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gallery';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= AdminTitle::widget(['title' => $this->title])?>
<div class="gallery-index page-content">

    <p>
        <?= Html::a('Add new images', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'img',
            [
                'attribute' => 'img',
                'label' => 'Image',
                'value' => function ($data) {
                    return "<img width='100' src='/web/upload/store/gallery/$data->img' alt='gallery image'>";
                },
                'format' => 'html',
            ],
            // 'category_id',
            [
                'attribute' => 'category_id',
                'label' => 'Category',
                'value' => function ($data) {
                    return $data->category->name_en;
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'headerOptions' => ['style' => 'width: 20%'],
                'contentOptions' => ['style' => 'text-align: center'],
                'buttons' => [
                    'view' => function ($url) {
                        return false;
                    },
                    'update' => function ($url) {
                        return false;
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
    ]); ?>
</div>
