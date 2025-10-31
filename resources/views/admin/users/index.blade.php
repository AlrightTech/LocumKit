@extends('admin.layout.app')
@section('content')
    @inject('controller', 'App\Http\Controllers\admin\UserController')

    <div class="main-container container">
        @include('admin.layout.sidebar')
        <div class="col-lg-12 main-content">
            <div id="breadcrumbs" class="breadcrumbs">
                <div id="menu-toggler-container" class="hidden-lg">
                    <span id="menu-toggler">
                        <i class="glyphicon glyphicon-new-window"></i>
                        <span class="menu-toggler-text">Menu</span>
                    </span>
                </div>
                <ul class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-home home-icon"></i>
                        <a href="/admin/dashboard">Dashboard</a>
                    </li>
                    <li>
                        <a href="/admin/config">Config</a>
                    </li>
                    <li class="active">
                        User </li>
                </ul>
            </div>
            <div class="page-content">
                <div id="tabs">
                    <div class="qus-tabs">
                        <ul>

                            <li class="{{ $controller->role == 'Locum' ? 'active' : '' }}">
                                <a href="{{ route('admin.users.index', ['q' => 'Locum']) }}">Locum</a>
                            </li>
                            <li class="{{ $controller->role == 'Employer' ? 'active' : '' }}">
                                <a href="{{ route('admin.users.index', ['q' => 'Employer']) }}">Employer</a>
                            </li>
                            <li class="{{ $controller->role == 'Administrator' ? 'active' : '' }}">
                                <a href="{{ route('admin.users.index', ['q' => 'Administrator']) }}">Admin</a>
                            </li>

                        </ul>
                    </div>
                    <div id="fre-tab">
                        <div class="cat-tabs">
                            <form method="GET" action="{{ route('admin.users.index') }}">
                                <input type="hidden" name="q" value="{{ $controller->role }}">
                                <input type="hidden" name="c" value="{{ $controller->profession }}">
                            
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" name="username" class="form-control" placeholder="Search by Username" value="{{ request('username') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="email" name="email" class="form-control" placeholder="Search by Email" value="{{ request('email') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <select name="status" class="form-control">
                                            <option value="">Select Status</option>
                                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Disabled</option>
                                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Blocked</option>
                                            <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Guest User (Pending Approval)</option>
                                            <option value="4" {{ request('status') == '4' ? 'selected' : '' }}>Expired</option>
                                            <option value="5" {{ request('status') == '5' ? 'selected' : '' }}>Deleted</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="{{ route('admin.users.index', ['q' => $controller->role, 'c' => $controller->profession]) }}" class="btn btn-secondary" style="border-color:#000;">Reset</a>
                                    </div>
                                </div>
                            </form>

                            <!--<ul>-->
                            <!--    @foreach ($professions as $profession)-->
                            <!--        <li style="margin-top: 25px;" {{ $controller->profession == $profession->id ? ' class=active' : '' }}>-->
                            <!--            <a-->
                            <!--                href="{{ route('admin.users.index', ['q' => $controller->role, 'c' => $profession->id]) }}">{{ $profession->name }}</a>-->

                            <!--        </li>-->
                            <!--    @endforeach-->
                            <!--</ul>-->
                        </div>
                        <table class="table clickable table-striped table-hover"> 
                            <colgroup>
                                <col width="1%">
                                <col width="20%">
                                <col width="20%">
                                <col width="20%">
                                <col width="20%">
                                <col width="10%">
                                <col width="1%">
                                <col width="1%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th> <a href="#">Id</a> </th>
                                    <th><a href="javascript:void(0);" onclick="changeUserNameOrder(2);">User Name</a>
                                    </th>
                                    <th><a href="javascript:void(0);" onclick="changeUserFNameOrder(2);">Firstname</a>
                                    </th>
                                    <th><a href="javascript:void(0);" onclick="changeUserLNameOrder(2);">Lastname</a>
                                    </th>
                                    <th><a href="javascript:void(0);" onclick="changeUserEmailOrder(2);">Email</a>
                                    </th>
                                    <th> <a href="#">Is active</a> </th>
                                    @cando('user/edit')
                                    <th class="text-center"> <a href="#">Edit</a> </th>
                                    @endcando
                                    @cando('user/delete')
                                    <th class="text-center"> <a href="#">Delete</a> </th>
                                    @endcando
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users->isNotEmpty())
                                    @foreach ($users as $user)
                                        <tr>
    
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->login }}</td>
                                            <td>{{ $user->firstname }}</td>
                                            <td>{{ $user->lastname }}</td>
                                            <td>
                                                {{ $user->email }}
                                            </td>
                                            <td>
                                                @switch($user->active)
                                                    @case(0)
                                                        <span class="badge badge-secondary">Disabled</span>
                                                        @break
                                                    @case(1)
                                                        <span class="badge badge-success">Active</span>
                                                        @break
                                                    @case(2)
                                                        <span class="badge badge-danger">Blocked</span>
                                                        @break
                                                    @case(3)
                                                        @if($user->user_acl_role_id == 3 || $user->user_acl_role_id == 2)
                                                            <span class="badge badge-warning" 
                                                                  onclick="showApprovalModal({{ $user->id }}, '{{ $user->firstname }}', '{{ $user->lastname }}')"
                                                                  style="font-size: 12px; padding: 8px 12px; cursor: pointer; transition: all 0.3s ease; display: inline-block;"
                                                                  onmouseover="this.style.backgroundColor='#e0a800'; this.style.transform='scale(1.05)'"
                                                                  onmouseout="this.style.backgroundColor=''; this.style.transform='scale(1)'">
                                                                <i class="fa fa-clock-o"></i> Pending Approval <i class="fa fa-hand-pointer-o" style="margin-left: 5px;"></i>
                                                            </span>
                                                            
                                                            <!-- Hidden forms for approve/reject -->
                                                            <form id="approve-form-{{ $user->id }}" 
                                                                  action="{{ route('admin.users.quick-approve', $user->id) }}" 
                                                                  method="POST" 
                                                                  style="display: none;">
                                                                @csrf
                                                                @method('PATCH')
                                                            </form>
                                                            
                                                            <form id="reject-form-{{ $user->id }}" 
                                                                  action="{{ route('admin.users.quick-reject', $user->id) }}" 
                                                                  method="POST" 
                                                                  style="display: none;">
                                                                @csrf
                                                                @method('PATCH')
                                                            </form>
                                                        @else
                                                            <span class="badge badge-warning" style="font-size: 12px; padding: 6px 10px;">
                                                                <i class="fa fa-clock-o"></i> Pending Approval
                                                            </span>
                                                        @endif
                                                        @break
                                                    @case(4)
                                                        <span class="badge badge-info">Expired</span>
                                                        @break
                                                    @case(5)
                                                        <span class="badge badge-dark">Deleted</span>
                                                        @break
                                                    @default
                                                        <span class="badge badge-secondary">Unknown</span>
                                                @endswitch
                                            </td>
                                            @cando('user/edit')
                                            <td class="text-center">
                                                <a href="{{ route('admin.users.edit', $user->id) }}" class="edit-line">
                                                    <img src="/backend/images/icones/edit.png" alt="Edit" />
                                                </a>
                                            </td>
                                            @endcando
                                            @cando('user/delete')
                                            <td class="text-center">
                                                <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="button" class="btn" onclick="confirmDelete({{ $user->id }})">
                                                        <img src="/backend/images/icones/delete.png" alt="Delete">
                                                    </button>
                                                </form>
                                            </td>
                                            @endcando
                                            
                                            <!-- Modal HTML -->
                                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this user? This action cannot be undone.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                            <button type="button" class="btn btn-danger" id="confirm-delete">Yes, Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Approval/Rejection Modal HTML -->
                                            <div class="modal fade" id="approvalModal" tabindex="-1" role="dialog" aria-labelledby="approvalModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content" style="border-radius: 8px; box-shadow: 0 5px 20px rgba(0,0,0,0.3);">
                                                        <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                                                            <h5 class="modal-title" id="approvalModalLabel" style="font-weight: 600;">
                                                                <i class="fa fa-user-circle" style="margin-right: 8px;"></i>
                                                                <span id="approvalModalTitle">Confirm Action</span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 0.8;">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="padding: 30px 25px;">
                                                            <div style="text-align: center; margin-bottom: 20px;">
                                                                <div id="approvalIcon" style="font-size: 64px; margin-bottom: 15px;">
                                                                    <i class="fa fa-user-circle" style="color: #667eea;"></i>
                                                                </div>
                                                                <h6 style="font-size: 18px; color: #333; font-weight: 600; margin-bottom: 8px;">
                                                                    Review User Application
                                                                </h6>
                                                                <p style="color: #666; font-size: 15px; margin-top: 10px;">
                                                                    <strong>User:</strong> <span id="employerName" style="color: #333;"></span>
                                                                </p>
                                                                <p style="color: #888; font-size: 13px; margin-top: 15px;">
                                                                    Would you like to approve or reject this user?
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer" style="border-top: 1px solid #e9ecef; padding: 20px 25px; background-color: #f8f9fa; display: flex; justify-content: center; gap: 10px;">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="padding: 10px 25px; border-radius: 4px; font-weight: 500;">
                                                                <i class="fa fa-times"></i> Cancel
                                                            </button>
                                                            <button type="button" class="btn btn-danger" id="reject-button" style="padding: 10px 25px; border-radius: 4px; font-weight: 500;">
                                                                <i class="fa fa-times-circle"></i> Reject
                                                            </button>
                                                            <button type="button" class="btn btn-success" id="approve-button" style="padding: 10px 25px; border-radius: 4px; font-weight: 500;">
                                                                <i class="fa fa-check-circle"></i> Approve
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <script>
                                                let deleteFormId = null;
                                                let currentUserId = null;
                                            
                                                function confirmDelete(userId) {
                                                    deleteFormId = `delete-form-${userId}`;
                                                    $('#deleteModal').modal('show');
                                                }
                                            
                                                document.getElementById('confirm-delete').addEventListener('click', function () {
                                                    if (deleteFormId) {
                                                        document.getElementById(deleteFormId).submit();
                                                    }
                                                    $('#deleteModal').modal('hide');
                                                });

                                                function showApprovalModal(userId, firstName, lastName) {
                                                    currentUserId = userId;
                                                    const fullName = firstName + ' ' + lastName;
                                                    document.getElementById('employerName').textContent = fullName;
                                                    document.getElementById('approvalModalTitle').innerHTML = '<i class="fa fa-user-check" style="margin-right: 8px;"></i>Review User Application';
                                                    
                                                    $('#approvalModal').modal('show');
                                                }
                                            
                                                // Approve button click handler
                                                document.getElementById('approve-button').addEventListener('click', function () {
                                                    if (currentUserId) {
                                                        const approveForm = document.getElementById(`approve-form-${currentUserId}`);
                                                        if (approveForm) {
                                                            approveForm.submit();
                                                        }
                                                    }
                                                    $('#approvalModal').modal('hide');
                                                });

                                                // Reject button click handler
                                                document.getElementById('reject-button').addEventListener('click', function () {
                                                    if (currentUserId) {
                                                        const rejectForm = document.getElementById(`reject-form-${currentUserId}`);
                                                        if (rejectForm) {
                                                            rejectForm.submit();
                                                        }
                                                    }
                                                    $('#approvalModal').modal('hide');
                                                });
                                            </script>
    
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-center">No users found.</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                        <div class="pagination">
                            <link rel="stylesheet"
                                href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
                            <p class="clearfix">
                                {{ $users->appends(request()->query())->links() }}
                            </p>
                        </div>


                    </div>
                    <script type="text/javascript">
                        Gc.initTableList();

                        function changeUserNameOrder(order) {
                            $.ajax({
                                'url': '/admin/config/user',
                                'type': 'POST',
                                'data': {
                                    'setUserNameOrder': order
                                },
                                'success': function(result) { //alert('question'+result);
                                    //alert("Order change");
                                    location.reload();
                                }
                            });
                        }

                        function changeUserFNameOrder(order) {
                            $.ajax({
                                'url': '/admin/config/user',
                                'type': 'POST',
                                'data': {
                                    'setUserFNameOrder': order
                                },
                                'success': function(result) { //alert('question'+result);
                                    //alert("Order change");
                                    location.reload();
                                }
                            });
                        }

                        function changeUserLNameOrder(order) {
                            $.ajax({
                                'url': '/admin/config/user',
                                'type': 'POST',
                                'data': {
                                    'setUserLNameOrder': order
                                },
                                'success': function(result) { //alert('question'+result);
                                    //alert("Order change");
                                    location.reload();
                                }
                            });
                        }

                        function changeUserEmailOrder(order) {
                            $.ajax({
                                'url': '/admin/config/user',
                                'type': 'POST',
                                'data': {
                                    'setUserEmailOrder': order
                                },
                                'success': function(result) { //alert('question'+result);
                                    //alert("Order change");
                                    location.reload();
                                }
                            });
                        }

                        if (window.location.search.indexOf('page') > -1 || window.location.search.indexOf('c') > -1 || window.location
                            .search.indexOf('q') > -1) {
                            //alert('track present');
                        } else {
                            var url = window.location.href;
                            window.location.href = url + "?page=1&q=Locum";
                        }
                    </script>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const filterForm = document.querySelector('form[action="{{ route('admin.users.index') }}"]');
                    
                        filterForm.addEventListener('submit', function (e) {
                            const username = filterForm.querySelector('input[name="username"]').value.trim();
                            const email = filterForm.querySelector('input[name="email"]').value.trim();
                            const status = filterForm.querySelector('select[name="status"]').value;
                    
                            if (!username && !email && !status) {
                                e.preventDefault();
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Filter Required',
                                    text: 'Please apply at least one filter before submitting.',
                                    confirmButtonText: 'OK',
                                    customClass: {
                                        popup: 'swal2-border-radius'
                                    }
                                });
                            }
                        });
                    });
                    </script>

                </div>
            </div>
            @include('components.validation-notifications')
        </div>

    </div>
@endsection
