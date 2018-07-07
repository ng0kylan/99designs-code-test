<?php
/**
 * Created by PhpStorm.
 * User: ducnguyen
 * Date: 8/7/18
 * Time: 12:10 AM
 */

namespace NinetyNineDesigns\PhpCodingTest\model;


abstract class BaseObject
{
    /**
     * @param $record
     * @return mixed
     */
    protected abstract function isValidData($record);
}