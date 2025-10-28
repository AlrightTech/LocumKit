@extends('admin.layout.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Complaints Management</h4>
                </div>
                <div class="card-body">
                    <!-- Filter Tabs -->
                    <ul class="nav nav-tabs" id="complaintTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 'all' ? 'active' : '' }}" 
                               href="{{ route('admin.complaints.index') }}">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 'open' ? 'active' : '' }}" 
                               href="{{ route('admin.complaints.index', ['status' => 'open']) }}">Open</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 'in_progress' ? 'active' : '' }}" 
                               href="{{ route('admin.complaints.index', ['status' => 'in_progress']) }}">In Progress</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 'resolved' ? 'active' : '' }}" 
                               href="{{ route('admin.complaints.index', ['status' => 'resolved']) }}">Resolved</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 'closed' ? 'active' : '' }}" 
                               href="{{ route('admin.complaints.index', ['status' => 'closed']) }}">Closed</a>
                        </li>
                    </ul>

                    <!-- Complaints Table -->
                    <div class="table-responsive mt-3">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Assigned To</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($complaints as $complaint)
                                    <tr>
                                        <td>{{ $complaint->id }}</td>
                                        <td>{{ $complaint->name }}</td>
                                        <td>{{ $complaint->email }}</td>
                                        <td>{!! $complaint->status_badge !!}</td>
                                        <td>
                                            @if($complaint->assignedUser)
                                                {{ $complaint->assignedUser->firstname }} {{ $complaint->assignedUser->lastname }}
                                            @else
                                                <span class="text-muted">Unassigned</span>
                                            @endif
                                        </td>
                                        <td>{{ $complaint->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('admin.complaints.show', $complaint) }}" 
                                               class="btn btn-sm btn-primary">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No complaints found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($complaints->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $complaints->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
