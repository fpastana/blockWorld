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
php terminal.php file.txt
```

- Running the unit tests
```
./vendor/bin/phpunit tests/Unit
```

# About the APP

Many areas of Computer Science use simple, abstract domains for both analytical and empirical studies. For example, an early AI study of planning and robotics (STRIPS) used a block world in which a robot arm performed tasks involving the manipulation of blocks. 

The app will model a simple block world under certain rules and constrains. Rather than determine how to achieve a specific state, it will "program" a robotic arm to respond to a limited set of commands.  

This app parses a series of commands that instruct a robot arm to manipulate blocks that lie on a flat table. Initially there are n blocks on the table (numbered from 0 to n -1) with blocks bi adjacent to block bi+1 for all 0 <= i < n-1.

