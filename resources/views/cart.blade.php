<?php
$tempProducts = Session::get('tempProducts');
$products = [];
// dd($tempProducts);
if(!empty($tempProducts)){
    foreach ($tempProducts as $product_id => $qty) {
        $product = \App\Models\Product::where('id', $product_id)->first();
        if(!empty($product)) 
            $products[] = $product;
    }
}
?>
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					giỏ hàng của bạn
				</span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <?php  $total = 0; ?>
            <ul class="header-cart-wrapitem w-full">
                @if (count($products) > 0)
               <?php
                    foreach($products as $product):
                            
                            
                            $price = $product->price_sale != 0 ? $product->price_sale : $product->price;
                            $priceEnd = $price * $tempProducts[$product->id];
                            $total += $priceEnd;    
                            
                            
                ?>
                <li class="header-cart-item flex-w flex-t m-b-12">
                    <div class="header-cart-item-img">
                        <img src="{{ asset( $product->thumb ) }}" alt="IMG">
                    </div>

                    <div class="header-cart-item-txt p-t-8">
                        <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            {{ $product->name }}
                        </a>
                        <span class="header-cart-item-info">
								{{ number_format($price, 0, '', '.') }}
                        </span>
                    </div>
                </li>
                    @endforeach
                @endif
            </ul>

            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Total: {{ number_format( $total, '0', '', '.') }}
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href=" {{ route('carts.shop') }} " class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        View Cart
                    </a>

                    <!-- <a href="{{ 'tempProducts' }}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                        Check Out
                    </a> -->
                </div>
            </div>
        </div>
    </div>
</div>

