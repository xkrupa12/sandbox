<?php

/**
 * Factory create() helper
 *
 * @param string $class
 * @param array $attributes
 * @return mixed
 */
function create(string $class, array $attributes = [])
{
    return factory($class)->create($attributes);
}

/**
 * Factory make() helper
 *
 * @param string $class
 * @param array $attributes
 * @return mixed
 */
function make(string $class, array $attributes = [])
{
    return factory($class)->make($attributes);
}