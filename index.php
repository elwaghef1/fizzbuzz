<?php

/**
 * Defines the interface for FizzBuzz rules.
 */
interface Rule {
    /**
     * Determines whether the rule applies to a given number.
     *
     * @param int $number The number to check.
     * @return bool True if the rule applies, false otherwise.
     */
    public function matches(int $number): bool;

    /**
     * Returns the output for a number that matches the rule.
     *
     * @return string The output associated with the rule.
     */
    public function getOutput(): string;
}

/**
 * Rule to return 'Fizz' if a number is divisible by 3.
 */
class FizzRule implements Rule {
    const FIZZ = 'Fizz';

    public function matches(int $number): bool {
        return $number % 3 === 0;
    }

    public function getOutput(): string {
        return self::FIZZ;
    }
}

/**
 * Rule to return 'Buzz' if a number is divisible by 5.
 */
class BuzzRule implements Rule {
    const BUZZ = 'Buzz';

    public function matches(int $number): bool {
        return $number % 5 === 0;
    }

    public function getOutput(): string {
        return self::BUZZ;
    }
}

/**
 * Rule to return 'FizzBuzz' if a number is divisible by both 3 and 5.
 */
class FizzBuzzRule implements Rule {
    const FIZBUZZ = 'FizzBuzz';
    public function matches(int $number): bool {
        return $number % 15 === 0;
    }

    public function getOutput(): string {
        return self::FIZBUZZ;
    }
}

/**
 * Manages the processing of numbers according to FizzBuzz rules.
 */
class FizzBuzzManager {
    /**
     * @var Rule[] Array of rules to apply for generating FizzBuzz output.
     */
    private array $rules;

    /**
     * Constructor for FizzBuzzManager.
     *
     * @param Rule[] $rules Array of rules to be used for generating output.
     */
    public function __construct(array $rules) {
        $this->rules = $rules;
    }

    /**
     * Generates the output for numbers from 1 up to a specified maximum number.
     *
     * @param int $maxNumber The maximum number to generate output for.
     * @return array An array of outputs for each number from 1 to maxNumber.
     */
    public function generateOutput(int $maxNumber): array {
        $output = [];
        for ($i = 1; $i <= $maxNumber; $i++) {
            $result = (string)$i;
            foreach ($this->rules as $rule) {
                if ($rule->matches($i)) {
                    $result = $rule->getOutput();
                    break;
                }
            }
            $output[] = $result;
        }
        return $output;
    }
}

// Instantiate the rules and the manager
$rules = [new FizzBuzzRule(), new FizzRule(), new BuzzRule()];

$fizzBuzz = new FizzBuzzManager($rules);
$output = $fizzBuzz->generateOutput(100);

// Print the results
foreach ($output as $line) {
    echo $line . PHP_EOL;
}

?>
