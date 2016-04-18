<?php
/**
 * Created by PhpStorm.
 * User: Snezhana
 * Date: 17/04/16
 * Time: 15:51
 */

class Calculator {

    /*
    *  The following formula will give us the total number of days for each date
    *  The first part of the formula deals with the number of days for the selected year
    *  The logic behind the following
    *
    *            365*$endYear + $endYear/4 - $endYear/100 + $endYear/400
    *
    *  is that every year that is divisible by 4 is a Leap Year
    *          every year that is divisible by 100 but not by 400 is NOT a Leap Year
    *          every year that is divisible by 400 is a Leap Year
     *
     * Source: http://mathforum.org/library/drmath/view/66857.html
    */

    public static function calculateDiffInDays($start, $end)
    {

        $myDate = new MyDate();
        $datesArray = $myDate->separateYearsMonthAndDays($start, $end);

        $daysOne = round((365 * $datesArray['startYear']
            + $datesArray['startYear'] / 4 - $datesArray['startYear'] / 100
            + $datesArray['startYear'] / 400 + $datesArray['startDays']
            + (153 * $datesArray['startMonth'] + 8) / 5), 0);

        $daysTwo = round((365 * $datesArray['endYear']
            + $datesArray['endYear'] / 4 - $datesArray['endYear'] / 100
            + $datesArray['endYear'] / 400 + $datesArray['endDays']
            + (153 * $datesArray['endMonth'] + 8) / 5), 0);

        $daysDiff = $daysTwo - $daysOne;

        return $daysDiff;

    }

    /**
     * @param $start
     * @param $end
     * @return stdClass
     */
    public static function calculateDiffInYearsMonthsAndAndDays($start, $end)
    {
        $myDate = new MyDate();
        $datesArray = $myDate->separateYearsMonthAndDays($start, $end);

        $monthsArray = $myDate->buildMonthsArray($datesArray['endYear']);

        $days = $datesArray['endDays'] - $datesArray['startDays'];
        $months = (int)$datesArray['endMonth'] - (int)$datesArray['startMonth'];
        if ($days < 0) {
            foreach ($monthsArray as $each => $month) {
                if ($datesArray['endMonth'] == $each) {
                    $days += $month;
                }
            }

            $months = $months - 1;
        }

        $years = $datesArray['endYear'] - $datesArray['startYear'];
        if ($months < 0) {
            $months += 12;
            $years -= 1;
        }


        $objDifference = new stdClass();
        $objDifference->years = $years;
        $objDifference->months = $months;
        $objDifference->days = $days;

        return $objDifference;
    }

}