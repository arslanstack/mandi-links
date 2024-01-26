<div>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Edit Category</h5>
    </div>
    <div class="modal-body">
        <form id="edit_cat_form" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" class="form-control" value="{{ $category['id'] }}">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Title</strong></label>
                <div class="col-sm-8">
                    <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $category['title'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Parent Category</strong></label>
                <div class="col-sm-8">
                    <select class="form-control" name="parent">
                        <option {{ $category['parent_id'] == null ? 'selected' : '' }} value="">None</option>
                        @foreach($parent_categories as $key => $value)
                        <option value="{{ $value->id }}" {{ $category['parent_id'] == $value->id ? 'selected' : '' }}>{{ $value->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Image</strong></label>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-10 mr-0 pr-0">
                            <input type="file" name="image" id="cat_img_input" class="form-control" accept="image/*">
                        </div>
                        <div class="col-sm-2 ml-0 pl-0">
                            <img id="previewImage" src="{{asset('uploads/categories/' . $category['image'] )}}" style="width: 50px; height: 40px; object-fit:contain;" alt="">
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update_cat_button">Save Changes</button>
    </div>