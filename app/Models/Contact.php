<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $fillable = ['name','company','email','phone','project'];

    /**
     * Let's keep our data clean. Format phone numbers consistently.
     */
    public function setPhoneAttribute($value)
    {
    	$this->attributes['phone'] = preg_replace("/\(?([0-9]{3})\)?[.\- ]?([0-9]{3})[.\- ]?([0-9]{4})/", "($1) $2-$3", $value);
    }

    /**
     * Convert our array of project types to a comma separated string.
     */
    public function setProjectAttribute($value)
    {
    	$this->attributes['project'] = implode(', ', $value);
    }

}
