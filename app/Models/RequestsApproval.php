<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestsApproval extends Model
{
    use HasFactory;

    protected $table = 'requests_approval';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'requests_id',
        'approved_by',
        'information',
    ];

    public function requests()
    {
        return $this->belongsTo(Requests::class, 'requests_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
