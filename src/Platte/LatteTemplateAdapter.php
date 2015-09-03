<?php

namespace Phalette\Platte;

use Latte\Engine;
use Phalcon\Debug;
use Phalcon\DI as PhDi;
use Phalcon\Mvc\View as PhView;
use Phalcon\Mvc\View\Engine as PhEngine;
use Phalcon\Tag as PhTag;
use Phalette\Platte\Latte\LatteFactory;

/**
 * @property-read PhView $_view
 */
class LatteTemplateAdapter extends PhEngine
{

    /** @var Engine */
    private $latte;

    /**
     * @param PhView $view
     * @param PhDi $di
     * @param LatteFactory $factory
     */
    function __construct(PhView $view, PhDi $di, LatteFactory $factory)
    {
        parent::__construct($view, $di);
        $this->latte = $factory->create();
    }

    /**
     * @return Engine
     */
    public function getLatte()
    {
        return $this->latte;
    }

    /**
     * API *********************************************************************
     */

    /**
     * @param string $path
     * @param array $params
     * @param bool $mustClean
     */
    public function render($path, $params, $mustClean = FALSE)
    {
        $this->initServices($params);

        // Render the view
        $content = $this->latte->renderToString($path, $params);
        if ($mustClean) {
            $this->_view->setContent($content);
        } else {
            echo $content;
        }
    }

    /**
     * HELPERS *****************************************************************
     */

    /**
     * @param $params
     */
    protected function initServices(&$params)
    {
        if (!isset($params['_view'])) {
            $params['_view'] = $this->_view;
        }

        if (!isset($params['_tag'])) {
            $params['_tag'] = $this->di->get('tag');
        }

        if (!isset($params['_url'])) {
            $params['_url'] = $this->di->get('url');
        }

        if (!isset($params['_security'])) {
            $params['_security'] = $this->di->get('security');
        }

        if (!isset($params['_di'])) {
            $params['_di'] = $this->di;
        }
    }

}
