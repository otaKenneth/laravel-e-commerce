<div
    class="elementor-element elementor-element-8058232 e-flex e-con-boxed e-con e-child"
    data-id="8058232"
    data-element_type="container"
    data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}">
    <div class="e-con-inner">
        @foreach ($chats as $chat)
        <a
            class="elementor-element elementor-element-17994e6 e-flex e-con-boxed e-con e-child"
            data-id="17994e6"
            data-element_type="container"
            data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
            href="#!"
            wire:click="navigationChatClicked('{{$chat->id}}', '{{$chat->user}}')"
        >
            <div class="e-con-inner">
                <div
                    class="elementor-element elementor-element-7100070 e-con-full e-flex e-con e-child"
                    data-id="7100070"
                    data-element_type="container"
                    data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
                >
                    <div
                        class="elementor-element elementor-element-adc46f9 elementor-widget elementor-widget-image"
                        data-id="adc46f9"
                        data-element_type="widget"
                        data-widget_type="image.default"
                    >
                        <div class="elementor-widget-container">
                            <img
                                fetchpriority="high"
                                decoding="async"
                                width="300"
                                height="300"
                                src="{{ $getImage('./images/', '2023-12-user.png') }}"
                                class="attachment-large size-large wp-image-423"
                                alt=""
                                srcset="{{ $getImage('./images/', '2023-12-user.png') }} 300w, {{ $getImage('./images/', '2023-12-user.png') }} 150w"
                                sizes="(max-width: 300px) 100vw, 300px"
                            >
                        </div>
                    </div>
                </div>
                <div
                    class="elementor-element elementor-element-a1ec28f e-con-full e-flex e-con e-child"
                    data-id="a1ec28f"
                    data-element_type="container"
                    data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
                >
                    <div
                        class="elementor-element elementor-element-fbf5ebe elementor-widget elementor-widget-text-editor"
                        data-id="fbf5ebe"
                        data-element_type="widget"
                        data-widget_type="text-editor.default"
                    >
                        <div class="elementor-widget-container">
                            <style>/*! elementor - v3.18.0 - 08-12-2023 */ .elementor-widget-text-editor.elementor-drop-cap-view-stacked .elementor-drop-cap{background-color:#69727d;color:#fff}.elementor-widget-text-editor.elementor-drop-cap-view-framed .elementor-drop-cap{color:#69727d;border:3px solid;background-color:transparent}.elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap{margin-top:8px}.elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap-letter{width:1em;height:1em}.elementor-widget-text-editor .elementor-drop-cap{float:left;text-align:center;line-height:1;font-size:50px}.elementor-widget-text-editor .elementor-drop-cap-letter{display:inline-block}</style>
                            <p>
                                <strong>{{$chat->user->first_name}}</strong>
                                <br>
                            </p>
                        </div>
                    </div>
                    <div
                        class="elementor-element elementor-element-70db8f0 elementor-widget elementor-widget-text-editor"
                        data-id="70db8f0"
                        data-element_type="widget"
                        data-widget_type="text-editor.default"
                    >
                        <div class="elementor-widget-container">
                            <p>{{$chat->messages->last()->message}}</p>
                        </div>
                    </div>
                </div>
                <div
                    class="elementor-element elementor-element-dede9a2 e-flex e-con-boxed e-con e-child"
                    data-id="dede9a2"
                    data-element_type="container"
                    data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                >
                    <div class="e-con-inner">
                        <div
                            class="elementor-element elementor-element-04178f5 elementor-widget elementor-widget-text-editor"
                            data-id="04178f5"
                            data-element_type="widget"
                            data-widget_type="text-editor.default"
                        >
                            <div class="elementor-widget-container">
                                <p>01/24</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>