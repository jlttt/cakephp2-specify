<?php


namespace jlttt\Specify;


final class Specification
{
    private $key;

    public function __construct($key) {
        $this->key = $key;
    }

    /**
     * @param mixed $candidate
     * @return boolean
     */
    public function isSatisfiedBy($candidate) {
        return isset($candidate[$this->key]);
    }
}