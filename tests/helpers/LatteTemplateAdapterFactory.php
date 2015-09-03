<?php

use Phalcon\DI as PhDi;
use Phalcon\Mvc\Url as PhUrl;
use Phalcon\Mvc\View as PhView;
use Phalcon\Security as PhSecurity;
use Phalcon\Tag as PhTag;
use Phalette\Platte\Latte\LatteFactory;

final class LatteTemplateAdapterFactory
{

    /**
     * @return DummyLatteTemplateAdapter
     */
    public static function create()
    {
        $view = new PhView();
        $di = new PhDi();
        $di->set('tag', new PhTag);
        $di->set('security', new PhSecurity());
        $di->set('url', new PhUrl);

        $latteFactory = new LatteFactory();
        $latteFactory->setTempDir(TEMP_DIR);

        $adapter = new DummyLatteTemplateAdapter($view, $di, $latteFactory);

        return $adapter;
    }

}
