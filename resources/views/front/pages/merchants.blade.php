{{-- This page is rendered by merchantsLists() method in Front/IndexController.php --}}
@extends('front.layout.layout')


@section('content')
<div
    data-elementor-type="wp-page"
    data-elementor-id="1751"
    class="elementor elementor-1751"
    data-elementor-post-type="page">
    <div
        class="elementor-element elementor-element-7c4e54c e-flex e-con-boxed e-con e-parent"
        data-id="7c4e54c"
        data-element_type="container"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
        data-core-v316-plus="true"
    >
        <div class="e-con-inner">
            <div
                class="elementor-element elementor-element-d507bf3 e-con-full e-flex e-con e-child"
                data-id="d507bf3"
                data-element_type="container"
                data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
            >
                <div
                    class="elementor-element elementor-element-9ed0446 elementor-invisible elementor-widget elementor-widget-heading"
                    data-id="9ed0446"
                    data-element_type="widget"
                    data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}"
                    data-widget_type="heading.default"
                >
                    <div class="elementor-widget-container">
                        <h1 class="elementor-heading-title elementor-size-default">MERCHANTS</h1>
                    </div>
                </div>
                <div
                    class="elementor-element elementor-element-94b41db login-container e-flex e-con-boxed elementor-invisible e-con e-child"
                    data-id="94b41db"
                    data-element_type="container"
                    data-settings="{&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                >
                    <div class="e-con-inner">
                        <div
                            class="elementor-element elementor-element-b3ddacb e-grid e-con-boxed e-con e-child"
                            data-id="b3ddacb"
                            data-element_type="container"
                            data-settings="{&quot;container_type&quot;:&quot;grid&quot;,&quot;content_width&quot;:&quot;boxed&quot;,&quot;grid_outline&quot;:&quot;yes&quot;,&quot;grid_columns_grid&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:3,&quot;sizes&quot;:[]},&quot;grid_columns_grid_tablet&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;grid_columns_grid_mobile&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]},&quot;grid_rows_grid&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:2,&quot;sizes&quot;:[]},&quot;grid_rows_grid_tablet&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;grid_rows_grid_mobile&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;grid_auto_flow&quot;:&quot;row&quot;,&quot;grid_auto_flow_tablet&quot;:&quot;row&quot;,&quot;grid_auto_flow_mobile&quot;:&quot;row&quot;}"
                            id='vendor-container'
                        >
                            <div class="e-con-inner" id="vendor-list-1">
                                @include('front.partials.vendor-cards')
                        </div>
                            <div id="no-more-merchants" class="no-more-merchants" style="display:none; width:100%; clear:both; text-align:center; padding:1em; margin-top:2em; color:gray;">
                                No more merchants to load.
                            </div>
                            <div id="load-more-merchants-trigger"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection