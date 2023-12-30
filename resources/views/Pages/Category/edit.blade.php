<div class="modal fade" id="editCategory{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategoryLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form class="row gutters" method="POST" action="{{ route('category.update',$category->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="col-sm-12 col-12">
    
                            <div class="form-group">
                                <label for="exampleInputCity1">Category Name</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $category->category_name }}"
                                    placeholder="">
                            </div>
                        </div>
                       
                        <div class="modal-footer custom">
                           
                           
                            <div class="center">
                                <button type="submit" class="btn btn-link success btn-block">Save</button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
</div>
</div>