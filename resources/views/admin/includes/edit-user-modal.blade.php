<!-- Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                <form id="editUserForm" action="{{ route('edit-user') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" id="editUserId">
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
                    <div class="mb-3">
                        <label for="editUserUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="editUserUsername" name="user_username">
                    </div>
                    <div class="mb-3">
                    	<label for="editUserEmail" class="form-label">Email</label>
                        <input type="text" class="form-control" id="editUserEmail" name="user_email">
                    </div>
                    <div class="mb-3">
                    	<label for="editUserPassword" class="form-label">New Password</label>
                        <input type="text" class="form-control" id="editUserPassword" name="user_password">
                    </div>
                    <div class="mb-3">
                    	<label for="editUserCampusId" class="form-label">Campus ID</label>
                        <input type="text" class="form-control" id="editUserCampusId" name="user_campus_id">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('editUserForm').submit()">Save changes</button>
            </div>
    </div>
  </div>
</div>
