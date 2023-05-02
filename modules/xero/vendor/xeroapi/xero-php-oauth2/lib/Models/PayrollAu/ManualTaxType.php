<?php
/**
 * ManualTaxType
 *
 * PHP version 5
 *
 * @category Class
 * @package  XeroAPI\XeroPHP
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Xero Payroll AU
 *
 * This is the Xero Payroll API for orgs in Australia region.
 *
 * OpenAPI spec version: 2.7.0
 * Contact: api@xero.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 4.2.3
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace XeroAPI\XeroPHP\Models\PayrollAu;

use \XeroAPI\XeroPHP\PayrollAuObjectSerializer;
use \XeroAPI\XeroPHP\StringUtil;

/**
 * ManualTaxType Class Doc Comment
 *
 * @category Class
 * @package  XeroAPI\XeroPHP
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ManualTaxType
{
    /**
     * Possible values of this enum
     */
    const PAYGMANUAL = 'PAYGMANUAL';
    const ETPOMANUAL = 'ETPOMANUAL';
    const ETPRMANUAL = 'ETPRMANUAL';
    const SCHEDULE5_MANUAL = 'SCHEDULE5MANUAL';
    const SCHEDULE5_STSLMANUAL = 'SCHEDULE5STSLMANUAL';

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::PAYGMANUAL,
            self::ETPOMANUAL,
            self::ETPRMANUAL,
            self::SCHEDULE5_MANUAL,
            self::SCHEDULE5_STSLMANUAL,
        ];
    }
}


