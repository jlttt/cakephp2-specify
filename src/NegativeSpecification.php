<?php


namespace jlttt\Specify;


final class NegativeSpecification
{
    /**
     * @var Specification
     */
    private $specification;


    public function __construct(Specification $specification) {
        $this->specification = $specification;
    }

    /**
     * @param mixed $candidate
     * @return boolean
     */
    public function isSatisfiedBy($candidate) {
        return !$this->specification->isSatisfiedBy($candidate);
    }
}