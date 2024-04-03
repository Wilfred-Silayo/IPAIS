<div class="container bg-white shadow-sm py-2 mt-1">
    <div class="row justify-content-between">
        <div class="col">
            <h4 class="text-success">{{user_type}}</h3>
        </div>
        <div class="col">
            <form class="d-flex" action="{{ route('$route') }}" method="GET">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
    @if ($users->isEmpty())
    <div class="alert alert-info">
        No records found.<a class="ms-2" href="{{route('dashboard')}}">Go To Dashboard</a>
    </div>
    @else
    <table id="example1" class="table table-striped table-hover">
            <thead>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->first_name}}</td>
                    <td>{{$user->last_name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <button class='btn btn-danger btn-sm  delete btn-flat' data-bs-toggle="modal"
                            data-bs-target="#delete" data-email="{{$user->email}}"
                            data-firstname="{{$user->first_name}}" data-last_name="{{$user->last_name}}">
                            <i class='fa fa-trash'></i> Delete
                        </button>
                    </td>
                </tr>
                @endforeach 
                
            </tbody>
        </table>
        @endif
        {{ $users->links('paginationlinks') }}
    </div>

    <!--delete student Modal -->
    <div class="modal fade" id="delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Are you sure you want to delete?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete <strong><span id="delete-user-name"></span></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm btn-flat"
                        data-bs-dismiss="modal">Cancel</button>
                    <form id="delete-user-form" method="POST"
                        action="{{ route('destroy.user', ['email' => '__email__']) }}">
                        @csrf
                        @method('DELETE')
                        <button class='btn btn-danger btn-sm delete btn-flat' type="submit"
                            data-bs-dismiss="modal">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    const deleteButtons = document.querySelectorAll('.delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const email = button.getAttribute('data-email');
            const firstname = button.getAttribute('data-first_name');
            const lastname = button.getAttribute('data-last_name');
            const deleteUserForm = document.querySelector('#delete-user-form');
            const deleteUserName = document.querySelector('#delete-user-name');
            const deleteUserAction = deleteUserForm.getAttribute('action').replace(
                '__email__', email);
            deleteUserForm.setAttribute('action', deleteUserAction);
            deleteUserName.textContent = `${firstname} ${lastname}`;

        });
    });
    </script>

</div>