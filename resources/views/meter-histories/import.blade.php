@extends('layouts.app')

@section('title', 'Import Meter History Data')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-upload me-2"></i>
                    Import Meter History Data from Excel
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('meter-histories.import.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="file" class="form-label">Select Excel File <span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" 
                               id="file" name="file" accept=".xlsx,.xls,.csv" required>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Supported formats: .xlsx, .xls, .csv (Maximum file size: 10MB)
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <h6 class="alert-heading">
                            <i class="bi bi-info-circle me-2"></i>Import Instructions
                        </h6>
                        <p class="mb-2">Your Excel file should contain the following columns (column names are flexible):</p>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Basic Information:</strong>
                                <ul class="mb-0">
                                    <li>status</li>
                                    <li>reason</li>
                                    <li>community</li>
                                    <li>english_name</li>
                                    <li>comet_id_household_public</li>
                                    <li>changed_date</li>
                                    <li>meter_number</li>
                                    <li>household_status</li>
                                    <li>old_meter_number</li>
                                    <li>new_meter_number</li>
                                    <li>meter_number_2</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <strong>New Holder Information:</strong>
                                <ul class="mb-0">
                                <li>old_community_for_new_holder</li>
                                <li>new_community_for_new_holder</li>
                                <li>new_holder_name</li>
                                <li>old_household_for_new_holder</li>
                                    <li>new_household_for_new_holder</li>
                                    <li>old_meter_number_for_new_holder</li>
                                    <li>new_meter_number_for_new_holder</li>
                                    <li>status_for_new_holder</li>
                                    <li>new_community_name</li>
                                    <li>main_holder</li>
                                    <li>comet_id_for_main_holder</li>
                                    <li>notes</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-warning">
                        <h6 class="alert-heading">
                            <i class="bi bi-exclamation-triangle me-2"></i>Important Notes
                        </h6>
                        <ul class="mb-0">
                            <li>Make sure your Excel file has headers in the first row</li>
                            <li>Date format should be recognizable (YYYY-MM-DD, MM/DD/YYYY, etc.)</li>
                            <li>All fields are optional - you can import partial data</li>
                            <li>Meter numbers should be numeric values</li>
                            <li>Large files may take several minutes to process</li>
                        </ul>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('meter-histories.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-upload me-1"></i>Import Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Sample Data Format -->
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-table me-2"></i>
                    Sample Data Format
                </h6>
            </div>
            <div class="card-body">
                <p class="text-muted mb-3">Here's an example of how your Excel file should be structured:</p>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>status</th>
                                <th>community</th>
                                <th>english_name</th>
                                <th>meter_number</th>
                                <th>main_holder</th>
                                <th>changed_date</th>
                                <th>household_status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Active</td>
                                <td>Downtown</td>
                                <td>John Doe</td>
                                <td>12345</td>
                                <td>John Doe</td>
                                <td>2024-01-15</td>
                                <td>Active</td>
                            </tr>
                            <tr>
                                <td>Transferred</td>
                                <td>Uptown</td>
                                <td>Jane Smith</td>
                                <td>67890</td>
                                <td>Jane Smith</td>
                                <td>2024-01-20</td>
                                <td>Transferred</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // File input validation
    document.getElementById('file').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const maxSize = 10 * 1024 * 1024; // 10MB
            if (file.size > maxSize) {
                alert('File size must be less than 10MB');
                e.target.value = '';
                return;
            }
            
            const allowedTypes = [
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // .xlsx
                'application/vnd.ms-excel', // .xls
                'text/csv' // .csv
            ];
            
            if (!allowedTypes.includes(file.type)) {
                alert('Please select a valid Excel or CSV file');
                e.target.value = '';
                return;
            }
        }
    });
</script>
@endsection
