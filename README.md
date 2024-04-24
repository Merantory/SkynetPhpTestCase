# SkynetPhpTestCase

## Введение
Тестовое задание из Skynet с написанием тестов на PhpUnit

### Исходный код с заданием
Класс требующий реализации удаление слов между скобками:
```PHP
<?php
class BracketDeleter {

    private string $destination = '';

    private array $brackets = [
        '(' => ')',
        '<' => '>',
        '{' => '}',
        '[' => ']',
    ];

    public function __construct(private string $source) {}

    public function process() {
    /* 
        Реализовать метод в классе, который принимает на вход функции process() строку,
        и обрабатывает её следующим образом:
        выкидывает из неё текст заключённый в скобочки []{}()<>
        Например: для строки "Привет <мир>" мы получим результат "Привет "
    */
      
    }

    public function getResult(): string {
        return $this->destination;
    }
}
```
Класс для тестов:
```PHP
<?php
use PHPUnit\Framework\TestCase;

class BracketDeleterTest extends TestCase {

/*
    2. При помощи phpunit написать тесты на этот класс
*/
       
}
```
