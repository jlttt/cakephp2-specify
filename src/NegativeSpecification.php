<?php


namespace jlttt\Specify;


final class NegativeSpecification implements SpecificationInterface
{
    /**
     * @var SpecificationInterface
     */
    private $specification;


    public function __construct(SpecificationInterface $specification) {
        $this->specification = $specification;
    }

    /**
     * @param mixed $candidate
     * @return boolean
     */
    public function isSatisfiedBy($candidate) {
        return !$this->specification->isSatisfiedBy($candidate);
    }

    /**
     * @return SpecificationInterface
     */
    public function not() {
        return new NegativeSpecification($this);
    }
}