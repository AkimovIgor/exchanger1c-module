<?php


namespace Modules\Exchanger1C\Services;


use Bigperson\Exchange1C\Services\CatalogService as BaseCatalogService;

class CatalogService extends BaseCatalogService
{
    public function import(): string
    {
        $this->authService->auth();
        $filename = $this->request->get('filename');
        if ($filename == 'import.xml' || $filename == 'import0_1.xml') {
            $this->categoryService->import();
        } elseif ($filename == 'offers.xml' || $filename == 'offers0_1.xml') {
            $this->offerService->import();
        }

        $response = "success\n";
        $response .= "laravel_session\n";
        $response .= $this->request->getSession()->getId()."\n";
        $response .= 'timestamp='.time();

        return $response;
    }
}
