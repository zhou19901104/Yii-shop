<?php

use yii\helpers\Url;

$this->registerCssFile('style/cart.css', ['depends' => 'frontend\assets\AppAsset']);
$this->registerJsFile('js/cart-step1.js', ['depends' => 'frontend\assets\AppAsset']);
$this->title = '我的购物车';
?>
<!-- 页面头部 start -->
<div class="header w990 bc mt15">
    <div class="logo w990">
        <h2 class="fl"><a href="<?= Yii::$app->homeUrl ?>"><img src="/images/logo.png" alt="京西商城"></a></h2>
        <div class="flow fr">
            <ul>
                <li class="cur">1.我的购物车</li>
                <li>2.填写核对订单信息</li>
                <li>3.成功提交订单</li>
            </ul>
        </div>
    </div>
</div>
<!-- 页面头部 end -->

<div style="clear:both;"></div>

<!-- 主体部分 start -->
<div class="mycart w990 mt10 bc">
    <h2><span>我的购物车</span></h2>
    <table>
        <thead>
            <tr>
                <th class="col1">商品名称</th>
                <th class="col2">商品信息</th>
                <th class="col3">单价</th>
                <th class="col4">数量</th>	
                <th class="col5">小计</th>
                <th class="col6">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach(Yii::$app->cart->positions as $productInCart): ?>
                <tr class="product" data-product-in-cart-id="<?= $productInCart->getId() ?>">
                    <td class="col1"><a href="<?= Url::to(['product/view', 'id' => $productInCart->id]) ?>"><img src="<?= $productInCart->logoAccessUrl ?>" alt="" /></a>  <strong><a href="<?= Url::to(['product/view', 'id' => $productInCart->id]) ?>"><?= $productInCart->name ?></a></strong></td>
                    <td class="col2">
                        <?php foreach($productInCart->getDisplayAttributeAssignmentPairs() as $name => $value): ?>
                            <p><?= $name ?>：<?= $value ?></p>
                        <?php endforeach; ?>
                    </td>
                    <td class="col3">￥<span><?= $productInCart->price ?></span></td>
                    <td class="col4"> 
                        <a href="javascript:;" class="reduce_num"></a>
                        <input type="text" name="amount" value="<?= $productInCart->quantity ?>" class="amount"/>
                        <a href="javascript:;" class="add_num"></a>
                    </td>
                    <td class="col5">￥<span class="cost"><?= $productInCart->cost ?></span></td>
                    <td class="col6"><a href="javascript:" class="delete">删除</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">购物金额总计： <strong>￥ <span id="total" class="sum-cost"><?= Yii::$app->cart->cost ?></span></strong></td>
            </tr>
        </tfoot>
    </table>
    <div class="cart_btn w990 bc mt10">
        <a href="<?= Yii::$app->homeUrl ?>" class="continue">继续购物</a>
        <a href="<?= Url::to(['order/create']) ?>" class="checkout">结 算</a>
    </div>
</div>
<!-- 主体部分 end -->
