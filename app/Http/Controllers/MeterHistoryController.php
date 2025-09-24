<?php

namespace App\Http\Controllers;

use App\Models\MeterHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class MeterHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MeterHistory::query();

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('meter_number', 'like', "%{$search}%")
                  ->orWhere('english_name', 'like', "%{$search}%")
                  ->orWhere('community', 'like', "%{$search}%")
                  ->orWhere('main_holder', 'like', "%{$search}%")
                  ->orWhere('comet_id_household_public', 'like', "%{$search}%");
            });
        }

        if ($request->filled('community')) {
            $query->byCommunity($request->community);
        }

        if ($request->filled('meter_number')) {
            $query->byMeterNumber($request->meter_number);
        }

        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->byDateRange($request->start_date, $request->end_date);
        }

        if ($request->filled('household_status')) {
            $query->byHouseholdStatus($request->household_status);
        }

        // Get unique communities for filter dropdown
        $communities = MeterHistory::distinct()->pluck('community')->filter()->sort()->values();
        
        // Get unique household statuses for filter dropdown
        $householdStatuses = MeterHistory::distinct()->pluck('household_status')->filter()->sort()->values();

        // Get unique statuses for filter dropdown
        $statuses = MeterHistory::distinct()->pluck('status')->filter()->sort()->values();

        $meterHistories = $query->orderBy('changed_date', 'desc')->paginate(15);

        return view('meter-histories.index', compact('meterHistories', 'communities', 'householdStatuses', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('meter-histories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'status' => 'nullable|string|max:255',
            'reason' => 'nullable|string|max:255',
            'community' => 'nullable|string|max:255',
            'english_name' => 'nullable|string|max:255',
            'comet_id_household_public' => 'nullable|string|max:255',
            'comet_id_for_new_holder' => 'nullable|string|max:255',
            'changed_date' => 'nullable|date',
            'meter_number' => 'nullable|numeric',
            'household_status' => 'nullable|string|max:255',
            'old_community_for_new_holder' => 'nullable|string|max:255',
            'new_community_for_new_holder' => 'nullable|string|max:255',
            'new_holder_name' => 'nullable|string|max:255',
            'old_household_for_new_holder' => 'nullable|string|max:255',
            'new_household_for_new_holder' => 'nullable|string|max:255',
            'old_meter_number_for_new_holder' => 'nullable|numeric',
            'new_meter_number_for_new_holder' => 'nullable|numeric',
            'status_for_new_holder' => 'nullable|string|max:255',
            'new_community_name' => 'nullable|string|max:255',
            'old_meter_number' => 'nullable|numeric',
            'new_meter_number' => 'nullable|numeric',
            'main_holder' => 'nullable|string|max:255',
            'comet_id_for_main_holder' => 'nullable|string|max:255',
            'meter_number_2' => 'nullable|numeric',
            'notes' => 'nullable|string',
        ]);

        MeterHistory::create($validated);

        return redirect()->route('meter-histories.index')
            ->with('success', 'Meter history record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MeterHistory $meterHistory)
    {
        $relatedRecords = MeterHistory::query()
            ->where('meter_number', $meterHistory->meter_number)
            ->where('id', '!=', $meterHistory->id)
            ->orderBy('changed_date', 'desc')
            ->limit(5)
            ->get();

        return view('meter-histories.show', compact('meterHistory', 'relatedRecords'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MeterHistory $meterHistory)
    {
        return view('meter-histories.edit', compact('meterHistory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MeterHistory $meterHistory)
    {
        $validated = $request->validate([
            'status' => 'nullable|string|max:255',
            'reason' => 'nullable|string|max:255',
            'community' => 'nullable|string|max:255',
            'english_name' => 'nullable|string|max:255',
            'comet_id_household_public' => 'nullable|string|max:255',
            'comet_id_for_new_holder' => 'nullable|string|max:255',
            'changed_date' => 'nullable|date',
            'meter_number' => 'nullable|numeric',
            'household_status' => 'nullable|string|max:255',
            'old_community_for_new_holder' => 'nullable|string|max:255',
            'new_community_for_new_holder' => 'nullable|string|max:255',
            'new_holder_name' => 'nullable|string|max:255',
            'old_household_for_new_holder' => 'nullable|string|max:255',
            'new_household_for_new_holder' => 'nullable|string|max:255',
            'old_meter_number_for_new_holder' => 'nullable|numeric',
            'new_meter_number_for_new_holder' => 'nullable|numeric',
            'status_for_new_holder' => 'nullable|string|max:255',
            'new_community_name' => 'nullable|string|max:255',
            'old_meter_number' => 'nullable|numeric',
            'new_meter_number' => 'nullable|numeric',
            'main_holder' => 'nullable|string|max:255',
            'comet_id_for_main_holder' => 'nullable|string|max:255',
            'meter_number_2' => 'nullable|numeric',
            'notes' => 'nullable|string',
        ]);

        $meterHistory->update($validated);

        return redirect()->route('meter-histories.index')
            ->with('success', 'Meter history record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MeterHistory $meterHistory)
    {
        $meterHistory->delete();

        return redirect()->route('meter-histories.index')
            ->with('success', 'Meter history record deleted successfully.');
    }

    /**
     * Show the import form.
     */
    public function importForm()
    {
        return view('meter-histories.import');
    }

    /**
     * Import meter history data from Excel file.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240', // 10MB max
        ]);

        try {
            $beforeCount = MeterHistory::count();
            $import = new MeterHistoryImport;
            Excel::import($import, $request->file('file'));
            $afterCount = MeterHistory::count();
            $importedCount = max(0, $afterCount - $beforeCount);

            return redirect()->route('meter-histories.index')
                ->with('success', "Meter history data imported successfully. Imported {$importedCount} records.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error importing file: ' . $e->getMessage());
        }
    }
}

/**
 * Import class for Excel files
 */
class MeterHistoryImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Check if the entire row is empty
        if ($this->isRowEmpty($row)) {
            \Log::info('Skipping empty row during import');
            return null; // Skip empty rows
        }

        // Normalize changed_date from Excel numeric or string formats
        $changedDateRaw = $row['changed_date'] ?? $row['changed date'] ?? null;
        $changedDate = null;
        if (is_numeric($changedDateRaw)) {
            try {
                $changedDate = Carbon::instance(ExcelDate::excelToDateTimeObject((float) $changedDateRaw))->format('Y-m-d');
            } catch (\Throwable $e) {
                $changedDate = null;
            }
        } elseif (!empty($changedDateRaw)) {
            try {
                $changedDate = Carbon::parse($changedDateRaw)->format('Y-m-d');
            } catch (\Throwable $e) {
                $changedDate = null;
            }
        }

        return new MeterHistory([
            'status' => $row['status'] ?? null,
            'reason' => $row['reason'] ?? null,
            'community' => $row['community'] ?? null,
            'english_name' => $row['english_name'] ?? $row['english name'] ?? null,
            'comet_id_household_public' => $row['comet_id_household_public'] ?? $row['comet id (household, public)'] ?? null,
            'comet_id_for_new_holder' => $row['comet_id_for_new_holder']
                ?? $row['comet id for the new household/public']
                ?? $row['comet id for the new household, public']
                ?? $row['comet id for the new holder']
                ?? null,
            'changed_date' => $changedDate,
            'meter_number' => $row['meter_number'] ?? $row['meter number'] ?? null,
            'household_status' => $row['household_status'] ?? $row['household status'] ?? null,
            'old_community_for_new_holder' => $row['old_community_for_new_holder'] ?? $row['old community for new holder'] ?? null,
            'new_community_for_new_holder' => $row['new_community_for_new_holder'] ?? $row['new community for new holder'] ?? null,
            'new_holder_name' => $row['new_holder_name'] ?? $row['new holder name (household/public)'] ?? null,
            'old_household_for_new_holder' => $row['old_household_for_new_holder'] ?? null,
            'new_household_for_new_holder' => $row['new_household_for_new_holder'] ?? null,
            'old_meter_number_for_new_holder' => $row['old_meter_number_for_new_holder'] ?? $row['old meter number for the new holder'] ?? null,
            'new_meter_number_for_new_holder' => $row['new_meter_number_for_new_holder'] ?? $row['new meter number for the new holder'] ?? null,
            'status_for_new_holder' => $row['status_for_new_holder'] ?? $row['status for the new holder'] ?? null,
            'new_community_name' => $row['new_community_name'] ?? $row['new community name'] ?? null,
            'old_meter_number' => $row['old_meter_number'] ?? $row['old meter number'] ?? null,
            'new_meter_number' => $row['new_meter_number'] ?? $row['new meter number'] ?? null,
            'main_holder' => $row['main_holder'] ?? $row['main holder'] ?? null,
            'comet_id_for_main_holder' => $row['comet_id_for_main_holder'] ?? $row['comet id for the main holder'] ?? null,
            'meter_number_2' => $row['meter_number_2'] ?? $row['meter number_2'] ?? null, // This maps to the second "Meter Number" column
            'notes' => $row['notes'] ?? null,
        ]);
    }

    /**
     * Check if a row is completely empty
     */
    private function isRowEmpty(array $row): bool
    {
        // Remove null values and empty strings
        $filteredRow = array_filter($row, function($value) {
            return $value !== null && $value !== '';
        });
        
        // If no non-empty values remain, the row is empty
        return empty($filteredRow);
    }

    public function rules(): array
    {
        return [
            // All fields are optional for this import
        ];
    }
}
