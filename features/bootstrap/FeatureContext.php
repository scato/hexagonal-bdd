<?php

use Application\Game\Board;
use Application\Game\Game;
use Application\Game\GameFactory;
use Application\Game\Move;
use Application\Game\Player;
use Application\GetGameHandler;
use Application\GetGameQuery;
use Application\MakeMoveCommand;
use Application\MakeMoveHandler;
use Application\StartGameCommand;
use Application\StartGameHandler;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;
use Ramsey\Uuid\UuidInterface;
use Repository\GameRepositoryStub;
use PHPUnit_Framework_Assert as Assert;
use Repository\MoveGeneratorFactoryStub;
use Repository\MoveGeneratorStub;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * @var UuidInterface
     */
    private $gameId;

    /**
     * @var GameRepositoryStub
     */
    private $gameRepository;

    /**
     * @var MoveGeneratorStub
     */
    private $moveGenerator;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->gameId = Uuid::uuid4();
        $this->moveGenerator = new MoveGeneratorStub([
            new Move(2, 2)
        ]);
    }

    /**
     * @Given I have not started a game yet
     */
    public function iHaveNotStartedAGameYet()
    {
        $this->gameRepository = new GameRepositoryStub([]);
    }

    /**
     * @When I start a game as player :playerName
     */
    public function iStartAGameAsPlayer($playerName)
    {
        $command = new StartGameCommand();
        $command->gameId = $this->gameId;
        $command->playerName = $playerName;

        $handler = new StartGameHandler(
            $this->gameRepository,
            new UuidFactory(),
            new GameFactory(),
            $this->moveGenerator
        );
        
        $handler->handle($command);
    }

    /**
     * @Then I should see an empty board
     */
    public function iShouldSeeAnEmptyBoard()
    {
        $query = new GetGameQuery();
        $query->gameId = $this->gameId;

        $handler = $this->createGetGameHandler();
        $result = $handler->handle($query);

        Assert::assertTrue($result->getBoard()->getNumberOfSymbols() === 0);
    }

    /**
     * @Then I should see a board with one symbol on it
     */
    public function iShouldSeeABoardWithOneSymbolOnIt()
    {
        $query = new GetGameQuery();
        $query->gameId = $this->gameId;

        $handler = $this->createGetGameHandler();
        $result = $handler->handle($query);

        Assert::assertEquals(1, $result->getBoard()->getNumberOfSymbols());
    }

    /**
     * @Given I have started a game as player :playerName
     */
    public function iHaveStartedAGameAsPlayer($playerName)
    {
        $opponentName = $playerName === 'X' ? 'O' : 'X';
        
        $this->gameRepository = new GameRepositoryStub([
            new Game(
                $this->gameId,
                new Player($playerName),
                new Board(),
                new Player($opponentName),
                $this->moveGenerator
            ),
        ]);
    }

    /**
     * @When I make a move
     */
    public function iMakeAMove()
    {
        $command = new MakeMoveCommand();
        $command->gameId = $this->gameId->toString();
        $command->x = 0;
        $command->y = 0;

        $handler = new MakeMoveHandler($this->gameRepository, new UuidFactory(), $this->moveGenerator);
        $handler->handle($command);
    }

    /**
     * @return GetGameHandler
     */
    private function createGetGameHandler()
    {
        return new GetGameHandler(new UuidFactory(), $this->gameRepository);
    }

    /**
     * @Then I should see a board with two symbols on it
     */
    public function iShouldSeeABoardWithTwoSymbolsOnIt()
    {
        $query = new GetGameQuery();
        $query->gameId = $this->gameId;

        $handler = $this->createGetGameHandler();
        $result = $handler->handle($query);

        Assert::assertEquals(2, $result->getBoard()->getNumberOfSymbols());
    }

    /**
     * @Then I should see a board with at least one symbol on it
     */
    public function iShouldSeeABoardWithAtLeastOneSymbolOnIt()
    {
        $query = new GetGameQuery();
        $query->gameId = $this->gameId;

        $handler = $this->createGetGameHandler();
        $result = $handler->handle($query);

        Assert::assertGreaterThanOrEqual(1, $result->getBoard()->getNumberOfSymbols());
    }
}
