<?php

namespace Phalette\Platte\Latte\Macros;

use Latte\Compiler;
use Latte\Macros\MacroSet;
use Phalette\Platte\Latte\MacroInstaller;

final class PhalconMacros extends MacroSet implements MacroInstaller
{

    /**
     * @param Compiler $compiler
     * @return void
     */
    public static function install(Compiler $compiler)
    {
        $me = new static($compiler);

        // Files & content
        $me->addMacro('content', 'echo $_view->getContent()');
        $me->addMacro('partial', 'echo $_view->getPartial(%node.word)');

        // Links & urls
        $me->addMacro('linkTo', 'echo $_tag->linkTo(%node.args)');
        $me->addMacro('url', 'echo $_url->get(%node.word)');

        // Forms
        $me->addMacro('textField', 'echo $_tag->textField(%node.array)');
        $me->addMacro('passwordField', 'echo $_tag->passwordField(%node.array)');
        $me->addMacro('hiddenField', 'echo $_tag->hiddenField(%node.array)');
        $me->addMacro('fileField', 'echo $_tag->fileField(%node.array)');
        $me->addMacro('radioField', 'echo $_tag->radioField(%node.array)');
        $me->addMacro('submitButton', 'echo $_tag->submitButton(%node.array)');
        $me->addMacro('selectStatic', 'echo $_tag->selectStatic(%node.args)');
        $me->addMacro('select', 'echo $_tag->select(%node.args)');
        $me->addMacro('textArea', 'echo $_tag->textArea(%node.array)');
        $me->addMacro('form', 'echo $_tag->form(%node.array)');
        $me->addMacro('endForm', 'echo $_tag->endForm()');

        // Other
        $me->addMacro('title', 'echo $_tag->getTitle()');
        $me->addMacro('friendlyTitle', 'echo $_tag->friendlyTitle(%node.args)');
        $me->addMacro('doctype', 'echo $_tag->getDocType()');

        // Assets
        $me->addMacro('stylesheetLink', 'echo $_tag->stylesheetLink(%node.args)');
        $me->addMacro('css', 'echo $_tag->stylesheetLink(%node.args)');
        $me->addMacro('javascriptInclude', 'echo $_tag->javascriptInclude(%node.args)');
        $me->addMacro('js', 'echo $_tag->javascriptInclude(%node.args)');
        $me->addMacro('image', 'echo $_tag->image(%node.array)');

        // Security
        $me->addMacro('securityToken', 'echo $_security->getToken()');
        $me->addMacro('securityTokenKey', 'echo $_security->getTokenKey()');
    }

}
