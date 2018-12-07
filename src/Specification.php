<?php


namespace jlttt\Specify;


final class Specification
{
    /**
     * @var key associated to the specification
     */
    private $key;

    /**
     * @param $value associated to the specification
     */
    private $value;

    public function __construct($key, $value) {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @param mixed $candidate
     * @return boolean
     */
    public function isSatisfiedBy($candidate) {
        return isset($candidate[$this->key]) && $candidate[$this->key] === $this->value;
    }

    /**
     * @return Specification
     */
    public function not() {
        return new NegativeSpecification($this);
    }
}