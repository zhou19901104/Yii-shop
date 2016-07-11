<?php
use yii\helpers\Url;

$this->registerCssFile('style/success.css', ['depends' => 'frontend\assets\AppAsset']);
$this->registerJsFile('js/pingpp-pc.js', ['depends' => 'frontend\assets\AppAsset']);

$this->title = "订单创建成功。";
?>
<!-- 页面头部 start -->
<div class="header w990 bc mt15">
	<div class="logo w990">
		<h2 class="fl"><a href="index.html"><img src="/images/logo.png" alt="京西商城"></a></h2>
		<div class="flow fr flow3">
			<ul>
				<li>1.我的购物车</li>
				<li>2.填写核对订单信息</li>
				<li class="cur">3.成功提交订单</li>
			</ul>
		</div>
	</div>
</div>
<!-- 页面头部 end -->

<div style="clear:both;"></div>

<!-- 主体部分 start -->
<div class="success w990 bc mt15">
	<div class="success_hd">
		<h2>订单提交成功</h2>
	</div>
	<div class="success_bd">
		<p><span></span>订单提交成功，我们将及时为您处理</p>
		
        <p class="message">完成支付后，你可以 <a href="javascript:">查看订单状态</a>  <a href="<?= Yii::$app->homeUrl ?>">继续购物</a></p>
        <style>
            .pay-btn-container {
                margin-top: 20px;
            }
            .pay-btn {
                background-color: #00A1CB;
                color: white;
                padding: 10px;
                border-radius: 3px;
            }
            .pay-btn:hover {
                color: white;
                background-color: #00b5e5;
                text-decoration: none;
            }
        </style>
        <p class="pay-btn-container"><a href="<?= Url::to(['pay/create', 'orderId' => $model->productOrder->id]) ?>" class="pay-btn">通过Ping++立即支付</a></p>
	</div>
</div>
<div id="info" data-order-id="<?= $model->productOrder->id ?>"></div>
<!-- 主体部分 end -->
<?php
$js = <<<'JS'
$(document).on('click', '.pay-btn', function(e) {
    e.preventDefault();
    $.post('/pay/create', {
        'orderId': $('#info').data('order-id')
    }, function(charge) {
        console.log(charge);
        // throw Error('aaa');
        pingppPc.createPayment(charge, function(result, err){
            // 处理错误信息
            console.log(result);
            console.log(err);
        });
    });
});
JS;
$this->registerJs($js);
?>
