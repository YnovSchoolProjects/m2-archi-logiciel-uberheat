<?php


namespace App\Controller;


use App\Service\ProductConfigurationImport\ImportService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImportController extends AbstractController
{

    /**
     * @Route(methods={"POST"}, name="api_product_configuration_import_csv", path="api/product_configuration/import.{format<(csv|json)>}")
     */
    public function import(Request $request, ImportService $importService, string $format): JsonResponse
    {
        if ($request->request->get('import', null) === null) {
            return $this->json('File "import" not found', Response::HTTP_BAD_REQUEST);
        }

        $importService->importProductConfiguration($request->request->get('import'), $format);
        return $this->json('Ok');
    }

}
