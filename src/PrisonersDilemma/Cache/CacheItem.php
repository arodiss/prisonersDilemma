<?php

namespace PrisonersDilemma\Cache;

class CacheItem
{
    /** @var array */
    protected $possibleResults = [];

    /** @param array $possibleResults */
    public function __construct(array $possibleResults)
    {
        $this->possibleResults = $possibleResults;
    }

    /** @return float */
    public function getResult()
    {
        return $this->possibleResults[array_rand($this->possibleResults)];
    }
} 
