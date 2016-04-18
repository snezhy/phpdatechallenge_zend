<?php


class MyDate
{



    /**
     * @param $start
     * @param $end
     * @return stdClass
     */
    public static function diff($start, $end)
    {
        $instance = new MyDate();

        $daysDiff = Calculator::calculateDiffInDays($start, $end);

        $diffInYearsMonthsAndDays = $instance->getDiffInYearsMonthsAndDays($start, $end, $daysDiff);

        $diffInYearsMonthsAndDays->total_days = $daysDiff;
        $invert = $instance->isItInvert($daysDiff);
        $diffInYearsMonthsAndDays->invert = $invert;

        return $diffInYearsMonthsAndDays;

    }

    /**
     * @param $daysDiff
     * @return bool
     */
    public function isItInvert($daysDiff)
    {

        if ($daysDiff < 0) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * @param $start
     * @param $end
     * @return array
     */
    public function separateYearsMonthAndDays($start, $end)
    {

        // Lets get year, month and days separately
        $startArray = explode('/', $start);
        $endArray = explode('/', $end);

        return array('startYear' => $startArray[0],
            'startMonth' => $startArray[1],
            'startDays' => $startArray[2],
            'endYear' => $endArray[0],
            'endMonth' => $endArray[1],
            'endDays' => $endArray[2]);
    }

    /**
     * @param $start
     * @param $end
     * @param $daysDiff
     * @return stdClass
     */
    public function getDiffInYearsMonthsAndDays($start, $end, $daysDiff)
    {

        $difference = new stdClass();
        if ($daysDiff < 0) {
            $difference = Calculator::calculateDiffInYearsMonthsAndAndDays($end, $start);
        } else {
            $difference = Calculator::calculateDiffInYearsMonthsAndAndDays($start, $end);
        }

        return $difference;

    }


    /**
     * @param $year
     * @return bool
     */
    public function isItLeapYear($year)
    {
        $remainerBy4 = $year % 4;
        $remainerBy100 = $year % 100;
        $remainerBy400 = $year % 400;
        $isLeapYear = false;

        if ((($remainerBy4 == 0) && ($remainerBy100 != 0)) ||
            ($remainerBy400 == 0)
        ) {
            $isLeapYear = true;
        }

        return $isLeapYear;
    }

    /**
     * @param $year
     * @return array
     */
    public function buildMonthsArray($year)
    {

        $isLeapYear = self::isItLeapYear($year);
        $monthsArray = array('01' => 31,
            '02' => ($isLeapYear == true) ? 29 : 28,
            '03' => 31,
            '04' => 30,
            '05' => 31,
            '06' => 30,
            '07' => 31,
            '08' => 31,
            '09' => 30,
            '10' => 31,
            '11' => 30,
            '12' => 31);

        return $monthsArray;

    }

}
