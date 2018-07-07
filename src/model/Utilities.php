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
     * @param $limit
     * @return bool
     */
    public function checkAndTrimCharacters($data, $limit, $maxCharacters)
    {
        if(empty($data) || !is_numeric($limit))
        {
            return false;
        }

        return count($data) > $limit;
    }

    private function trimCharacters($data, $maxCharacters)
    {
        return substr($data, 0, ($maxCharacters - 1));
    }

    /**
     * @param $score
     * @return float|int|string
     */
    public function convertScoreToStars($score)
    {
        if($score < 0)
        {
            return "";
        }

        return "★" * $score;
    }
}