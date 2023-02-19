<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'item_id',
        'nominal',
        'information',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function approval()
    {
        return $this->belongsTo(RequestsApproval::class, 'id', 'requests_id');
    }

    public function finance()
    {
        return $this->belongsTo(RequestsFinance::class, 'id', 'requests_id');
    }
}
