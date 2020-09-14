<?php

use Atom\Validation\Scope;
use Atom\Validation\Validator;

class UserExistenceConstraint extends \Atom\Validation\Constraints\AbstractConstraint
{

    public function validate(string $field, array $data = []): bool
    {
        // TODO: Implement validate() method.
    }

    public function getKey(): string
    {
        // TODO: Implement getKey() method.
    }

    public function getFallbackErrorMessage(string $field): string
    {
        // TODO: Implement getFallbackErrorMessage() method.
    }
}

$v = new Validator();

$v->assert("title")->is()->present()->filled()->alphaNumeric()->and()->between(2, 255);
$v->assert("image")->on(Scope::files())->is()->present()->file()->and()->image();
$v->assert("description")->is()->present()->and()->filled();
$v->assert("post_type")->is()->present()->filled()->and()->in(["ARTICLE","PAGE"]);
$v->assert("user_id")->is()->present()->filled()->numeric()->integer()->and()->follows(new UserExistenceConstraint());
$v->assert("created_at")->is()->present()->filled()->date()->and()->before("now");

$v->check($request);
if ($v->failed()) {
    echo "validation failed";
}
