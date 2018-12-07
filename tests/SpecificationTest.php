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

    public function testConjunctiveSpecificationSatisfied() {
        $specification = (new Specification('foo', 'bar'))->and((new Specification('fizz', 'buzz'))->not());
        $candidate = ['foo' => 'bar'];
        $this->assertTrue($specification->isSatisfiedBy($candidate));
    }

    public function testDisjunctiveSpecificationSatisfied() {
        $specification = (new Specification('foo', 'bar'))->or(new Specification('fizz', 'buzz'));
        $candidate = ['foo' => 'bar'];
        $this->assertTrue($specification->isSatisfiedBy($candidate));
    }

    public function testDisjunctiveSpecificationNotSatisfied() {
        $specification = (new Specification('fizz', 'buzz'))->or((new Specification('foo', 'bar'))->not());
        $candidate = ['foo' => 'bar'];
        $this->assertFalse($specification->isSatisfiedBy($candidate));
    }
}
