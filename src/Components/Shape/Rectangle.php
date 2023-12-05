<?php

namespace DrawingTool\Components\Shape;

use DrawingTool\Components\Shape\Line;

class Rectangle {
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
        // When the line is Horizontal
        if ($x1 == $x2 || $y1 == $y2) {
            $line = new Line($this->grid, $x1, $y1, $x2, $y2);
            return $this->grid;
        } else {
            $line = new Line($this->grid,$x1, $y1, $x2, $y1);
            $this->grid = $line->draw();
            $line = new Line($this->grid,$x1, $y1, $x1, $y2);
            $this->grid = $line->draw();
            $line = new Line($this->grid,$x2, $y1, $x2, $y2);
            $this->grid = $line->draw();
            $line = new Line($this->grid,$x1, $y2, $x2, $y2);
            $this->grid = $line->draw();
            return  $this->grid;
        }
    }
}