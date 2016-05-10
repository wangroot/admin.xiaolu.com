<?php
/**
 * Created by PhpStorm.
 * User: sheng
 * Date: 16/4/25
 * Time: 下午3:46
 * @var $this yii\web\View
 *
 */

\app\assets\ChartsAsset::register($this);

$js =<<<EOD

var data = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
        {
            label: "My Second dataset",
            fill: false,
            backgroundColor: "rgba(255,205,86,0.4)",
            borderColor: "rgba(255,205,86,1)",
            pointBorderColor: "rgba(255,205,86,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(255,205,86,1)",
            pointHoverBorderColor: "rgba(255,205,86,1)",
            pointHoverBorderWidth: 2,
            data: [28, 48, 40, 19, 86, 27, 90]
        }
    ]
};

var getChartData = function() {
  $.ajax({
    url: $('#EffectChart').attr(),
    method: 'POST',
    dataType: 'json',
    success: function(res) {
        data = res.result;
     console.log(res);
        Canvas();
    }
  });
}

function Canvas(){
    var ctx = document.getElementById("EffectChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: data,
    });
}

EOD;



$this->registerJs($js, \yii\web\View::POS_END);

?>


<canvas id="EffectChart" data-url="<?= \yii\helpers\Url::to(['index'])?>" width="400" height="400"></canvas>
