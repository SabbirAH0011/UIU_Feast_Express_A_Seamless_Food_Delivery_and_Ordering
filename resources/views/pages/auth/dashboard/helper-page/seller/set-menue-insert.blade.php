<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Insert Menu Item</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('store.set_menu') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                   <div class="mb-3">
                     <label class="form-label">Item Name <span class="text-danger">*</span></label>
                     <input type="text" class="form-control" id="name" name="name" required>
                     @error('name')
                       <span class="text-danger text-center">{{ $message }}</span>
                    @enderror
                   </div>
                   <div class="mb-3">
                     <label class="form-label">Product image <span class="text-danger">*</span></label>
                     <input type="file" class="form-control" id="img" name="img" required>
                     @error('file')
                       <span class="text-danger text-center">{{ $message }}</span>
                    @enderror
                   </div>
                   <div class="mb-3">
                       <label class="form-label">Price <span class="text-danger">*</span></label>
                        <div class="input-group">
                         <div class="input-group-text">&#2547;</div>
                         <input type="number" class="form-control" id="start_price" name="start_price" required>
                          @error('start_price')
                           <span class="text-danger text-center">{{ $message }}</span>
                          @enderror
                       </div>

                    </div>
                    <div class="mb-3 form-check">
                     <input type="checkbox" class="form-check-input" id="is_discount" name="is_discount">
                     <label class="form-check-label">Is it discounted product?</label>
                   </div>
                   <div class="previous_price" style="display:none">
                     <div class="mb-3">
                       <label class="form-label">Previous Price</label>
                       <div class="input-group">
                         <div class="input-group-text">&#2547;</div>
                         <input type="number" class="form-control" id="prev_price" name="prev_price">
                          @error('prev_price')
                           <span class="text-danger text-center">{{ $message }}</span>
                          @enderror
                       </div>
                     </div>
                   </div>
                    <div class="mb-3">
                        <label class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10" required></textarea>
                    </div>
                   <div class="mb-3">
                   <label class="form-label">Product search tag</label>
                       <input type="text" class="form-control" id="search_tag[]" name="search_tag[]" required>
                        @error('name')
                          <span class="text-danger text-center">{{ $message }}</span>
                       @enderror
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
    $(document).ready(function(){
        $(document).on('change','#is_discount',function(){
          if($(this).is(':checked')=== true ){
            $('.previous_price').css('display','block');
          }else{
            $('.previous_price').css('display','none');
          }
        });
    });

    //add more
    $(document).ready(function () {
            var url = "/add-remove-input-fields";
            var i = 1;
            $('#add').click(function () {
                i++;
                $('#dynamic_field').append('<tr id="row' + i + '"  class="dynamic-added"><td><input type="text" class="form-control" id="search_tag[]" name="search_tag[]"></td><td><button class="btn btn-danger btn_remove" type="button" name="remove"  id="' + i + '">X</button></td></tr>');
            });
            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
        });
</script>
