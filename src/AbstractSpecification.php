<?php


namespace jlttt\Specify;


abstract class AbstractSpecification implements SpecificationInterface
{
    /**
     * @return NegativeSpecification
     */
    public function not() {
        return new NegativeSpecification($this);
    }

    /**
     * @return ConjunctiveSpecification
     */
    public function and(SpecificationInterface $specification) {
        return new ConjunctiveSpecification($this, $specification);
    }

    /**
     * @return DisjunctiveSpecification
     */
    public function or(SpecificationInterface $specification) {
        return new DisjunctiveSpecification($this, $specification);
    }
}