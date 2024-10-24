<div
    data-elementor-type="wp-page"
    data-elementor-id="1086"
    class="elementor elementor-1086"
    data-elementor-post-type="page"
    wire:poll="refreshMessages"
>

    <div
        class="elementor-element elementor-element-be0fba5 e-flex e-con-boxed e-con e-parent"
        data-id="be0fba5"
        data-element_type="container"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
        data-core-v316-plus="true"
    >
        <div class="e-con-inner">
            <div
                class="elementor-element elementor-element-aca939b login-container e-flex e-con-boxed e-con e-child"
                data-id="aca939b"
                data-element_type="container"
                data-settings="{&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
            >
                <div class="e-con-inner">
                    <div
                        class="elementor-element elementor-element-b372be7 e-con-full e-flex e-con e-child"
                        data-id="b372be7"
                        data-element_type="container"
                        data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
                    >
                        <div
                            class="elementor-element elementor-element-b9bf068 e-flex e-con-boxed e-con e-child"
                            data-id="b9bf068"
                            data-element_type="container"
                            data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                        >
                            <div class="e-con-inner">
                                <div
                                    class="elementor-element elementor-element-7a72717 elementor-widget elementor-widget-heading"
                                    data-id="7a72717"
                                    data-element_type="widget"
                                    data-widget_type="heading.default"
                                >
                                    <div class="elementor-widget-container">
                                        <h2 class="elementor-heading-title elementor-size-default">Chats</h2>
                                    </div>
                                </div>
                                <div
                                    class="elementor-element elementor-element-afda1e3 elementor-widget elementor-widget-html"
                                    data-id="afda1e3"
                                    data-element_type="widget"
                                    data-widget_type="html.default"
                                >
                                    <div class="elementor-widget-container">
                                        <input type="text" placeholder="Search">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- LIST OF PERSON/MERCHANT HERE chat-list-of-merchant.blade.php -->
                        <div id="container-chat-list">@include('front.chats.chat-list-of-merchant')</div>
                    </div>
                    <div
                        class="elementor-element elementor-element-1c203fa e-flex e-con-boxed e-con e-child"
                        data-id="1c203fa"
                        data-element_type="container"
                        data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                    >
                        <div class="e-con-inner">
                            <div
                                class="elementor-element elementor-element-8395f69 e-flex e-con-boxed e-con e-child"
                                data-id="8395f69"
                                data-element_type="container"
                                data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                            >
                                <div class="e-con-inner">
                                    <div
                                        class="elementor-element elementor-element-2c8f7d3 e-con-full e-flex e-con e-child"
                                        data-id="2c8f7d3"
                                        data-element_type="container"
                                        data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
                                    >
                                        <div
                                            class="elementor-element elementor-element-6b54838 elementor-widget elementor-widget-image"
                                            data-id="6b54838"
                                            data-element_type="widget"
                                            data-widget_type="image.default"
                                        >
                                            <div class="elementor-widget-container">
                                                <img
                                                    fetchpriority="high"
                                                    decoding="async"
                                                    width="300"
                                                    height="300"
                                                    src="{{ $getImage('front/images/brand-logos/', $activeChat->admin->vendorBusiness->shop_logo) }}"
                                                    class="attachment-large size-large wp-image-423"
                                                    alt=""
                                                    srcset="{{ $getImage('front/images/brand-logos/', $activeChat->admin->vendorBusiness->shop_logo) }} 300w, {{ $getImage('front/images/brand-logos/', $activeChat->admin->vendorBusiness->shop_logo) }} 150w"
                                                    sizes="(max-width: 300px) 100vw, 300px"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="elementor-element elementor-element-fb79497 e-con-full e-flex e-con e-child"
                                        data-id="fb79497"
                                        data-element_type="container"
                                        data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
                                    >
                                        <div
                                            class="elementor-element elementor-element-fc78f05 elementor-widget elementor-widget-text-editor"
                                            data-id="fc78f05"
                                            data-element_type="widget"
                                            data-widget_type="text-editor.default"
                                        >
                                            <div class="elementor-widget-container">
                                                <p>
                                                    <strong>{{ $activeChat->admin->vendorBusiness->shop_name }}</strong>
                                                    <br>
                                                </p>
                                            </div>
                                            <div wire:loading wire:target="navigationChatClicked">Loading Messages...</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- CHATS CONVERSATION HERE conversation-div.blade.php -->
                            <div id="container-chat-convo">
                                @isset($activeChat)
                                    @include('front.chats.conversation-div')
                                @endisset
                            </div>
                            <div
                                class="elementor-element elementor-element-b183ae1 elementor-widget__width-initial elementor-button-align-stretch elementor-widget elementor-widget-form"
                                data-id="b183ae1"
                                data-element_type="widget"
                                data-settings="{&quot;step_next_label&quot;:&quot;Next&quot;,&quot;step_previous_label&quot;:&quot;Previous&quot;,&quot;step_type&quot;:&quot;number_text&quot;,&quot;step_icon_shape&quot;:&quot;circle&quot;}"
                                data-widget_type="form.default"
                            >
                                <div class="elementor-widget-container">
                                    <style>/*! elementor-pro - v3.18.0 - 06-12-2023 */ .elementor-button.elementor-hidden,.elementor-hidden{display:none}.e-form__step{width:100%}.e-form__step:not(.elementor-hidden){display:flex;flex-wrap:wrap}.e-form__buttons{flex-wrap:wrap}.e-form__buttons,.e-form__buttons__wrapper{display:flex}.e-form__indicators{display:flex;justify-content:space-between;align-items:center;flex-wrap:nowrap;font-size:13px;margin-bottom:var(--e-form-steps-indicators-spacing)}.e-form__indicators__indicator{display:flex;flex-direction:column;align-items:center;justify-content:center;flex-basis:0;padding:0 var(--e-form-steps-divider-gap)}.e-form__indicators__indicator__progress{width:100%;position:relative;background-color:var(--e-form-steps-indicator-progress-background-color);border-radius:var(--e-form-steps-indicator-progress-border-radius);overflow:hidden}.e-form__indicators__indicator__progress__meter{width:var(--e-form-steps-indicator-progress-meter-width,0);height:var(--e-form-steps-indicator-progress-height);line-height:var(--e-form-steps-indicator-progress-height);padding-right:15px;border-radius:var(--e-form-steps-indicator-progress-border-radius);background-color:var(--e-form-steps-indicator-progress-color);color:var(--e-form-steps-indicator-progress-meter-color);text-align:right;transition:width .1s linear}.e-form__indicators__indicator:first-child{padding-left:0}.e-form__indicators__indicator:last-child{padding-right:0}.e-form__indicators__indicator--state-inactive{color:var(--e-form-steps-indicator-inactive-primary-color,#c2cbd2)}.e-form__indicators__indicator--state-inactive [class*=indicator--shape-]:not(.e-form__indicators__indicator--shape-none){background-color:var(--e-form-steps-indicator-inactive-secondary-color,#fff)}.e-form__indicators__indicator--state-inactive object,.e-form__indicators__indicator--state-inactive svg{fill:var(--e-form-steps-indicator-inactive-primary-color,#c2cbd2)}.e-form__indicators__indicator--state-active{color:var(--e-form-steps-indicator-active-primary-color,#39b54a);border-color:var(--e-form-steps-indicator-active-secondary-color,#fff)}.e-form__indicators__indicator--state-active [class*=indicator--shape-]:not(.e-form__indicators__indicator--shape-none){background-color:var(--e-form-steps-indicator-active-secondary-color,#fff)}.e-form__indicators__indicator--state-active object,.e-form__indicators__indicator--state-active svg{fill:var(--e-form-steps-indicator-active-primary-color,#39b54a)}.e-form__indicators__indicator--state-completed{color:var(--e-form-steps-indicator-completed-secondary-color,#fff)}.e-form__indicators__indicator--state-completed [class*=indicator--shape-]:not(.e-form__indicators__indicator--shape-none){background-color:var(--e-form-steps-indicator-completed-primary-color,#39b54a)}.e-form__indicators__indicator--state-completed .e-form__indicators__indicator__label{color:var(--e-form-steps-indicator-completed-primary-color,#39b54a)}.e-form__indicators__indicator--state-completed .e-form__indicators__indicator--shape-none{color:var(--e-form-steps-indicator-completed-primary-color,#39b54a);background-color:initial}.e-form__indicators__indicator--state-completed object,.e-form__indicators__indicator--state-completed svg{fill:var(--e-form-steps-indicator-completed-secondary-color,#fff)}.e-form__indicators__indicator__icon{width:var(--e-form-steps-indicator-padding,30px);height:var(--e-form-steps-indicator-padding,30px);font-size:var(--e-form-steps-indicator-icon-size);border-width:1px;border-style:solid;display:flex;justify-content:center;align-items:center;overflow:hidden;margin-bottom:10px}.e-form__indicators__indicator__icon img,.e-form__indicators__indicator__icon object,.e-form__indicators__indicator__icon svg{width:var(--e-form-steps-indicator-icon-size);height:auto}.e-form__indicators__indicator__icon .e-font-icon-svg{height:1em}.e-form__indicators__indicator__number{width:var(--e-form-steps-indicator-padding,30px);height:var(--e-form-steps-indicator-padding,30px);border-width:1px;border-style:solid;display:flex;justify-content:center;align-items:center;margin-bottom:10px}.e-form__indicators__indicator--shape-circle{border-radius:50%}.e-form__indicators__indicator--shape-square{border-radius:0}.e-form__indicators__indicator--shape-rounded{border-radius:5px}.e-form__indicators__indicator--shape-none{border:0}.e-form__indicators__indicator__label{text-align:center}.e-form__indicators__indicator__separator{width:100%;height:var(--e-form-steps-divider-width);background-color:#babfc5}.e-form__indicators--type-icon,.e-form__indicators--type-icon_text,.e-form__indicators--type-number,.e-form__indicators--type-number_text{align-items:flex-start}.e-form__indicators--type-icon .e-form__indicators__indicator__separator,.e-form__indicators--type-icon_text .e-form__indicators__indicator__separator,.e-form__indicators--type-number .e-form__indicators__indicator__separator,.e-form__indicators--type-number_text .e-form__indicators__indicator__separator{margin-top:calc(var(--e-form-steps-indicator-padding, 30px) / 2 - var(--e-form-steps-divider-width, 1px) / 2)}.elementor-field-type-hidden{display:none}.elementor-field-type-html{display:inline-block}.elementor-field-type-tel input{direction:inherit}.elementor-login .elementor-lost-password,.elementor-login .elementor-remember-me{font-size:.85em}.elementor-field-type-recaptcha_v3 .elementor-field-label{display:none}.elementor-field-type-recaptcha_v3 .grecaptcha-badge{z-index:1}.elementor-button .elementor-form-spinner{order:3}.elementor-form .elementor-button>span{display:flex;justify-content:center;align-items:center}.elementor-form .elementor-button .elementor-button-text{white-space:normal;flex-grow:0}.elementor-form .elementor-button svg{height:auto}.elementor-form .elementor-button .e-font-icon-svg{height:1em}.elementor-select-wrapper .select-caret-down-wrapper{position:absolute;top:50%;transform:translateY(-50%);inset-inline-end:10px;pointer-events:none;font-size:11px}.elementor-select-wrapper .select-caret-down-wrapper svg{display:unset;width:1em;aspect-ratio:unset;fill:currentColor}.elementor-select-wrapper .select-caret-down-wrapper i{font-size:19px;line-height:2}.elementor-select-wrapper.remove-before:before{content:""!important}</style>
                                    <form wire:submit.prevent="sendMessage" method="post" name="New Form">
                                        <input type="hidden" name="post_id" value="1086">
                                        <input type="hidden" name="form_id" value="b183ae1">
                                        <input type="hidden" name="referer_title" value="Chat">
                                        <input type="hidden" name="queried_id" value="1086">
                                        <div class="elementor-form-fields-wrapper elementor-labels-">
                                            <div class="elementor-field-type-textarea elementor-field-group elementor-column elementor-field-group-name elementor-col-100">
                                                <label for="form-field-name" class="elementor-field-label elementor-screen-only"> 								Type a message here</label>
                                                <textarea
                                                    class="elementor-field-textual elementor-field  elementor-size-sm"
                                                    name="message"
                                                    wire:model="message"
                                                    id="form-field-name"
                                                    rows="2"
                                                    placeholder="Type a message here"
                                                ></textarea>
                                            </div>
                                            <div class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100 e-form__buttons">
                                                <button type="submit" class="elementor-button elementor-size-xs">
                                                    <span>
                                                        <span class="elementor-button-icon"></span>
                                                        <span class="elementor-button-text">Send</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

