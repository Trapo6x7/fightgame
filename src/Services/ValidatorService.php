<?php

class ValidatorService
{
    private $strategies = [];

    public function addStrategy(string $field, ValidationContract $strategy)
    {
        if (!isset($this->strategies[$field])) {
            $this->strategies[$field] = [];
        }
        $this->strategies[$field][] = $strategy;
    }

    public function validate(array $data): bool
    {
        foreach ($this->strategies as $field => $strategies) {
            foreach ($strategies as $strategy) {
                if (!isset($data[$field]) || !$strategy->validate($data[$field])) {
                    return false;
                }
            }
        }
        return true;
    }

    public function sanitize(array $data): array
    {
        $sanitizedData = [];
        foreach ($data as $field => $value) {
            $sanitizedData[$field] = htmlspecialchars(trim($value));
        }
        return $sanitizedData;
    }

    public function checkMethods(string $method): bool
    {
        if ($_SERVER['REQUEST_METHOD'] !== $method) {
            header('location: ../index.php');
            return false;
        }
        return true;
    }
}