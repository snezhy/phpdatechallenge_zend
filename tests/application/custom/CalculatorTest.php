<?php
/**
 * Created by PhpStorm.
 * User: Snezhana
 * Date: 17/04/16
 * Time: 23:51
 */

class CalculatorTest extends PHPUnit_Framework_TestCase {

    private $calculator;

    public function __construct() {

        require_once("../../../library/custom/Calculator.php");
        $this->calculator = new Custom_Calculator();
    }

    public function testCalculateDiffInDays() {

        $daysDiff = $this->calculator->calculateDiffInDays('2014/07/27', '2016/09/17');
        $this->assertEquals(782, $daysDiff);
    }

    public function testCalculateDiffDays() {

        $this->assertDays('2016/04/07', '2016/04/21');
    }

    public function assertDays($start, $end) {

        $yearsMonthsAndDays = $this->calculator->calculateDiffInYearsMonthsAndAndDays($start, $end);

        $this->assertEquals(14, $yearsMonthsAndDays->days);

    }

}