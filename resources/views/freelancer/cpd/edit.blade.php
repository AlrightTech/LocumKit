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
                    <li><a href="{{ route('freelancer.cpd.edit', $cpdSubmission) }}">Edit</a></li>
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
                    <h3>Edit CPD Submission</h3>
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
                    <h1><span>EDIT CPD SUBMISSION</span></h1>
                    <hr class="shadow-line">
                </div>

                <div class="profile-details">
                    <form action="{{ route('freelancer.cpd.update', $cpdSubmission) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cpd_points">CPD Points <span class="text-danger">*</span></label>
                                    <input type="number" name="cpd_points" id="cpd_points" 
                                           class="form-control @error('cpd_points') is-invalid @enderror" 
                                           value="{{ old('cpd_points', $cpdSubmission->cpd_points) }}" min="1" max="100" required>
                                    @error('cpd_points')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="submission_date">Submission Date <span class="text-danger">*</span></label>
                                    <input type="date" name="submission_date" id="submission_date" 
                                           class="form-control @error('submission_date') is-invalid @enderror" 
                                           value="{{ old('submission_date', $cpdSubmission->submission_date->format('Y-m-d')) }}" required>
                                    @error('submission_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="evidence_file">Evidence File</label>
                            <input type="file" name="evidence_file" id="evidence_file" 
                                   class="form-control @error('evidence_file') is-invalid @enderror" 
                                   accept=".pdf,.jpg,.jpeg,.png">
                            <small class="form-text text-muted">
                                Accepted formats: PDF, JPG, JPEG, PNG. Maximum file size: 10MB
                                <br>Leave empty to keep current file.
                            </small>
                            @error('evidence_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            @if($cpdSubmission->evidence_file_path)
                                <div class="mt-2">
                                    <strong>Current file:</strong>
                                    <a href="{{ $cpdSubmission->evidence_file_url }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="fa fa-download"></i> Download Current File
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update CPD Submission</button>
                            <a href="{{ route('freelancer.cpd.show', $cpdSubmission) }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
