@extends('admin.layout.app')

@section('content')
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
                    <a href="{{ route('admin.complaints.index') }}">Contact Us Messages</a>
                </li>
                <li class="active">
                    Message #{{ $complaint->id }}
                </li>
            </ul>
        </div>

        <div class="page-content">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('error') }}
                </div>
            @endif

            <form class="relative form-horizontal" method="post" action="{{ route('admin.complaints.update', $complaint) }}">
                @csrf
                @method('PUT')
                
                <!-- Status Section -->
                <div class="form-group">
                    <label class="required control-label col-lg-2">Status</label>
                    <div class="col-lg-10">
                        @php
                            $statusColors = [
                                'open' => 'label-danger',
                                'in_progress' => 'label-warning',
                                'resolved' => 'label-success',
                                'closed' => 'label-default'
                            ];
                            $statusLabels = [
                                'open' => 'Open',
                                'in_progress' => 'In Progress',
                                'resolved' => 'Resolved',
                                'closed' => 'Closed'
                            ];
                            $color = $statusColors[$complaint->status] ?? 'label-default';
                            $label = $statusLabels[$complaint->status] ?? ucfirst($complaint->status);
                        @endphp
                        <span class="label {{ $color }}" style="font-size: 14px; padding: 5px 10px; margin-right: 10px;">{{ $label }}</span>
                        <select name="status" id="status" class="form-control" style="width: 200px; display: inline-block;">
                            <option value="open" {{ $complaint->status == 'open' ? 'selected' : '' }}>Open</option>
                            <option value="in_progress" {{ $complaint->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="resolved" {{ $complaint->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                            <option value="closed" {{ $complaint->status == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="form-group">
                    <label class="required control-label col-lg-2">Name</label>
                    <div class="col-lg-10">
                        <p class="form-control" readonly style="text-transform: capitalize; background-color: #f5f5f5;">{{ $complaint->name }}</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="required control-label col-lg-2">Email</label>
                    <div class="col-lg-10">
                        <p class="form-control" readonly style="background-color: #f5f5f5;">{{ $complaint->email }}</p>
                    </div>
                </div>

                <!-- Date Information -->
                <div class="form-group">
                    <label class="required control-label col-lg-2">Submitted</label>
                    <div class="col-lg-10">
                        <p class="form-control" readonly style="background-color: #f5f5f5;">
                            <i class="glyphicon glyphicon-calendar"></i> {{ $complaint->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                </div>

                @if($complaint->resolved_at)
                <div class="form-group">
                    <label class="control-label col-lg-2">Resolved</label>
                    <div class="col-lg-10">
                        <p class="form-control" readonly style="background-color: #f5f5f5;">
                            <i class="glyphicon glyphicon-ok"></i> {{ $complaint->resolved_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                </div>
                @endif

                <!-- Assignment Section -->
                <div class="form-group">
                    <label class="control-label col-lg-2">Assigned To</label>
                    <div class="col-lg-10">
                        <select name="assigned_to" id="assigned_to" class="form-control" style="width: 300px;">
                            <option value="">Unassigned</option>
                            @foreach($admins as $admin)
                                <option value="{{ $admin->id }}" 
                                        {{ $complaint->assigned_to == $admin->id ? 'selected' : '' }}>
                                    {{ $admin->firstname }} {{ $admin->lastname }} ({{ $admin->email }})
                                </option>
                            @endforeach
                        </select>
                        @if($complaint->assignedUser)
                        <p class="form-control-static" style="margin-top: 5px; text-transform: capitalize; color: #666;">
                            Currently assigned to: <strong>{{ $complaint->assignedUser->firstname }} {{ $complaint->assignedUser->lastname }}</strong>
                        </p>
                        @endif
                    </div>
                </div>

                <!-- Message Section -->
                <div class="form-group">
                    <label class="required control-label col-lg-2">Message</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" readonly style="min-height: 150px; white-space: pre-wrap; background-color: #f9f9f9; font-family: inherit;">{{ $complaint->message }}</textarea>
                    </div>
                </div>

                <!-- Resolution Notes Section -->
                <div class="form-group">
                    <label class="control-label col-lg-2">Resolution Notes</label>
                    <div class="col-lg-10">
                        <textarea name="resolution_notes" id="resolution_notes" 
                                  class="form-control" rows="4" 
                                  placeholder="Add notes about how this issue was resolved...">{{ $complaint->resolution_notes }}</textarea>
                    </div>
                </div>

                @if(isset($complaint->admin_reply) && $complaint->admin_reply)
                <div class="form-group">
                    <label class="control-label col-lg-2">Admin Reply</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" readonly style="min-height: 100px; white-space: pre-wrap; background-color: #e8f4f8;">{{ $complaint->admin_reply }}</textarea>
                        @if(isset($complaint->replied_at) && $complaint->replied_at)
                        <small class="text-muted" style="display: block; margin-top: 5px;">
                            <i class="glyphicon glyphicon-time"></i> Replied on {{ $complaint->replied_at->format('d/m/Y H:i') }}
                        </small>
                        @endif
                    </div>
                </div>
                @endif

                <hr style="margin: 30px 0;">

                <!-- Action Buttons -->
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" class="btn btn-warning">
                            <i class="glyphicon glyphicon-floppy-disk"></i> Update
                        </button>

                        @if($complaint->status == 'open')
                        <form method="POST" action="{{ route('admin.complaints.assign', $complaint) }}" style="display: inline-block; margin-left: 10px;">
                            @csrf
                            <select name="assigned_to" class="form-control" required style="width: 200px; display: inline-block;">
                                <option value="">Quick Assign...</option>
                                @foreach($admins as $admin)
                                    <option value="{{ $admin->id }}">{{ $admin->firstname }} {{ $admin->lastname }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-info btn-sm" style="margin-left: 5px;">
                                <i class="glyphicon glyphicon-user"></i> Assign
                            </button>
                        </form>
                        @endif


                        @if($complaint->status == 'resolved')
                        <form method="POST" action="{{ route('admin.complaints.close', $complaint) }}" style="display: inline-block; margin-left: 10px;">
                            @csrf
                            <button type="submit" class="btn btn-secondary">
                                <i class="glyphicon glyphicon-lock"></i> Close
                            </button>
                        </form>
                        @endif

                        <a href="{{ route('admin.complaints.index') }}" class="btn btn-default" style="margin-left: 10px;">
                            <i class="glyphicon glyphicon-arrow-left"></i> Back to Messages
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
