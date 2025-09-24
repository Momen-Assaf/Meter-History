@extends('layouts.app')

@section('title', 'Meter History Record Details')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-eye me-2"></i>
                        Meter History Record Details
                    </h5>
                    <div class="btn-group btn-group-sm">
                        <a href="{{ route('meter-histories.edit', $meterHistory) }}" class="btn btn-outline-primary">
                            <i class="bi bi-pencil me-1"></i>Edit
                        </a>
                        <form action="{{ route('meter-histories.destroy', $meterHistory) }}" method="POST" class="d-inline" 
                              onsubmit="confirmDelete(this); return false;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="bi bi-trash me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Basic Information -->
                    <div class="col-12">
                        <h6 class="text-primary mb-3">Basic Information</h6>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <p class="form-control-plaintext">
                            @if($meterHistory->status)
                                <span class="badge bg-primary">{{ $meterHistory->status }}</span>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Reason</label>
                        <p class="form-control-plaintext">{{ $meterHistory->reason ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Community</label>
                        <p class="form-control-plaintext">{{ $meterHistory->community ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">English Name</label>
                        <p class="form-control-plaintext">{{ $meterHistory->english_name ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Comet ID Household Public</label>
                        <p class="form-control-plaintext">{{ $meterHistory->comet_id_household_public ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Changed Date</label>
                        <p class="form-control-plaintext">{{ $meterHistory->formatted_changed_date ?? 'N/A' }}</p>
                    </div>
                    
                    <!-- Meter Information -->
                    <div class="col-12 mt-4">
                        <h6 class="text-primary mb-3">Meter Information</h6>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Meter Number</label>
                        <p class="form-control-plaintext">{{ $meterHistory->meter_number ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Household Status</label>
                        <p class="form-control-plaintext">
                            @if($meterHistory->household_status)
                                <span class="badge bg-info">{{ $meterHistory->household_status }}</span>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Old Meter Number</label>
                        <p class="form-control-plaintext">{{ $meterHistory->old_meter_number ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">New Meter Number</label>
                        <p class="form-control-plaintext">{{ $meterHistory->new_meter_number ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Meter Number 2</label>
                        <p class="form-control-plaintext">{{ $meterHistory->meter_number_2 ?? 'N/A' }}</p>
                    </div>
                    
                    <!-- New Holder Information -->
                    <div class="col-12 mt-4">
                        <h6 class="text-primary mb-3">New Holder Information</h6>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Old Community for New Holder</label>
                        <p class="form-control-plaintext">{{ $meterHistory->old_community_for_new_holder ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">New Community for New Holder</label>
                        <p class="form-control-plaintext">{{ $meterHistory->new_community_for_new_holder ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">New Holder Name (Household/Public)</label>
                        <p class="form-control-plaintext">{{ $meterHistory->new_holder_name ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Comet ID for the new Household/Public</label>
                        <p class="form-control-plaintext">{{ $meterHistory->comet_id_for_new_holder ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Old Household for New Holder</label>
                        <p class="form-control-plaintext">{{ $meterHistory->old_household_for_new_holder ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">New Household for New Holder</label>
                        <p class="form-control-plaintext">{{ $meterHistory->new_household_for_new_holder ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Old Meter Number for New Holder</label>
                        <p class="form-control-plaintext">{{ $meterHistory->old_meter_number_for_new_holder ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">New Meter Number for New Holder</label>
                        <p class="form-control-plaintext">{{ $meterHistory->new_meter_number_for_new_holder ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status for New Holder</label>
                        <p class="form-control-plaintext">{{ $meterHistory->status_for_new_holder ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">New Community Name</label>
                        <p class="form-control-plaintext">{{ $meterHistory->new_community_name ?? 'N/A' }}</p>
                    </div>
                    
                    <!-- Main Holder Information -->
                    <div class="col-12 mt-4">
                        <h6 class="text-primary mb-3">Main Holder Information</h6>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Main Holder</label>
                        <p class="form-control-plaintext">{{ $meterHistory->main_holder ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Comet ID for Main Holder</label>
                        <p class="form-control-plaintext">{{ $meterHistory->comet_id_for_main_holder ?? 'N/A' }}</p>
                    </div>
                    
                    <!-- Notes -->
                    @if($meterHistory->notes)
                        <div class="col-12 mt-4">
                            <h6 class="text-primary mb-3">Notes</h6>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <p class="mb-0">{{ $meterHistory->notes }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Timestamps -->
                    <div class="col-12 mt-4">
                        <h6 class="text-primary mb-3">Record Information</h6>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Created At</label>
                        <p class="form-control-plaintext">{{ $meterHistory->created_at->format('M d, Y g:i A') }}</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Last Updated</label>
                        <p class="form-control-plaintext">{{ $meterHistory->updated_at->format('M d, Y g:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions Sidebar -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('meter-histories.edit', $meterHistory) }}" class="btn btn-primary hover-lift">
                        <i class="bi bi-pencil me-2"></i>Edit This Record
                    </a>
                    <a href="{{ route('meter-histories.create') }}" class="btn btn-outline-primary hover-lift">
                        <i class="bi bi-plus-circle me-2"></i>Add New Record
                    </a>
                    <a href="{{ route('meter-histories.index') }}" class="btn btn-outline-secondary hover-lift">
                        <i class="bi bi-list me-2"></i>View All Records
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Related Records -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Related Records</h6>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-2">Other records for meter {{ $meterHistory->meter_number ?? 'N/A' }}:</p>
                @if($relatedRecords->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($relatedRecords as $record)
                            <a href="{{ route('meter-histories.show', $record) }}" 
                               class="list-group-item list-group-item-action py-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted">{{ $record->formatted_changed_date ?? 'N/A' }}</small><br>
                                        <span class="small">{{ $record->english_name ?? $record->main_holder ?? 'N/A' }}</span>
                                    </div>
                                    <span class="badge bg-primary status-badge">
                                        {{ $record->status ?? 'N/A' }}
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted small mb-0">No other records found for this meter.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection