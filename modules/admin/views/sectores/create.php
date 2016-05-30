<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sector */

$this->title = 'Create Sector';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sectores'), 'url' => ['index']];
$this->params['breadcrumbs'][] =Yii::t('app', 'create',['itemName'=>'Sector']);
?>
<div class="sector-create">

    <h1><?php echo Yii::t('app', 'create',['itemName'=>'Sector']); ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
        'title' => Yii::t('app', 'Sector'),
    ]); ?>

</div>
