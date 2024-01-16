
<div class="modal fade" id="editTable{{ $table->id }}" tabindex="-1" role="dialog" aria-labelledby="editTableLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTableLabel">Edit Table</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              
                    <form class="row gutters" method="POST" action="{{ route('table.update',$table->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="col-sm-12 col-12">
    
                            <div class="form-group">
                                <label for="exampleInputCity1">Table Name</label>
                                <input type="text" class="form-control" id="table_name" name="table_name" value="{{ $table->table_name }}"
                                    placeholder="Table Name">
                            </div>
                        </div>
                        <div class="col-sm-12 col-12">
                            <div class="form-group">
                                <label for="exampleInputCity1">Capacity</label>
                                <input type="intiger" class="form-control" id="capacity" name="capacity" value="{{ $table->capacity }}"
                                    placeholder="Location">
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