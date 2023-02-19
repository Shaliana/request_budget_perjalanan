<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestsFinance extends Model
{
    use HasFactory;

    protected $table = 'requests_finance';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'requests_id',
        'bukti_transfer',
        'information',
    ];

    public function requests()
    {
        return $this->belongsTo(Requests::class, 'requests_id');
    }
    
}
