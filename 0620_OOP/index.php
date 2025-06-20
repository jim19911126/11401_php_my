<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>父類別</h2>
    <?php
    class Person {
        private $name;
        private $age;
        private $place;

        public function __construct($name, $age, $place) {
            $this->name = $name;
            $this->age = $age;
            $this->place = $place;
        }
        public function greet() {
            echo "Hi, my name is {$this->name}, I am {$this->age} old and I am from {$this->place}.";
        }

        public function getName(){
            return $this->name;
        }
        public function getAge(){
            return $this->age;
        }
        
        public function getPlace(){
            return $this->place;
        }
         public function setName($name){
            $this->name = $name;
        }
        public function setAge($age){
            $this->age = $age;
        }
        public function setPlace($place){
            $this->place = $place;
        }
    }

    $james = new Person('James', 25, 'Taipei');
    echo $james->getName();
    echo "<br>";
    echo $james->getAge();
    echo "<br>";
    echo $james->getPlace();
    echo "<br>";
    $james->greet();

    echo "<hr>";

    $james->setName("Stefani");
    echo "<br>";
    $james->setAge("36");
    echo "<br>";
    $james->setPlace("New York City");
    echo "<br>";
    $james->greet();


    ?>
<h2>繼承</h2>
<?php

Interface PersonInterface {
    public function getGender();
    public function say();

}

class Men extends Person implements PersonInterface {
    private $gender='Male';
    public static $race='Asian';

    function getGender(){
        return $this->gender;
    } 

    function say(){

    }
    static function getRace(){
        return self::$race;
    }

}

class Women extends Person {
    private $gender='Female';
    public static $race='Caucasian';
    function getGender(){
        return $this->gender;
    } 
        function say(){

    }
    static function getRace(){
        return self::$race;
    }

}

$man=new Men('James', 25, 'Yilan');
echo "<br>";
echo $man->getName();
echo "<br>";
echo $man->getGender();
echo "<br>";
echo Men::$race;
echo Men::getRace();
$man->greet();

$man=new Women('Taylor', 33, 'Nashville');
echo "<br>";
echo $man->getName();
echo "<br>";
echo $man->getGender();
echo "<br>";
$man->greet();

?>

</body>
</html>