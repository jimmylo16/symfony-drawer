## Symfony-drawer

For this project, we have the input.txt, synfony will read the file in the root of the project and then will generate an output once you run the project, to do that you need to install the necesary dependencies:

```bash
$ composer install
```

and then run the project, notice that you can run only `php bin/console` and you will see a list of the available commands

```bash
$ php bin/console DrawingTool input.txt
```

The program support the following set of commands:

C w h
L x1 y1 x2 y2
R x1 y1 x2 y2
B x y c

Create Canvas: Create a new canvas of width w and height h.
Create Line: Create a new line from (x1,y1) to (x2,y2). Currently only horizontal or
vertical lines are supported. Horizontal and vertical lines will be drawn using the 'x' character.
Create Rectangle: Create a new rectangle, whose upper left corner is (x1,y1) and lower
right corner is (x2,y2). Horizontal and vertical lines will be drawn using the 'x' character.
Bucket Fill: Fill the entire area connected to (x,y) with "colour" c. The behaviour of this is
the same as that of the "bucket fill" tool in paint programs.
