<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Entity\Media;
use App\Service\FileUploader;

#[AsController]
final class MediaController extends AbstractController
{
    public function __invoke(Request $request, FileUploader $fileUploader):Media
    {
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        $mediaObject = new Media();
        $mediaObject->filePath = $fileUploader->upload($uploadedFile);

        return $mediaObject;
    }
}