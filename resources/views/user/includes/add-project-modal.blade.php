{{-- Add project form --}}
<div class="modal fade" id="projectModal" tabindex="-1" role="dialog"
aria-labelledby="projectModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="projectModalLabel">Create a Project</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        {{-- Project form modal BODY --}}
        <div class="modal-body">
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
                    <textarea class="form-control" id="user-description" type="text" placeholder="Enter project description" name="description"> </textarea>
                </div> 

                <div class="mb-3">
                    <label>Select Campus and Status</label>
                    <div class="row">
                        @foreach ($campuses as $campus)
                            @if (Auth::user()->campus->location === $campus->location)
                                <div class="col-6">
                                    <input type="checkbox" name="campuses[]" value="{{ $campus->id }}">
                                    {{ $campus->location }}
                                </div>
                                <div class="col-6 d-flex justify-content-center align-items-center">
                                    <label class="mr-1" for="status_{{ $campus->id }}">Status:</label>
                                    <select class="project-status" 
                                        name="status_{{ $campus->id }}" 
                                        id="status_{{ $campus->id }}" 
                                        required>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}">{{ $status->status_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>


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