<?php
/**
 * Created by PhpStorm.
 * User: ducnguyen
 * Date: 6/7/18
 * Time: 9:26 AM
 */

namespace NinetyNineDesigns\PhpCodingTest\model;


class Utilities
{
    /**
     * @param $stringData
     * @return bool|mixed
     */
    public function convertStringToArray($stringData)
    {
        if(empty($stringData)) return false;

        try
        {
            return json_decode($stringData);
        }
        catch (\Exception $e)
        {
            return false;
        }
    }

    /**
     * @param $data
     * @param $trimAmount
     * @return bool|string
     */
    public function trimCharacters($data, $trimAmount)
    {
        if(strlen($data) <= $trimAmount) return $data;

        return substr($data, 0, (strlen($data) - $trimAmount) - 1);
    }

    /**
     * @param $data
     * @param $maxCharacters
     * @return bool|string
     */
    public function getMaxCharacters($data, $maxCharacters)
    {
        return substr($data, 0, $maxCharacters);
    }
}