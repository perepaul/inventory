<!-- Modal -->
<div class="modal fade" id="create-purchase" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{route('purchase.store')}}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Record a purchase</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="product_id">Select Inventory</label>
                        <input type="text" id="product" class="form-control" placeholder="Search inventories by Name, Sku, or scan barcode">
                        <input type="hidden" name="product_id" id="product_id">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control" name="quantity" id="quantity">
                    </div>
                    <div class="form-group">
                        <label for="price">Purchase price <small>* per quantity</small></label>
                        <input type="text" class="form-control" name="price" id="price">
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="view-purchase" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle2">Inventory purchase</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="view-pur">Inventory Purchased</label>
                        <input type="text" id="pur-product" class="form-control" placeholder="" disabled readonly>
                    </div>
                    <div class="form-group">
                        <label for="price">Purchased by</label>
                        <input type="text" class="form-control" name="user" id="pur-user" disabled readonly>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control" name="quantity" id="pur-quantity" disabled readonly>
                    </div>
                    <div class="form-group">
                        <label for="price">Purchase price <small>* per quantity</small></label>
                        <input type="text" class="form-control" name="price" id="pur-price" disabled readonly>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea class="form-control" id="pur-comment" name="comment" rows="2" disabled readonly></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

        </div>
    </div>
</div>
