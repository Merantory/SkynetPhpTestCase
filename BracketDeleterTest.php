<?php

use PHPUnit\Framework\TestCase;

class BracketDeleterTest extends TestCase {

    public function testWithEmptySourceString() : void {
        $testString = "";

        $bracketDeleter = new BracketDeleter($testString);
        $bracketDeleter->process();
        $processResult = $bracketDeleter->getResult();

        $this->assertEmpty($processResult);
    }

    public function testWithoutBrackets() : void {
        $expectedResult = "Hello world";
        $testString = "Hello world";

        $bracketDeleter = new BracketDeleter($testString);
        $bracketDeleter->process();
        $processResult = $bracketDeleter->getResult();

        $this->assertSame($expectedResult, $processResult);
    }

    public function testWithoutOpenBrackets() : void {
        $expectedResult = "Hello] ]wo}rl)d>";
        $testString = "Hello] ]wo}rl)d>";

        $bracketDeleter = new BracketDeleter($testString);
        $bracketDeleter->process();
        $processResult = $bracketDeleter->getResult();

        $this->assertSame($expectedResult, $processResult);
    }

    public function testWithoutClosedBrackets() : void {
        $expectedResult = "He(llo (wo[rl<d{";
        $testString = "He(llo (wo[rl<d{";

        $bracketDeleter = new BracketDeleter($testString);
        $bracketDeleter->process();
        $processResult = $bracketDeleter->getResult();

        $this->assertSame($expectedResult, $processResult);
    }

    public function testDeleteWordsInBrackets() : void {
        $expectedResult = "Hello  ";
        $testString = "Hello {world} ";

        $bracketDeleter = new BracketDeleter($testString);
        $bracketDeleter->process();
        $processResult = $bracketDeleter->getResult();

        $this->assertSame($expectedResult, $processResult);
    }

    public function testDeleteWithNotSameBrackets() : void {
        $expectedResult = "Hello (world}";
        $testString = "Hello (world}";

        $bracketDeleter = new BracketDeleter($testString);
        $bracketDeleter->process();
        $processResult = $bracketDeleter->getResult();

        $this->assertSame($expectedResult, $processResult);
    }

    public function testDeleteBracketsWithoutWords() : void {
        $expectedResult = "";
        $testString = "{({<[]>})}";

        $bracketDeleter = new BracketDeleter($testString);
        $bracketDeleter->process();
        $processResult = $bracketDeleter->getResult();

        $this->assertSame($expectedResult, $processResult);
    }

    public function testDeleteWordsInBracketsWithNewSourceAsParam() : void {
        $expectedResult = " new source";
        $newSourceString = "(It's not) new source";
        $ignoreTestString = "Bad string";

        $bracketDeleter = new BracketDeleter($ignoreTestString);
        $bracketDeleter->process($newSourceString);
        $processResult = $bracketDeleter->getResult();

        $this->assertSame($expectedResult, $processResult);
    }

    public function testDeleteWithBrackets() : void {
        $expectedResult = "Lorem ipsum (dolor> sit, ect>etur adipiscing elit.";
        $testString = "[[P]]Lorem ipsum (dolor> sit{amet}, (con<s)ect>etur adipiscing {(e)}elit.";

        $bracketDeleter = new BracketDeleter($testString);
        $bracketDeleter->process();
        $processResult = $bracketDeleter->getResult();

        $this->assertSame($expectedResult, $processResult);
    }
}

