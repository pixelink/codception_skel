<?php
namespace Tests;

use Codeception\Step\Argument\PasswordArgument;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    /**
     * Define custom actions here
     */

    public function fillInRichText($divCkeEditor, $text)
    {
        $I = $this;
        $I->waitForElementVisible($divCkeEditor . ' .cke_top', 10);
        $I->switchToIFrame($divCkeEditor . ' iframe.cke_wysiwyg_frame');
        $I->pressKey('body', $text);
        $I->switchToIFrame();
    }

    public function tryToAcceptPrivacy() {
        $I = $this;

        $I->wait(1);
        $I->waitForElement('privacy overlay');
        $I->tryToClick('accept button');
    }

    public function tryToLogin()
    {
        $I = $this;

        $I->amOnPage('/login');
        $I->waitForElement('#login');
        // $I->tryToClick('Akzeptieren'); // anything to confirm
        $I->fillField('_username', 'username');
        $I->fillField('_password', new PasswordArgument('password'));
        $I->click('Anmelden');
        $I->wait(3);
    }
}
