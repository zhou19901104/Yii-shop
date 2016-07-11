var ajaxInProgress = false;
$(document).on('click', '.reduce_num, .add_num', function(e) {
    e.preventDefault();
    if (ajaxInProgress) {
        return;
    }
    ajaxInProgress = true;
    var $tr = $(this).parents('.product'),
        productId = $tr.data('product-id'),
        productInCartId = $tr.data('product-in-cart-id'),
        $quantity = $('.amount', $tr),
        $cost = $('.cost', $tr),
        $sumCost = $('.sum-cost'),
        quantity = + parseInt($quantity.val());

    if ($(this).is('.reduce_num')) {
        quantity = quantity - 1;
    } else if ($(this).is('.add_num')) {
        quantity = quantity + 1;
    }

    if (quantity <= 0) {
        alert("商品数量不能小于1。");
        return;
    }

    $.ajax({
        'url': '/cart/change-quantity',
        'method': 'POST',
        'dataType': 'JSON',
        'data': {
            'productInCartId': productInCartId,
            'operator': $(this).is('.add_num') ? '+' : '-'
        }
    }).success(function(data) {
        if (data.status) {
            $quantity.val(data.data.quantity);
            $cost.html(data.data.cost);
            $sumCost.html(data.data.sumCost);
        }
    }).fail(function() {
        alert("请稍后重试。");
    }).always(function() {
        ajaxInProgress = false;
    });
}).on('click', '.product .delete', function(e) {
    e.preventDefault();
    if (!confirm("你确定吗？")) {
        return;
    }
    if (ajaxInProgress) {
        return;
    }
    ajaxInProgress = true;
    var $tr = $(this).parents('.product'),
        $sumCost = $('.sum-cost'),
        productInCartId = $tr.data('product-in-cart-id');

    $.ajax({
        'url': '/cart/delete',
        'method': 'POST',
        'dataType': 'JSON',
        'data': {
            'productInCartId': productInCartId
        }
    }).success(function(data) {
        if (data.status) {
            $tr.remove();
            $sumCost.html(data.data.sumCost);
            alert(data.message);
        }
    }).fail(function() {
        alert("请稍后重试。");
    }).always(function() {
        ajaxInProgress = false;
    });
});
