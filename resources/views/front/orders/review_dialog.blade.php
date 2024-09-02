<div class="popup_review_order elementor-491">
    <div class="elementor-element elementor-element-1dc2f32 displayed-block">
        <form id="form-productReview" action="javascript:;" name="Write a review">
            @csrf

            <input type="hidden" name="post_id" value="491">
            <input type="hidden" name="form_id" value="1dc2f32">
            <input type="hidden" name="referer_title" value="Product Page">
            <input type="hidden" name="queried_id" value="491">
            <input type="hidden" id="product_id" name="product_id" value="">
            <div class="elementor-form-fields-wrapper elementor-labels-">
                <div
                    class="elementor-field-type-html elementor-field-group elementor-column elementor-field-group-field_e12c23e elementor-col-100">
                    <h3 style="text-align: center; margin-bottom: 0px; color: #5F7A61">
                        <b>Write a Review</b>
                    </h3>
                </div>
                <div
                    class="elementor-field-type-html elementor-field-group elementor-column elementor-field-group-field_2c1b095 elementor-col-100">
                    <label style="text-align: center; width: 100%;">
                        <b>Rating</b>
                    </label>
                    <div class="rating">
                        <input type="radio" id="star5" name="rating" value="5" checked>
                        <label for="star5"></label>
                        <input type="radio" id="star4" name="rating" value="4">
                        <label for="star4"></label>
                        <input type="radio" id="star3" name="rating" value="3">
                        <label for="star3"></label>
                        <input type="radio" id="star2" name="rating" value="2">
                        <label for="star2"></label>
                        <input type="radio" id="star1" name="rating" value="1">
                        <label for="star1"></label>
                    </div>
                </div>
                <div
                    class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-field_009055d elementor-col-100 elementor-field-required">
                    <label for="form-field-field_009055d" class="elementor-field-label elementor-screen-only">
                        Name</label>
                    <input size="1" type="text" name="reviewer" id="form-field-field_009055d"
                        class="elementor-field elementor-size-sm  elementor-field-textual" placeholder="Name"
                        required="required" aria-required="true" value="{{Auth::user()->first_name}} {{Auth::user()->last_name}}">
                </div>
                <div
                    class="elementor-field-type-checkbox elementor-field-group elementor-column elementor-field-group-field_ff7cdbc elementor-col-100">
                    <label for="form-field-field_ff7cdbc" class="elementor-field-label elementor-screen-only">Write as
                        Anonymous</label>
                    <div class="elementor-field-subgroup  ">
                        <span class="elementor-field-option">
                            <input type="checkbox" value="Write as Anonymous" id="anonymousCheckbox"
                                name="form_fields[field_ff7cdbc]">
                            <label for="anonymousCheckbox">Write as Anonymous</label>
                        </span>
                    </div>
                </div>


                <div
                    class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-name elementor-col-100 elementor-field-required">
                    <label for="form-field-name" class="elementor-field-label elementor-screen-only"> Review
                        Title</label>
                    <input size="1" type="text" name="title" id="form-field-name"
                        class="elementor-field elementor-size-sm  elementor-field-textual" placeholder="Review Title"
                        required="required" aria-required="true">
                </div>
                <div
                    class="elementor-field-type-textarea elementor-field-group elementor-column elementor-field-group-email elementor-col-100 elementor-field-required">
                    <label for="form-field-email" class="elementor-field-label elementor-screen-only"> Review</label>
                    <textarea class="elementor-field-textual elementor-field  elementor-size-sm" name="review"
                        id="form-field-email" rows="5" placeholder="Write your comments here" required="required"
                        aria-required="true"></textarea>
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
                <div class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100 e-form__buttons"
                    style="justify-content: center;">
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
    <a href="#" class="close_image_review_popup">X</a>
</div>