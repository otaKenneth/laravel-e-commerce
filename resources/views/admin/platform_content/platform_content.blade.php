{{-- This page is rendered by orders() method inside Admin/OrderController.php --}}
@extends('admin.layout.layout')

@section('content')
<div data-elementor-type="wp-page" data-elementor-id="1856" class="elementor elementor-1856"
    data-elementor-post-type="page">
    <div class="elementor-element elementor-element-3069eba e-flex e-con-boxed e-con e-parent"
        data-id="3069eba" data-element_type="container"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
        data-core-v316-plus="true">
        <div class="e-con-inner">
            <div class="elementor-element elementor-element-67ba668 e-con-full e-flex e-con e-child"
                data-id="67ba668" data-element_type="container"
                data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}">
                <div class="elementor-element elementor-element-41763c3 login-container e-flex e-con-boxed e-con e-child"
                    data-id="41763c3" data-element_type="container">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-a63ff4e elementor-widget elementor-widget-heading"
                            data-id="a63ff4e" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <h4 class="elementor-heading-title elementor-size-default">SELECT SECTION
                                </h4>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-d3b7a2e elementor-widget elementor-widget-html"
                            data-id="d3b7a2e" data-element_type="widget" data-widget_type="html.default">
                            <div class="elementor-widget-container">
                                <form> <select id="pcontents-select" style="border-radius: 10px;">
                                        <option value="select">Select</option>
                                        @foreach ($pcontents as $content)
                                            <option value="{{$content->id}}">{{$content->page}} - {{$content->container}}</option>
                                        @endforeach
                                    </select> </form>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-719c1ba elementor-widget elementor-widget-html"
                            data-id="719c1ba" data-element_type="widget" data-widget_type="html.default">
                            <div class="elementor-widget-container">
                                <div> <textarea id="tinymce">Aaaa...</textarea> </div>
                                <script>
                                    $('textarea#tinymce').tinymce({
                                        height: 300,
                                        menubar: 'edit format'
                                        /* other settings... */
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-4d9c8a1 elementor-widget__width-inherit elementor-align-justify elementor-widget elementor-widget-button"
                            data-id="4d9c8a1" data-element_type="widget" data-widget_type="button.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-button-wrapper"> <button id="pcontents-save-btn"
                                        class="elementor-button elementor-button-link elementor-size-sm"
                                        href="#"> <span class="elementor-button-content-wrapper"> <span
                                                class="elementor-button-text">SAVE</span> </span> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
