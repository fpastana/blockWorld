## Technology Stack

- [PHP 8.2.2](https://php.net): Fast, flexible and pragmatic, PHP powers everything from your blog to the most popular websites in the world.
- [Composer 2.5.3](https://getcomposer.org): A Dependency Manager for PHP.

##  Install the composer packages:

```
# composer install
```

## Setting up the Input

- Sample Input (.txt)

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
# php index.php \path\to\the\file.txt
```

# About the APP

Many areas of Computer Science use simple, abstract domains for both analytical and empirical studies. For example, an early Ai study of planning and robotics (STRIPS) used a block world in which a robot arm performed tasks involving the manipulation of blocks. 

The app will model a simple block world under certain rules and constrains. Rather than determine how to achieve a specific state, it will "program" a robotic arm to respond to a limited set of commands.  

This app parses a series of commands that instruct a robot arm to manipulate blocks that lie on a flat table. Initially there are n blocks on the table (numbered from 0 to n -1) with blocks bi adjacent to block bi+1 for all 0 <= i < n-1.

