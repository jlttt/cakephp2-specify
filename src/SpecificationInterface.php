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
     * @return NegativeSpecification
     */
    public function not();
}
