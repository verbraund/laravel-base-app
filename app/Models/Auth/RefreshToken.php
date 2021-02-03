<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefreshToken extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'admin_id',
        'token',
        'user_agent',
        'ip_address',
        'expiration_in',
    ];


    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function scopeToken($query, $value){
        return $query->where('token', $value);
    }
}
