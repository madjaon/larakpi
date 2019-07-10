<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpiUnit extends Model
{
	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'kpi_unit';

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
	];
}
