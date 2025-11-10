@extends('layouts.user_profile_app')

@push('styles')
    <style>
        .blocked-locums-container {
            background: #fff;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .search-filter-section {
            margin-bottom: 25px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        
        .search-filter-section .form-group {
            margin-bottom: 15px;
        }
        
        .search-filter-section label {
            font-weight: 600;
            color: #000;
            margin-bottom: 8px;
            display: block;
        }
        
        .search-filter-section input,
        .search-filter-section select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            color: #000;
        }
        
        .search-filter-section .btn {
            padding: 10px 20px;
            margin-top: 20px;
        }
        
        .blocked-locums-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .blocked-locums-table thead {
            background-color: #0095cd;
            color: #fff;
        }
        
        .blocked-locums-table thead th {
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            border: 1px solid #0077a3;
        }
        
        .blocked-locums-table tbody td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            color: #000;
            vertical-align: middle;
        }
        
        .blocked-locums-table tbody tr {
            background-color: #fff;
        }
        
        .blocked-locums-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .blocked-locums-table tbody tr:hover {
            background-color: #f0f8ff;
        }
        
        .unblock-btn {
            background-color: #28a745;
            color: #fff;
            padding: 6px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 13px;
            transition: background-color 0.3s;
        }
        
        .unblock-btn:hover {
            background-color: #218838;
            color: #fff;
            text-decoration: none;
        }
        
        .no-records {
            text-align: center;
            padding: 40px;
            color: #666;
        }
        
        .no-records i {
            font-size: 48px;
            color: #ccc;
            margin-bottom: 15px;
        }
        
        .profession-badge {
            display: inline-block;
            padding: 4px 10px;
            background-color: #e9ecef;
            border-radius: 12px;
            font-size: 12px;
            color: #495057;
            font-weight: 500;
        }
        
        .stats-section {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }
        
        .stat-card {
            flex: 1;
            min-width: 200px;
            padding: 15px;
            background: linear-gradient(135deg, #0095cd 0%, #004c68 100%);
            color: #fff;
            border-radius: 5px;
            text-align: center;
        }
        
        .stat-card .stat-number {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .stat-card .stat-label {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .add-locum-section {
            position: relative;
        }
        
        .search-result-item {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            transition: background-color 0.2s;
            color: #000;
        }
        
        .search-result-item:hover {
            background-color: #f0f8ff;
        }
        
        .search-result-item:last-child {
            border-bottom: none;
        }
        
        .search-result-item .result-name {
            font-weight: 600;
            color: #0095cd;
            margin-bottom: 4px;
        }
        
        .search-result-item .result-email {
            font-size: 13px;
            color: #666;
            margin-bottom: 2px;
        }
        
        .search-result-item .result-profession {
            font-size: 12px;
            color: #999;
        }
        
        .no-results {
            padding: 15px;
            text-align: center;
            color: #666;
        }
        
        @media (max-width: 768px) {
            .stats-section {
                flex-direction: column;
            }
            
            .stat-card {
                width: 100%;
            }
            
            .blocked-locums-table {
                font-size: 12px;
            }
            
            .blocked-locums-table thead th,
            .blocked-locums-table tbody td {
                padding: 8px 10px;
            }
        }
    </style>
@endpush

@section('content')
    <section id="breadcrum" class="breadcrum">
        <div class="breadcrum-sitemap">
            <div class="container">
                <div class="row">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/employer/dashboard">My Dashboard</a></li>
                        <li><a href="#">Blocked Locums</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="breadcrum-title">
            <div class="container">
                <div class="row">
                    <div class="set-icon registration-icon">
                        <i class="glyphicon glyphicon-lock" aria-hidden="true"></i>
                    </div>
                    <div class="set-title">
                        <h3>Blocked Locums</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div id="primary-content" class="main-content profiles">
        <div class="container">
            <div class="row">
                <div class="white-bg contents">
                    <div class="blocked-locums-container">
                        <div class="welcome-heading">
                            <h1><span>Manage Blocked Locums</span></h1>
                            <hr class="shadow-line">
                            <p style="color: #666; margin-top: 10px;">
                                View and manage locums you have blocked from receiving job invitations. Blocked locums will not see or be able to apply to your future job postings.
                            </p>
                        </div>
                        
                        <!-- Statistics -->
                        <div class="stats-section">
                            <div class="stat-card">
                                <div class="stat-number">{{ $block_locums->count() }}</div>
                                <div class="stat-label">Total Blocked Locums</div>
                            </div>
                        </div>
                        
                        <!-- Add Locum to Block Section -->
                        <div class="add-locum-section" style="margin-bottom: 25px; padding: 20px; background: #e8f4f8; border-radius: 5px; border: 1px solid #0095cd;">
                            <h3 style="margin-top: 0; color: #0095cd; font-size: 18px; font-weight: 600;">
                                <i class="fa fa-user-plus"></i> Add Locum to Block
                            </h3>
                            <p style="color: #666; margin-bottom: 15px; font-size: 14px;">
                                Search for a locum by name, email, or ID to add them to your blocked list.
                            </p>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group" style="position: relative;">
                                        <label for="add-locum-search" style="font-weight: 600; color: #000; margin-bottom: 8px; display: block;">
                                            Search Locum
                                        </label>
                                        <input 
                                            type="text" 
                                            id="add-locum-search" 
                                            class="form-control" 
                                            placeholder="Type name, email, or ID to search..."
                                            autocomplete="off"
                                            style="color: #000; padding-right: 40px;"
                                        >
                                        <i class="fa fa-spinner fa-spin" id="search-spinner" style="display: none; position: absolute; right: 15px; top: 38px; color: #0095cd;"></i>
                                        <div id="search-results" style="display: none; position: absolute; top: 100%; left: 0; right: 0; background: #fff; border: 1px solid #ddd; border-radius: 4px; max-height: 300px; overflow-y: auto; z-index: 1000; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-top: 5px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Search and Filter Section -->
                        <div class="search-filter-section">
                            <form method="GET" action="{{ route('employer.manage-block-freelancer') }}" id="search-form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="search">Search Locums</label>
                                            <input 
                                                type="text" 
                                                id="search" 
                                                name="search" 
                                                class="form-control" 
                                                placeholder="Search by name, email, or ID..."
                                                value="{{ request('search') }}"
                                                style="color: #000;"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="profession">Filter by Profession</label>
                                            <select 
                                                id="profession" 
                                                name="profession" 
                                                class="form-control"
                                                style="color: #000;"
                                            >
                                                <option value="">All Professions</option>
                                                @foreach($professions as $profession)
                                                    <option value="{{ $profession->id }}" {{ request('profession') == $profession->id ? 'selected' : '' }}>
                                                        {{ $profession->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 0;">
                                                <i class="fa fa-search"></i> Search
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @if(request('search') || request('profession'))
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{ route('employer.manage-block-freelancer') }}" class="btn btn-default">
                                                <i class="fa fa-times"></i> Clear Filters
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>
                        
                        <!-- Success/Error Messages -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <i class="fa fa-check-circle"></i> {{ session('success') }}
                            </div>
                        @endif
                        
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <i class="fa fa-exclamation-circle"></i> {{ session('error') }}
                            </div>
                        @endif
                        
                        <!-- Blocked Locums Table -->
                        <div class="table-responsive">
                            <table class="blocked-locums-table">
                                <thead>
                                    <tr>
                                        <th>Locum ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Profession</th>
                                        <th>Blocked Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($block_locums as $block_locum)
                                        <tr>
                                            <td>{{ $block_locum->freelancer->id }}</td>
                                            <td>
                                                <strong>{{ $block_locum->freelancer->firstname }} {{ $block_locum->freelancer->lastname }}</strong>
                                            </td>
                                            <td>{{ $block_locum->freelancer->email }}</td>
                                            <td>
                                                @if($block_locum->freelancer->user_acl_profession)
                                                    <span class="profession-badge">{{ $block_locum->freelancer->user_acl_profession->name }}</span>
                                                @else
                                                    <span class="profession-badge">N/A</span>
                                                @endif
                                            </td>
                                            <td>{{ $block_locum->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="javascript:void(0)" 
                                                   onclick="confirmUnblock('{{ $block_locum->id }}', '{{ $block_locum->freelancer->firstname }} {{ $block_locum->freelancer->lastname }}')" 
                                                   class="unblock-btn">
                                                    <i class="fa fa-unlock"></i> Unblock
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="no-records">
                                                <i class="fa fa-user-times"></i>
                                                <h4>No Blocked Locums Found</h4>
                                                <p>You haven't blocked any locums yet.</p>
                                                @if(request('search') || request('profession'))
                                                    <p>Try adjusting your search or filter criteria.</p>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        function confirmUnblock(id, name) {
            if (confirm('Are you sure you want to unblock ' + name + '?\n\nThey will be able to receive invitations to your future jobs.')) {
                // Create a form and submit it
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '/employer/unblock-locum/' + id;
                
                // Add CSRF token
                var csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = document.querySelector('meta[name="csrf-token"]').content;
                form.appendChild(csrfInput);
                
                // Add method spoofing for DELETE
                var methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);
                
                document.body.appendChild(form);
                form.submit();
            }
        }
        
        // Auto-submit form on filter change
        $(document).ready(function() {
            $('#profession').on('change', function() {
                $('#search-form').submit();
            });
            
            // Add Locum Search Functionality
            let searchTimeout;
            const searchInput = $('#add-locum-search');
            const searchResults = $('#search-results');
            const searchSpinner = $('#search-spinner');
            
            searchInput.on('input', function() {
                const query = $(this).val().trim();
                
                clearTimeout(searchTimeout);
                
                if (query.length < 2) {
                    searchResults.hide().empty();
                    return;
                }
                
                searchSpinner.show();
                searchResults.hide();
                
                searchTimeout = setTimeout(function() {
                    $.ajax({
                        url: '{{ route("employer.search-locums") }}',
                        method: 'GET',
                        data: { search: query },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            searchSpinner.hide();
                            
                            if (response.locums && response.locums.length > 0) {
                                let html = '';
                                response.locums.forEach(function(locum) {
                                    html += `
                                        <div class="search-result-item" data-id="${locum.id}" data-name="${locum.name}">
                                            <div class="result-name">${locum.name}</div>
                                            <div class="result-email">${locum.email}</div>
                                            <div class="result-profession">Profession: ${locum.profession}</div>
                                        </div>
                                    `;
                                });
                                searchResults.html(html).show();
                            } else {
                                searchResults.html('<div class="no-results">No locums found. Try a different search term.</div>').show();
                            }
                        },
                        error: function() {
                            searchSpinner.hide();
                            searchResults.html('<div class="no-results" style="color: #d32f2f;">Error searching for locums. Please try again.</div>').show();
                        }
                    });
                }, 300);
            });
            
            // Handle click on search result
            $(document).on('click', '.search-result-item', function() {
                const locumId = $(this).data('id');
                const locumName = $(this).data('name');
                
                if (confirm('Are you sure you want to block ' + locumName + '?\n\nThey will not receive invitations to your future jobs.')) {
                    // Create a form and submit it
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route("block-user.post", ":id") }}'.replace(':id', locumId);
                    form.style.display = 'none';
                    
                    // Add CSRF token
                    var csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = document.querySelector('meta[name="csrf-token"]').content;
                    form.appendChild(csrfInput);
                    
                    document.body.appendChild(form);
                    form.submit();
                }
            });
            
            // Hide search results when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#add-locum-search, #search-results').length) {
                    searchResults.hide();
                }
            });
        });
    </script>
@endpush
