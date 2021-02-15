<?php
namespace phpDesignPatterns;

class CatVariation {
    public $breed;
    public $image;
    public $color;
    public $texture;
    public $fur;
    public $size;

    public function __construct(
        string $breed,
        string $image,
        string $color,
        string $texture,
        string $fur,
        string $size
    ) {
        $this->breed = $breed;
        $this->image = $image;
        $this->color = $color;
        $this->texture = $texture;
        $this->fur = $fur;
        $this->size = $size;
    }

    public function renderProfile(string $name, string $age, string $owner) {
        echo "= $name =<br/>";
        echo "Age: $age<br/>";
        echo "Owner: $owner<br/>";
        echo "Breed: $this->breed<br/>";
        echo "Image: $this->image<br/>";
        echo "Color: $this->color<br/>";
        echo "Texture: $this->texture<br/>";
    }
}

class Cat {
    public $name;
    public $age;
    public $owner;
    private $variation;

    public function __construct(string $name, string $age, string $owner, CatVariation $variation) {
        $this->name = $name;
        $this->age = $age;
        $this->owner = $owner;
        $this->variation = $variation;
    }
    
    public function matches(array $query): bool {
        foreach($query as $key => $value) {
            if(property_exists($this, $key)) {
                if ($this->key != $value) {
                    return false;
                }
            } elseif(property_exists($this->variation, $key)) {
                if($this->variation->$key != $value) {
                    return false;
                }
            } else {
                return false
            }
        }
        return true;
    }

    public function render(): string {
        $this->variation->renderProfile($this->name, $this->age, $this->owner);
    }
}

class CatDataBase {
    private $cats = [];
    private $variations = [];

    public function addCat(
        string $name,
        string $age,
        string $owner,
        string $breed,
        string $image,
        string $color,
        string $texture,
        string $fur,
        string $size
    ) {
        $variation = $this->getVariation($breed, $image, $color, $texture, $fur, $size);
        $this->cats[] = new Cat($name, $age, $owner, $variation);
        echo "CatDataBase: added a cat ($name, $breed).<br/>";
    }

    public function getVariation(
        string $breed,
        string $image,
        string $color,
        string $texture,
        string $fur,
        string $size
    ): CatVariation {
        $key = $this->getKey(get_defined_vars());
        if (!isset($this->variations[$key])) {
            $this->variations[$key] = new CatVariation($breed, $image, $color, $texture, $fur, $size);
        }
        return $this->variations[$key];
    }

    private function getKey(array $data): string {
        return md5(implode("_", $data));
    }

    public function findCat(array $query) {
        foreach($this->cats as $cat) {
            if ($cat->matches($query)) {
                return $cat;
            }
        }
    }
}

$db = new CatDataBase();
echo "Client: let's see what we have in cats.csv<br/>";

$handle = fopen(__DIR__."/cats.csv", "r");
$row = 0;
$columns = [];
while(($data = fgetcsv($handle)) !== false) {
    if($row == 0) {
        for($c = 0; $c < count($data); $c++) {
            $columnIndex = $c;
            $columnKey = strtolower($data[$c]);
            $columns[$columnKey] = $columnIndex;
        }
        $row++;
        continue;
    }
    $db->addCat(
        $data[$columns['name']],
        $data[$columns['age']],
        $data[$columns['owner']],
        $data[$columns['breed']],
        $data[$columns['image']],
        $data[$columns['color']],
        $data[$columns['texture']],
        $data[$columns['fur']],
        $data[$columns['size']]
    );
    $row++;
}
fclose($handle);

echo "Client: let's look for a cat named Siri<br/>";
$cat = $db->findCat(['name' => 'Siri']);
if($cat) {
    $cat->render();
}

echo "Client: let's look for a cat named Bob<br/>";
$cat = $db->findCat(['name' => 'Bob']);
if($cat) {
    $cat->render();
}