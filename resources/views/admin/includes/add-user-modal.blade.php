{{-- ADD A USER FORM --}}

    
<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create a user account</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
			<form method="POST" action="{{ route('create-user') }}" id="createUserForm">
			@csrf

                <div class="input-group mb-3">
                    <label for="username">Role</label>
                    <select class="users-role-select-multiple" 
                        name="role[]"
                        multiple="multiple" 
                        style="width: 100%"
                        data-placeholder="Select roles">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group mb-3">
                    <label for="username">Campus</label>

                    <select class="custom-select" name="campus" style="width: 100%">
                        @foreach ($campuses as $campus)
                            <option value="{{ $campus->id }}">{{ $campus->location }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="username">Username</label>
                    <input class="form-control" id="username" type="text"
                        placeholder="Enter username" name="username">
                </div>

                <div class="mb-3">
                    <label for="email">Email address</label>
                    <input class="form-control" id="email" type="email"
                        placeholder="Enter email Ex. [name@nemsu.edu.ph]" name="email">
                </div>

                <div class="mb-3">
                    <label for="password">Password</label>
                    <input class="form-control" id="password" type="password"
                        placeholder="Enter password" name="password">
                    <span class="text-xs text-danger">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation">Repeat Password</label>
                    <input class="form-control" id="password_confirmation" type="password"
                        placeholder="Enter password again" name="password_confirmation">
                    <span class="text-danger" id="password-error"></span>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Create account">
                </div>
			</form>

            </div>
        </div>
    </div>
</div>
