<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class MeterHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'reason',
        'community',
        'english_name',
        'comet_id_household_public',
        'changed_date',
        'meter_number',
        'household_status',
        'old_community_for_new_holder',
        'new_community_for_new_holder',
        'new_holder_name',
        'comet_id_for_new_holder',
        'old_household_for_new_holder',
        'new_household_for_new_holder',
        'old_meter_number_for_new_holder',
        'new_meter_number_for_new_holder',
        'status_for_new_holder',
        'new_community_name',
        'old_meter_number',
        'new_meter_number',
        'main_holder',
        'comet_id_for_main_holder',
        'meter_number_2',
        'notes',
    ];

    protected $casts = [
        'changed_date' => 'date',
        'meter_number' => 'integer',
        'old_meter_number_for_new_holder' => 'integer',
        'new_meter_number_for_new_holder' => 'integer',
        'old_meter_number' => 'integer',
        'new_meter_number' => 'integer',
        'meter_number_2' => 'integer',
    ];

    // Scopes for filtering
    public function scopeByCommunity($query, $community)
    {
        return $query->where('community', 'like', "%{$community}%");
    }

    public function scopeByMeterNumber($query, $meterNumber)
    {
        return $query->where('meter_number', $meterNumber);
    }

    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('changed_date', [$startDate, $endDate]);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByHouseholdStatus($query, $householdStatus)
    {
        return $query->where('household_status', $householdStatus);
    }

    // Accessor for formatted changed date
    public function getFormattedChangedDateAttribute()
    {
        return $this->changed_date ? $this->changed_date->format('M d, Y') : null;
    }

    // Accessor for main holder display
    public function getMainHolderDisplayAttribute()
    {
        return $this->main_holder ?: $this->english_name;
    }
}
