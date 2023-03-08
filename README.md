## Technology Stack

- [PHP 8.2.2](https://php.net): Fast, flexible and pragmatic, PHP powers everything from your blog to the most popular websites in the world.
- [Composer 2.5.3](https://getcomposer.org): A Dependency Manager for PHP.
- [PHPUnit 9.5](https://docs.phpunit.de/en/9.5/index.html): Sebastian Bergmann's framework for unit test. PHPUnit requires the dom and json extensions, which are normally enabled by default.

##  Install the composer packages:

```
composer install
```

## Setting up the Input

- [Sample Input](https://github.com/fpastana/blockWorld/blob/main/input.txt)

```
10
move 9 onto 1
move 8 over 1
move 7 over 1
move 6 over 1
pile 8 over 6
pile 8 over 5
move 2 over 1
move 4 over 9 
quit
```

- Running and reading the inputs from a file

```
php terminal.php input.txt
```

- Running the unit tests
```
./vendor/bin/phpunit tests/Unit
```

# About the APP

Many areas of Computer Science use simple, abstract domains for both analytical and empirical studies. For example, an early AI study of planning and robotics (STRIPS) used a block world in which a robot arm performed tasks involving the manipulation of blocks. 

The app will model a simple block world under certain rules and constrains. Rather than determine how to achieve a specific state, it will "program" a robotic arm to respond to a limited set of commands.  

This app parses a series of commands that instruct a robot arm to manipulate blocks that lie on a flat table. Initially there are n blocks on the table (numbered from 0 to n -1) with blocks bi adjacent to block bi+1 for all 0 <= i < n-1.

The valid commands for the robot arm that manipulates blocks are:

1. move "a" onto "b": where "a" and "b" are block numbers, puts block "a" onto block "b" after returning any blocks that are stacked on top of blocks "a" and "b" to their initial positions.

2. move "a" over "b": where "a" and "b" are block numbers, puts block "a" onto the top of stack containing block "b", after returning any blocks that are stacked on top of block "a" to their initial positions.

3. pile "a" onto "b": where "a" and "b" are block numbers, moves the pile of blocks consisting of block "a", and any blocks that are stacked above block "a", onto block "b". All blocks on top of block "b" are moved to their initial positions prior to the pile taking place. The blocks stacked above block "a" retain their order when moved.

4. pile "a" over "b": where "a" and "b" are block numbers, puts the pile of blocks consisting of block "a", and any blocks that are stacked above block "a", onto the top of stack containing block "b". The blocks stacked above block "a" retain their original order when moved.

5. quit: terminates manipulations in the bloc world.

Any command in which a === b or in which "a" and "b" are in the same stack of blocks is an illegal command. All illegal commands should be ignored and should have no affect on the configuration of blocks

> Input: The input begins with an integer "n" on a line by itself representing the number of blocks in the block world. You may assume that 0 < "n" < 25. 
The number of blocks is followed by a sequence of blocks commands, one command per line. Your program should process all commands until the quit command is encountered. You may assume that all commands will be of the form specified above. There will be no syntactically incorrect commands. 

> Output: The output should consist of the final state of the blocks world. Each original block position numbered "i" (0 <= "i" < "n" where "n" is the number of blocks) should appear followed immediately by a colon. If there is at least a block on it, the colon must be followed by one space, followed by a list of blocks that appear stacked in that position with each block number separated from other block numbers by a space. Don't put any trailing spaces on a line. There should be one line of output for each block position (i.e., n lines of output where n is the integer on the first line of input)

