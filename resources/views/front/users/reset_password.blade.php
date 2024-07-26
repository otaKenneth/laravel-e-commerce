{{-- User Forgot Password Functionality --}} 
{{-- This page is accessed from the <a> tag in front/users/login_register.blade.php --}}
@extends('front.users.profile')


@section('user_account_content')

@php
    $account_page = 'user_security';
@endphp
<div
    class="elementor-element elementor-element-1d0a7bf e-con-full e-flex e-con e-child"
    data-id="1d0a7bf"
    data-element_type="container"
    data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
>
    <div
        class="elementor-element elementor-element-24f0421 e-flex e-con-boxed e-con e-child"
        data-id="24f0421"
        data-element_type="container"
        data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
    >
        <div class="e-con-inner">
            <div
                class="elementor-element elementor-element-ae8f5ac elementor-widget__width-initial elementor-button-align-stretch elementor-widget elementor-widget-form"
                data-id="ae8f5ac"
                data-element_type="widget"
                data-settings="{&quot;step_type&quot;:&quot;number_text&quot;,&quot;step_icon_shape&quot;:&quot;circle&quot;}"
                data-widget_type="form.default"
            >
                <div class="elementor-widget-container">
                    <style>/*! elementor-pro - v3.18.0 - 06-12-2023 */ .elementor-button.elementor-hidden,.elementor-hidden{display:none}.e-form__step{width:100%}.e-form__step:not(.elementor-hidden){display:flex;flex-wrap:wrap}.e-form__buttons{flex-wrap:wrap}.e-form__buttons,.e-form__buttons__wrapper{display:flex}.e-form__indicators{display:flex;justify-content:space-between;align-items:center;flex-wrap:nowrap;font-size:13px;margin-bottom:var(--e-form-steps-indicators-spacing)}.e-form__indicators__indicator{display:flex;flex-direction:column;align-items:center;justify-content:center;flex-basis:0;padding:0 var(--e-form-steps-divider-gap)}.e-form__indicators__indicator__progress{width:100%;position:relative;background-color:var(--e-form-steps-indicator-progress-background-color);border-radius:var(--e-form-steps-indicator-progress-border-radius);overflow:hidden}.e-form__indicators__indicator__progress__meter{width:var(--e-form-steps-indicator-progress-meter-width,0);height:var(--e-form-steps-indicator-progress-height);line-height:var(--e-form-steps-indicator-progress-height);padding-right:15px;border-radius:var(--e-form-steps-indicator-progress-border-radius);background-color:var(--e-form-steps-indicator-progress-color);color:var(--e-form-steps-indicator-progress-meter-color);text-align:right;transition:width .1s linear}.e-form__indicators__indicator:first-child{padding-left:0}.e-form__indicators__indicator:last-child{padding-right:0}.e-form__indicators__indicator--state-inactive{color:var(--e-form-steps-indicator-inactive-primary-color,#c2cbd2)}.e-form__indicators__indicator--state-inactive [class*=indicator--shape-]:not(.e-form__indicators__indicator--shape-none){background-color:var(--e-form-steps-indicator-inactive-secondary-color,#fff)}.e-form__indicators__indicator--state-inactive object,.e-form__indicators__indicator--state-inactive svg{fill:var(--e-form-steps-indicator-inactive-primary-color,#c2cbd2)}.e-form__indicators__indicator--state-active{color:var(--e-form-steps-indicator-active-primary-color,#39b54a);border-color:var(--e-form-steps-indicator-active-secondary-color,#fff)}.e-form__indicators__indicator--state-active [class*=indicator--shape-]:not(.e-form__indicators__indicator--shape-none){background-color:var(--e-form-steps-indicator-active-secondary-color,#fff)}.e-form__indicators__indicator--state-active object,.e-form__indicators__indicator--state-active svg{fill:var(--e-form-steps-indicator-active-primary-color,#39b54a)}.e-form__indicators__indicator--state-completed{color:var(--e-form-steps-indicator-completed-secondary-color,#fff)}.e-form__indicators__indicator--state-completed [class*=indicator--shape-]:not(.e-form__indicators__indicator--shape-none){background-color:var(--e-form-steps-indicator-completed-primary-color,#39b54a)}.e-form__indicators__indicator--state-completed .e-form__indicators__indicator__label{color:var(--e-form-steps-indicator-completed-primary-color,#39b54a)}.e-form__indicators__indicator--state-completed .e-form__indicators__indicator--shape-none{color:var(--e-form-steps-indicator-completed-primary-color,#39b54a);background-color:initial}.e-form__indicators__indicator--state-completed object,.e-form__indicators__indicator--state-completed svg{fill:var(--e-form-steps-indicator-completed-secondary-color,#fff)}.e-form__indicators__indicator__icon{width:var(--e-form-steps-indicator-padding,30px);height:var(--e-form-steps-indicator-padding,30px);font-size:var(--e-form-steps-indicator-icon-size);border-width:1px;border-style:solid;display:flex;justify-content:center;align-items:center;overflow:hidden;margin-bottom:10px}.e-form__indicators__indicator__icon img,.e-form__indicators__indicator__icon object,.e-form__indicators__indicator__icon svg{width:var(--e-form-steps-indicator-icon-size);height:auto}.e-form__indicators__indicator__icon .e-font-icon-svg{height:1em}.e-form__indicators__indicator__number{width:var(--e-form-steps-indicator-padding,30px);height:var(--e-form-steps-indicator-padding,30px);border-width:1px;border-style:solid;display:flex;justify-content:center;align-items:center;margin-bottom:10px}.e-form__indicators__indicator--shape-circle{border-radius:50%}.e-form__indicators__indicator--shape-square{border-radius:0}.e-form__indicators__indicator--shape-rounded{border-radius:5px}.e-form__indicators__indicator--shape-none{border:0}.e-form__indicators__indicator__label{text-align:center}.e-form__indicators__indicator__separator{width:100%;height:var(--e-form-steps-divider-width);background-color:#babfc5}.e-form__indicators--type-icon,.e-form__indicators--type-icon_text,.e-form__indicators--type-number,.e-form__indicators--type-number_text{align-items:flex-start}.e-form__indicators--type-icon .e-form__indicators__indicator__separator,.e-form__indicators--type-icon_text .e-form__indicators__indicator__separator,.e-form__indicators--type-number .e-form__indicators__indicator__separator,.e-form__indicators--type-number_text .e-form__indicators__indicator__separator{margin-top:calc(var(--e-form-steps-indicator-padding, 30px) / 2 - var(--e-form-steps-divider-width, 1px) / 2)}.elementor-field-type-hidden{display:none}.elementor-field-type-html{display:inline-block}.elementor-field-type-tel input{direction:inherit}.elementor-login .elementor-lost-password,.elementor-login .elementor-remember-me{font-size:.85em}.elementor-field-type-recaptcha_v3 .elementor-field-label{display:none}.elementor-field-type-recaptcha_v3 .grecaptcha-badge{z-index:1}.elementor-button .elementor-form-spinner{order:3}.elementor-form .elementor-button>span{display:flex;justify-content:center;align-items:center}.elementor-form .elementor-button .elementor-button-text{white-space:normal;flex-grow:0}.elementor-form .elementor-button svg{height:auto}.elementor-form .elementor-button .e-font-icon-svg{height:1em}.elementor-select-wrapper .select-caret-down-wrapper{position:absolute;top:50%;transform:translateY(-50%);inset-inline-end:10px;pointer-events:none;font-size:11px}.elementor-select-wrapper .select-caret-down-wrapper svg{display:unset;width:1em;aspect-ratio:unset;fill:currentColor}.elementor-select-wrapper .select-caret-down-wrapper i{font-size:19px;line-height:2}.elementor-select-wrapper.remove-before:before{content:""!important}</style>
                    <form id="passwordForm" action="javascript:;" class="elementor-form" method="post" name="Reset Password">
                        <div id="password-success" class="message-form"></div>
                        <div id="password-error" class="message-form"></div>
                        <div id="password-error-current" class="message-form"></div>
                        <input type="hidden" name="post_id" value="884">
                        <input type="hidden" name="form_id" value="ae8f5ac">
                        <input type="hidden" name="referer_title" value="RESET PASSWORD">
                        <input type="hidden" name="queried_id" value="884">
                        <div class="elementor-form-fields-wrapper elementor-labels-">
                            <div class="elementor-field-type-password elementor-field-group elementor-column elementor-field-group-email elementor-col-100 elementor-field-required">
                                <label for="current_password" class="elementor-field-label elementor-screen-only"> 								Current Password</label>
                                <input
                                    size="1"
                                    type="password"
                                    name="current_password"
                                    id="current_password"
                                    class="elementor-field elementor-size-sm  elementor-field-textual"
                                    placeholder="Current Password"
                                    required="required"
                                    aria-required="true"
                                >
                            </div>
                            <div class="elementor-field-type-password elementor-field-group elementor-column elementor-field-group-field_3ff5bb2 elementor-col-100 elementor-field-required">
                                <label for="form-field-field_3ff5bb2" class="elementor-field-label elementor-screen-only"> 								New Password</label>
                                <input
                                    size="1"
                                    type="password"
                                    name="new_password"
                                    id="form-field-field_3ff5bb2"
                                    class="elementor-field elementor-size-sm  elementor-field-textual"
                                    placeholder="New Password"
                                    required="required"
                                    aria-required="true"
                                >
                            </div>
                            <div class="elementor-field-type-password elementor-field-group elementor-column elementor-field-group-field_cfa2f1f elementor-col-100 elementor-field-required">
                                <label for="form-field-field_cfa2f1f" class="elementor-field-label elementor-screen-only"> 								Confirm New Password</label>
                                <input
                                    size="1"
                                    type="password"
                                    name="confirm_password"
                                    id="form-field-field_cfa2f1f"
                                    class="elementor-field elementor-size-sm  elementor-field-textual"
                                    placeholder="Confirm New Password"
                                    required="required"
                                    aria-required="true"
                                >
                            </div>
                            <div class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100 e-form__buttons">
                                <button type="submit" class="elementor-button elementor-size-sm">
                                    <span>
                                        <span class="elementor-button-icon"></span>
                                        <span class="elementor-button-text">Change Password</span>
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


@endsection