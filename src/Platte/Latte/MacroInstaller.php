<?php

namespace Phalette\Platte\Latte;

use Latte\Compiler;

interface MacroInstaller
{

    /**
     * @param Compiler $compiler
     * @return void
     */
    public static function install(Compiler $compiler);

}
