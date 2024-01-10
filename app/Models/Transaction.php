<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'initiator',
        'moderator',
        'transaction_type',
        'amount',
        'reference',
        'mode',
        'contact_type',
        'contact',
        'status'
    ];

    public function initiator(){
        return $this->belongsTo(User::class, 'initiator');
    }

    public function moderator(){
        return $this->belongsTo(User::class, 'moderator');
    }

}
