<?php

namespace spec\Application\Game;

use Application\Game\Board;
use Application\Game\Move;
use Application\Game\MoveGenerator;
use Application\Game\Player;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\UuidInterface;

class GameSpec extends ObjectBehavior
{
    function let(
        UuidInterface $id,
        Player $humanPlayer,
        Board $board,
        Player $computerPlayer,
        MoveGenerator $moveGenerator,
        Move $computerMove
    ) {
        $this->beConstructedWith($id, $humanPlayer, $board, $computerPlayer, $moveGenerator);

        $moveGenerator->generateMove($board)->willReturn($computerMove);
    }

    function it_has_a_board(Board $board)
    {
        $this->getBoard()->shouldBe($board);
    }

    function it_has_an_id(UuidInterface $id)
    {
        $this->getId()->shouldBe($id);
    }

    function it_has_a_human_player(Player $humanPlayer)
    {
        $this->getHumanPlayer()->shouldBe($humanPlayer);
    }

    function it_has_a_computer_player(Player $computerPlayer)
    {
        $this->getComputerPlayer()->shouldBe($computerPlayer);
    }

    function it_should_make_a_human_move(Move $humanMove, Board $board, Player $humanPlayer)
    {
        $this->makeHumanMove($humanMove);

        $board->makeMove($humanMove, $humanPlayer)->shouldHaveBeenCalled();
    }

    function it_should_not_make_a_computer_move_if_the_human_is_first_to_move(
        Board $board,
        Move $computerMove,
        Player $computerPlayer
    ) {
        $computerPlayer->isFirstToMove()->willReturn(false);

        $this->start();

        $board->makeMove($computerMove, $computerPlayer)->shouldNotHaveBeenCalled();
    }

    function it_should_make_a_computer_move_if_the_computer_is_first_to_move(
        Board $board,
        Move $computerMove,
        Player $computerPlayer
    ) {
        $computerPlayer->isFirstToMove()->willReturn(true);

        $this->start();

        $board->makeMove($computerMove, $computerPlayer)->shouldHaveBeenCalled();
    }

    function it_should_make_a_computer_move_after_a_human_move(
        Move $humanMove,
        Board $board,
        Move $computerMove,
        Player $computerPlayer
    ) {
        $this->makeHumanMove($humanMove);

        $board->makeMove($computerMove, $computerPlayer)->shouldHaveBeenCalled();
    }
}
