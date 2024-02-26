<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Users</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }} ">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.users') }} ">Users</a></li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            {{-- @if(session()->has('message'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="fa fa-check-circle mr-1"></i>{{ session('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif --}}
            <div class="d-flex justify-content-end mb-1"><button class="btn btn-primary" wire:click.prevent="addNewUser" data-toggle="modal" data-target="#userModal"><i class="fa fa-plus-circle mr-1"></i>Add New User</button></div>
            <div class="card">
              <div class="card-body">
                
                <table class="table">
                    <thead>
                     
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="" wire:click.prevent="edit({{ $user }})">
                                <i class="fa fa-edit mr-2"></i>
                            </a>
                            <a href="" wire:click.prevent="userDeleteConfirmation({{ $user->id }})">
                                <i class="fa fa-trash text-danger"></i>
                            </a>
                        </td>
                        </tr>
                        @endforeach
                      
                    </tbody>
                </table>
              </div>
            </div>

           <div class="d-flex justify-content-end">{{ $users->links() }}</div>
          </div>
          <!-- /.col-md-6 -->
          
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


    

<!-- Modal -->
<div class="modal fade" id="newuserModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog" role="document">
  <form autocomplete="off" wire:submit.prevent="{{ $editUserModal ? 'updateUser' : 'createUser' }}">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userModalLabel">
          @if($editUserModal)
          <span>Edit User</span>
          @else  
          <span>Add New User</span>
          @endif
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="name"  wire:model.defer="state.name" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp" placeholder="Enter name">
          @error('name')
            <div class="invalid-feedback">
              {{$message}}
            </div>
          @enderror
        </div>        
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" class="form-control @error('email') is-invalid @enderror" wire:model.defer="state.email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
          @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model.defer="state.password" id="password" placeholder="Password">
          @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror

        </div>
        <div class="form-group">
          <label for="password_confirmation">Confirm Password</label>
          <input type="password" class="form-control" wire:model.defer="state.password_confirmation" id="password_confirmation" placeholder="Confirm Password">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">
          
        @if($editUserModal)
            <span>Save Changes</span>
        @else
            <span>Save</span>
        @endif
    </button>
      </div>
    </div>
  </form>
  </div>
</div>


<div class="modal fade" id="userdeleteConfirmation"  tabindex="-1" role="dialog"  aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog" role="document">

  <div class="modal-content">
      <div class="modal-header">
        <h5>Delete User</h5>
      </div>
      <div class="modal-body">
        <h4>Are you sure you want to delete this user?</h4>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      <button type="button" class="btn btn-danger mr-2 " wire:click.prevent="deleteUser"><i class="fa fa-trash mr-2">Delete User</i></button>
      </div>

  </div>
  </div>
</div>

</div>


