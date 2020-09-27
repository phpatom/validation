<?php

namespace Atom\Validation;

use Atom\Validation\Constraints\AlphabeticOnlyConstraint;
use Atom\Validation\Constraints\AlphaNumericOnlyConstraint;
use Atom\Validation\Constraints\ArrayConstraint;
use Atom\Validation\Constraints\BetweenConstraint;
use Atom\Validation\Constraints\BooleanConstraint;
use Atom\Validation\Constraints\Date\AfterDateConstraint;
use Atom\Validation\Constraints\Date\AfterOrEqualsDateConstraint;
use Atom\Validation\Constraints\Date\BeforeDateConstraint;
use Atom\Validation\Constraints\Date\BeforeOrEqualsDateConstraint;
use Atom\Validation\Constraints\Date\DateEqualsConstraint;
use Atom\Validation\Constraints\Date\DateFormatConstraint;
use Atom\Validation\Constraints\DifferenceConstraint;
use Atom\Validation\Constraints\EmailConstraint;
use Atom\Validation\Constraints\EqualityConstraint;
use Atom\Validation\Constraints\FileConstraint;
use Atom\Validation\Constraints\FilledConstraint;
use Atom\Validation\Constraints\ImageConstraint;
use Atom\Validation\Constraints\InConstraint;
use Atom\Validation\Constraints\IntegerConstraint;
use Atom\Validation\Constraints\Length\GreaterThanConstraint;
use Atom\Validation\Constraints\Length\GreaterThanOrEqualsConstraint;
use Atom\Validation\Constraints\Length\LessThanConstraint;
use Atom\Validation\Constraints\Length\LessThanOrEqualsConstraint;
use Atom\Validation\Constraints\NonEqualityConstraint;
use Atom\Validation\Constraints\NotInConstraint;
use Atom\Validation\Constraints\PatternMatchConstraint;
use Atom\Validation\Constraints\PatternMismatchConstraint;
use Atom\Validation\Constraints\PresenceConstraint;
use Atom\Validation\Constraints\StrictEqualityConstraint;
use Atom\Validation\Contracts\ValidationConstraintContract;
use Atom\Validation\Constraints\AcceptedConstraint;
use Atom\Validation\Constraints\NotNullConstraint;
use Atom\Validation\Constraints\NumericConstraint;

class ConstraintFactory
{
    /**
     * @var Expectation
     */
    private $expectation;

    public function __construct($expectation)
    {
        $this->expectation = $expectation;
    }

    public function notNull(): self
    {
        $this->expectation->addConstraint(new NotNullConstraint());
        return $this;
    }

    public function numeric(): self
    {
        $this->expectation->addConstraint(new NumericConstraint());
        return $this;
    }

    public function accepted(): self
    {
        $this->expectation->addConstraint(new AcceptedConstraint());
        return $this;
    }

    public function follows(ValidationConstraintContract $rule): self
    {
        $this->expectation->addConstraint($rule);
        return $this;
    }

    public function alphabetic(): self
    {
        $this->expectation->addConstraint(new AlphabeticOnlyConstraint());
        return $this;
    }

    public function alphaNumeric(): self
    {
        $this->expectation->addConstraint(new AlphaNumericOnlyConstraint());
        return $this;
    }

    public function array(): self
    {
        $this->expectation->addConstraint(new ArrayConstraint());
        return $this;
    }

    public function between(float $min, float $max): self
    {
        $this->expectation->addConstraint(new BetweenConstraint($min, $max));
        return $this;
    }

    public function boolean(): self
    {
        $this->expectation->addConstraint(new BooleanConstraint());
        return $this;
    }

    public function differentFrom(string $field): self
    {
        $this->expectation->addConstraint(new DifferenceConstraint($field));
        return $this;
    }

    public function email(): self
    {
        $this->expectation->addConstraint(new EmailConstraint());
        return $this;
    }

    public function equalsTo($value): self
    {
        $this->expectation->addConstraint(new EqualityConstraint($value));
        return $this;
    }

    public function file(): self
    {
        $this->expectation->addConstraint(new FileConstraint());
        return $this;
    }

    public function filled(): self
    {
        $this->expectation->addConstraint(new FilledConstraint());
        return $this;
    }

    public function image(): self
    {
        $this->expectation->addConstraint(new ImageConstraint());
        return $this;
    }

    public function in(array $data): self
    {
        $this->expectation->addConstraint(new InConstraint($data));
        return $this;
    }

    public function notEqualsTo($value): self
    {
        $this->expectation->addConstraint(new NonEqualityConstraint($value));
        return $this;
    }

    public function notIn(array $values): self
    {
        $this->expectation->addConstraint(new NotInConstraint($values));
        return $this;
    }

    public function matching(string $pattern): self
    {
        $this->expectation->addConstraint(new PatternMatchConstraint($pattern));
        return $this;
    }

    public function notMatching(string $pattern): self
    {
        $this->expectation->addConstraint(new PatternMismatchConstraint($pattern));
        return $this;
    }

    public function present(): self
    {
        $this->expectation->addConstraint(new PresenceConstraint());
        return $this;
    }

    public function presentAndFilled(): self
    {
        $this->expectation->addConstraint(new PresenceConstraint());
        $this->expectation->addConstraint(new FilledConstraint());
        return $this;
    }

    public function strictlyEqualsTo($value): self
    {
        $this->expectation->addConstraint(new StrictEqualityConstraint($value));
        return $this;
    }

    public function greaterThan(float $minimum): self
    {
        $this->expectation->addConstraint(new GreaterThanConstraint($minimum));
        return $this;
    }

    public function greaterThanOrEquals(float $minimum): self
    {
        $this->expectation->addConstraint(new GreaterThanOrEqualsConstraint($minimum));
        return $this;
    }
    public function lessThan(float $maximum): self
    {
        $this->expectation->addConstraint(new LessThanConstraint($maximum));
        return $this;
    }

    public function lessThanOrEquals(float $maximum): self
    {
        $this->expectation->addConstraint(new LessThanOrEqualsConstraint($maximum));
        return $this;
    }

    public function after(string $date): self
    {
        $this->expectation->addConstraint(new AfterDateConstraint($date));
        return $this;
    }

    public function afterOrEquals(string $date): self
    {
        $this->expectation->addConstraint(new AfterOrEqualsDateConstraint($date));
        return $this;
    }

    public function before(string $date): self
    {
        $this->expectation->addConstraint(new BeforeDateConstraint($date));
        return $this;
    }

    public function beforeOrEquals(string $date): self
    {
        $this->expectation->addConstraint(new BeforeOrEqualsDateConstraint($date));
        return $this;
    }

    public function equalsDate(string $date): self
    {
        $this->expectation->addConstraint(new DateEqualsConstraint($date));
        return $this;
    }

    public function followingDateFormat(string $format): self
    {
        $this->expectation->addConstraint(new DateFormatConstraint($format));
        return $this;
    }

    public function integer(): self
    {
        $this->expectation->addConstraint(new IntegerConstraint());
        return $this;
    }

    public function date(): self
    {
        $this->expectation->addConstraint(new Constraints\Date\DateConstraint());
        return $this;
    }

    public function and()
    {
        return $this;
    }
}
