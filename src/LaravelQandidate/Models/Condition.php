<?php namespace AM2Studio\LaravelQandidate\Models;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{

    protected $table    = 'am2_qandidate_conditions';
    public $fillable    = ['toggle_id', 'name', 'key', 'operator', 'value'];

    public function toggle()
    {
        return $this->belongsTo('AM2Studio\LaravelQandidate\Models\Toggle');
    }
}
