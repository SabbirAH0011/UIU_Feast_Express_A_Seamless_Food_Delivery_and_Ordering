<a href="#">
    <div class="float-cart shadow" id="float-cart">
        <div class="p-2">
            <img src="{{ asset('assets/img/basket3-white.svg') }}" alt="cart" class="nav_icon_size aux_icon_name">
            <p>Item: <br> <span id="total_cart_item">0</span></p>
            <p>price: <br> <span id="total_cart_item_cost">0</span> &#x9F3;</p>
        </div>
    </div>
</a>
<script>
    $(window).on('load', function () {
        const total_cart_item = parseInt(localStorage.getItem('lotif_cart_count'));
        const total_cart_item_cost = parseInt(localStorage.getItem('lotif_cart_price'));
        if(localStorage.getItem('lotif_cart_count') !== null){
            if (total_cart_item <= 99) {
                $('#total_cart_item').text(total_cart_item);
            } else {
                $('#total_cart_item').text('99+');
            }
        }else{
            $('#total_cart_item').text('0');
        }

        if(localStorage.getItem('lotif_cart_price') !== null){
            if (total_cart_item_cost <= 10000) {
                $('#total_cart_item_cost').text(total_cart_item_cost);
            } else {
                $('#total_cart_item_cost').text('10000+');
            }
        }else{
            $('#total_cart_item_cost').text('0');
        }
    });
</script>
