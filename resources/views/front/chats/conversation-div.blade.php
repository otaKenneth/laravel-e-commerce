<div
    class="elementor-element elementor-element-d05fb94 e-flex e-con-boxed e-con e-child"
    data-id="d05fb94"
    data-element_type="container"
    data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}">
    <div class="e-con-inner">
        @foreach ($activeChat->messages as $message)
            @if (strpos(strtolower($message->from), 'admin') > -1)
            <div
                class="elementor-element elementor-element-419ad9e e-flex e-con-boxed e-con e-child"
                data-id="419ad9e"
                data-element_type="container"
                data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
            >
                <div class="e-con-inner">
                    <div
                        class="elementor-element elementor-element-5ecb742 elementor-widget__width-initial elementor-widget elementor-widget-text-editor"
                        data-id="5ecb742"
                        data-element_type="widget"
                        data-widget_type="text-editor.default"
                    >
                        <div class="elementor-widget-container">
                            <p>{{$message->message}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div
                class="elementor-element elementor-element-6a66c9c e-flex e-con-boxed e-con e-child"
                data-id="6a66c9c"
                data-element_type="container"
                data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
            >
                <div class="e-con-inner">
                    <div
                        class="elementor-element elementor-element-39ebb8f elementor-widget__width-initial elementor-widget elementor-widget-text-editor"
                        data-id="39ebb8f"
                        data-element_type="widget"
                        data-widget_type="text-editor.default"
                    >
                        <div class="elementor-widget-container">
                            <p>{{$message->message}} </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        <!-- start -->
        <!-- <div
            class="elementor-element elementor-element-ee52aa3 e-flex e-con-boxed e-con e-child"
            data-id="ee52aa3"
            data-element_type="container"
            data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
        >
            <div class="e-con-inner">
                <div
                    class="elementor-element elementor-element-69ba13b elementor-widget elementor-widget-text-editor"
                    data-id="69ba13b"
                    data-element_type="widget"
                    data-widget_type="text-editor.default"
                >
                    <div class="elementor-widget-container">
                        <p>19 Dec 2024</p>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div
            class="elementor-element elementor-element-18c5cc0 e-flex e-con-boxed e-con e-child"
            data-id="18c5cc0"
            data-element_type="container"
            data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
        >
            <div class="e-con-inner">
                <div
                    class="elementor-element elementor-element-abf9aa5 elementor-widget elementor-widget-text-editor"
                    data-id="abf9aa5"
                    data-element_type="widget"
                    data-widget_type="text-editor.default"
                >
                    <div class="elementor-widget-container">
                        <p>24 Jan 2024</p>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- end -->
        @endforeach
        <div
            class="elementor-element elementor-element-923c4ad e-flex e-con-boxed e-con e-child"
            data-id="923c4ad"
            data-element_type="container"
            data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
        >
            <div class="e-con-inner">
                <div
                    class="elementor-element elementor-element-ac8b163 elementor-widget elementor-widget-spacer"
                    data-id="ac8b163"
                    data-element_type="widget"
                    data-widget_type="spacer.default"
                >
                    <div class="elementor-widget-container">
                        <style>/*! elementor - v3.18.0 - 08-12-2023 */ .elementor-column .elementor-spacer-inner{height:var(--spacer-size)}.e-con{--container-widget-width:100%}.e-con-inner>.elementor-widget-spacer,.e-con>.elementor-widget-spacer{width:var(--container-widget-width,var(--spacer-size));--align-self:var(--container-widget-align-self,initial);--flex-shrink:0}.e-con-inner>.elementor-widget-spacer>.elementor-widget-container,.e-con>.elementor-widget-spacer>.elementor-widget-container{height:100%;width:100%}.e-con-inner>.elementor-widget-spacer>.elementor-widget-container>.elementor-spacer,.e-con>.elementor-widget-spacer>.elementor-widget-container>.elementor-spacer{height:100%}.e-con-inner>.elementor-widget-spacer>.elementor-widget-container>.elementor-spacer>.elementor-spacer-inner,.e-con>.elementor-widget-spacer>.elementor-widget-container>.elementor-spacer>.elementor-spacer-inner{height:var(--container-widget-height,var(--spacer-size))}.e-con-inner>.elementor-widget-spacer.elementor-widget-empty,.e-con>.elementor-widget-spacer.elementor-widget-empty{position:relative;min-height:22px;min-width:22px}.e-con-inner>.elementor-widget-spacer.elementor-widget-empty .elementor-widget-empty-icon,.e-con>.elementor-widget-spacer.elementor-widget-empty .elementor-widget-empty-icon{position:absolute;top:0;bottom:0;left:0;right:0;margin:auto;padding:0;width:22px;height:22px}</style>
                        <div class="elementor-spacer">
                            <div class="elementor-spacer-inner"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>