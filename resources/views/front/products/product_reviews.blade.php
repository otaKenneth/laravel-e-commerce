<div
        class="elementor-element elementor-element-8916704 e-flex e-con-boxed e-con e-parent"
        data-id="8916704"
        data-element_type="container"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
        data-core-v316-plus="true">
        <div class="e-con-inner">
            <div
                class="elementor-element elementor-element-bc9eac4 e-flex e-con-boxed e-con e-child"
                data-id="bc9eac4"
                data-element_type="container"
                data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
            >
                <div class="e-con-inner">
                    <div
                        class="elementor-element elementor-element-cdb250b elementor-widget elementor-widget-heading"
                        data-id="cdb250b"
                        data-element_type="widget"
                        data-widget_type="heading.default"
                    >
                        <div class="elementor-widget-container">
                            <h2 class="elementor-heading-title elementor-size-default">CUSTOMER REVIEWS</h2>
                        </div>
                    </div>
                    <div
                        class="elementor-element elementor-element-ac0046e e-flex e-con-boxed e-con e-child"
                        data-id="ac0046e"
                        data-element_type="container"
                        data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                    >
                        <div class="e-con-inner">
                            <div
                                class="elementor-element elementor-element-65b7b51 e-con-full e-flex e-con e-child"
                                data-id="65b7b51"
                                data-element_type="container"
                                data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
                            >
                                <div
                                    class="elementor-element elementor-element-09dfa96 elementor-widget elementor-widget-rating"
                                    data-id="09dfa96"
                                    data-element_type="widget"
                                    data-widget_type="rating.default"
                                >
                                    <div class="elementor-widget-container">
                                        <div
                                            class="e-rating"
                                            itemtype="https://schema.org/Rating"
                                            itemscope=""
                                            itemprop="reviewRating"
                                        >
                                            <meta itemprop="worstRating" content="0">
                                            <meta itemprop="bestRating" content="5">
                                            <div
                                                class="e-rating-wrapper"
                                                itemprop="ratingValue"
                                                content="4.5"
                                                role="img"
                                                aria-label="Rated 4.5 out of 5"
                                            >
                                                @for ($stars = 0; $stars < 5; $stars++)
                                                <div class="e-icon">
                                                    @if ($stars < $avgStarRating)
                                                    <div class="e-icon-wrapper e-icon-marked">
                                                        <svg
                                                            aria-hidden="true"
                                                            class="e-font-icon-svg e-eicon-star"
                                                            viewbox="0 0 1000 1000"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <path d="M450 75L338 312 88 350C46 354 25 417 58 450L238 633 196 896C188 942 238 975 275 954L500 837 725 954C767 975 813 942 804 896L763 633 942 450C975 417 954 358 913 350L663 312 550 75C529 33 471 33 450 75Z"></path>
                                                        </svg>
                                                    </div>
                                                    @endif
                                                    <div class="e-icon-wrapper e-icon-unmarked">
                                                        <svg
                                                            aria-hidden="true"
                                                            class="e-font-icon-svg e-eicon-star"
                                                            viewbox="0 0 1000 1000"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <path d="M450 75L338 312 88 350C46 354 25 417 58 450L238 633 196 896C188 942 238 975 275 954L500 837 725 954C767 975 813 942 804 896L763 633 942 450C975 417 954 358 913 350L663 312 550 75C529 33 471 33 450 75Z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                @endfor
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="elementor-element elementor-element-c38b191 elementor-widget elementor-widget-text-editor"
                                    data-id="c38b191"
                                    data-element_type="widget"
                                    data-widget_type="text-editor.default"
                                >
                                    <div class="elementor-widget-container">
                                        <p>
                                            <strong>{{$avgRating}} out of 5</strong>
                                            <br>Based on {{ $ratings->total() }} review(s)
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="elementor-element elementor-element-ea8042d e-con-full e-flex e-con e-child"
                                data-id="ea8042d"
                                data-element_type="container"
                                data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
                            >
                                <div
                                    class="elementor-element elementor-element-117e49d elementor-widget elementor-widget-button"
                                    data-id="117e49d"
                                    data-element_type="widget"
                                    data-widget_type="button.default"
                                >
                                    <div class="elementor-widget-container">
                                        <div class="elementor-button-wrapper">
                                            <a class="elementor-button elementor-button-link elementor-size-sm" href="#">
                                                <span class="elementor-button-content-wrapper">
                                                    <span class="elementor-button-text">ALL REVIEWS</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="elementor-element elementor-element-1d834c8 elementor-widget elementor-widget-button"
                                    data-id="1d834c8"
                                    data-element_type="widget"
                                    data-widget_type="button.default"
                                >
                                    <div class="elementor-widget-container">
                                        <div class="elementor-button-wrapper">
                                            <a class="elementor-button elementor-button-link elementor-size-sm" href="#">
                                                <span class="elementor-button-content-wrapper">
                                                    <span class="elementor-button-text">5 Star ({{$ratingFiveStarCount}})</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="elementor-element elementor-element-600f384 elementor-widget elementor-widget-button"
                                    data-id="600f384"
                                    data-element_type="widget"
                                    data-widget_type="button.default"
                                >
                                    <div class="elementor-widget-container">
                                        <div class="elementor-button-wrapper">
                                            <a class="elementor-button elementor-button-link elementor-size-sm" href="#">
                                                <span class="elementor-button-content-wrapper">
                                                    <span class="elementor-button-text">4 Star ({{$ratingFourStarCount}})</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="elementor-element elementor-element-68d8a9b elementor-widget elementor-widget-button"
                                    data-id="68d8a9b"
                                    data-element_type="widget"
                                    data-widget_type="button.default"
                                >
                                    <div class="elementor-widget-container">
                                        <div class="elementor-button-wrapper">
                                            <a class="elementor-button elementor-button-link elementor-size-sm" href="#">
                                                <span class="elementor-button-content-wrapper">
                                                    <span class="elementor-button-text">3 Star ({{$ratingThreeStarCount}})</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="elementor-element elementor-element-3e71e7f elementor-widget elementor-widget-button"
                                    data-id="3e71e7f"
                                    data-element_type="widget"
                                    data-widget_type="button.default"
                                >
                                    <div class="elementor-widget-container">
                                        <div class="elementor-button-wrapper">
                                            <a class="elementor-button elementor-button-link elementor-size-sm" href="#">
                                                <span class="elementor-button-content-wrapper">
                                                    <span class="elementor-button-text">2 Star ({{$ratingTwoStarCount}})</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="elementor-element elementor-element-2a1a322 elementor-widget elementor-widget-button"
                                    data-id="2a1a322"
                                    data-element_type="widget"
                                    data-widget_type="button.default"
                                >
                                    <div class="elementor-widget-container">
                                        <div class="elementor-button-wrapper">
                                            <a class="elementor-button elementor-button-link elementor-size-sm" href="#">
                                                <span class="elementor-button-content-wrapper">
                                                    <span class="elementor-button-text">1 Star ({{$ratingOneStarCount}})</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @auth
                            @if (\App\Models\OrdersProduct::hasUserOrderedThisProduct(Auth::user()->id, $productDetails['id']))
                            <div
                                class="elementor-element elementor-element-f5186bb elementor-align-justify elementor-mobile-align-justify elementor-widget-tablet__width-initial elementor-widget elementor-widget-button"
                                data-id="f5186bb"
                                data-element_type="widget"
                                data-widget_type="button.default"
                            >
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <span id="write_review_btn" class="elementor-button elementor-button-link elementor-size-sm">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text">WRITE A REVIEW</span>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endauth
                        </div>
                    </div>
                    <div
                        id="form_write_review"
                        class="elementor-element elementor-element-1dc2f32 elementor-widget__width-initial elementor-button-align-stretch elementor-widget elementor-widget-form"
                        data-id="1dc2f32"
                        data-element_type="widget"
                        data-settings="{&quot;step_next_label&quot;:&quot;Next&quot;,&quot;step_previous_label&quot;:&quot;Previous&quot;,&quot;button_width&quot;:&quot;100&quot;,&quot;step_type&quot;:&quot;number_text&quot;,&quot;step_icon_shape&quot;:&quot;circle&quot;}"
                        data-widget_type="form.default"
                    >
                        <div class="elementor-widget-container">
                            <form id="form-productReview" action="javascript:;" name="Write a review">

                                @csrf
                                @if (session('success_message'))
                                    <div class="alert success">{{ session('success_message') }}</div>
                                @endif

                                <input type="hidden" name="post_id" value="491">
                                <input type="hidden" name="form_id" value="1dc2f32">
                                <input type="hidden" name="referer_title" value="Product Page">
                                <input type="hidden" name="queried_id" value="491">
                                <input type="hidden" name="product_id" value="{{$productDetails['id']}}">
                                <div class="elementor-form-fields-wrapper elementor-labels-">
                                    <div class="elementor-field-type-html elementor-field-group elementor-column elementor-field-group-field_e12c23e elementor-col-100">
                                        <h3 style="text-align: center; margin-bottom: 0px; color: #5F7A61">
                                            <b>Write a Review</b>
                                        </h3>
                                    </div>
                                    <div class="elementor-field-type-html elementor-field-group elementor-column elementor-field-group-field_2c1b095 elementor-col-100">
                                        <label style="text-align: center; width: 100%;">
                                            <b>Rating</b>
                                        </label>
                                        <div class="rating">
                                            <input
                                                type="radio"
                                                id="star5"
                                                name="rating"
                                                value="5"
                                                checked
                                            >
                                            <label for="star5"></label>
                                            <input
                                                type="radio"
                                                id="star4"
                                                name="rating"
                                                value="4"
                                            >
                                            <label for="star4"></label>
                                            <input
                                                type="radio"
                                                id="star3"
                                                name="rating"
                                                value="3"
                                            >
                                            <label for="star3"></label>
                                            <input
                                                type="radio"
                                                id="star2"
                                                name="rating"
                                                value="2"
                                            >
                                            <label for="star2"></label>
                                            <input
                                                type="radio"
                                                id="star1"
                                                name="rating"
                                                value="1"
                                            >
                                            <label for="star1"></label>
                                        </div>
                                    </div>
                                    <div class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-field_009055d elementor-col-100 elementor-field-required">
                                        <label for="form-field-field_009055d" class="elementor-field-label elementor-screen-only"> 								Name</label>
                                        <input
                                            size="1"
                                            type="text"
                                            name="reviewer"
                                            id="form-field-field_009055d"
                                            class="elementor-field elementor-size-sm  elementor-field-textual"
                                            placeholder="Name"
                                            required="required"
                                            aria-required="true"
                                            value="{{Auth::check() ? Auth::user()->first_name . ' ' . Auth::user()->last_name:''}}"
                                        >
                                    </div>
                                    <div class="elementor-field-type-checkbox elementor-field-group elementor-column elementor-field-group-field_ff7cdbc elementor-col-100">
                                        <label for="form-field-field_ff7cdbc" class="elementor-field-label elementor-screen-only">Write as Anonymous</label>
                                        <div class="elementor-field-subgroup  ">
                                            <span class="elementor-field-option">
                                                <input type="checkbox" value="Write as Anonymous" id="anonymousCheckbox" name="form_fields[field_ff7cdbc]"> 
                                                <label for="anonymousCheckbox">Write as Anonymous</label>
                                            </span>
                                        </div>
                                    </div>


                                    <div class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-name elementor-col-100 elementor-field-required">
                                        <label for="form-field-name" class="elementor-field-label elementor-screen-only"> 								Review Title</label>
                                        <input
                                            size="1"
                                            type="text"
                                            name="form_fields[name]"
                                            id="form-field-name"
                                            class="elementor-field elementor-size-sm  elementor-field-textual"
                                            placeholder="Review Title"
                                            required="required"
                                            aria-required="true"
                                        >
                                    </div>
                                    <div class="elementor-field-type-textarea elementor-field-group elementor-column elementor-field-group-email elementor-col-100 elementor-field-required">
                                        <label for="form-field-email" class="elementor-field-label elementor-screen-only"> 								Review</label>
                                        <textarea
                                            class="elementor-field-textual elementor-field  elementor-size-sm"
                                            name="review"
                                            id="form-field-email"
                                            rows="5"
                                            placeholder="Write your comments here"
                                            required="required"
                                            aria-required="true"
                                        ></textarea>
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100 e-form__buttons">
                                        <button type="submit" class="elementor-button elementor-size-sm">
                                            <span>
                                                <span class="elementor-button-icon"></span>
                                                <span class="elementor-button-text">SUBMIT REVIEW</span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="elementor-element elementor-element-4e9dd00 e-flex e-con-boxed e-con e-child"
                data-id="4e9dd00"
                data-element_type="container"
                data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
            >
                <div class="e-con-inner">
                    @foreach ($ratings as $rating)
                    <div
                        class="elementor-element elementor-element-b004388 e-con-full e-flex e-con e-child"
                        data-id="b004388"
                        data-element_type="container"
                        data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
                    >
                        <div
                            class="elementor-element elementor-element-ca834ef e-flex e-con-boxed e-con e-child"
                            data-id="ca834ef"
                            data-element_type="container"
                            data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                        >
                            <div class="e-con-inner">
                                <div
                                    class="elementor-element elementor-element-3693829 elementor-widget elementor-widget-rating"
                                    data-id="3693829"
                                    data-element_type="widget"
                                    data-widget_type="rating.default"
                                >
                                    <div class="elementor-widget-container">
                                        <div
                                            class="e-rating"
                                            itemtype="https://schema.org/Rating"
                                            itemscope=""
                                            itemprop="reviewRating"
                                        >
                                            <meta itemprop="worstRating" content="0">
                                            <meta itemprop="bestRating" content="5">
                                            <div
                                                class="e-rating-wrapper"
                                                itemprop="ratingValue"
                                                content="{{$rating['rating']}}"
                                                role="img"
                                                aria-label="Rated {{$rating['rating']}} out of 5"
                                            >
                                                @for ($stars = 0; $stars < 5; $stars++)
                                                <div class="e-icon">
                                                    @if ($stars < $rating['rating'])
                                                    <div class="e-icon-wrapper e-icon-marked">
                                                        <svg
                                                            aria-hidden="true"
                                                            class="e-font-icon-svg e-eicon-star"
                                                            viewbox="0 0 1000 1000"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <path d="M450 75L338 312 88 350C46 354 25 417 58 450L238 633 196 896C188 942 238 975 275 954L500 837 725 954C767 975 813 942 804 896L763 633 942 450C975 417 954 358 913 350L663 312 550 75C529 33 471 33 450 75Z"></path>
                                                        </svg>
                                                    </div>
                                                    @endif
                                                    <div class="e-icon-wrapper e-icon-unmarked">
                                                        <svg
                                                            aria-hidden="true"
                                                            class="e-font-icon-svg e-eicon-star"
                                                            viewbox="0 0 1000 1000"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <path d="M450 75L338 312 88 350C46 354 25 417 58 450L238 633 196 896C188 942 238 975 275 954L500 837 725 954C767 975 813 942 804 896L763 633 942 450C975 417 954 358 913 350L663 312 550 75C529 33 471 33 450 75Z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                @endfor
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="elementor-element elementor-element-5243e95 elementor-widget elementor-widget-text-editor"
                                    data-id="5243e95"
                                    data-element_type="widget"
                                    data-widget_type="text-editor.default"
                                >
                                    <div class="elementor-widget-container">
                                        <p>{{ date('M d, Y H:m:i', strtotime($rating['created_at'])) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="elementor-element elementor-element-7f7bd83 elementor-widget elementor-widget-heading"
                            data-id="7f7bd83"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h5 class="elementor-heading-title elementor-size-default">{{ $rating['user']['first_name'] }} {{ $rating['user']['last_name'] }}
                                    @if (!is_null($rating['user']['email_verified_at']))
                                        <span>Verified</span>
                                    @endif
                                </h5>
                            </div>
                        </div>
                        <div
                            class="elementor-element elementor-element-034afc5 elementor-widget elementor-widget-text-editor"
                            data-id="034afc5"
                            data-element_type="widget"
                            data-widget_type="text-editor.default"
                        >
                            <div class="elementor-widget-container">
                                <p>
                                    <strong>Title</strong>
                                    <br>{{ $rating['review'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @if ($ratings->hasPages())
                    @php
                        $lastNumInRange = $ratings->lastPage();
                        $urlRange = $ratings->getUrlRange(1, $ratings->lastPage());
                        
                        if ($ratings->lastPage() > 5) {
                            if ($ratings->currentPage() + 2 < $ratings->lastPage()) {
                                $lastNumInRange = $ratings->currentPage() + 2;
                                $urlRange = $ratings->getUrlRange($ratings->currentPage(), $ratings->currentPage() + 2);
                            } else {
                                $lastNumInRange = $ratings->lastPage();
                                if ($ratings->currentPage() - 2 < 1) {
                                    $urlRange = $ratings->getUrlRange($ratings->currentPage(), $ratings->currentPage() + 2);
                                } else {
                                    $urlRange = $ratings->getUrlRange($ratings->currentPage() -2, $ratings->lastPage());
                                }
                            }
                        }
                    @endphp
                        
                        <div
                            class="navigation-button elementor-element elementor-element-f97c986 e-con-full e-flex elementor-invisible e-con e-child"
                            data-id="f97c986"
                            data-element_type="container"
                            data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
                        >
                            @if ($ratings->currentPage() > 1)
                            <div
                                class="elementor-element elementor-element-4e10030 elementor-align-left elementor-widget elementor-widget-button"
                                data-id="4e10030"
                                data-element_type="widget"
                                data-widget_type="button.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <a class="elementor-button elementor-button-link elementor-size-sm" href="{{$ratings->previousPageUrl()}}">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-icon elementor-align-icon-left">
                                                    <svg aria-hidden="true" class="e-font-icon-svg e-fas-angle-left" viewBox="0 0 256 512" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M31.7 239l136-136c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9L127.9 256l96.4 96.4c9.4 9.4 9.4 24.6 0 33.9L201.7 409c-9.4 9.4-24.6 9.4-33.9 0l-136-136c-9.5-9.4-9.5-24.6-.1-34z"></path>
                                                    </svg>
                                                </span>
                                                <span class="elementor-button-text"></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($ratings->currentPage() != 1 && $ratings->lastPage() > 5)
                            <div
                                class="elementor-element elementor-element-cf4102a elementor-align-left elementor-widget elementor-widget-button"
                                data-id="cf4102a"
                                data-element_type="widget"
                                data-widget_type="button.default"
                            >
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <a class="elementor-button elementor-button-link elementor-size-sm" href="{{$ratings->url(1)}}">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text">1</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($ratings->currentPage() - 1 > 1)
                                <div
                                    class="elementor-element elementor-element-21e3336 elementor-align-left elementor-widget elementor-widget-button"
                                    data-id="21e3336"
                                    data-element_type="widget"
                                    data-widget_type="button.default"
                                >
                                    <div class="elementor-widget-container">
                                        <div class="elementor-button-wrapper">
                                            <a class="elementor-button elementor-size-sm" role="button">
                                                <span class="elementor-button-content-wrapper">
                                                    <span class="elementor-button-text">...</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @foreach ($urlRange as $urlKey => $url)
                            <div
                                class="elementor-element elementor-element-cf4102a elementor-align-left elementor-widget elementor-widget-button"
                                data-id="cf4102a"
                                data-element_type="widget"
                                data-widget_type="button.default"
                            >
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <a class="elementor-button elementor-size-sm" href="{{$url}}" role="button">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text">{{$urlKey}}</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @if ($ratings->lastPage() - $ratings->currentPage() > 3)
                                <div
                                    class="elementor-element elementor-element-21e3336 elementor-align-left elementor-widget elementor-widget-button"
                                    data-id="21e3336"
                                    data-element_type="widget"
                                    data-widget_type="button.default"
                                >
                                    <div class="elementor-widget-container">
                                        <div class="elementor-button-wrapper">
                                            <a class="elementor-button elementor-size-sm" role="button">
                                                <span class="elementor-button-content-wrapper">
                                                    <span class="elementor-button-text">...</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($lastNumInRange != $ratings->lastPage() && $ratings->lastPage() > 5)
                            <div
                                class="elementor-element elementor-element-cf4102a elementor-align-left elementor-widget elementor-widget-button"
                                data-id="cf4102a"
                                data-element_type="widget"
                                data-widget_type="button.default"
                            >
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <a class="elementor-button elementor-button-link elementor-size-sm" href="{{$ratings->url($ratings->lastPage())}}">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text">{{$ratings->lastPage()}}</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($ratings->currentPage() < $ratings->lastPage())
                            <div
                                class="elementor-element elementor-element-4e10030 elementor-align-left elementor-widget elementor-widget-button"
                                data-id="4e10030"
                                data-element_type="widget"
                                data-widget_type="button.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <a class="elementor-button elementor-button-link elementor-size-sm" href="{{$ratings->nextPageUrl()}}">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-icon elementor-align-icon-left">
                                                    <svg
                                                        aria-hidden="true"
                                                        class="e-font-icon-svg e-fas-angle-right"
                                                        viewbox="0 0 256 512"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z"></path>
                                                    </svg>
                                                </span>
                                                <span class="elementor-button-text"></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>