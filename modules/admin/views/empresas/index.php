<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\EmpresaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Empresas');

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresa-index">

    <h1><?php echo  Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo  Html::a(Yii::t('app', 'Crear Empresa'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'empresa_id',
            'ruc',
            'razon_social',
            'nombre_comercial',
            'codigo_postal',
            'estado',
             'correo_electronico',
            // 'observacion',

            //['class' => 'yii\grid\ActionColumn'],
            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{view}',
              'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                'title' => Yii::t('app', 'viewDetail'),
                    ]);
                }
              ],
              'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {                    
                    return '?r=admin/empresas/view&id='.$model->empresa_id;
                }
              }
            ], 
			
        ],
    ]); ?>

</div>
