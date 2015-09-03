<?php

/**
 * Test: Latte - hello world
 */

use Tester\Assert;

require_once __DIR__ . '/../../../bootstrap.php';

test(function () {
    $adapter = LatteTemplateAdapterFactory::create();

    Assert::matchFile(
        __DIR__ . '/expected/helloworld.html',
        $adapter->renderToString(__DIR__ . '/templates/helloworld.latte', [])
    );
});