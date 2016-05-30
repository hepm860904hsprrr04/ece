<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Postulación Completada');
$this->params['breadcrumbs'][] = $this->title;
?>

<a href="<?php echo Url::to(['/site/iniciar-session' ]);?>" class="btn btn-primary"> <?php echo Yii::t('app', 'Iniciar session');?> </a> 


