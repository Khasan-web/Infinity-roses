<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\AdminTitle;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= AdminTitle::widget(['title' => $this->title])?>
<div class="category-index page-content">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name_en',
            'name_ru',
            // 'description_en:ntext',
            // 'description_ru:ntext',
            //'keywords',

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
    ]); ?>
</div>
