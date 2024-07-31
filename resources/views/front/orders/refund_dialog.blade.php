<div class="refund_popup_outer">
    <div class="refund_popup_inner">
        <h3 style="text-align: center; margin-bottom: 40px; color: #5F7A61"><b>Reason for Refund</b></h3>
        <form id="form-productRefund" action="javascript:;" name="refund-form">
            @csrf
            <input type="hidden" id="order_id" name="order_id" value="">
            <input type="hidden" id="order_item_id" name="order_item_id" value="">
            <input type="hidden" id="product_id" name="product_id" value="">
            <div
                class="elementor-field-type-textarea elementor-field-group elementor-column elementor-field-group-email elementor-col-100 elementor-field-required">
                <label for="form-field-email" class="elementor-field-label elementor-screen-only">Reason</label>
                <textarea class="elementor-field-textual elementor-field  elementor-size-sm" name="reason"
                    id="form-field-email" rows="5" placeholder="Write your reason here" required="required"
                    aria-required="true"></textarea>
            </div>
            <div class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100 e-form__buttons"
                style="justify-content: center;">
                <input type="file" id="return-product-upload" accept="image/*" style="margin: 15px auto 20px; max-width: 240px;"/>
                <button type="submit" class="elementor-button elementor-size-sm refund__popup__btn">
                    <span>
                        <span class="elementor-button-icon"></span>
                        <span class="elementor-button-text">SUBMIT REFUND</span>
                    </span>
                </button>
            </div>
        </form>
    </div>
    <a href="#" class="close_image_refund_popup">X</a>
</div>