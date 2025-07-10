<?php

namespace App\Models;

use App\Enums\LeadStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lead';

    protected $hidden = [
        'id',
        'deleted_at',
        'deleted_by',
    ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'status' => LeadStatus::class,
    ];

    protected static function booted()
    {
        static::creating(function ($data) {
            $data->public_id = (string) Str::uuid();
        });

        static::updating(function ($data) {
            $data->updated_at = now();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'public_id';
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->timezone('Asia/Jakarta')->format('d-m-Y H:i:s'),
        );
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->timezone('Asia/Jakarta')->format('d-m-Y H:i:s'),
        );
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by')
            ->select('id', 'public_id', 'name');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by')
            ->select('id', 'public_id', 'name');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by')
            ->select('id', 'public_id', 'name');
    }
}
