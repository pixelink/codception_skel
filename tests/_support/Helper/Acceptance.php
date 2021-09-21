<?php
namespace Tests\Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Facebook\WebDriver\Remote\RemoteWebDriver;

class Acceptance extends \Codeception\Module
{
    public function press($keys, $delay = 0)
    {
        /** @var $webDriver RemoteWebDriver **/
        $webDriver = $this->getModule('WebDriver')->webDriver;
        if (is_array($keys)) {
            foreach ($keys as $key) {
                sleep($delay);
                $webDriver->getKeyboard()->pressKey($key);
            }
            sleep($delay);
            return;
        }

        sleep($delay);
        $webDriver->getKeyboard()->pressKey($keys);
        sleep($delay);
    }

    public function seeNumberOfTabs($number)
    {
        /** @var $webDriver RemoteWebDriver **/
        $webDriver = $this->getModule('WebDriver')->webDriver;

        $this->assertEquals(count($webDriver->getWindowHandles()), $number);
    }

    public function seeDomainIs($expectedDomain)
    {
        /** @var $webDriver RemoteWebDriver **/
        $webDriver = $this->getModule('WebDriver')->webDriver;

        $expectedDomain = preg_replace('~^www\.~', '', $expectedDomain);
        for ($i =0; $i < 50; $i++) {
            $host = parse_url($webDriver->getCurrentURL(), PHP_URL_HOST);
            $host = preg_replace('~^www\.~', '', $host);
            if ($host == $expectedDomain) break;
            sleep(0.1);
        }


        $this->assertStringContainsStringIgnoringCase($expectedDomain, $host);
    }


    public function seeFullCurrentURLEquals($value)
    {
        return ($this->getModule('PhpBrowser')->client->getHistory()->current()->getUri() == $value);
    }
}
