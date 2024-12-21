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
                        <div id="append-wishlist-items">@include('front.users.wishlist_table')</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection