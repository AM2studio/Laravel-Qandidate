<?php namespace AM2Studio\LaravelQandidate\Models;

use Illuminate\Database\Eloquent\Model;

class Toggle extends Model
{

    protected $table    = 'am2_qandidate_toggles';
    public $fillable    = ['name', 'status'];

    public function conditions()
    {
        return $this->hasMany('AM2Studio\LaravelQandidate\Models\Condition');
    }
}
