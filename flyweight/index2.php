<?php
namespace phpDesignPatterns;

$carType = array("subcompact", "compact", "suv");

class Car {
    private static $pool = array();
    private $carType;
    public function __construct($carType) {
        $obj = array_search($carType, Car::$pool);
        if(empty($obj)) {
            $obj = new Car($carType);
            array_push(Car::$pool, $carType);
            $obj->carType = $carType;
        }
        return $obj;
    }

    public function render($color, $x, $y) {
        $msg = "render a car of type $this->carType and color $color at($x, $y)";
        print(msg);
    }
}


$colors = array("white", "black", "silver", "gray", "red", "blue", "brown", "beige", "yellow", "green");
$carCounter = 0;

foreach (range(0, 1) as $number) {
    $c1 = new Car("subcompact");
    $c1.render(array_rand($colors), rand(0, 100), rand(0, 100));
    $carCounter += 1;
}

//foreach (range(0, 2) as $number) {
//    $c2 = new Car("compact");
//    $c2.render(array_rand($colors), rand(0, 100), rand(0, 100));
//    $carCounter += 1;
//}
//
//foreach (range(0, 2) as $number) {
//    $c3 = new Car("suv");
//    $c3.render(array_rand($colors), rand(0, 100), rand(0, 100));
//    $carCounter += 1;
//}

print("cars rendered: $carCounter");
print("cars actually created: {".sizeof(Car::$pool)."}");