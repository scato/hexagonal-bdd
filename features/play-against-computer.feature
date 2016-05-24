Feature: Play against a computer
  In order to practice by myself
  As a player
  I need to play against a computer

  Scenario: Computer makes the first move
    Given I have not started a game yet
    When I start a game as player "O"
    Then I should see a board with one symbol on it

  Scenario: Computer makes the second move
    Given I have started a game as player "X"
    When I make a move
    Then I should see a board with two symbols on it
