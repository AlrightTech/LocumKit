@extends('layouts.user_profile_app')

@section('content')
<section id="breadcrum" class="breadcrum">
    <div class="breadcrum-sitemap">
        <div class="container">
            <div class="row">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('freelancer.dashboard') }}">My Dashboard</a></li>
                    <li><a href="{{ route('freelancer.cpd.index') }}">CPD Submissions</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="breadcrum-title">
        <div class="container">
            <div class="row">
                <div class="set-icon registration-icon">
                    <i class="glyphicon glyphicon-edit" aria-hidden="true"></i>
                </div>
                <div class="set-title">
                    <h3>CPD Submissions</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="primary-content" class="main-content profiles">
    <div class="container">
        <div class="row">
            <div class="gray-gradient contents">
                <div class="welcome-heading">
                    <h1><span>CPD SUBMISSIONS</span></h1>
                    <hr class="shadow-line">
                </div>

                <div class="profile-details">
                    <div class="row">
                        <div class="col-md-12" align="right">
                            <div class="profile-edit-btn" style="padding-top: 0;">
                                <a href="{{ route('freelancer.cpd.create') }}" class="gradient-threeline post-new-job-btn">Submit CPD Evidence</a>
                            </div>
                        </div>
                    </div>

                    <div class="job-list-div">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>CPD Points</th>
                                        <th>Cycle Period</th>
                                        <th>Submission Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($submissions as $submission)
                                        <tr>
                                            <td>{{ $submission->cpd_points }}</td>
                                            <td>
                                                {{ $submission->cycle_start_date->format('d/m/Y') }} - 
                                                {{ $submission->cycle_end_date->format('d/m/Y') }}
                                            </td>
                                            <td>{{ $submission->submission_date->format('d/m/Y') }}</td>
                                            <td>{!! $submission->status_badge !!}</td>
                                            <td>
                                                <a href="{{ route('freelancer.cpd.show', $submission) }}" 
                                                   class="btn btn-sm btn-primary">View</a>
                                                @if($submission->status === 'pending')
                                                    <a href="{{ route('freelancer.cpd.edit', $submission) }}" 
                                                       class="btn btn-sm btn-warning">Edit</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No CPD submissions found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        @if($submissions->hasPages())
                            <div class="paginator-holder">
                                {{ $submissions->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
