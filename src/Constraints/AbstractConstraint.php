<?php


namespace Atom\Validation\Constraints;

use Atom\Validation\Contracts\ValidationConstraintContract;
use Exception;
use Psr\Http\Message\UploadedFileInterface;

abstract class AbstractConstraint implements ValidationConstraintContract
{
    abstract public function validate(string $field, array $data = []): bool;

    public function check($field, array $data = []): ?string
    {
        if (!$this->validate($field, $data)) {
            return $this->getKey();
        }
        return null;
    }

    public function exist($field, $data)
    {
        return array_key_exists($field, $data);
    }

    /**
     * @param $field
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function value($field, $data)
    {
        if (!$this->exist($field, $data)) {
            throw new Exception("The field $field does not exists");
        }
        return $data[$field];
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return [];
    }

    /**
     * @param string $key
     * @param array $data
     * @return float
     * @throws Exception
     */
    public function lengthOf(string $key, array $data):float
    {
        $value = $this->value($key, $data);
        if (is_numeric($value)) {
            return (float)$value;
        }
        if (is_string($value)) {
            return (float)strlen($value);
        }
        if (is_array($value)) {
            return (float)count($value);
        }
        if ($value instanceof UploadedFileInterface) {
            return (float)$value->getSize();
        }
        throw new \Exception("we are unable to get the size/length of $key");
    }

    public function isNotEmpty(string $key, array $data):float
    {
        $value = $this->value($key, $data);
        $isNotEmpty  = true;
        $isNotEmpty = $isNotEmpty && !is_null($key);
        $isNotEmpty = $isNotEmpty && ($value !=  "");
        if (is_array($value) || is_countable($value)) {
            $isNotEmpty = $isNotEmpty && (count($value) != 0);
        }
        if ($value instanceof  UploadedFileInterface) {
            $isNotEmpty = $isNotEmpty && ($value->getClientFilename() != "");
        }
        return $isNotEmpty;
    }

    public function isFile($value)
    {
        return $value instanceof UploadedFileInterface;
    }
}
