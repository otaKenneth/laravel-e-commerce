@extends('front.users.profile')


@section('user_account_content')
<div
    data-elementor-type="wp-page"
    data-elementor-id="1956"
    class="elementor elementor-1956"
    data-elementor-post-type="page">
    <div
        class="elementor-element elementor-element-8c4c512 e-flex e-con-boxed e-con e-parent"
        data-id="8c4c512"
        data-element_type="container"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
        data-core-v316-plus="true"
    >
        <div class="e-con-inner">
            <div
                class="elementor-element elementor-element-d1dea40 e-con-full e-flex e-con e-child"
                data-id="d1dea40"
                data-element_type="container"
                data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
            >
                <div
                    class="elementor-element elementor-element-b8d85aa login-container e-flex e-con-boxed elementor-invisible e-con e-child"
                    data-id="b8d85aa"
                    data-element_type="container"
                    data-settings="{&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                >
                    <div class="e-con-inner">
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
                                        @foreach ($wishlist as $product)
                                        <tr>
                                            <td>
                                                <div class="prod-wishlist">
                                                    <div class="wishlist-img">
                                                        <img decoding="async" class="prod-img" src="{{ $getImage('front/images/product/', $product['product']['product_image']) }}">
                                                    </div>
                                                    <div class="wishlist-prod-desc">
                                                        <h4>{{$product['product']['product_name']}}</h4>
                                                        <p class="other-info">{{$product['product']['description']}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>                 ₱{{$product['product']['product_price']}}</td>
                                            <td style="text-align: right;">
                                                <a href="#" class="item-addCart button btn" data-product="{{$product['product_id']}}">Add to cart</a>
                                                <a href="#" class="button btn button--secondary">remove</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <style></style>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection