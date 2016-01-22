<?php namespace AM2Studio\LaravelQandidate\Exceptions;

/**
 * Class QandidateException
 * @package AM2Studio\LaravelQandidate\Exceptions
 */
class QandidateException extends \Exception
{

    /**
     * QandidateException constructor.
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return __CLASS__ . " : [{$this->code}]: {$this->message}\n";
    }
}
