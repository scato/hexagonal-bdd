<?php

use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext;

class WebFeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * @var MinkContext
     */
    private $minkContext;

    /**
     * @BeforeScenario
     */
    public function loadMinkExtension(BeforeScenarioScope $scope)
    {
        $environment = $scope->getEnvironment();

        $this->minkContext = $environment->getContext(MinkContext::class);
    }

    /**
     * @Given I have started a game as player :playerName
     */
    public function iHaveStartedAGameAsPlayer($playerName)
    {
        $this->minkContext->visit('/');
        $this->minkContext->pressButton('');
    }

    /**
     * @When I make a move
     */
    public function iMakeAMove()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see a board with at least one symbol on it
     */
    public function iShouldSeeABoardWithAtLeastOneSymbolOnIt()
    {
        throw new PendingException();
    }
}
