<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo  Yii::$app->language ?>">
<head>
    <meta charset="<?php echo  Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo  Html::csrfMetaTags() ?>
    <title><?php echo  Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<div class="wrap">    
    <?php
    NavBar::begin([
        'brandLabel' => 'Admin ECE',
        'brandUrl' => ['/empresa/'],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Productos', 'url' => ['/empresa/productos/index']],                               			                     
            [
                'label' => '' . $_SESSION['ece_empresa']['nombre']. ' ('.Yii::t('app', 'Cerrar Session').')',                    
                'url' => ['/empresa/acceso/cerrar-session'],
                'linkOptions' => ['data-method' => 'post']
            ],
        ],
    ]);
    NavBar::end();
 
    ?>

        <div class="container">

			<?php echo Breadcrumbs::widget([ 
				'homeLink'=>array('label'=>'Home','url'=>'?r=empresa/default/index'),
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			]) ?>
			<!-- breadcrumbs -->  
			
			<?php
			foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
				echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
                Yii::$app->session->removeFlash($key);
			} ?>
			
        <?php echo  $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?php echo Yii::t('app', 'Ecuador Compra Ecuador');?> <?php echo  date('Y') ?></p>

        <p class="pull-right"><?php echo Yii::t('app', 'Desarrollado por');?> <a href="http://www.soastec.com" target="_blank"><?php echo Yii::t('app', 'Soastec');?></a> </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

