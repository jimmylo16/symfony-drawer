<?php

namespace DrawingTool\Components;
use DrawingTool\Components\Shape\Line;
use DrawingTool\Components\Shape\Rectangle;

class Canvas
{
    private $paddingChar = ' ';
    private $horizontalBorderChar = '-';
    private $verticalBorderChar = '|';
    private $grid = array();
    private $line;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function createCanvas() {

        for ($row = 0; $row <= $this->getHeight() + 1; $row++)
        {
            for ($col = 0; $col <= $this->getWidth() + 1; $col++)
            {
                if ($row == 0 || $row == $this->getHeight() + 1)
                {
                    $this->grid[$row][$col] = $this->horizontalBorderChar;
                }
                elseif ($col == 0 || $col == $this->getWidth() + 1)
                {
                    $this->grid[$row][$col] = $this->verticalBorderChar;
                }
                else
                {
                    $this->grid[$row][$col] = $this->paddingChar;
                }
            }
        }
    }

    public function setDimensions($width, $height) {
        $this->width = $width;
        $this->height = $height;
        $this->createCanvas();
    }
    public function getHeight()
    {
        return $this->height;
    }
    public function getWidth()
    {
        return $this->width;
    }

    public function render() {

        $render = '';
        foreach ($this->grid as $row) {
            $render .= implode('', $row) . "\n";
        }

        return rtrim($render);
    }

    public function drawLine($x1, $y1, $x2, $y2) {
        $line  = new Line( $this->grid, $x1, $y1, $x2, $y2); 
        $this->grid = $line->draw();
    }
    public function drawRectangle($x1, $y1, $x2, $y2) {
        $rectangle   = new Rectangle( $this->grid, $x1, $y1, $x2, $y2); 
        $this->grid = $rectangle ->draw();
    }

    public function fillArea($x, $y, $color) {
        if ($this->alreadyFilled($x, $y)) {
            return;
        }

        $this->grid[$y][$x + 1] = $color;

        $this->fillArea($x, $y - 1, $color);
        $this->fillArea($x + 1, $y, $color);
        $this->fillArea($x, $y + 1, $color);
        $this->fillArea($x - 1, $y, $color);
    }

    public function alreadyFilled($x, $y)
    {
        if ($this->grid[$y][$x + 1] == " ")
        {
            return false;
        }
        return true;
    }

}