<?php
namespace jlttt\Specify;

abstract class AbstractSpecification implements SpecificationInterface
{
    /**
     * @return NegativeSpecification
     */
    public function not()
    {
        return new NegativeSpecification($this);
    }

    /**
     * @return ConjunctiveSpecification
     */
    public function andX(SpecificationInterface $specification)
    {
        return new ConjunctiveSpecification($this, $specification);
    }

    /**
     * @return DisjunctiveSpecification
     */
    public function orX(SpecificationInterface $specification)
    {
        return new DisjunctiveSpecification($this, $specification);
    }
}
