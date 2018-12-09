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
     * @return mixed
     */
    public function buildDqlConditions();

    /**
     * @return NegativeSpecification
     */
    public function not();

    /**
     * @return ConjunctiveSpecification
     */
    public function andX(SpecificationInterface $specification);

    /**
     * @return DisjunctiveSpecification
     */
    public function orX(SpecificationInterface $specification);
}
