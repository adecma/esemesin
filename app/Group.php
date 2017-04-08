<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'description'];

    public function setNameAttribute($value)
    {
    	$this->attributes['name'] = studly_case($value);
    }

    public function contacts()
    {
    	return $this->belongsToMany(Contact::class);
    }

    public function scopeSearch($query, $word)
	{
		$query->where('name', 'like', "%{$word}%")
			->orWhere('description', 'like', "%{$word}%");
	}
}
