<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kpi extends Model
{
	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'kpis';

	/**
     * The attributes that are not mass assignable.
     *
     * @var array
  	*/
   protected $guarded = ['id'];

	/**
   * Fillable fields for a Profile.
   *
   * @var array
   */
	protected $fillable = [
	   'name',
	   'code',
	   'unit',
	   'trend',
	   'percent',
	   'target',
	   'perform',
	   'per_perform',
	   'score',
	   'efficiency',
	   'user_id',
	];

	public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id', 'id');
	}
}
