<?php

use PHPUnit\Framework\TestCase;
use jlttt\Specify\Specification;

final class SpecificationTest extends TestCase {
    public function testSatisfiedBySimpleCandidate() {
        $specification = new Specification('foo', 'bar');
        $candidate = ['foo' => 'bar'];
        $this->assertTrue($specification->isSatisfiedBy($candidate));
    }

    public function testNotSatisfiedBySimpleCandidateWithDifferentKey() {
        $specification = new Specification('foo', 'bar');
        $candidate = ['baz' => 'bar'];
        $this->assertFalse($specification->isSatisfiedBy($candidate));
    }
}
