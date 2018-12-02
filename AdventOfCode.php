<?php

class AdventOfCode
{

    const PUZZLE_INPUT_FILE = 'puzzle_input.txt';
    protected $inputArray   = [];
    protected $allFrequency = [];

    public function __construct()
    {
        $this->inputToArray();
    }

    protected function inputToArray()
    {
        $input            = file_get_contents(self::PUZZLE_INPUT_FILE);
        $this->inputArray = explode("\r\n", trim($input));
    }

    /**
     * Day 1 Puzzle 1
     *
     * @return int
     */
    public function getFrequency(): int
    {
        $total = 0;
        foreach ($this->inputArray as $inputValue) {
            $total += (int)$inputValue;
        }
        return $total;
    }

    /**
     * Day 1 Puzzle 2
     *
     * @return int
     */
    public function calibrateDevice(): int
    {
        $total                   = 0;
        $this->allFrequency      = [];
        $foundDuplicateFrequency = false;

        $runNumber = 0;

        while ($foundDuplicateFrequency === false) {

            echo "\r\n-------- RUN " . ++$runNumber . "-------------\r\n";

            foreach ($this->inputArray as $inputValue) {
                $total                   += (int)$inputValue;
                $foundDuplicateFrequency = in_array($total, $this->allFrequency, true);
                $this->allFrequency[]    = $total;
                if ($foundDuplicateFrequency) {
                    echo " \r\nFound duplicate \r\n";
                    break;
                }
            }
        }

        return $this->allFrequency[count($this->allFrequency) - 1];
    }

    /**
     * Day 2 Puzzle 1
     *
     * @return int
     */
    public function boxIDCheckSum(): int
    {
        $twoLetter   = 0;
        $threeLetter = 0;

        foreach ($this->inputArray as $inputValue) {
            $count = array_count_values(str_split($inputValue));
            if (in_array(3, $count, true) !== false) {
                $threeLetter++;
            }
            if (in_array(2, $count, true) !== false) {
                $twoLetter++;
            }
        }

        return $twoLetter * $threeLetter;
    }


    /**
     * Day 2 Puzzle 2
     * @return string
     */
    public function boxIDDistance(): string
    {

        $j                 = 0;
        $sizeOfArray         = count($this->inputArray);
        $firstSimilarWord  = '';
        $secondSimilarWord = '';

        foreach ($this->inputArray as $inputValue) {
            for ($i = $j; $i < $sizeOfArray - 1; $i++) {
                $wordCompare = $this->inputArray[$i + 1];
                if (levenshtein($inputValue, $wordCompare, 2, 1, 2) < 2) {
                    $firstSimilarWord = $inputValue;
                    $secondSimilarWord = $wordCompare;
                    break 2;
                }
            }
            $j++;
        }

        $letterAppearsOnce = array_search(1, array_count_values(str_split($firstSimilarWord . $secondSimilarWord)), true);
        return str_replace($letterAppearsOnce,'',$firstSimilarWord);
    }
}

$advent = new AdventOfCode();
echo $advent->boxIDDistance();

