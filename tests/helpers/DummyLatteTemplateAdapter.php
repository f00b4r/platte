<?php

use Latte\Loaders\FileLoader;
use Latte\Loaders\StringLoader;
use Phalette\Platte\LatteTemplateAdapter;

final class DummyLatteTemplateAdapter extends LatteTemplateAdapter
{

    /**
     * @param string $path
     * @param array $params
     * @return string
     */
    public function renderToString($path, $params = [])
    {
        ob_start();
        $this->render($path, $params);
        return ob_get_clean();
    }

    public function useStringLoader()
    {
        $this->getLatte()->setLoader(new StringLoader());
    }

    public function useFileLoader()
    {
        $this->getLatte()->setLoader(new FileLoader());
    }

}
