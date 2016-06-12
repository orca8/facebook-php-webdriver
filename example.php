<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

require_once('vendor/autoload.php');

$host = 'http://localhost:4444/wd/hub';
$driver = RemoteWebDriver::create($host, DesiredCapabilities::firefox(), 5000);

$driver->get('http://localhost:8080/index.html');

// select box
// option の選択はvalueではなくラベルを指定する
$driver->findElement(
  WebDriverBy::id('group')
)->click();
$driver->getKeyboard()->sendKeys('グループ3');

// select box
$driver->findElement(
  WebDriverBy::id('name')
)->sendKeys('三郎');

// text:userid
$input = $driver->findElement(
  WebDriverBy::id('userid')
);
$input->sendKeys('foo bar');

// text:email
$input = $driver->findElement(
  WebDriverBy::id('email')
);
$input->sendKeys('foo@example.com');

$driver->findElement(
  WebDriverBy::cssSelector('input[type=submit]')
)->click();

$driver->wait(10, 500)->until(
  WebDriverExpectedCondition::titleIs('Document')
);

$driver->close();
