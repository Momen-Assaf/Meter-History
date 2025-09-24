@extends('layouts.app')

@section('title', 'Add New Meter History Record')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-plus-circle me-2"></i>
                    Add New Meter History Record
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('meter-histories.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <!-- Basic Information -->
                        <div class="col-12">
                            <h6 class="text-primary mb-3">Basic Information</h6>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control @error('status') is-invalid @enderror" 
                                   id="status" name="status" value="{{ old('status') }}">
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="reason" class="form-label">Reason</label>
                            <input type="text" class="form-control @error('reason') is-invalid @enderror" 
                                   id="reason" name="reason" value="{{ old('reason') }}">
                            @error('reason')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="community" class="form-label">Community</label>
                            <input type="text" class="form-control @error('community') is-invalid @enderror" 
                                   id="community" name="community" value="{{ old('community') }}">
                            @error('community')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="english_name" class="form-label">English Name</label>
                            <input type="text" class="form-control @error('english_name') is-invalid @enderror" 
                                   id="english_name" name="english_name" value="{{ old('english_name') }}">
                            @error('english_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="comet_id_household_public" class="form-label">Comet ID Household Public</label>
                            <input type="text" class="form-control @error('comet_id_household_public') is-invalid @enderror" 
                                   id="comet_id_household_public" name="comet_id_household_public" value="{{ old('comet_id_household_public') }}">
                            @error('comet_id_household_public')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="changed_date" class="form-label">Changed Date</label>
                            <input type="date" class="form-control @error('changed_date') is-invalid @enderror" 
                                   id="changed_date" name="changed_date" value="{{ old('changed_date') }}">
                            @error('changed_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Meter Information -->
                        <div class="col-12 mt-4">
                            <h6 class="text-primary mb-3">Meter Information</h6>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="meter_number" class="form-label">Meter Number</label>
                            <input type="number" class="form-control @error('meter_number') is-invalid @enderror" 
                                   id="meter_number" name="meter_number" value="{{ old('meter_number') }}">
                            @error('meter_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="household_status" class="form-label">Household Status</label>
                            <input type="text" class="form-control @error('household_status') is-invalid @enderror" 
                                   id="household_status" name="household_status" value="{{ old('household_status') }}">
                            @error('household_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="old_meter_number" class="form-label">Old Meter Number</label>
                            <input type="number" class="form-control @error('old_meter_number') is-invalid @enderror" 
                                   id="old_meter_number" name="old_meter_number" value="{{ old('old_meter_number') }}">
                            @error('old_meter_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="new_meter_number" class="form-label">New Meter Number</label>
                            <input type="number" class="form-control @error('new_meter_number') is-invalid @enderror" 
                                   id="new_meter_number" name="new_meter_number" value="{{ old('new_meter_number') }}">
                            @error('new_meter_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="meter_number_2" class="form-label">Meter Number 2</label>
                            <input type="number" class="form-control @error('meter_number_2') is-invalid @enderror" 
                                   id="meter_number_2" name="meter_number_2" value="{{ old('meter_number_2') }}">
                            @error('meter_number_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- New Holder Information -->
                        <div class="col-12 mt-4">
                            <h6 class="text-primary mb-3">New Holder Information</h6>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="old_community_for_new_holder" class="form-label">Old Community for New Holder</label>
                            <input type="text" class="form-control @error('old_community_for_new_holder') is-invalid @enderror" 
                                   id="old_community_for_new_holder" name="old_community_for_new_holder" value="{{ old('old_community_for_new_holder') }}">
                            @error('old_community_for_new_holder')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="new_community_for_new_holder" class="form-label">New Community for New Holder</label>
                            <input type="text" class="form-control @error('new_community_for_new_holder') is-invalid @enderror" 
                                   id="new_community_for_new_holder" name="new_community_for_new_holder" value="{{ old('new_community_for_new_holder') }}">
                            @error('new_community_for_new_holder')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="new_holder_name" class="form-label">New Holder Name (Household/Public)</label>
                            <input type="text" class="form-control @error('new_holder_name') is-invalid @enderror" 
                                   id="new_holder_name" name="new_holder_name" value="{{ old('new_holder_name') }}">
                            @error('new_holder_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="comet_id_for_new_holder" class="form-label">Comet ID for the new Household/Public</label>
                            <input type="text" class="form-control @error('comet_id_for_new_holder') is-invalid @enderror" 
                                   id="comet_id_for_new_holder" name="comet_id_for_new_holder" value="{{ old('comet_id_for_new_holder') }}">
                            @error('comet_id_for_new_holder')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="old_household_for_new_holder" class="form-label">Old Household for New Holder</label>
                            <input type="text" class="form-control @error('old_household_for_new_holder') is-invalid @enderror" 
                                   id="old_household_for_new_holder" name="old_household_for_new_holder" value="{{ old('old_household_for_new_holder') }}">
                            @error('old_household_for_new_holder')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="new_household_for_new_holder" class="form-label">New Household for New Holder</label>
                            <input type="text" class="form-control @error('new_household_for_new_holder') is-invalid @enderror" 
                                   id="new_household_for_new_holder" name="new_household_for_new_holder" value="{{ old('new_household_for_new_holder') }}">
                            @error('new_household_for_new_holder')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="old_meter_number_for_new_holder" class="form-label">Old Meter Number for New Holder</label>
                            <input type="number" class="form-control @error('old_meter_number_for_new_holder') is-invalid @enderror" 
                                   id="old_meter_number_for_new_holder" name="old_meter_number_for_new_holder" value="{{ old('old_meter_number_for_new_holder') }}">
                            @error('old_meter_number_for_new_holder')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="new_meter_number_for_new_holder" class="form-label">New Meter Number for New Holder</label>
                            <input type="number" class="form-control @error('new_meter_number_for_new_holder') is-invalid @enderror" 
                                   id="new_meter_number_for_new_holder" name="new_meter_number_for_new_holder" value="{{ old('new_meter_number_for_new_holder') }}">
                            @error('new_meter_number_for_new_holder')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="status_for_new_holder" class="form-label">Status for New Holder</label>
                            <input type="text" class="form-control @error('status_for_new_holder') is-invalid @enderror" 
                                   id="status_for_new_holder" name="status_for_new_holder" value="{{ old('status_for_new_holder') }}">
                            @error('status_for_new_holder')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="new_community_name" class="form-label">New Community Name</label>
                            <input type="text" class="form-control @error('new_community_name') is-invalid @enderror" 
                                   id="new_community_name" name="new_community_name" value="{{ old('new_community_name') }}">
                            @error('new_community_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Main Holder Information -->
                        <div class="col-12 mt-4">
                            <h6 class="text-primary mb-3">Main Holder Information</h6>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="main_holder" class="form-label">Main Holder</label>
                            <input type="text" class="form-control @error('main_holder') is-invalid @enderror" 
                                   id="main_holder" name="main_holder" value="{{ old('main_holder') }}">
                            @error('main_holder')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="comet_id_for_main_holder" class="form-label">Comet ID for Main Holder</label>
                            <input type="text" class="form-control @error('comet_id_for_main_holder') is-invalid @enderror" 
                                   id="comet_id_for_main_holder" name="comet_id_for_main_holder" value="{{ old('comet_id_for_main_holder') }}">
                            @error('comet_id_for_main_holder')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Notes -->
                        <div class="col-12 mt-4">
                            <h6 class="text-primary mb-3">Additional Information</h6>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('meter-histories.index') }}" class="btn btn-secondary hover-lift">
                            <i class="bi bi-arrow-left me-1"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary hover-lift">
                            <i class="bi bi-check-circle me-1"></i>Create Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection