<!-- Modal -->
<div class="modal fade" id="addNewRoleModal" tabindex="-1" role="dialog"
    aria-labelledby="addNewRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewRoleModalLabel">Create a user account</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('create-role') }}">
                @csrf
                    <div class="mb-3">
                        <label for="role_name">Role Name</label>
                        <input class="form-control" id="role_name" type="text"
                            placeholder="Enter role name" name="role_name">
                    </div>

                    <div class="modal-footer">                                                
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Create role">
                        
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
