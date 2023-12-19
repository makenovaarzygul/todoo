<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $table = 'todo';
   	protected $fillable = ['name','status','priority','due_date', 'user_id', 'is_sent'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
   	//items
   	public function items()
   	{
   		return $this->hasMany(Item::class);
   	}



    protected $dates = ['due_date'];


}
