<?php

namespace Components;

class Canvas
{
    private $paddingChar = ' ';
    private $horizontalBorderChar = '-';
    private $verticalBorderChar = '|';
    private $grid = array();

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->createGrid();
    }

    public function createGrid() {
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
    }
    public function getHeight()
    {
        return $this->height;
    }
    public function getWidth()
    {
        return $this->width;
    }


}