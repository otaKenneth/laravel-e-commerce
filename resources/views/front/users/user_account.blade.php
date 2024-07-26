@extends('front.users.profile')

@section('user_account_content')

@php
    $account_page = 'user_account';
@endphp

<div
    class="elementor-element elementor-element-df7ebda e-con-full e-flex e-con e-child customer_information"
    data-id="df7ebda"
    data-element_type="container"
    data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
>
    <div
        class="elementor-element elementor-element-66eba68 e-grid e-con-boxed e-con e-child"
        data-id="66eba68"
        data-element_type="container"
        data-settings="{&quot;container_type&quot;:&quot;grid&quot;,&quot;grid_columns_grid_tablet&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:2,&quot;sizes&quot;:[]},&quot;content_width&quot;:&quot;boxed&quot;,&quot;grid_outline&quot;:&quot;yes&quot;,&quot;grid_columns_grid&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:3,&quot;sizes&quot;:[]},&quot;grid_columns_grid_mobile&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]},&quot;grid_rows_grid&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:2,&quot;sizes&quot;:[]},&quot;grid_rows_grid_tablet&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;grid_rows_grid_mobile&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;grid_auto_flow&quot;:&quot;row&quot;,&quot;grid_auto_flow_tablet&quot;:&quot;row&quot;,&quot;grid_auto_flow_mobile&quot;:&quot;row&quot;}"
    >
        <div class="">

            <form id="accountForm" action="javascript:;" method="post" name="Edit Form" class="edit-information-form">
                <div id="account-success" class="message-form"></div>
                <div id="account-error" class="message-form"></div>
                <div
                    class="elementor-element elementor-element-8ef6cca e-flex e-con-boxed e-con e-child"
                    data-id="8ef6cca"
                    data-element_type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}">
                    <div class="e-con-inner">
                        <div
                            class="elementor-element elementor-element-846d9e7 elementor-widget elementor-widget-heading"
                            data-id="846d9e7"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h6 class="elementor-heading-title elementor-size-default">FIRST NAME</h6>
                            </div>
                        </div>
                        <div
                            class="elementor-element elementor-element-fce3415 elementor-widget elementor-widget-heading"
                            data-id="fce3415"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h5 class="elementor-heading-title elementor-size-default">{{ $user->first_name }}</h5>
                                <input class="text-field first_name_edit" type="text" id="first_name_edit" name="first_name" value="{{ $user->first_name }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="elementor-element elementor-element-4c294d7 e-flex e-con-boxed e-con e-child"
                    data-id="4c294d7"
                    data-element_type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                >
                    <div class="e-con-inner">
                        <div
                            class="elementor-element elementor-element-0954561 elementor-widget elementor-widget-heading"
                            data-id="0954561"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h6 class="elementor-heading-title elementor-size-default">LAST NAME</h6>
                            </div>
                        </div>
                        <div
                            class="elementor-element elementor-element-30f458e elementor-widget elementor-widget-heading"
                            data-id="30f458e"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h5 class="elementor-heading-title elementor-size-default">{{ $user->last_name }}</h5>
                                <input class="text-field last_name_edit" type="text" id="last_name_edit" name="last_name" value="{{ $user->last_name }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="elementor-element elementor-element-bd6cfb3 e-flex e-con-boxed e-con e-child"
                    data-id="bd6cfb3"
                    data-element_type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                >
                    <div class="e-con-inner">
                        <div
                            class="elementor-element elementor-element-3f22892 elementor-widget elementor-widget-heading"
                            data-id="3f22892"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h6 class="elementor-heading-title elementor-size-default">Address 1</h6>
                            </div>
                        </div>
                        <div
                            class="elementor-element elementor-element-f49bf8e elementor-widget elementor-widget-heading"
                            data-id="f49bf8e"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h5 class="elementor-heading-title elementor-size-default">{{ $user->address }}</h5>
                                <input class="text-field address_1_edit" type="text" id="address_1_edit" name="address" value="{{ $user->address }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="elementor-element elementor-element-39ebcd7 e-flex e-con-boxed e-con e-child"
                    data-id="39ebcd7"
                    data-element_type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}">
                    <div class="e-con-inner">
                        <div
                            class="elementor-element elementor-element-735d997 elementor-widget elementor-widget-heading"
                            data-id="735d997"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h6 class="elementor-heading-title elementor-size-default">COUNTRY</h6>
                            </div>
                        </div>
                        <div
                            class="elementor-element elementor-element-9f0221a elementor-widget elementor-widget-heading"
                            data-id="9f0221a"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h5 class="elementor-heading-title elementor-size-default">{{ $user->country }}</h5>
                                <select class="text-field address-field country-edit" id="user-country" name="country" style="color: #495057">
                                    <option value="">Select Country</option>

                                    @foreach ($countries as $country) {{-- $countries was passed from UserController to view using compact() method --}}
                                        <option value="{{ $country['country_name'] }}"  @if ($country['country_name'] == \Illuminate\Support\Facades\Auth::user()->country) selected @endif>{{ $country['country_name'] }}</option>
                                    @endforeach

                                </select>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div
                    class="elementor-element elementor-element-b364a78 e-flex e-con-boxed e-con e-child"
                    data-id="b364a78"
                    data-element_type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}">
                    <div class="e-con-inner">
                        <div
                            class="elementor-element elementor-element-d3788cf elementor-widget elementor-widget-heading"
                            data-id="d3788cf"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h6 class="elementor-heading-title elementor-size-default">PROVINCE</h6>
                            </div>
                        </div>
                        <div
                            class="elementor-element elementor-element-72c84e2 elementor-widget elementor-widget-heading"
                            data-id="72c84e2"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h5 class="elementor-heading-title elementor-size-default">{{ $user->state }}</h5>
                                <select class="text-field address-field state-edit" id="user-state" name="state" style="color: #495057">
                                    <option value="">Select State</option>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div
                    class="elementor-element elementor-element-00b548d e-flex e-con-boxed e-con e-child"
                    data-id="00b548d"
                    data-element_type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}">
                    <div class="e-con-inner">
                        <div
                            class="elementor-element elementor-element-27fbff6 elementor-widget elementor-widget-heading"
                            data-id="27fbff6"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h6 class="elementor-heading-title elementor-size-default">CITY</h6>
                            </div>
                        </div>
                        <div
                            class="elementor-element elementor-element-6892f69 elementor-widget elementor-widget-heading"
                            data-id="6892f69"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h5 class="elementor-heading-title elementor-size-default">{{ $user->city }}</h5>
                                <input class="text-field user-city" type="text" id="user-city" name="city" value="{{ $user->city }}">
                            </div>
                            
                        </div>
                    </div>
                </div>

                

                

                <div
                    class="elementor-element elementor-element-e30bacf e-flex e-con-boxed e-con e-child"
                    data-id="e30bacf"
                    data-element_type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                >
                    <div class="e-con-inner">
                        <div
                            class="elementor-element elementor-element-5a654f7 elementor-widget elementor-widget-heading"
                            data-id="5a654f7"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h6 class="elementor-heading-title elementor-size-default">ZIP CODE</h6>
                            </div>
                        </div>
                        <div
                            class="elementor-element elementor-element-cba44ce elementor-widget elementor-widget-heading"
                            data-id="cba44ce"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h5 class="elementor-heading-title elementor-size-default">{{ $user->pincode }}</h5>
                                <input class="text-field zip_code_edit" type="text" id="zip_code_edit" name="pincode" value="{{ $user->pincode }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="elementor-element elementor-element-647b37c e-flex e-con-boxed e-con e-child"
                    data-id="647b37c"
                    data-element_type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                >
                    <div class="e-con-inner">
                        <div
                            class="elementor-element elementor-element-fa1ec7a elementor-widget elementor-widget-heading"
                            data-id="fa1ec7a"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h6 class="elementor-heading-title elementor-size-default">MOBILE</h6>
                            </div>
                        </div>
                        <div
                            class="elementor-element elementor-element-e51720f elementor-widget elementor-widget-heading"
                            data-id="e51720f"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h5 class="elementor-heading-title elementor-size-default">{{ $user->mobile }}</h5>
                                <input type="text" class="text-field phone_edit" id="phone_edit" name="mobile" pattern="^0\d{10}$" value="{{ $user->mobile }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="elementor-element elementor-element-4ad3441 e-flex e-con-boxed e-con e-child"
                    data-id="4ad3441"
                    data-element_type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                >
                    <div class="e-con-inner">
                        <div
                            class="elementor-element elementor-element-3739a7b elementor-widget elementor-widget-heading"
                            data-id="3739a7b"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h6 class="elementor-heading-title elementor-size-default">EMAIL</h6>
                            </div>
                        </div>
                        <div
                            class="elementor-element elementor-element-7bd22e0 elementor-widget elementor-widget-heading"
                            data-id="7bd22e0"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h5 class="elementor-heading-title elementor-size-default">{{ $user->email }}</h5>
                                <input class="text-field email_edit" type="email" id="email_edit" name="email_edit" value="{{ $user->email }}">
                            </div>
                        </div>
                    </div>
                </div>




                <div
                    class="elementor-element elementor-element-1765a07 tablet-grid-col-1 elementor-mobile-align-center elementor-widget elementor-widget-button"
                    data-id="1765a07"
                    data-element_type="widget"
                    data-widget_type="button.default"
                >
                    <div class="elementor-widget-container">
                        <div class="elementor-button-wrapper">
                            <a id="edit_info" class="elementor-button elementor-button-link elementor-size-sm" href="#">
                                <span class="elementor-button-content-wrapper">
                                    <span class="elementor-button-text">Edit information</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="elementor-element elementor-element-1765a09 tablet-hide elementor-mobile-align-center elementor-widget elementor-widget-button"
                    data-id="1765a09"
                    data-element_type="widget"
                    data-widget_type="button.default"
                >
                    
                </div>

                <div
                    class="elementor-element elementor-element-1765a07 mobile-grid-col-1 elementor-mobile-align-center elementor-widget elementor-widget-button"
                    data-id="1765a07"
                    data-element_type="widget"
                    data-widget_type="button.default"
                >
                    <div class="elementor-widget-container">
                        <div class="elementor-button-wrapper text-align-right save_button text-align-center-mobile">
                            <button id="save_info" type="submit" class="elementor-button elementor-button-link elementor-size-sm">
                                <span class="elementor-button-content-wrapper">
                                    <span class="elementor-button-text">Save changes</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection