<div class="input-group" style="width:140px !important">
    <div class="input-group-prepend">
        <button class="input-group-text btn-number bg-white" data-type="minus"><i class="fa fa-minus"></i></button>
    </div>
    <input type="text" class="form-control text-center p-0 input-text" onchange="update({{$product->id}},this)" min="1"
        max="{{$product->quantity??20}}" value="{{$value}}">
    <div class="input-group-append">
        <button class="input-group-text d-block btn-number bg-white" data-type="plus"><i
                class="fa fa-plus"></i></button>
    </div>
</div>
