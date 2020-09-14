<?php


namespace Atom\Validation\Constraints;

use Psr\Http\Message\UploadedFileInterface;

class ImageConstraint extends AbstractConstraint
{

    public function validate(string $field, array $data = []): bool
    {
        /**
         * @var $file UploadedFileInterface
         */
        $file = $this->value($field, $data);
        return $this->isFile($file) && $this->isValidFile($file);
    }

    public function getKey(): string
    {
        return "image";
    }


    public function getFallbackErrorMessage(string $field): string
    {
        return "$field should be an image";
    }

    private function isValidFile(UploadedFileInterface $file)
    {
        return in_array(strtolower(pathinfo($file->getClientFilename(), PATHINFO_EXTENSION)), [
            "jpeg","png","bmp","gif","svg","webp","jpg"
        ]);
    }
}
