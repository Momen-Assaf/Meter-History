@extends('layouts.app')

@section('title', 'Meter History Records')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="bi bi-speedometer2 me-2"></i>
                Meter History Records
            </h1>
            <div>
                <a href="{{ route('meter-histories.create') }}" class="btn btn-primary me-2 hover-lift">
                    <i class="bi bi-plus-circle me-1"></i>Add Record
                </a>
                <a href="{{ route('meter-histories.import') }}" class="btn btn-outline-primary hover-lift">
                    <i class="bi bi-upload me-1"></i>Import Excel
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="card filter-card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('meter-histories.index') }}" class="row g-3">
                    <div class="col-md-3">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               value="{{ request('search') }}" placeholder="Meter number, English name, community, main holder...">
                    </div>
                    <div class="col-md-2">
                        <label for="community" class="form-label">Community</label>
                        <select class="form-select" id="community" name="community">
                            <option value="">All Communities</option>
                            @foreach($communities as $community)
                                <option value="{{ $community }}" {{ request('community') == $community ? 'selected' : '' }}>
                                    {{ $community }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">All Status</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="household_status" class="form-label">Household Status</label>
                        <select class="form-select" id="household_status" name="household_status">
                            <option value="">All Household Status</option>
                            @foreach($householdStatuses as $householdStatus)
                                <option value="{{ $householdStatus }}" {{ request('household_status') == $householdStatus ? 'selected' : '' }}>{{ $householdStatus }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" 
                               value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-2">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" 
                               value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="submit" class="btn btn-outline-primary me-2 hover-lift">
                            <i class="bi bi-search"></i>
                        </button>
                        <a href="{{ route('meter-histories.index') }}" class="btn btn-outline-secondary hover-lift">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Records Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    Records ({{ $meterHistories->total() }} total)
                </h5>
            </div>
            <div class="card-body p-0">
                @if($meterHistories->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Community</th>
                                    <th>English Name</th>
                                    <th>Meter Number</th>
                                    <th>Main Holder</th>
                                    <th>Changed Date</th>
                                    <th>Household Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($meterHistories as $record)
                                    <tr>
                                        <td>
                                            @if($record->status)
                                                <span class="badge bg-primary status-badge">{{ $record->status }}</span>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>{{ $record->community ?? 'N/A' }}</td>
                                        <td>{{ $record->english_name ?? 'N/A' }}</td>
                                        <td>
                                            @if($record->meter_number)
                                                <strong>{{ $record->meter_number }}</strong>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>{{ $record->main_holder ?? $record->english_name ?? 'N/A' }}</td>
                                        <td>{{ $record->formatted_changed_date ?? 'N/A' }}</td>
                                        <td>
                                            @if($record->household_status)
                                                <span class="badge bg-info status-badge">{{ $record->household_status }}</span>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('meter-histories.show', $record) }}" 
                                                   class="btn btn-outline-primary hover-lift" title="View">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('meter-histories.edit', $record) }}" 
                                                   class="btn btn-outline-secondary hover-lift" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('meter-histories.destroy', $record) }}" 
                                                      method="POST" class="d-inline" 
                                                      onsubmit="confirmDelete(this); return false;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger hover-lift" title="Delete" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="card-footer py-4 px-4" style="background-color: #f8f9fa; border-top: none;">
                        <style>
                            .card-footer a {
                                color: #6b7280 !important;
                                text-decoration: none !important;
                            }
                            .card-footer a:hover {
                                color: #374151 !important;
                                text-decoration: none !important;
                            }
                        </style>
                        {{ $meterHistories->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-inbox display-1 text-muted"></i>
                        <h4 class="mt-3 text-muted">No records found</h4>
                        <p class="text-muted">
                            @if(request()->hasAny(['search', 'community', 'status', 'start_date', 'end_date']))
                                No records match your current filters.
                            @else
                                Get started by adding your first meter history record.
                            @endif
                        </p>
                        @if(!request()->hasAny(['search', 'community', 'status', 'start_date', 'end_date']))
                            <a href="{{ route('meter-histories.create') }}" class="btn btn-primary hover-lift">
                                <i class="bi bi-plus-circle me-1"></i>Add First Record
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
