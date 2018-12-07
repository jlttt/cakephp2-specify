<?php


namespace jlttt\Specify;


final class DisjunctiveSpecification extends AbstractSpecification
{
    /**
     * @var SpecificationInterface[]
     */
    private $specifications;

    public function __construct(SpecificationInterface ...$specifications) {
        $this->specifications = $specifications;
    }

    /**
     * @param mixed $candidate
     * @return boolean
     */
    public function isSatisfiedBy($candidate) {
        return true;
    }
}