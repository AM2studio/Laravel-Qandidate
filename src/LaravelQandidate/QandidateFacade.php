<?php namespace AM2Studio\LaravelQandidate;

use Illuminate\Support\Facades\Facade;

/**
 * Class QandidateFacade
 * @package AM2Studio\LaravelQandidate
 */
class QandidateFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'qandidate';
    }
}
