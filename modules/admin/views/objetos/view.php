<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $objObjeto app\modules\admin\models\Objeto */

$this->title = $objObjeto->objeto_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sistema'), 'url' => ['/admin/sistema/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Objetos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objeto-view">

    <h1><?php echo  Html::encode($this->title); ?></h1>

    <p>
        <?php echo  Html::a(Yii::t('app', 'Update'), ['update', 'id' => $objObjeto->objeto_id], ['class' => 'btn btn-primary']); ?>
        <?php /*echo  Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $objObjeto->objeto_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]);*/ ?>
    </p>

    <?php echo  DetailView::widget([
        'model' => $objObjeto,
        'attributes' => [
            'objeto_id',
            'obj_objeto_id',
            'sistema_id',
            'tipo',
            'nombre',
            'url:url',
            'estado',
            'nivel',
            'orden',
        ],
    ]); ?>

</div>
