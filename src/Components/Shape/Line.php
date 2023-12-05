<?php

namespace DrawingTool\Components\Shape;

use DrawingTool\Components\Drawer\LineDrawer;

class Line  {
    private $grid;
    private $x1;
    private $y1;
    private $x2;
    private $y2;
    public function __construct($grid,$x1,$y1,$x2,$y2)
    {
  
        $this -> grid = $grid;
        $this -> x1 = $x1;
        $this -> y1 = $y1;
        $this -> x2 = $x2;
        $this -> y2 = $y2;
    }
    public function draw()
    {
        $x1 = $this->x1;
        $x2 = $this->x2;
        $y1 = $this->y1;
        $y2 = $this->y2;
        if ($x1 == $x2) {
            return $this->drawVerticalLine();
        }
        elseif ($y1 == $y2) {
            return $this->drawHorizontalLine();
        }
        else {
            throw new \LogicException('Currently only horizontal and vertical lines supported');
        }
    }

    private function drawVerticalLine()
    {
        $x1 = $this->x1;
        $y1 = $this->y1;
        $line_distance = $this->getLineDistance();

        for ($row = 0; $row < $line_distance; $row++)
        {
            $this->grid[$y1 + $row][$x1] = 'x';
        }
        return $this->grid;
    }


    private function drawHorizontalLine()
    {
        $x1 = $this->x1;
        $y1 = $this->y1;
        $line_distance = $this->getLineDistance();

        for ($col = 0; $col < $line_distance; $col++)
        {
            $this->grid[$y1][$x1 + $col] = 'x';
        }
        return $this->grid;
    }

    public function getLineDistance() {
        $x1 = $this->x1;
        $x2 = $this->x2;
        $y1 = $this->y1;
        $y2 = $this->y2;

        $dx = $x2 - $x1;
        $dy = $y2 - $y1;

        return sqrt(pow($dx, 2) + pow($dy, 2)) + 1;
    }
}
