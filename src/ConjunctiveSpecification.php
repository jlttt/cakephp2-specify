<?php


namespace jlttt\Specify;


final class ConjunctiveSpecification extends AbstractSpecification
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
        return array_reduce(
            $this->specifications,
            function($satisfied, $specification) use ($candidate) {
                return $satisfied && $specification->isSatisfiedBy($candidate);
            },
            true
        );
    }
}