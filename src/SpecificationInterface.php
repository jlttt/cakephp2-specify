<?php


namespace jlttt\Specify;


interface SpecificationInterface
{
    /**
     * @param mixed $candidate
     * @return boolean
     */
    public function isSatisfiedBy($candidate);

    /**
     * @return SpecificationInterface
     */
    public function not();
}