@extends('front.users.profile')

@section('user_account_content')
@php
    $account_page = 'user_delivery_addresses';
@endphp
<div
    class="elementor-element elementor-element-48758d2 e-con-full e-flex e-con e-child"
    data-id="48758d2"
    data-element_type="container"
    data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
>
    <div
        class="elementor-element elementor-element-0425fae e-flex e-con-boxed e-con e-child"
        data-id="0425fae"
        data-element_type="container"
        data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
    >
        <div class="e-con-inner">
            @foreach ($delivery_addresses as $delivery_address)
            <div
                class="elementor-element elementor-element-39fce9a e-con-full e-flex e-con e-child"
                data-id="39fce9a"
                data-element_type="container"
                data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
            >
                <div
                    class="elementor-element elementor-element-05bf1f4 elementor-widget elementor-widget-heading"
                    data-id="05bf1f4"
                    data-element_type="widget"
                    data-widget_type="heading.default"
                >
                    <div class="elementor-widget-container">
                        <h6 class="elementor-heading-title elementor-size-default">{{$delivery_address['name']}}</h6>
                    </div>
                </div>
                <div
                    class="elementor-element elementor-element-66ff1cb elementor-widget elementor-widget-heading"
                    data-id="66ff1cb"
                    data-element_type="widget"
                    data-widget_type="heading.default"
                >
                    <div class="elementor-widget-container">
                        <h5 class="elementor-heading-title elementor-size-default">
                            {{$delivery_address['address']}} {{$delivery_address['city']}} {{$delivery_address['state']}} {{$delivery_address['country']}} {{$delivery_address['pincode']}}
                            <br> {{$delivery_address['mobile']}}
                        </h5>
                    </div>
                </div>
                <div
                    class="elementor-element elementor-element-7deb183 elementor-widget elementor-widget-text-editor"
                    data-id="7deb183"
                    data-element_type="widget"
                    data-widget_type="text-editor.default"
                >
                    <div class="elementor-widget-container">
                        <p>
                            <span style="text-decoration: underline; color: #000000;">
                                <a class="edit-address" style="color: #000000; text-decoration: underline;" data-addressid="{{$delivery_address['id']}}">Edit</a>
                            </span>
                        </p>
                        <p>
                            <span style="text-decoration: underline; color: #000000;">
                                <a style="color: #000000; text-decoration: underline;" class="removeAddress" data-addressid="{{$delivery_address['id']}}">Delete</a>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
            <div
                class="elementor-element elementor-element-a0b40fb elementor-widget__width-auto elementor-widget elementor-widget-button"
                data-id="a0b40fb"
                data-element_type="widget"
                data-widget_type="button.default"
            >
                <div class="elementor-widget-container">
                    <div class="elementor-button-wrapper">
                        <a id="add-address-btn" class="elementor-button elementor-button-link elementor-size-sm" href="#">
                            <span class="elementor-button-content-wrapper">
                                <span class="elementor-button-text">ADD NEW ADDRESS</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif
            <div
                class="elementor-element elementor-element-6d78141 elementor-button-align-start address-page-form elementor-widget elementor-widget-form"
                data-id="6d78141"
                data-element_type="widget"
                data-settings="{&quot;button_width&quot;:&quot;100&quot;,&quot;step_type&quot;:&quot;number_text&quot;,&quot;step_icon_shape&quot;:&quot;circle&quot;}"
                data-widget_type="form.default"
            >
                <div class="elementor-widget-container">
                    <style>/*! elementor-pro - v3.18.0 - 06-12-2023 */ .elementor-button.elementor-hidden,.elementor-hidden{display:none}.e-form__step{width:100%}.e-form__step:not(.elementor-hidden){display:flex;flex-wrap:wrap}.e-form__buttons{flex-wrap:wrap}.e-form__buttons,.e-form__buttons__wrapper{display:flex}.e-form__indicators{display:flex;justify-content:space-between;align-items:center;flex-wrap:nowrap;font-size:13px;margin-bottom:var(--e-form-steps-indicators-spacing)}.e-form__indicators__indicator{display:flex;flex-direction:column;align-items:center;justify-content:center;flex-basis:0;padding:0 var(--e-form-steps-divider-gap)}.e-form__indicators__indicator__progress{width:100%;position:relative;background-color:var(--e-form-steps-indicator-progress-background-color);border-radius:var(--e-form-steps-indicator-progress-border-radius);overflow:hidden}.e-form__indicators__indicator__progress__meter{width:var(--e-form-steps-indicator-progress-meter-width,0);height:var(--e-form-steps-indicator-progress-height);line-height:var(--e-form-steps-indicator-progress-height);padding-right:15px;border-radius:var(--e-form-steps-indicator-progress-border-radius);background-color:var(--e-form-steps-indicator-progress-color);color:var(--e-form-steps-indicator-progress-meter-color);text-align:right;transition:width .1s linear}.e-form__indicators__indicator:first-child{padding-left:0}.e-form__indicators__indicator:last-child{padding-right:0}.e-form__indicators__indicator--state-inactive{color:var(--e-form-steps-indicator-inactive-primary-color,#c2cbd2)}.e-form__indicators__indicator--state-inactive [class*=indicator--shape-]:not(.e-form__indicators__indicator--shape-none){background-color:var(--e-form-steps-indicator-inactive-secondary-color,#fff)}.e-form__indicators__indicator--state-inactive object,.e-form__indicators__indicator--state-inactive svg{fill:var(--e-form-steps-indicator-inactive-primary-color,#c2cbd2)}.e-form__indicators__indicator--state-active{color:var(--e-form-steps-indicator-active-primary-color,#39b54a);border-color:var(--e-form-steps-indicator-active-secondary-color,#fff)}.e-form__indicators__indicator--state-active [class*=indicator--shape-]:not(.e-form__indicators__indicator--shape-none){background-color:var(--e-form-steps-indicator-active-secondary-color,#fff)}.e-form__indicators__indicator--state-active object,.e-form__indicators__indicator--state-active svg{fill:var(--e-form-steps-indicator-active-primary-color,#39b54a)}.e-form__indicators__indicator--state-completed{color:var(--e-form-steps-indicator-completed-secondary-color,#fff)}.e-form__indicators__indicator--state-completed [class*=indicator--shape-]:not(.e-form__indicators__indicator--shape-none){background-color:var(--e-form-steps-indicator-completed-primary-color,#39b54a)}.e-form__indicators__indicator--state-completed .e-form__indicators__indicator__label{color:var(--e-form-steps-indicator-completed-primary-color,#39b54a)}.e-form__indicators__indicator--state-completed .e-form__indicators__indicator--shape-none{color:var(--e-form-steps-indicator-completed-primary-color,#39b54a);background-color:initial}.e-form__indicators__indicator--state-completed object,.e-form__indicators__indicator--state-completed svg{fill:var(--e-form-steps-indicator-completed-secondary-color,#fff)}.e-form__indicators__indicator__icon{width:var(--e-form-steps-indicator-padding,30px);height:var(--e-form-steps-indicator-padding,30px);font-size:var(--e-form-steps-indicator-icon-size);border-width:1px;border-style:solid;display:flex;justify-content:center;align-items:center;overflow:hidden;margin-bottom:10px}.e-form__indicators__indicator__icon img,.e-form__indicators__indicator__icon object,.e-form__indicators__indicator__icon svg{width:var(--e-form-steps-indicator-icon-size);height:auto}.e-form__indicators__indicator__icon .e-font-icon-svg{height:1em}.e-form__indicators__indicator__number{width:var(--e-form-steps-indicator-padding,30px);height:var(--e-form-steps-indicator-padding,30px);border-width:1px;border-style:solid;display:flex;justify-content:center;align-items:center;margin-bottom:10px}.e-form__indicators__indicator--shape-circle{border-radius:50%}.e-form__indicators__indicator--shape-square{border-radius:0}.e-form__indicators__indicator--shape-rounded{border-radius:5px}.e-form__indicators__indicator--shape-none{border:0}.e-form__indicators__indicator__label{text-align:center}.e-form__indicators__indicator__separator{width:100%;height:var(--e-form-steps-divider-width);background-color:#babfc5}.e-form__indicators--type-icon,.e-form__indicators--type-icon_text,.e-form__indicators--type-number,.e-form__indicators--type-number_text{align-items:flex-start}.e-form__indicators--type-icon .e-form__indicators__indicator__separator,.e-form__indicators--type-icon_text .e-form__indicators__indicator__separator,.e-form__indicators--type-number .e-form__indicators__indicator__separator,.e-form__indicators--type-number_text .e-form__indicators__indicator__separator{margin-top:calc(var(--e-form-steps-indicator-padding, 30px) / 2 - var(--e-form-steps-divider-width, 1px) / 2)}.elementor-field-type-hidden{display:none}.elementor-field-type-html{display:inline-block}.elementor-field-type-tel input{direction:inherit}.elementor-login .elementor-lost-password,.elementor-login .elementor-remember-me{font-size:.85em}.elementor-field-type-recaptcha_v3 .elementor-field-label{display:none}.elementor-field-type-recaptcha_v3 .grecaptcha-badge{z-index:1}.elementor-button .elementor-form-spinner{order:3}.elementor-form .elementor-button>span{display:flex;justify-content:center;align-items:center}.elementor-form .elementor-button .elementor-button-text{white-space:normal;flex-grow:0}.elementor-form .elementor-button svg{height:auto}.elementor-form .elementor-button .e-font-icon-svg{height:1em}.elementor-select-wrapper .select-caret-down-wrapper{position:absolute;top:50%;transform:translateY(-50%);inset-inline-end:10px;pointer-events:none;font-size:11px}.elementor-select-wrapper .select-caret-down-wrapper svg{display:unset;width:1em;aspect-ratio:unset;fill:currentColor}.elementor-select-wrapper .select-caret-down-wrapper i{font-size:19px;line-height:2}.elementor-select-wrapper.remove-before:before{content:""!important}</style>
                    <form id="form-addDeliveryAddress" class="form-address" action="javascript:;" name="Add Address">
                        <input type="hidden" name="post_id" value="1628">
                        <input type="hidden" name="form_id" value="6d78141">
                        <input type="hidden" name="referer_title" value="Addresses">
                        <input type="hidden" name="queried_id" value="1628">
                        <input type="hidden" name="delivery_id" value="">
                        <div class="elementor-form-fields-wrapper elementor-labels-">
                            <div class="elementor-field-type-email elementor-field-group elementor-column elementor-field-group-field_f4dd461 elementor-col-100 elementor-field-required">
                                <label for="form-field-field_f4dd461" class="elementor-field-label elementor-screen-only"> 								Name</label>
                                <input
                                    size="1"
                                    type="text"
                                    name="delivery_name"
                                    id="form-field-field_f4dd461"
                                    class="elementor-field elementor-size-sm  elementor-field-textual"
                                    placeholder="Name"
                                    required="required"
                                    aria-required="true"
                                >
                            </div>
                            <div class="elementor-field-type-select elementor-field-group elementor-column elementor-field-group-field_81b413f elementor-col-100 elementor-field-required">
                                <label for="form-field-field_81b413f" class="elementor-field-label elementor-screen-only"> 								Phone</label>
                                <div class="elementor-field elementor-select-wrapper remove-before">
                                    <label for="form-field-field_212z2x2" class="elementor-field-label elementor-screen-only"> 								Phone</label>
                                    <select name="mobile-dialing-code" class="mobile-dialing-codes"></select>
                                    <input
                                        size="1"
                                        type="text"
                                        name="delivery_mobile"
                                        id="form-field-field_212z2x2"
                                        class="elementor-field elementor-size-sm  elementor-field-textual"
                                        placeholder="9----------"
                                        required="required"
                                        aria-required="true"
                                        pattern="^+63\d{10}$"
                                    >
                                    
                                </div>
                            </div>
                            <div class="elementor-field-type-textarea elementor-field-group elementor-column elementor-field-group-field_db46221 elementor-col-100 elementor-field-required">
                                <label for="form-field-field_db46221" class="elementor-field-label elementor-screen-only"> 								Address 1</label>
                                <textarea
                                    class="address-field elementor-field-textual elementor-field  elementor-size-sm"
                                    name="delivery_address"
                                    id="form-field-field_db46221"
                                    rows="2"
                                    placeholder="Address 1"
                                    required="required"
                                    aria-required="true"
                                ></textarea>
                            </div>
                            <div class="elementor-field-type-select elementor-field-group elementor-column elementor-field-group-field_7dbec52 elementor-col-50 elementor-field-required">
                                <label for="form-field-field_7dbec52" class="elementor-field-label elementor-screen-only"> 								Country</label>
                                <div class="elementor-field elementor-select-wrapper remove-before">
                                    <div class="select-caret-down-wrapper">
                                        <svg
                                            aria-hidden="true"
                                            class="e-font-icon-svg e-eicon-caret-down"
                                            viewbox="0 0 571.4 571.4"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path d="M571 393Q571 407 561 418L311 668Q300 679 286 679T261 668L11 418Q0 407 0 393T11 368 36 357H536Q550 357 561 368T571 393Z"></path>
                                        </svg>
                                    </div>
                                    <select
                                        name="delivery_country"
                                        id="form-field-field_7dbec52"
                                        class="elementor-field-textual address-field elementor-size-sm country-edit"
                                        required="required"
                                        aria-required="true"
                                    >
                                        <option value="Select Country">Select Country</option>

                                        @foreach ($countries as $country)
                                            {{-- $countries was passed from UserController to view using compact() method --}}
                                            <option value="{{ $country['country_name'] }}"
                                                @if ($country['country_name'] == \Illuminate\Support\Facades\Auth::user()->country) 
                                                    selected 
                                                @endif
                                            >{{ $country['country_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="elementor-field-type-select elementor-field-group elementor-column elementor-field-group-field_01a6d54 elementor-col-50 elementor-field-required">
                                <label for="form-field-field_01a6d54" class="elementor-field-label elementor-screen-only"> 								Country</label>
                                <div class="elementor-field elementor-select-wrapper remove-before">
                                    <div class="select-caret-down-wrapper">
                                        <svg
                                            aria-hidden="true"
                                            class="e-font-icon-svg e-eicon-caret-down"
                                            viewbox="0 0 571.4 571.4"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path d="M571 393Q571 407 561 418L311 668Q300 679 286 679T261 668L11 418Q0 407 0 393T11 368 36 357H536Q550 357 561 368T571 393Z"></path>
                                        </svg>
                                    </div>
                                    <select
                                        name="delivery_state"
                                        id="form-field-field_01a6d54"
                                        class="elementor-field-textual address-field elementor-size-sm state-edit"
                                        required="required"
                                        aria-required="true"
                                    >
                                        <option value="Select Province">Select Province</option>
                                    </select>
                                </div>
                            </div>
                            <div class="elementor-field-type-select elementor-field-group elementor-column elementor-field-group-field_81b413f elementor-col-50 elementor-field-required">
                                <label for="form-field-field_81b413f" class="elementor-field-label elementor-screen-only"> 								City</label>
                                <input
                                    size="1"
                                    type="text"
                                    name="delivery_city"
                                    id="form-field-field_81b413f"
                                    class="address-field elementor-field elementor-size-sm  elementor-field-textual"
                                    placeholder="City"
                                    required="required"
                                    aria-required="true"
                                >
                            </div>
                            <div class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-field_289f7f5 elementor-col-50 elementor-field-required">
                                <label for="form-field-field_289f7f5" class="elementor-field-label elementor-screen-only"> 								Zip Code</label>
                                <input
                                    size="1"
                                    type="text"
                                    name="delivery_pincode"
                                    id="form-field-field_289f7f5"
                                    class="address-field elementor-field elementor-size-sm  elementor-field-textual"
                                    placeholder="Zip Code"
                                    required="required"
                                    aria-required="true"
                                >
                            </div>
                            <div class="hidden">
                                <input type="hidden" id="shipping_address_lat" name="shipping[lat]" value="">
                                <input type="hidden" id="shipping_address_lng" name="shipping[lng]" value="">
                            </div>
                            
                            <div class="elementor-field-type-html elementor-col-100 elementor-column iframe-map" style="border-radius: 15px !important; overflow: hidden;">
                                <div id="map-profile" style="min-height: 375px;"></div>
                                <p></p>
                            </div>
                            <div class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100 e-form__buttons">
                                <button type="submit" class="elementor-button elementor-size-sm">
                                    <span>
                                        <span class="elementor-button-icon"></span>
                                        <span class="elementor-button-text">SAVE ADDRESS</span>
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