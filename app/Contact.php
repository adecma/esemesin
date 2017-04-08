<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $fillable = ['name', 'phoneNumber'];

	public function setNameAttribute($value)
	{
		$this->attributes['name'] = title_case($value);
	}

	public function groups()
	{
		return $this->belongsToMany(Group::class);
	}

	public function scopeSearch($query, $word)
	{
		$query->where('name', 'like', "%{$word}%")
			->orWhere('phoneNumber', 'like', "%{$word}%");
	}
}
