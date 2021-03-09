<?php


namespace App\Controller;


use App\Entity\ProductMedia;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CreateProductMediaAction
{
    public function __invoke(Request $request): ProductMedia
    {
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        $productMedia = new ProductMedia();
        $productMedia->setFile($uploadedFile);

        return $productMedia;
    }
}
