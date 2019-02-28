<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group_list extends Model
{
    protected $table = 'group_list';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'group_id'
    ];

    public function group(){
        return $this->hasOne(Groups::class, 'id', 'group_id');
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
