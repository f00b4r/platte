<?php

namespace Phalette\Platte\Latte;

use Latte\Engine;

class LatteFactory
{

    /** @var string */
    protected $tempDir;

    /** @var string */
    protected $contentType = 'html';

    /** @var bool */
    protected $autoRefresh = FALSE;

    /** @var callable[] */
    protected $filters = [];

    /** @var MacroInstaller[] */
    protected $macros = ['Phalette\Platte\Latte\Macros\PhalconMacros'];

    /**
     * SETTERS *****************************************************************
     */

    /**
     * @param string $tempDir
     */
    public function setTempDir($tempDir)
    {
        $this->tempDir = $tempDir;
    }

    /**
     * @param string $contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }

    /**
     * @param boolean $refresh
     */
    public function setAutoRefresh($refresh)
    {
        $this->debug = boolval($refresh);
    }

    /**
     * @param string $name
     * @param callable $filter
     */
    public function addFilter($name, $filter)
    {
        $this->filters[$name] = $filter;
    }

    /**
     * @param MacroInstaller $macro
     */
    public function addMacro(MacroInstaller $macro)
    {
        $this->macros[] = $macro;
    }

    /**
     * FACTORY *****************************************************************
     */

    /**
     * @return Engine
     */
    public function create()
    {
        $engine = new Engine();

        // Options
        $engine->setTempDirectory($this->tempDir);
        $engine->setAutoRefresh($this->autoRefresh);
        $engine->setContentType($this->contentType);

        // Filters
        foreach ($this->filters as $name => $callback) {
            $engine->addFilter($name, $callback);
        }

        // Macros
        $engine->onCompile[] = function (Engine $engine) {
            $compiler = $engine->getCompiler();
            foreach ($this->macros as $macro) {
                $macro::install($compiler);
            }
        };

        return $engine;
    }

}
