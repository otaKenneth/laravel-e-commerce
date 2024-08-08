<style>
    .refund_image_popup_container {
        position: fixed;
        z-index: 9;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        background: #000000a8;
        height: 100vh;
        display: none;
    }

    .refund_image_popup_container.active {
        display: flex !important;
    }

    .refund_image_popup_container img {
        display: block;
        width: 100%;
        max-width: 700px;
        border-radius: 10px;
    }

    .close_refund_popup {
        background: white;
        color: black;
        padding: 5px;
        top: 10px;
        position: absolute;
        left: auto;
        right: 20px;
        border-radius: 100px;
        height: 30px;
        width: 30px;
        text-align: center;
        display: flex;
        align-content: center;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        transition: all 0.3s ease;
        box-shadow: 0 0 0px white;
    }

    .refund_image_popup_container>div {
        background: white;
        padding: 30px;
        width: 470px !important;
        border-radius: 20px;
        margin: auto;
        max-width: 90vw !important;
        max-height: 590px;
    }

    .refund_image_popup_container .refund_images {
        display: flex;
        overflow: auto;
        gap: 10px;
    }
</style>

<div class="refund_image_popup_container">

    <a href="#" class="close_refund_popup">X</a>
    <div>
        @isset($refund)
        <div>
            <p style="text-align: center; margin: 30px 10px;"><b>CUSTOMER:</b> &nbsp;{{$refund->reason}}</p>
            <p style="text-align: center; margin: 30px 10px;"><b>Amount:</b> &nbsp;{{$refund->amount}}</p>
            <div class="refund_images">
                @foreach ($refund->refund_images as $image)
                    <img src="{{ $getImage('front/images/product/', $image->image) }}">
                @endforeach
            </div>

        </div>
        @endisset
    </div>
</div>