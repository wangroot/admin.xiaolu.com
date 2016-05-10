<?php
/**
 * Created by PhpStorm.
 * User: sheng
 * Date: 16/4/29
 * Time: 下午3:13
 */
use app\modules\adsplatform\models\Datadict;
use app\modules\adsplatform\models\Position;
$db = Yii::$app->db;

?>
<!-- CSS goes in the document HEAD or added to your external stylesheet -->
<style type="text/css">
    table.gridtable {
        font-family: verdana,arial,sans-serif;
        font-size:11px;
        color:#333333;
        border-width: 1px;
        border-color: #666666;
        border-collapse: collapse;
    }
    table.gridtable th {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #666666;
        background-color: #dedede;
    }
    table.gridtable td {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #666666;
        background-color: #ffffff;
    }
</style>
<table class="gridtable">
    <thead>
    <tr>
        <th>
            日期
        </th>
        <th>
            广告名
        </th>
        <th>
            失败量
        </th>
        <th>
            展示量
        </th>
        <th>
            点击量
        </th>
        <th>
            下载量
        </th>
        <th>
            安装量
        </th>
        <th>
            点击率
        </th>
        <th>
            下载率
        </th>
        <th>
            安装率
        </th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($dataProvider as $key=>$value){
        ?>
        <?php

        if (empty($value->ad_id)) {
            $ad_name = '未设置';
        }else {
            $db = Yii::$app->db;
            $adSql = <<<EOD
SELECT `provider`, `position_id`, `title` FROM `ad` WHERE id={$value->ad_id}
EOD;
            $adResult = $db->createCommand($adSql)->queryOne();
            $provider = Datadict::getDataValue('ad_provider', $adResult['provider']);
            $position = Position::findOne($adResult['position_id']);
            $ad_name = $provider . '-' . $position->name . '-' . $adResult['title'];
        }
        ?>
        <tr data-key="4">
            <td><?= date('Y-m-d', strtotime('-1 day', $value->create_time));?></td>
            <td><?= $ad_name ?></td>
            <td><?= empty($value->total_failure)?0:$value->total_failure?></td>
            <td><?= empty($value->total_view)?0:$value->total_view?></td>
            <td><?= empty($value->total_click)?0:$value->total_click?></td>
            <td><?= empty($value->total_download)?0:$value->total_download?></td>
            <td><?= empty($value->total_install)?0:$value->total_install?></td>
            <td><?= empty($value->total_view)?0:round(($value->total_click/$value->total_view)*100, 2).'%';?></td>
            <td><?= empty($value->total_click)?0:round(($value->total_download/$value->total_click)*100, 2).'%';?></td>
            <td><?= empty($value->total_download)?0:round(($value->total_install/$value->total_download)*100, 2).'%'?></td>
        </tr>
    <?php }?>
    </tbody>
</table>
