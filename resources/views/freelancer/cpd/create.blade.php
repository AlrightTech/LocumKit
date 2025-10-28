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
                    <li><a href="{{ route('freelancer.cpd.create') }}">Submit CPD Evidence</a></li>
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
                    <h3>Submit CPD Evidence</h3>
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
                    <h1><span>SUBMIT CPD EVIDENCE</span></h1>
                    <hr class="shadow-line">
                </div>

                <div class="profile-details">
                    <form action="{{ route('freelancer.cpd.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cpd_points">CPD Points <span class="text-danger">*</span></label>
                                    <input type="number" name="cpd_points" id="cpd_points" 
                                           class="form-control @error('cpd_points') is-invalid @enderror" 
                                           value="{{ old('cpd_points') }}" min="1" max="100" required>
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
                                           value="{{ old('submission_date', now()->format('Y-m-d')) }}" required>
                                    @error('submission_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cycle_start_date">Cycle Start Date <span class="text-danger">*</span></label>
                                    <input type="date" name="cycle_start_date" id="cycle_start_date" 
                                           class="form-control @error('cycle_start_date') is-invalid @enderror" 
                                           value="{{ old('cycle_start_date', $currentCycle['start']) }}" required>
                                    @error('cycle_start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cycle_end_date">Cycle End Date <span class="text-danger">*</span></label>
                                    <input type="date" name="cycle_end_date" id="cycle_end_date" 
                                           class="form-control @error('cycle_end_date') is-invalid @enderror" 
                                           value="{{ old('cycle_end_date', $currentCycle['end']) }}" required>
                                    @error('cycle_end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="evidence_file">Evidence File <span class="text-danger">*</span></label>
                            <input type="file" name="evidence_file" id="evidence_file" 
                                   class="form-control @error('evidence_file') is-invalid @enderror" 
                                   accept=".pdf,.jpg,.jpeg,.png" required>
                            <small class="form-text text-muted">
                                Accepted formats: PDF, JPG, JPEG, PNG. Maximum file size: 10MB
                            </small>
                            @error('evidence_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit CPD Evidence</button>
                            <a href="{{ route('freelancer.cpd.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
