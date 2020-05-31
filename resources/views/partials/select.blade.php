{{-- <div class="quantity buttons_added">
    <input type="button" value="-" class="minus btn-number" data-type="minus">
    <input type="text" step="1" min="1" max="20" name="quantity" value="{{$current_val??'1'}}" title="Qty"
class="input-text qty text" size="4" pattern="" inputmode="">
<input type="button" value="+" class="plus btn-number" data-type="plus">
</div> --}}
<div class="input-group" style="width:100%;">
    <div class="input-group-prepend">
        <button class="input-group-text btn-number bg-white" data-type="minus"><i class="fa fa-minus"></i></button>
    </div>
    <input type="text" class="form-control text-center p-0 input-text" min="1" max="20" value="0">
    <div class="input-group-append">
        <button class="input-group-text d-block btn-number bg-white" data-type="plus"><i
                class="fa fa-plus"></i></button>
    </div>
</div>
