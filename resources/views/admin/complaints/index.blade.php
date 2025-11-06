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
                <li class="active">
                    Contact Us Messages
                </li>
            </ul>
        </div>

        <div class="page-content">
            <div class="question">
                <!-- Filter Tabs -->
                <div class="qus-tabs">
                    <ul>
                        <li class="{{ $status == 'all' ? 'active' : '' }}">
                            <a href="{{ route('admin.complaints.index') }}">All</a>
                        </li>
                        <li class="{{ $status == 'open' ? 'active' : '' }}">
                            <a href="{{ route('admin.complaints.index', ['status' => 'open']) }}">Open</a>
                        </li>
                        <li class="{{ $status == 'in_progress' ? 'active' : '' }}">
                            <a href="{{ route('admin.complaints.index', ['status' => 'in_progress']) }}">In Progress</a>
                        </li>
                        <li class="{{ $status == 'resolved' ? 'active' : '' }}">
                            <a href="{{ route('admin.complaints.index', ['status' => 'resolved']) }}">Resolved</a>
                        </li>
                        <li class="{{ $status == 'closed' ? 'active' : '' }}">
                            <a href="{{ route('admin.complaints.index', ['status' => 'closed']) }}">Closed</a>
                        </li>
                    </ul>
                </div>

                <!-- Complaints Table -->
                <div id="fre-tab">
                    <table class="table clickable table-striped table-hover">
                        <colgroup>
                            <col width="5%">
                            <col width="15%">
                            <col width="20%">
                            <col width="10%">
                            <col width="15%">
                            <col width="15%">
                            <col width="20%">
                        </colgroup>
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
                                    <td style="text-transform: capitalize;">{{ $complaint->name }}</td>
                                    <td>{{ $complaint->email }}</td>
                                    <td>
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
                                        <span class="label {{ $color }}">{{ $label }}</span>
                                    </td>
                                    <td>
                                        @if($complaint->assignedUser)
                                            <span style="text-transform: capitalize;">{{ $complaint->assignedUser->firstname }} {{ $complaint->assignedUser->lastname }}</span>
                                        @else
                                            <span class="text-muted">Unassigned</span>
                                        @endif
                                    </td>
                                    <td>{{ $complaint->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.complaints.show', $complaint) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="glyphicon glyphicon-eye-open"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No contact messages found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    @if($complaints->hasPages())
                        <div class="text-center mt-3">
                            {{ $complaints->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
