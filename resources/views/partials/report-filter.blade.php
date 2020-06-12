<div class="card card-secondary pb-0">
    <div class="card-header" >
        <div class="d-flex justify-content-between">

            <div class="card-title"><i class="fa fa-filter"></i> <strong>Filter</strong> </div>
            <div class="text-sm mt-2" data-toggle="collapse" data-target="#filter-details"><span><i class="fa fa-minus" id="filter-collapse"></i></span></div>
        </div>
    </div>

    <form role="form" id="filter-details" class="collapse show">
        <div class="card-body pb-0">
            <div style="" class="row justify-content-center">
                <div class="form-group col-md-3" id="from-wrap">
                    <label for="from">Start date</label>
                    <div class="input-group" >
                        <input
                            data-provide="datepicker"
                            data-date-container="#from-wrap"
                            data-date-autoclose="true"
                            data-date-today-btn="linked"
                            data-date-format="yyyy-mm-dd"
                            type="text" class="form-control"
                            placeholder="Start date" id="from">
                        <div class="input-group-append">
                            <label for="from"  class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3" id="to-wrap">
                    <label for="to">End date</label>
                    <div class="input-group" >
                        <input id="to"
                            data-provide="datepicker"
                            data-date-container="#to-wrap"
                            data-date-autoclose="true"
                            data-date-format="yyyy-mm-dd"
                            data-date-today-highlight="true"
                            data-date-end-date="0d" type="text"
                            class="form-control" placeholder="End Date">
                        <div class="input-group-append">
                            <label for="to"  class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="user">Employee</label>
                    <select name="user" id="user" class="form-control">
                        <option value="jdf">ldf</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="product">Inventory</label>
                    <select name="product" id="product" class="form-control">
                        <option value="jdf">ldf</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-2">
                    <button type="reset" class="btn btn-danger btn-flat btn-sm mr-1">Clear <i class="text-sm fa fa-times"></i></button>
                    <button type="submit" class="btn btn-success btn-flat btn-sm ml-1">Apply <i class="fa fa-check"></i></button>
            </div>
        </div>
    </form>


  </div>
