<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $objBuscadorObjeto app\modules\admin\models\ObjetoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Objetos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sistema'), 'url' => ['/admin/sistema/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objeto-index">

    <h1><?php echo  Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $objBuscadorObjeto]); ?>

    <p>
        <?php echo  Html::a(Yii::t('app', 'Create Objeto'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $objBuscadorObjeto,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'objeto_id',
            'obj_objeto_id',
            //'sistema_id',
            'tipo',
            'nombre',
             'url:url',
            // 'estado',
             'nivel',
             'orden',

            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{view}',
              'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                'title' => Yii::t('app', 'Ver Detalle'),
                    ]);
                }
              ],
              'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {                    
                    return '?r=admin/objetos/view&id='.$model->objeto_id;
                }
              }
            ],
        ],
    ]); ?>

</div>
