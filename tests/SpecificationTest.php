<?php
namespace jlttt\Tests;

use PHPUnit\Framework\TestCase;
use jlttt\Specify\Specification;
use jlttt\Specify\NegativeSpecification;

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
        $specification = (new Specification('foo', 'bar'))->andX(new Specification('fizz', 'buzz'));
        $candidate = ['foo' => 'bar'];
        $this->assertFalse($specification->isSatisfiedBy($candidate));
    }

    public function testConjunctiveSpecificationSatisfied() {
        $specification = (new Specification('foo', 'bar'))->andX((new Specification('fizz', 'buzz'))->not());
        $candidate = ['foo' => 'bar'];
        $this->assertTrue($specification->isSatisfiedBy($candidate));
    }

    public function testDisjunctiveSpecificationSatisfied() {
        $specification = (new Specification('foo', 'bar'))->orX(new Specification('fizz', 'buzz'));
        $candidate = ['foo' => 'bar'];
        $this->assertTrue($specification->isSatisfiedBy($candidate));
    }

    public function testDisjunctiveSpecificationNotSatisfied() {
        $specification = (new Specification('fizz', 'buzz'))->orX((new Specification('foo', 'bar'))->not());
        $candidate = ['foo' => 'bar'];
        $this->assertFalse($specification->isSatisfiedBy($candidate));
    }

    public function testBuildDQLConditionsFromSimpleSpecification() {
        $specification = new Specification('foo', 'bar');
        $expected = ['foo' => 'bar'];
        $this->assertEquals($expected, $specification->buildDqlConditions());
    }

    public function testBuildDQLConditionsFromNegativeSpecification() {
        $specification = (new Specification('foo', 'bar'))->not();
        $expected = ['NOT' => ['foo' => 'bar']];
        $this->assertEquals($expected, $specification->buildDqlConditions());
    }

    public function testBuildDQLConditionsFromConjunctiveSpecification() {
        $specification = (new Specification('foo', 'bar'))->andX(new Specification('fizz', 'buzz'));
        $expected = [
            ['foo' => 'bar'],
            ['fizz' =>'buzz'],
        ];
        $this->assertEquals($expected, $specification->buildDqlConditions());
    }

    public function testBuildDQLConditionsFromDisjunctiveSpecification() {
        $specification = (new Specification('foo', 'bar'))->orX(new Specification('fizz', 'buzz'));
        $expected = [
            'OR' => [
                ['foo' => 'bar'],
                ['fizz' =>'buzz'],
            ]
        ];
        $this->assertEquals($expected, $specification->buildDqlConditions());
    }
}
