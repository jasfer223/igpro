{{-- Add project form --}}
<div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog"
aria-labelledby="deleteProjectModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="deleteProjectModalLabel">Create a Project</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>`
        </div>

        {{-- Project form modal BODY --}}
        <div class="modal-body">
            <form method="POST" action="{{ route('create-project') }}" id="createProjectForm">
            @csrf


              <div class="modal-footer">
                  <button type="button" 
                      class="btn btn-secondary"
                      data-dismiss="modal">
                      Close
                  </button>
                  <input type="submit" class="btn btn-primary" value="Create project">
              </div>
            </form> {{-- FORM END --}}
        </div> {{-- Modal body END --}}
    </div>
</div>
</div>