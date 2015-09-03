<?php

/**
 * Test: Latte - vars
 */

use Tester\Assert;

require_once __DIR__ . '/../../../bootstrap.php';

$adapter = LatteTemplateAdapterFactory::create();
$adapter->useStringLoader();
$latte = $adapter->getLatte();

/**
 * FILES & CONTENTS ********************************************************
 * *************************************************************************
 */

// {content}
test(function () use ($latte) {
    Assert::match('%A%
echo $_view->getContent() ;
%A%
', $latte->compile('{content}'));
});

// {partial test}
test(function () use ($latte) {
    Assert::match('%A%
echo $_view->getPartial("test") ;
%A%
', $latte->compile('{partial test}'));
});

/**
 * LINKS & URLS ************************************************************
 * *************************************************************************
 */

// {linkTo}
test(function () use ($latte) {
    Assert::match('%A%
echo $_tag->linkTo(1, \'test\') ;
%A%
', $latte->compile('{linkTo 1, test}'));
});

// {url}
test(function () use ($latte) {
    Assert::match('%A%
echo $_url->get("test") ;
%A%
', $latte->compile('{url test}'));
});

/**
 * FORMS *******************************************************************
 * *************************************************************************
 */

// {textField}
test(function () use ($latte) {
    Assert::match('%A%
echo $_tag->textField(array(1, \'test\')) ;
%A%
', $latte->compile('{textField 1, test}'));
});

// {passwordField}
test(function () use ($latte) {
    Assert::match('%A%
echo $_tag->passwordField(array(1, \'test\')) ;
%A%
', $latte->compile('{passwordField 1, test}'));
});

// {hiddenField}
test(function () use ($latte) {
    Assert::match('%A%
echo $_tag->hiddenField(array(1, \'test\')) ;
%A%
', $latte->compile('{hiddenField 1, test}'));
});

// {fileField}
test(function () use ($latte) {
    Assert::match('%A%
echo $_tag->fileField(array(1, \'test\')) ;
%A%
', $latte->compile('{fileField 1, test}'));
});

// {radioField}
test(function () use ($latte) {
    Assert::match('%A%
echo $_tag->radioField(array(1, \'test\')) ;
%A%
', $latte->compile('{radioField 1, test}'));
});

// {submitButton}
test(function () use ($latte) {
    Assert::match('%A%
echo $_tag->submitButton(array(1, \'test\')) ;
%A%
', $latte->compile('{submitButton 1, test}'));
});

// {selectStatic}
test(function () use ($latte) {
    Assert::match('%A%
echo $_tag->selectStatic(1, \'test\') ;
%A%
', $latte->compile('{selectStatic 1, test}'));
});

// {select}
test(function () use ($latte) {
    Assert::match('%A%
echo $_tag->select(1, \'test\') ;
%A%
', $latte->compile('{select 1, test}'));
});

// {textArea}
test(function () use ($latte) {
    Assert::match('%A%
echo $_tag->textArea(array(1, \'test\')) ;
%A%
', $latte->compile('{textArea 1, test}'));
});

// {form}
test(function () use ($latte) {
    Assert::match('%A%
echo $_tag->form(array(1, \'test\')) ;
%A%
', $latte->compile('{form 1, test}'));
});

// {endForm}
test(function () use ($latte) {
    Assert::match('%A%
echo $_tag->endForm() ;
%A%
', $latte->compile('{endForm}'));
});

/**
 * OTHER *******************************************************************
 * *************************************************************************
 */

// {title}
test(function () use ($latte) {
    Assert::match('%A%
echo $_tag->getTitle() ;
%A%
', $latte->compile('{title}'));
});

// {friendlyTitle}
test(function () use ($latte) {
    Assert::match('%A%
echo $_tag->friendlyTitle(1, \'test\') ;
%A%
', $latte->compile('{friendlyTitle 1, test}'));
});

// {doctype}
test(function () use ($latte) {
    Assert::match('%A%
echo $_tag->getDocType() ;
%A%
', $latte->compile('{doctype}'));
});


/**
 * ASSETS ******************************************************************
 * *************************************************************************
 */

// {stylesheetLink}
test(function () use ($latte) {
    Assert::match('%A%
echo $_tag->stylesheetLink(1, \'test\') ;
%A%
', $latte->compile('{stylesheetLink 1, test}'));
});

// {css}
test(function () use ($latte) {
    Assert::match('%A%
echo $_tag->stylesheetLink(1, \'test\') ;
%A%
', $latte->compile('{css 1, test}'));
});

// {javascriptInclude}
test(function () use ($latte) {
    Assert::match('%A%
echo $_tag->javascriptInclude(1, \'test\') ;
%A%
', $latte->compile('{javascriptInclude 1, test}'));
});

// {js}
test(function () use ($latte) {
    Assert::match('%A%
echo $_tag->javascriptInclude(1, \'test\') ;
%A%
', $latte->compile('{js 1, test}'));
});

// {image}
test(function () use ($latte) {
    Assert::match('%A%
echo $_tag->image(array(1, \'test\')) ;
%A%
', $latte->compile('{image 1, test}'));
});

/**
 * SECURITY ****************************************************************
 * *************************************************************************
 */

// {securityToken}
test(function () use ($latte) {
    Assert::match('%A%
echo $_security->getToken() ;
%A%
', $latte->compile('{securityToken}'));
});

// {securityToken}
test(function () use ($latte) {
    Assert::match('%A%
echo $_security->getTokenKey() ;
%A%
', $latte->compile('{securityTokenKey}'));
});
