# JSON и PHP на практике

JSON поддерживает несколько типов данных, включая строки (в двойных кавычках), числа, десятичные дроби, логические значения (true и false), null, объекты (набор пар ключ-значение, заключенных в фигурные скобки) и массивы (упорядоченный список значений, заключенных в квадратные скобки).

```json
["Some string", 100, 2.5, true, false, null, {}, []]
```

`names.json`

```json
["Mikhail", "Yaroslav", "Maxim"]
```

**Попробовать получить JSON строку из файла и преобразовать в привычный PHP массив.**

```php
<?php

$names = file_get_contents('names.json');
dump($names);
$names = json_decode($names);
dump($names);
```

**Теперь нужно перейти к объектам. Показать синтаксис.**

```json
{
	"key": "value",
	"number": 100,
	"object": {
		"key": "value"
	},
	"array": ["tag1", "tag2"]
}
```

**Привести пример с информацией о пользователе.**

`user.json`

```json
{
  "name": "Максим Цветков",
  "dob": "24/12/1999",
  "age": 23,
  "languages": [
    "Русский",
    "Испанский"
  ],
  "props": {
    "height": 165,
    "weight": 60
  }
}
```

**Попробовать в PHP. Показать, что по умолчанию мы получаем объект.**

```php
<?php

$user = file_get_contents('user.json');
dump($user);
$user = json_decode($user);
dump($user);
```

**Рассказать как преобразовать в ассоциативный массив.**

```php
<?php

$user = json_decode($user, true);
```

**Привести пример с продуктами:**

`products.json`

```json
[
	{
		"id": 100,
		"name": "iPhone 4s",
		"price": 19990.00,
		"total": 32,
		"tags": ["телефон", "новый", "apple"]
	},
	{
		"id": 101,
		"name": "iPad 4",
		"price": 26990.00,
		"total": 7,
		"tags": ["планшет", "apple"]
	},
	{
		"id": 102,
		"name": "JBL наушники",
		"price": 6990.00,
		"total": 55,
		"tags": ["наушники", "jbl"]
	}
]
```

**Попробовать в PHP.**

```php
<?php

$products = file_get_contents('products.json');
dump($products);
$products = json_decode($products);
dump($products);
```

**Попробовать `json_encode()` на примерах выше.**

Рассказать о флагах: `JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE`