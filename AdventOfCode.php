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
     * @return int
     */
    public function calibrateDevice(): int
    {
        $total                   = 0;
        $this->allFrequency      = [];
        $foundDuplicateFrequency = false;

        $runNumber = 0;

        while ($foundDuplicateFrequency === false) {

            echo "\r\n-------- RUN ".++$runNumber."-------------\r\n";

            foreach ($this->inputArray as $inputValue) {
                $total                   += (int)$inputValue;
                $foundDuplicateFrequency = in_array($total, $this->allFrequency, true);
                $this->allFrequency[] = $total;
                if ($foundDuplicateFrequency) {
                    echo " \r\nFound duplicate \r\n";
                    break;
                }
            }
        }

        return $this->allFrequency[count($this->allFrequency) - 1];
    }

}

$advent = new AdventOfCode();
echo $advent->calibrateDevice();

