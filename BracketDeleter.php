<?php
class BracketDeleter {

    private string $destination = '';

    private array $brackets = [
        '(' => ')',
        '<' => '>',
        '{' => '}',
        '[' => ']',
    ];

    public function __construct(private string $source) {
    }

    public function process(string $newString = null): void {
        // Проверка пришла ли новая строка
        if (!is_null($newString)) {
            $processString = $newString;
        } else {
            $processString = $this->source;
        }

        $stack = [];
        $openBracketsCount = ['(' => 0, '<' => 0, '{' => 0, '[' => 0];

        for ($i = 0; $i < strlen($processString); ++$i) {
            $appendSymbol = $processString[$i];
            $stack[] = $appendSymbol;

            // Если пришла открывающаяся скобка - добавляем её в стек
            // и увеличиваем текущее количество этой скобки в стеке
            if (array_key_exists($appendSymbol, $openBracketsCount)) {
                ++$openBracketsCount[$appendSymbol];
            } elseif (in_array($appendSymbol, $this->brackets)) { // Если закрывающаяся скобка
                $mappedOpenBracket = array_search($appendSymbol, $this->brackets);
                $count = $openBracketsCount[$mappedOpenBracket];

                // Удаляем символы из стека, пока не удалим парную открывающуюся
                while (!empty($stack) && $count > 0 && $count === $openBracketsCount[$mappedOpenBracket]) {
                    $removeSymbol = array_pop($stack);
                    if (array_key_exists($removeSymbol, $openBracketsCount)) {
                        --$openBracketsCount[$removeSymbol];
                    }
                }
            }
        }
        $this->destination = implode($stack);
    }

    public function getResult(): string {
        return $this->destination;
    }
}
