<?php
/** @var common\models\Product $product */

$this->registerJs(<<<JS
$('#add-to-cart').on('click', function () {
    const productId = $(this).data('id');
    const quantity = parseInt($('.modal .count').text());
    $.ajax({
        url: 'site/add',
        type: 'GET',
        data: {
            product_id: productId,
            quantity: quantity
        },
        success: function (response) {
            if (response.success) {
                $('.countercart').text(response.count);
                $('#myModal').modal('hide');
                const toastEl = document.getElementById('toastprouctaddedtiny');
                const toast = new bootstrap.Toast(toastEl, {
                    delay: 3000
                });
                toast.show();
            } else {
                alert(response.error || 'Xatolik yuz berdi');
            }
        },
        error: function () {
            alert('Server bilan aloqa xatosi');
        }
    });
});

JS
    ,3)
?>
<figure class="text-center mb-0 px-5 py-3">
    <img src="template/img/apple.png" alt="" class="mw-100">
</figure>
<div class="modal-body">
    <p class="mb-1">
        <small class="text-opac"><?=$product->category->name_uz?></small>
    </p>
    <a href="#" class="text-normal">
        <h6 class="text-color-theme"><?=$product->name_uz?></h6>
    </a>
    <div class="row">
        <div class="col">
            <p class="mb-0">$12.00<br><small class="text-opac">per 1 kg</small></p>
        </div>
        <div class="col-auto">
            <!-- button counter increamenter-->
            <div class="counter-number">
                <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                    <i class="bi bi-dash size-22"></i>
                </button>
                <span class="count">1</span>
                <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                    <i class="bi bi-plus size-22"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer justify-content-center">
    <button id="add-to-cart" data-id="<?=$product->id?>" type="button" class="btn text-color-theme">Savatchaga qo'shish</button>
</div>