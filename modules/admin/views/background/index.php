<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\AdminTitle;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Backgrounds';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= AdminTitle::widget(['title' => $this->title])?>
<div class="background-index page-content">

    <p>
        <?= Html::a('Create Background', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                // 'filePath',
                [
                    'attribute' => 'filePath',
                    'value' => function ($data) {
                        return '<img src="' . $data->filePath . '" width="100"></img>';
                    },
                    'format' => 'html',
                ],
                'position',
                'title_en',
                'title_ru',
                //'description_en',
                //'description_ru',

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
</div>
