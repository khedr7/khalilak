<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = 'contacts';
	
    protected $fillable = ['user_id', 'fname', 'lname', 'email', 'mobile', 'message','reason_id', 'contact'];

    // one to many
    public function reason()
    {
        return $this->belongsTo(Contactreason::class, 'reason_id');
    }
}
