 <div class="form-group row">
     <label class="col-sm-2 col-form-label">Select Category lavel</label>
     <div class="col-sm-10">
         <select class=" form-control single-select1" name="parent_id" id="parent_id">
             <option value="0" @if (isset($categorydata['parent_id']) &&
                 $categorydata['parent_id']==0)
                 selected=''
                 @endif>Main Category</option>
             @if (!empty($getCategories))
                 @foreach ($getCategories as $category)
                     <option value="{{ $category['id'] }}" @if (isset($categorydata['parent_id']) &&
                         $categorydata['parent_id']==$category['id']) selected=""
                 @endif >{{ $category['category_name'] }}</option>

                 @if (!empty($category['sub_categories']))
                     @foreach ($category['sub_categories'] as $subcategory)
                         <option disabled value="{{ $subcategory['id'] }}">
                             &nbsp;&raquo;&nbsp;{{ $subcategory['category_name'] }}</option>
                     @endforeach
                 @endif
             @endforeach
             @endif

         </select>
     </div>
 </div>
