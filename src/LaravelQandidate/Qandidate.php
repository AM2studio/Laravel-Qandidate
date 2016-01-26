<?php namespace AM2Studio\LaravelQandidate;

use AM2Studio\LaravelQandidate\Exceptions\QandidateException;
use AM2Studio\LaravelQandidate\Models\Toggle as DBToggle;
use Qandidate\Toggle\Context;
use Qandidate\Toggle\OperatorCondition;
use Qandidate\Toggle\Toggle;
use Qandidate\Toggle\ToggleCollection\InMemoryCollection;
use Qandidate\Toggle\ToggleManager;

/**
 * Class Qandidate
 * @package AM2Studio\LaravelQandidate
 */
class Qandidate
{
    /**
     * @var Qandidate\Toggle\ToggleManager
     */
    protected $manager;
    /**
     * @var AM2Studio\LaravelQandidate\Models\Toggle
     */
    protected $toggle;
    /**
     * @var AM2Studio\LaravelQandidate\Models\Condition
     */
    protected $condition;

    /**
     * Qandidate constructor.
     */
    public function __construct()
    {
        $this->manager = new ToggleManager(new InMemoryCollection());
    }

    /**
     * It checks whether feature is active or not
     *
     * @param null $featureName
     * @param array $attributes
     * @throws QandidateException
     * @return True
     */
    public function active($featureName = null, $attributes = [])
    {
        if (!$featureName) {
            throw new QandidateException(
                "Feature name must not be empty"
            );
        }

        if (!is_array($attributes)) {
            throw new QandidateException(
                "Attribute must be an instance of array"
            );
        }

        $this->getToggleConditions($featureName);
        
        $conditionCollection = [];
        foreach ($this->conditions as $condition) {
            $class = $this->convertStringToClass($condition->operator);
            if ('Qandidate\Toggle\Operator\InSet' === $class) {
                $value = [$condition->value];
            } else {
                $value = $condition->value;
            }
            $operator              = new $class($value);
            $conditionCollection[] = new OperatorCondition(
                $condition->key,
                $operator
            );
        }
        $toggle    = new Toggle('toggling', $conditionCollection);
        $constName = $this->convertStringToConstant(
            $this->toggle->status
        );
        if ('INACTIVE' === $constName) {
            $toggle->deactivate();
        } else {
            $toggle->activate(constant('Qandidate\Toggle\Toggle::'.$constName));
        }
        $this->manager->add($toggle);
        $context = new Context();
        foreach ($attributes as $key => $value) {
            $context->set($key, $value);
        }

        return $this->manager->active('toggling', $context);
    }

    /**
     * Converts string to class
     *
     * @param $string
     * @return string
     */
    private function convertStringToClass($string)
    {
        $className = str_replace(
            "-",
            "",
            mb_convert_case($string, MB_CASE_TITLE)
        );
        return 'Qandidate\Toggle\Operator\\'.$className;
    }

    /**
     * Converts string to constant
     *
     * @param $string
     * @return mixed
     */
    private function convertStringToConstant($string)
    {
        $constName = str_replace(
            "-",
            "_",
            mb_convert_case($string, MB_CASE_UPPER)
        );
        return $constName;
    }

    /**
     * Sets toggle and condition variable based on feature name
     *
     * @param $featureName
     */
    private function getToggleConditions($featureName)
    {
        $this->toggle     = DBToggle::where('name', $featureName)->firstOrFail();
        $this->conditions = $this->toggle->conditions;
    }
}
