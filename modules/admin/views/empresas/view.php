<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Empresa */

$this->title = $model->empresa_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Empresas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresa-view">

    <!--<h1><?php echo  Html::encode($this->title) ?></h1>-->

    <p>
        <?php echo  Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->empresa_id], ['class' => 'btn btn-primary']); ?>
        <?php /*echo  Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->empresa_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]);*/ ?>
    </p>

    <?php echo  DetailView::widget([
        'model' => $model,
        'attributes' => [
            'empresa_id',
            'ruc',
            'razon_social',
            'nombre_comercial',
            'codigo_postal',
            'estado',
            'correo_electronico',
            'observacion',
        ],
    ]); ?>

</div>
