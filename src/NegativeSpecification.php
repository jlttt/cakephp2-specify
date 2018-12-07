<?php


namespace jlttt\Specify;


final class NegativeSpecification extends AbstractSpecification
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
}
