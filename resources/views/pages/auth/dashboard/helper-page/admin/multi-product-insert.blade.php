<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Insert Multi ranage Product</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('insert.product_multi') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                   <div class="mb-3">
                     <label class="form-label">Name <span class="text-danger">*</span></label>
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
                   <div class="mb-3 form-check">
                     <input type="checkbox" class="form-check-input" id="is_feature" name="is_feature">
                     <label class="form-check-label">Is it featured product (will appear in speacial offer)?</label>
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
                   <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label">Select weight type <span class="text-danger">*</span></label>
                        <select class="form-select" aria-label="Default select example" id="weight_type" name="weight_type" required>
                            <option value="Pcs">Pcs</option>
                            <option value="Gram">Gram</option>
                            <option value="Kg">Kg</option>
                            <option value="Litre">Litre</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label">Per weight <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="per_weight" name="per_weight" required>
                        @error('file')
                        <span class="text-danger text-center">{{ $message }}</span>
                        @enderror
                    </div>
                   </div>
                   </div>

                    <div class="mb-3 row">
                        <label for="range_1" class="col-sm-2 col-form-label">Range 1</label>
                        <div class="col-sm-10">
                           <div class="row pb-3">
                            <div class="col">
                                <input type="number" class="form-control" id="range_1_price" name="range_1_price" placeholder="Enter price" required>
                            </div>
                           </div>
                           <div class="row">
                            <div class="col">
                                <input type="number" class="form-control" id="range_1_qty" name="range_1_qty" placeholder="Enter quantity" required>
                            </div>
                           </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="range_1" class="col-sm-2 col-form-label">Range 2</label>
                        <div class="col-sm-10">
                            <div class="row pb-3">
                                <div class="col">
                                    <input type="number" class="form-control" id="range_2_price" name="range_2_price" placeholder="Enter price" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="number" class="form-control" id="range_2_qty" name="range_2_qty" placeholder="Enter quantity" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="range_1" class="col-sm-2 col-form-label">Range 3</label>
                        <div class="col-sm-10">
                            <div class="row pb-3">
                                <div class="col">
                                    <input type="number" class="form-control" id="range_3_price" name="range_3_price"
                                        placeholder="Enter price" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="number" class="form-control" id="range_3_qty" name="range_3_qty"
                                        placeholder="Enter quantity" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select a category <span class="text-danger">*</span></label>
                        <select class="form-select" aria-label="Default select example" id="category" name="category" required>
                            <option value="খাদ্য তৈরি উপকরণ ও শুকনো বাজার">খাদ্য তৈরি উপকরণ ও শুকনো বাজার</option>
                            <option value="মসলা, স্পাইস ও তেল">মসলা, স্পাইস ও তেল</option>
                            <option value="চাল, ডাল ও দুগ্ধজাত প্রোডাক্ট">চাল, ডাল ও দুগ্ধজাত প্রোডাক্ট</option>
                            <option value="বেভারেজ ও জুস">বেভারেজ ও জুস</option>
                            <option value="বিস্কুট এবং চকলেট">বিস্কুট এবং চকলেট</option>
                            <option value="নিত্যপ্রয়োজনীয়">নিত্যপ্রয়োজনীয়</option>
                        </select>
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
