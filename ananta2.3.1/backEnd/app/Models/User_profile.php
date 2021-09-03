<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_profile extends Model
{
    use HasFactory;
    protected $table = 'user_profile';
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id','account_id','f_name','l_name','email','image','birthday'];

    function account(){
        return $this->hasOne(Account::class,'account_id','account_id');
    }
}
