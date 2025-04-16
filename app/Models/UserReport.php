<?php

// app/Models/UserReport.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{
    protected $fillable = ['user_id', 'file_path', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
