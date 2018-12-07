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

    public function testNotSatisfiedBySimpleCandidateWithDifferentValue() {
        $specification = new Specification('foo', 'bar');
        $candidate = ['foo' => 'baz'];
        $this->assertFalse($specification->isSatisfiedBy($candidate));
    }

    public function testNegatedSpecification() {
       $specification = (new Specification('foo', 'bar'))->not();
       $candidate = ['firstKey' => 'firstValue', 'foo' => 'bar', 'secondKey' => 'secondValue'];
       $this->assertFalse($specification->isSatisfiedBy($candidate));
    }

    public function testTwiceNegatedSpecification() {
        $specification = (new Specification('foo', 'bar'))->not()->not();
        $candidate = ['foo' => 'bar'];
        $this->assertTrue($specification->isSatisfiedBy($candidate));
    }

    public function testConjonctiveSpecificationNotSatisfied() {
        $specification = (new Specification('foo', 'bar'))->and(new Specification('fizz', 'buzz'));
        $candidate = ['foo' => 'bar'];
        $this->assertFalse($specification->isSatisfiedBy($candidate));
    }

    public function testConjonctiveSpecificationSatisfied() {
        $specification = (new Specification('foo', 'bar'))->and((new Specification('fizz', 'buzz'))->not());
        $candidate = ['foo' => 'bar'];
        $this->assertTrue($specification->isSatisfiedBy($candidate));
    }
}
