<!-- Modal -->
<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProjectModalLabel">Edit Project</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editProjectForm" action="{{ route('edit-project') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" id="editProjectId">
            <div class="mb-3">
                <label for="editProjectTitle" class="form-label">Title</label>
                <input type="text" class="form-control" id="editProjectTitle" placeholder="Enter project title" name="project_title">
            </div>
            {{-- CKEDITOR --}}
            <div class="mb-3">
                <label for="editProjectDescription">Description</label>
                <textarea class="form-control" id="editProjectDescription" type="text" placeholder="Enter project description" name="project_description"></textarea>
            </div>  
            <div class="input-group mb-3">
                      <label for="campus">Campus</label>
                      <select class="form-control" 
                          name="campus"
                          style="width: 100%"
                          data-placeholder="Select roles">
                          @foreach ($campuses as $campus)
                              <option value="{{ $campus->id }}">{{ $campus->location }}</option>
                          @endforeach
                      </select>
            </div>
            <div class="input-group mb-3">
                <label class="mr-1" for="status_{{ $campus->id }}">Status</label>
                <select class="form-control" name="status_{{ $campus->id }}" id="status_{{ $campus->id }}" style="width: 100%" required>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->status_name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="document.getElementById('editProjectForm').submit()">Save changes</button>
      </div>
    </div>
  </div>
</div>