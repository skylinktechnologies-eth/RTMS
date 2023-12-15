<div class="modal fade " id="editTables{{ $table->id }}" tabindex="-1" aria-labelledby="edittablesLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content px-3 rounded-4" style="background-color: #ffffff">
            <div class="modal-header p-3" style="background-color: #b66dff">
                <h4 class="modal-title " id="addtablesLabel" style="color: #ffffff">Create Table</h4>
                <a type="button" data-bs-dismiss="modal" aria-label="Close"><i class=" mdi mdi-close  "
                        style="color: #ffffff"></i></a>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('table.update',$table->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row mt-3">

                        <div class="form-group">
                            <label for="exampleInputCity1">Table Name</label>
                            <input type="text" class="form-control" id="table_name" name="table_name" value="{{ $table->table_name }}"
                                placeholder="Table Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCity1">Capacity</label>
                            <input type="intiger" class="form-control" id="capacity" name="capacity" value="{{ $table->capacity }}"
                                placeholder="Location">
                        </div>

                    </div>




                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>