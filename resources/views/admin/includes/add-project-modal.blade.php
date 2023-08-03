<div class="modal fade" id="addNewProjectModal" tabindex="-1" role="dialog"
    aria-labelledby="addNewProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewProjectModalLabel">Create a Project</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {{-- .modal-body START --}}
            <div class="modal-body">
                {{-- form START --}}
                <form method="POST" action="{{ route('create-project') }}" id="createProjectForm">
                @csrf
                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input class="form-control" id="title" type="text"
                            placeholder="Enter project title" name="title">
                    </div>

                    {{-- CKEDITOR --}}
                    <div class="mb-3">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="editor" type="text" placeholder="Enter project description" name="description"> </textarea>
                    </div>                                      
                    
                    <div class="mb-3">
                        <label>Select Campuses and Status</label>
                        <div class="row">
                            @foreach ($campuses as $campus)
                                <div class="col-6">
                                    <input type="checkbox" name="campuses[]" value="{{ $campus->id }}">
                                    {{ $campus->location }}
                                </div>
                                <div class="col-6 d-flex justify-content-center align-items-center">
                                    <label class="mr-1" for="status_{{ $campus->id }}">Status:</label>
                                    <select name="status_{{ $campus->id }}" id="status_{{ $campus->id }}" required>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}">{{ $status->status_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Create project">
                    </div>
                </form> {{-- form END --}}
            </div> {{-- .modal-body END --}}
        </div>
    </div>
</div>
