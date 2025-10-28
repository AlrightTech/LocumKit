@extends('admin.layout.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Complaint #{{ $complaint->id }}</h4>
                    <div>
                        {!! $complaint->status_badge !!}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <!-- Complaint Details -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5>Complaint Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Name:</strong> {{ $complaint->name }}</p>
                                            <p><strong>Email:</strong> {{ $complaint->email }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Submitted:</strong> {{ $complaint->created_at->format('d/m/Y H:i') }}</p>
                                            @if($complaint->resolved_at)
                                                <p><strong>Resolved:</strong> {{ $complaint->resolved_at->format('d/m/Y H:i') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <strong>Message:</strong>
                                        <div class="border p-3 mt-2 bg-light">
                                            {{ $complaint->message }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Resolution Notes -->
                            @if($complaint->resolution_notes)
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5>Resolution Notes</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="border p-3 bg-light">
                                            {{ $complaint->resolution_notes }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-4">
                            <!-- Actions -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5>Actions</h5>
                                </div>
                                <div class="card-body">
                                    @if($complaint->status == 'open')
                                        <!-- Assign to Admin -->
                                        <form method="POST" action="{{ route('admin.complaints.assign', $complaint) }}" class="mb-3">
                                            @csrf
                                            <div class="form-group">
                                                <label for="assigned_to">Assign to:</label>
                                                <select name="assigned_to" id="assigned_to" class="form-control" required>
                                                    <option value="">Select Admin</option>
                                                    @foreach($admins as $admin)
                                                        <option value="{{ $admin->id }}">{{ $admin->firstname }} {{ $admin->lastname }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-warning btn-sm">Assign</button>
                                        </form>
                                    @endif

                                    @if($complaint->status == 'in_progress')
                                        <!-- Resolve Complaint -->
                                        <form method="POST" action="{{ route('admin.complaints.resolve', $complaint) }}" class="mb-3">
                                            @csrf
                                            <div class="form-group">
                                                <label for="resolution_notes">Resolution Notes:</label>
                                                <textarea name="resolution_notes" id="resolution_notes" 
                                                          class="form-control" rows="4" required 
                                                          placeholder="Describe how the complaint was resolved..."></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-success btn-sm">Mark as Resolved</button>
                                        </form>
                                    @endif

                                    @if($complaint->status == 'resolved')
                                        <!-- Close Complaint -->
                                        <form method="POST" action="{{ route('admin.complaints.close', $complaint) }}" class="mb-3">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary btn-sm">Close Complaint</button>
                                        </form>
                                    @endif

                                    <!-- Update Status -->
                                    <form method="POST" action="{{ route('admin.complaints.update', $complaint) }}" class="mb-3">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="status">Update Status:</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="open" {{ $complaint->status == 'open' ? 'selected' : '' }}>Open</option>
                                                <option value="in_progress" {{ $complaint->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="resolved" {{ $complaint->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                                <option value="closed" {{ $complaint->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="assigned_to">Assigned To:</label>
                                            <select name="assigned_to" id="assigned_to" class="form-control">
                                                <option value="">Unassigned</option>
                                                @foreach($admins as $admin)
                                                    <option value="{{ $admin->id }}" 
                                                            {{ $complaint->assigned_to == $admin->id ? 'selected' : '' }}>
                                                        {{ $admin->firstname }} {{ $admin->lastname }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="resolution_notes">Resolution Notes:</label>
                                            <textarea name="resolution_notes" id="resolution_notes" 
                                                      class="form-control" rows="3">{{ $complaint->resolution_notes }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                    </form>
                                </div>
                            </div>

                            <!-- Assignment Info -->
                            @if($complaint->assignedUser)
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Assigned To</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Name:</strong> {{ $complaint->assignedUser->firstname }} {{ $complaint->assignedUser->lastname }}</p>
                                        <p><strong>Email:</strong> {{ $complaint->assignedUser->email }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="mt-4">
                        <a href="{{ route('admin.complaints.index') }}" class="btn btn-secondary">Back to Complaints</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
