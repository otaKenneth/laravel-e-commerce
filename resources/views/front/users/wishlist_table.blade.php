<div
    class="elementor-element elementor-element-e297bd7 elementor-widget elementor-widget-html"
    data-id="e297bd7"
    data-element_type="widget"
    data-widget_type="html.default"
>
    <div class="elementor-widget-container">
        <div style="    width: 100%;    overflow: auto; ">
            <table width="100%">
                <tr>
                    <th>PRODUCT</th>
                    <th>PRICE</th>
                    <th class="align-right"></th>
                </tr>
                @foreach ($mapped_wishlists as $product)
                <tr>
                    <td>
                        <div class="prod-wishlist">
                            <div class="wishlist-img">
                                <img decoding="async" class="prod-img" src="{{ $getImage('front/images/product_images/small/', $product['product']['product_image']) }}">
                            </div>
                            <div class="wishlist-prod-desc">
                                <h4>{{$product['product']['product_name']}}</h4>
                                <p class="other-info">{{$product['product']['description']}}</p>
                            </div>
                        </div>
                    </td>
                    <td>                 ₱{{$product['price']}}</td>
                    <td style="text-align: right;">
                        <button class="item-addCart button btn" data-product="{{$product['product_id']}}" data-color="{{$product['attribute_one']}}" data-size="{{$product['attribute_two']}}">Add to cart</button>
                        <button class="wishlist-item-remove button btn button--secondary" data-product="{{$product['id']}}">remove</button>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <style></style>
    </div>
</div>