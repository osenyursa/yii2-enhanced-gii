<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator mootensai\enhancedgii\crud\Generator */


$tableLabel = $generator->getTableLabel($generator->tableName);
echo "<?php\n";
?>

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = <?= $generator->generateString('新建{tableLabel}', ['tableLabel' => $tableLabel]) ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString($tableLabel) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-create">

    <?= "<?php if(!Yii::\$app->request->isAjax): ?> \n" ?>
    <h1><?= "<?= " ?>Html::encode($this->title) ?></h1>
    <?= "<?php endif; ?> \n" ?>

    <?= "<?= " ?>$this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
