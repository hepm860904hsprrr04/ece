<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\InventarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Productos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Crear Producto'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
			'inventario_id',
			'codigo',    
			'inventario',  			
			'nombre_sector',  
            'razon_social',
                         
            // 'volumen_minimo',
            // 'volumen_maximo',
            // 'unidad_id',
            // 'periodo_id',
            // 'partida_id',
            // 'ubicacion_necesidad_id',
            // 'precio_referencia_min',
            // 'precio_referencia_maximo',
            // 'foto',
            // 'anexo',
            // 'observaciones',
            // 'publicado:boolean',
            // 'sector_industrial_id',
            // 'aliado_id',
            // 'creado_por',
            // 'fecha_creacion',
            // 'modificado_por',
            // 'fecha_modificacion',
            // 'asignado_a',
            // 'fecha_asignacion',
            // 'total_postulacion',
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
                    return '?r=admin/productos/view&id='.$model->inventario_id;
                }
              }
            ], 			
        ],
    ]); ?>

</div>
