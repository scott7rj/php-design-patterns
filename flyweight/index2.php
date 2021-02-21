<?php
namespace phpDesignPatterns;

interface IShape {
    public function draw();
}

class Circle implements IShape {
    private $color;
    private $x;
    private $y;
    private $radius;
 
    public function __construct(string $color){
       $this->color = $color;		
    }
 
    public function setX(int $x) {
       $this->x = $x;
    }
 
    public function setY(int $y) {
       $this->y = $y;
    }
 
    public function setRadius(int $radius) {
       $this->radius = $radius;
    }
 
    public function draw() {
       print("Circle: Draw() [Color : $this->color , x : $this->x, y : $this->y, radius : $this->radius\n");
    }
 }

class ShapeFactory {

    private static $circleMap = array();
 
    static function getCircle(string $color) : ?IShape {
        if(!array_key_exists($color, ShapeFactory::$circleMap)) {
            $circle = new Circle($color);
            ShapeFactory::$circleMap[$color] = $circle;
            print("Creating circle of color : $color\n");
        } else {
            $circle = ShapeFactory::$circleMap[$color];
        }
        return $circle;
    }
}

static $colors = array("Red", "Green", "Blue", "White", "Black");

function getRandomColor($colors) {
    return array_rand($colors, 1);
}

function getRandomX() {
    return rand(1, 100);
}

function getRandomY() {
    return rand(1, 100);
}

for($i=0; $i < 50; $i++) {
    $circle = ShapeFactory::getCircle($colors[getRandomColor($colors)]);
    $circle->setX(getRandomX());
    $circle->setY(getRandomY());
    $circle->setRadius(100);
    $circle->draw();
}