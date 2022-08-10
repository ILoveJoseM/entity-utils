## 将数组转对象

````
composer require "jose-chan/entity-utils"
````

#### laravel中使用

````php
<?php

$data = [
    "a" => 1,
    "b" => "b",
    "c" => [
        "d" => 1.22,
        "e" => ""
    ],
    "d" => [
        [
            "f" => "f",
            "g" => 4
        ],
        [
            "f" => "f",
            "g" => 4
        ]
    ]
];

$entity = app(\JoseChan\Entity\Entity::class, ["data" => $data]);

````

#### 指定对象类型

````php
<?php

class CEntity extends JoseChan\Entity\Entity{
    
}

class MyEntity extends \JoseChan\Entity\Entity {
    
    protected $arrayAttributeEntity = [
        "c" => CEntity::class
    ];
}
````

#### 指定二维数组用的Collection

````php
<?php

class MyCollection extends \Illuminate\Support\Collection{
    
}

class DEntity extends \JoseChan\Entity\Entity{
    
    protected static function collection(){
        return MyCollection::class;
    }
}
````

#### 使用自动校验数组

````php
<?php
class MyValidateEntity extends \JoseChan\Entity\ValidateEntity{
    protected function rules(){
        return [
            "a" => "required"    
        ];
    }
    
    protected function messages(){
        return [
            "a.required" => "a属性必须存在"    
        ];
    }
    
}

````
