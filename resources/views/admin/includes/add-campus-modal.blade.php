<!-- Modal -->
<div class="modal fade" id="addNewCampusModal" tabindex="-1" role="dialog"
    aria-labelledby="addNewCampusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewCampusModalLabel">Create a user account</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('create-campus') }}">
                @csrf
                    <div class="mb-3">
                        <label for="location">Location</label>
                        <input class="form-control" id="location" type="text"
                            placeholder="Enter campus location" name="location">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Create campus">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
                        