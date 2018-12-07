<?php


namespace jlttt\Specify;


final class Specification
{
    /**
     * @param mixed $candidate
     * @return boolean
     */
    public function isSatisfiedBy($candidate) {
        return true;
    }
}