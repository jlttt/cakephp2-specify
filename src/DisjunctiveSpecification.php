<?php


namespace jlttt\Specify;


final class DisjunctiveSpecification extends AbstractSpecification
{
    /**
     * @var SpecificationInterface[]
     */
    private $specifications;

    protected function __construct(SpecificationInterface ...$specifications) {
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
                return $satisfied || $specification->isSatisfiedBy($candidate);
            },
            false
        );
    }

    /**
     * @return mixed
     */
    public function buildDqlConditions()
    {
        $conditions = array_reduce(
            $this->specifications,
            function($conditions, $specification) {
                $conditions[] = $specification->buildDqlConditions();
                return $conditions;
            },
            []
        );
        return ['OR' => $conditions];
    }
}