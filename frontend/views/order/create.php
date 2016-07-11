<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\ProductOrder;

$this->registerCssFile('style/fillin.css', ['depends' => 'frontend\assets\AppAsset']);
$this->registerJsFile('js/cart2.js', ['depends' => 'frontend\assets\AppAsset']);
$this->title = '填写订单详细信息';

?>
<!-- 页面头部 start -->
<div class="header w990 bc mt15">
	<div class="logo w990">
        <h2 class="fl"><a href="<?= Yii::$app->homeUrl ?>"><img src="/images/logo.png" alt="京西商城"></a></h2>
		<div class="flow fr flow2">
			<ul>
				<li>1.我的购物车</li>
				<li class="cur">2.填写核对订单信息</li>
				<li>3.成功提交订单</li>
			</ul>
		</div>
	</div>
</div>
<!-- 页面头部 end -->

<div style="clear:both;"></div>

<?= Html::beginForm(["order/create"], "post", [
    "id" => 'create-order-form',
]) ?>
    <?= Html::csrfMetaTags() ?>
    <!-- 主体部分 start -->
    <div class="fillin w990 bc mt15">
        <p><?= Html::errorSummary($model) ?></p>
        <div class="fillin_hd">
            <h2>填写并核对订单信息</h2>
        </div>

        <div class="fillin_bd">
            <!-- 收货人信息  start-->
            <div class="address">
                <h3>收货人信息</h3>

                <div class="address_select">
                    <form action="" class="" name="address_form">
                        <ul>
                            <li>
                                <label for=""><span>*</span>联系方式：</label>
                                <input type="text" name="contact" class="txt" value="<?= $model->contact ?>" />
                            </li>
                            <li>
                                <label for=""><span>*</span>详细地址：</label>
                                <input type="text" name="address" class="txt address" value="<?= $model->address ?>" />
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
            <!-- 收货人信息  end-->

            <!-- 配送方式 start -->
            <div class="delivery">
                <h3>送货方式</h3>
                <div class="delivery_select">
                    <table>
                        <thead>
                            <tr>
                                <th class="col1">送货方式</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach(ProductOrder::$shipmentList as $id => $name): ?>
                                <?php $checked = ($model->shipment == $id) || ($id == 1); ?>
                                <tr class="<?php if($checked): ?>cur<?php endif; ?>">	
                                    <td>
                                        <input type="radio" name="shipment" <?php if ($checked): ?>checked<?php endif; ?> value="<?= $id ?>" /><?= $name ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div> 
            <!-- 配送方式 end --> 

            <!-- 支付方式  start-->
            <div class="pay">
                <h3>支付方式</h3>
                <div class="pay_select">
                    <table> 
                        <?php foreach(ProductOrder::$paymentList as $id => $name): ?>
                            <?php $checked = ($model->payment == $id) || ($id == 1); ?>
                            <tr class="<?php if($checked): ?>cur<?php endif; ?>">	
                                <td class="col1"><input <?php if ($checked): ?>checked<?php endif; ?> type="radio" name="payment" value="<?= $id ?>" /><?= $name ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <!-- 支付方式  end-->

            <!-- 商品清单 start -->
            <div class="goods">
                <h3>商品清单</h3>
                <table>
                    <thead>
                        <tr>
                            <th class="col1">商品</th>
                            <th class="col2">规格</th>
                            <th class="col3">价格</th>
                            <th class="col4">数量</th>
                            <th class="col5">小计</th>
                        </tr>	
                    </thead>
                    <tbody>
                        <?php foreach(Yii::$app->cart->positions as $productInCart): ?>
                            <tr>
                                <td class="col1"><a href=""><img src="<?= $productInCart->logoAccessUrl ?>" alt="" /></a>  <strong><a href=""><?= $productInCart->name ?></a></strong></td>
                                <td class="col2">
                                    <?php foreach($productInCart->getDisplayAttributeAssignmentPairs() as $name => $value): ?>
                                        <p><?= $name ?>：<?= $value ?></p>
                                    <?php endforeach; ?>
                                </td>
                                <td class="col3">￥<?= $productInCart->price ?></td>
                                <td class="col4"><?= $productInCart->quantity ?></td>
                                <td class="col5"><span>￥<?= $productInCart->cost ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- 商品清单 end -->
        
        </div>

        <div class="fillin_ft">
            <a href="javascript:" onclick="$('#create-order-form').submit();"><span>提交订单</span></a>
            <p><?= Yii::$app->cart->count ?> 件商品，应付总额：<strong>￥<?= Yii::$app->cart->cost ?>元</strong></p>
        </div>
    </div>
    <!-- 主体部分 end -->
<?= Html::endForm() ?>
