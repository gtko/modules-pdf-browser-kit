<?php

namespace Modules\PdfBrowserKit\Services;

use dawood\phpChrome\Chrome;
use HeadlessChromium\BrowserFactory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;
use Modules\BaseCore\Contracts\Services\PdfContract;

class PdfBrowserKitService implements PdfContract
{

    protected mixed $chrome;

    protected string $url;
    protected string $content;

    protected string $path;

    protected string $filename;
    protected array $params = [];
    protected array $params_browser = [];


    public function getContentPdf(): string
    {
        $browserFactory = new BrowserFactory(config("pdfbrowserkit.binary"));
        $browser = $browserFactory->createBrowser(array_merge(config('pdfbrowserkit.params_browser') ?? [], $this->params_browser));

        $this->path = storage_path('app').uniqid('pdf_', true).'.pdf';

        try {
            $page = $browser->createPage();
            $width = 1920;
            $height = 1000;
            $page->setViewport($width, $height)->await(); // wait for operation to complete
            if(!empty($this->url)){
                $page->navigate($this->url)->waitForNavigation();
                $options = array_merge(config('pdfbrowserkit.params') ?? [], $this->params);
                $page->pdf($options)->saveToFile($this->path); 
            }else{

            }
        } finally {
            // bye
            $browser->close();
        }

        $content = file_get_contents($this->path);
        unlink($this->path);

        return $content;
    }

    public function downloadPdf(string $filename):\Illuminate\Http\Response
    {
        return Response::make($this->getContentPdf(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"'
        ]);
    }

    public function setUrl(string $url): PdfContract
    {
        $this->url = $url;

        return $this;
    }

    public function setContentHtml(string $contentHtml): PdfContract
    {
        $this->content = $contentHtml;

        return $this;
    }

    public function setParams(array $params = []): PdfContract
    {
        $this->params = $params;

        return $this;
    }

    public function setParamsBrowser(array $paramsBrowser = []): PdfContract
    {
        $this->params_browser = $paramsBrowser;

        return $this;
    }
}
