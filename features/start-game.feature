Feature: Start a new game
  In order to practice my tic-tac-toe skills
  As a player
  I need to be able to start a new game

  Scenario: Choose to go first
    Given I have not started a game yet
    When I start a game as player "X"
    Then I should see an empty board

  Scenario: Make a move
    Given I have started a game as player "X"
    When I make a move
    Then I should see a board with at least one symbol on it
