<?php

/**
 * Created by PhpStorm.
 * User: Islem Khemissi
 */

function create($class_name, $attributes = [], $rows_number = 1)
{
    return ($rows_number == 1)
        ? factory($class_name)->create($attributes)
        : factory($class_name, $rows_number)->create($attributes);
}

function make($class_name, $attributes = [])
{
    return factory($class_name)->make($attributes);
}

function raw($class_name, $attributes = [])
{
    return factory($class_name)->raw($attributes);
}
