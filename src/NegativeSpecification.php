<?php


namespace jlttt\Specify;


final class NegativeSpecification extends AbstractSpecification
{
    /**
     * @var SpecificationInterface
     */
    private $specification;

    protected function __construct(SpecificationInterface $specification) {
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
     * @return mixed
     */
    public function buildDqlConditions()
    {
        return ['NOT' => $this->specification->buildDqlConditions()];
    }
}
