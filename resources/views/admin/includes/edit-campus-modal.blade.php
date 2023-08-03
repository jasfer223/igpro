<!-- Edit Campus Modal -->
<div class="modal fade" id="editCampusModal" tabindex="-1" aria-labelledby="editCampusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCampusModalLabel">Edit Campus Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCampusForm" action="{{ route('edit-campus') }}" method="POST">
                    @csrf
                    <input type="hidden" name="campus_id" id="editCampusId">
                    <div class="mb-3">
                        <label for="editCampusLocation" class="form-label">Location</label>
                        <input type="text" class="form-control" id="editCampusLocation" name="campus_location">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('editCampusForm').submit()">Save changes</button>
            </div>
        </div>
    </div>
</div>
