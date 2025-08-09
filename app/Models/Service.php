<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'nim', 'email', 'type', 'phone', 'line', 'organization', 'title', 
        'event_name', 'description', 'date', 'start_time', 'end_time', 
        'location', 'person', 'medical_equipment', 'note', 'status'
    ];

    // Define possible status values
    public const STATUS_PENDING = 'Pending';
    public const STATUS_ON_PROGRESS = 'On Progress';
    public const STATUS_COMPLETED = 'Completed';
    public const STATUS_CANCELED = 'Canceled';

    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_ON_PROGRESS,
            self::STATUS_COMPLETED,
            self::STATUS_CANCELED
        ];
    }

    protected $guarded = ['created_at', 'updated_at'];
    
    protected $casts = [
        'medical_equipment' => 'array' // Cast ke array
    ];

    public function getFormattedDateAttribute(): string
    {
        return Carbon::parse($this->attributes['date'])->format('d-m-Y');
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d-m-Y H:i');
    }
    
    // Accessor untuk menampilkan alat kesehatan sebagai string
    public function getMedicalEquipmentListAttribute()
    {
        return $this->medical_equipment 
            ? implode(', ', $this->medical_equipment)
            : 'Tidak ada alat yang dipilih';
    }

    
}