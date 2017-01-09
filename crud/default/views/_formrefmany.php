<?php
/* @var $generator \mootensai\enhancedgii\crud\Generator */
/* @var $relations array */

$relClassName = $relations[$generator::REL_CLASS];
$tableSchema = $generator->getDbConnection()->getTableSchema($relations[$generator::REL_TABLE]);
$fk = $generator->generateFK($tableSchema);
$relID = \yii\helpers\Inflector::camel2id($relations[$generator::REL_CLASS]);
$humanize = \yii\helpers\Inflector::humanize($relations[$generator::REL_TABLE], true);
$class = $generator->nsModel.'\\'.$relClassName;
$class = new $class();
$label = $class::tableLabel();
echo "<div class=\"form-group\" id=\"add-$relID\">\n";
echo "<?php\n";
?>
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;
use <?= $generator->nsModel. '\\'. $relClassName ?>;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'modelClass' => <?= $relClassName ?>::className(),
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => '<?= $relations[1]; ?>',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
<?php foreach ($tableSchema->getColumnNames() as $attribute) : 
    $column = $tableSchema->getColumn($attribute);
    if (!in_array($attribute, $generator->skippedColumns) && $attribute != $relations[5]) {
        echo "        " . $generator->generateTabularFormField($attribute, $fk, $tableSchema) . ",\n";
    }
endforeach; ?>
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  <?= $generator->generateString('删除') ?>, 'onClick' => 'delRow<?= $relations[$generator::REL_CLASS]; ?>(' . $key . '); return false;', 'id' => '<?= yii\helpers\Inflector::camel2id($relations[$generator::REL_CLASS]) ?>-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . <?= $generator->generateString('新增'.$label) ?>, ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRow<?= $relations[$generator::REL_CLASS]; ?>()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

