<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Make Invoice On list</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('invoice.visitor_gocery_list') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                   <div class="mb-3" id="serial_holder" hidden>
                     <label class="form-label">Serial <span class="text-danger">*</span></label>
                     <input type="text" class="form-control" id="serial" name="serial"  value="{{ $serial }}">
                   </div>
                   <div class="mb-3">
                     <div class="row">
                        <div class="col-2">
                            <label class="form-label">Product name</label>
                            <input type="text" class="form-control" id="product_name[]" name="product_name[]" required>
                        </div>
                        <div class="col-2">
                            <label class="form-label">Weight/unit</label>
                            <input type="number" class="form-control" id="weight[]" name="weight[]" step="0.01" required>
                        </div>
                        <div class="col-2">
                            <label class="form-label">Weight unit</label>
                            <input type="text" class="form-control" id="weight_unit[]" name="weight_unit[]" required>
                        </div>
                        <div class="col-2">
                            <label class="form-label">Product quantity</label>
                            <input type="number" class="form-control" id="product_quantity[]" name="product_quantity[]" required>
                        </div>
                        <div class="col-2">
                            <label class="form-label">Single price</label>
                            <input type="number" class="form-control" id="single_price[]" name="single_price[]" required>
                        </div>
                        <div class="col-2">
                            <label class="form-label">Total price</label>
                            <input type="number" class="form-control" id="total_price[]" name="total_price[]" required>
                        </div>
                     </div>
                    </div>
                    <div class="mb-3">
                     <table class="table  table-hover" id="dynamic_field">
                       <tbody>

                       </tbody>
                     </table>
                      <div class="d-grid gap-2 d-md-block text-center">
                       <button type="button" name="add" id="add" class="btn btn-success btn-sm " style="border-radius: 25px">+ Add
                          another Product search tag</button>
                      </div>
                    </div>
                   <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    //add more
    $(document).ready(function () {
        var i = 1;
        $('#add').click(function () {
            i++;
            $('#dynamic_field').append(`
                <tr id="tab${i}" class="dynamic-added">
                    <td>
                        <div class="row">
                            <div class="col-2">
                                <label class="form-label">Product name</label>
                                <input type="text" class="form-control" id="product_name[]" name="product_name[]" required>
                            </div>
                            <div class="col-2">
                               <label class="form-label">Weight/unit</label>
                               <input type="number" class="form-control" id="weight[]" name="weight[]" step="0.01" required>
                            </div>
                            <div class="col-2">
                                <label class="form-label">Weight unit</label>
                                <input type="text" class="form-control" id="weight_unit[]" name="weight_unit[]" required>
                            </div>
                            <div class="col-2">
                                <label class="form-label">Product quantity</label>
                                <input type="number" class="form-control" id="product_quantity[]" name="product_quantity[]" required>
                            </div>
                            <div class="col-2">
                                <label class="form-label">Single price</label>
                                <input type="number" class="form-control" id="single_price[]" name="single_price[]" required>
                            </div>
                            <div class="col-2">
                                <label class="form-label">Total price</label>
                                <input type="number" class="form-control" id="total_price[]" name="total_price[]" required>
                            </div>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-danger btn_remove" style="backgroud-color:#bccf60; color:#0a7151" type="button" name="remove" id="${i}">X</button>
                    </td>
                </tr>
            `);
        });

        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $('#tab' + button_id).remove();
        });
    });
</script>

