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
                    <li><a href="{{ route('freelancer.cpd.show', $cpdSubmission) }}">CPD Submission #{{ $cpdSubmission->id }}</a></li>
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
                    <h3>CPD Submission #{{ $cpdSubmission->id }}</h3>
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
                    <h1><span>CPD SUBMISSION DETAILS</span></h1>
                    <hr class="shadow-line">
                </div>

                <div class="profile-details">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Submission Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>CPD Points:</strong> {{ $cpdSubmission->cpd_points }}</p>
                                            <p><strong>Submission Date:</strong> {{ $cpdSubmission->submission_date->format('d/m/Y') }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Status:</strong> {!! $cpdSubmission->status_badge !!}</p>
                                            <p><strong>Submitted:</strong> {{ $cpdSubmission->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-3">
                                        <p><strong>Cycle Period:</strong></p>
                                        <p>{{ $cpdSubmission->cycle_start_date->format('d/m/Y') }} - {{ $cpdSubmission->cycle_end_date->format('d/m/Y') }}</p>
                                    </div>

                                    @if($cpdSubmission->evidence_file_path)
                                        <div class="mt-3">
                                            <p><strong>Evidence File:</strong></p>
                                            <a href="{{ $cpdSubmission->evidence_file_url }}" 
                                               target="_blank" class="btn btn-sm btn-info">
                                                <i class="fa fa-download"></i> Download Evidence
                                            </a>
                                        </div>
                                    @endif

                                    @if($cpdSubmission->admin_notes)
                                        <div class="mt-3">
                                            <p><strong>Admin Notes:</strong></p>
                                            <div class="border p-3 bg-light">
                                                {{ $cpdSubmission->admin_notes }}
                                            </div>
                                        </div>
                                    @endif

                                    @if($cpdSubmission->reviewed_at)
                                        <div class="mt-3">
                                            <p><strong>Reviewed:</strong> {{ $cpdSubmission->reviewed_at->format('d/m/Y H:i') }}</p>
                                            @if($cpdSubmission->reviewer)
                                                <p><strong>Reviewed By:</strong> {{ $cpdSubmission->reviewer->firstname }} {{ $cpdSubmission->reviewer->lastname }}</p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Actions</h4>
                                </div>
                                <div class="card-body">
                                    @if($cpdSubmission->status === 'pending')
                                        <a href="{{ route('freelancer.cpd.edit', $cpdSubmission) }}" 
                                           class="btn btn-warning btn-block mb-2">Edit Submission</a>
                                    @endif
                                    
                                    <a href="{{ route('freelancer.cpd.index') }}" 
                                       class="btn btn-secondary btn-block">Back to Submissions</a>
                                </div>
                            </div>

                            @if($cpdSubmission->status === 'pending')
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h4>Reminder</h4>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted">
                                            Your CPD submission is currently under review. 
                                            You will be notified once it has been processed.
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
