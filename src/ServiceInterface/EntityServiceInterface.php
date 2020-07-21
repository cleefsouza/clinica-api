<?php

namespace App\ServiceInterface;

/**
 * Interface EntityServiceInterface
 * @package App\ServiceInterface
 */
interface EntityServiceInterface
{

    /**
     * @param string $json
     * @return mixed
     */
    public function createEntity(string $json);
}