<?php


namespace App\Http\Controllers;


class Utils
{
    public const SAFARICOM_REGEX = "/^(?:254|\+254|0)7(?:[0129]\d{7}|5[789]\d{6}|4[01234568]\d{6}|6[89]\d{6})$/";
    public const AIRTEL_REGEX = "/^(?:254|\+254|0)?(7(?:(?:[3][0-9])|(?:5[0-6])|(8[0-9]))[0-9]{6})$/";
}
