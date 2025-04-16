<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserActivity extends Model
{
    // Table name (optional if following Laravel conventions)
    protected $table = 'user_activities';

    // Primary key column
    protected $primaryKey = 'user_activity_id';

    // Disable timestamps management (no updated_at auto-handling)
    public $timestamps = false;

    // Fillable fields for mass-assignment
    protected $fillable = [
        'user_id',
        'activity_name',
        'description',
        'created_at',
        'ip_address',
    ];

    /**
     * Get the user that owns the activity.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeWeeklyReport($query)
    {
        return $query->where('created_at', '>=', now()->subWeek());
    }
}
