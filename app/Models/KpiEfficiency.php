<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpiEfficiency extends Model
{
	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'kpi_efficiency';

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
	   'user_id',
	   'total',
	   'rank',
	];

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

}
