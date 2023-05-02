<?php
/**
 * EmployeeStatutorySickLeave
 *
 * PHP version 5
 *
 * @category Class
 * @package  XeroAPI\XeroPHP
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Xero Payroll UK
 *
 * This is the Xero Payroll API for orgs in the UK region.
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

namespace XeroAPI\XeroPHP\Models\PayrollUk;

use \ArrayAccess;
use \XeroAPI\XeroPHP\PayrollUkObjectSerializer;
use \XeroAPI\XeroPHP\StringUtil;

/**
 * EmployeeStatutorySickLeave Class Doc Comment
 *
 * @category Class
 * @package  XeroAPI\XeroPHP
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class EmployeeStatutorySickLeave implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'EmployeeStatutorySickLeave';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'statutory_leave_id' => 'string',
        'employee_id' => 'string',
        'leave_type_id' => 'string',
        'start_date' => '\DateTime',
        'end_date' => '\DateTime',
        'type' => 'string',
        'status' => 'string',
        'work_pattern' => 'string[]',
        'is_pregnancy_related' => 'bool',
        'sufficient_notice' => 'bool',
        'is_entitled' => 'bool',
        'entitlement_weeks_requested' => 'double',
        'entitlement_weeks_qualified' => 'double',
        'entitlement_weeks_remaining' => 'double',
        'overlaps_with_other_leave' => 'bool',
        'entitlement_failure_reasons' => 'string[]'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPIFormats = [
        'statutory_leave_id' => 'uuid',
        'employee_id' => 'uuid',
        'leave_type_id' => 'uuid',
        'start_date' => 'date',
        'end_date' => 'date',
        'type' => null,
        'status' => null,
        'work_pattern' => null,
        'is_pregnancy_related' => null,
        'sufficient_notice' => null,
        'is_entitled' => null,
        'entitlement_weeks_requested' => 'double',
        'entitlement_weeks_qualified' => 'double',
        'entitlement_weeks_remaining' => 'double',
        'overlaps_with_other_leave' => null,
        'entitlement_failure_reasons' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'statutory_leave_id' => 'statutoryLeaveID',
        'employee_id' => 'employeeID',
        'leave_type_id' => 'leaveTypeID',
        'start_date' => 'startDate',
        'end_date' => 'endDate',
        'type' => 'type',
        'status' => 'status',
        'work_pattern' => 'workPattern',
        'is_pregnancy_related' => 'isPregnancyRelated',
        'sufficient_notice' => 'sufficientNotice',
        'is_entitled' => 'isEntitled',
        'entitlement_weeks_requested' => 'entitlementWeeksRequested',
        'entitlement_weeks_qualified' => 'entitlementWeeksQualified',
        'entitlement_weeks_remaining' => 'entitlementWeeksRemaining',
        'overlaps_with_other_leave' => 'overlapsWithOtherLeave',
        'entitlement_failure_reasons' => 'entitlementFailureReasons'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'statutory_leave_id' => 'setStatutoryLeaveId',
        'employee_id' => 'setEmployeeId',
        'leave_type_id' => 'setLeaveTypeId',
        'start_date' => 'setStartDate',
        'end_date' => 'setEndDate',
        'type' => 'setType',
        'status' => 'setStatus',
        'work_pattern' => 'setWorkPattern',
        'is_pregnancy_related' => 'setIsPregnancyRelated',
        'sufficient_notice' => 'setSufficientNotice',
        'is_entitled' => 'setIsEntitled',
        'entitlement_weeks_requested' => 'setEntitlementWeeksRequested',
        'entitlement_weeks_qualified' => 'setEntitlementWeeksQualified',
        'entitlement_weeks_remaining' => 'setEntitlementWeeksRemaining',
        'overlaps_with_other_leave' => 'setOverlapsWithOtherLeave',
        'entitlement_failure_reasons' => 'setEntitlementFailureReasons'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'statutory_leave_id' => 'getStatutoryLeaveId',
        'employee_id' => 'getEmployeeId',
        'leave_type_id' => 'getLeaveTypeId',
        'start_date' => 'getStartDate',
        'end_date' => 'getEndDate',
        'type' => 'getType',
        'status' => 'getStatus',
        'work_pattern' => 'getWorkPattern',
        'is_pregnancy_related' => 'getIsPregnancyRelated',
        'sufficient_notice' => 'getSufficientNotice',
        'is_entitled' => 'getIsEntitled',
        'entitlement_weeks_requested' => 'getEntitlementWeeksRequested',
        'entitlement_weeks_qualified' => 'getEntitlementWeeksQualified',
        'entitlement_weeks_remaining' => 'getEntitlementWeeksRemaining',
        'overlaps_with_other_leave' => 'getOverlapsWithOtherLeave',
        'entitlement_failure_reasons' => 'getEntitlementFailureReasons'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    const ENTITLEMENT_FAILURE_REASONS_UNABLE_TO_CALCULATE_AWE = 'UnableToCalculateAwe';
    const ENTITLEMENT_FAILURE_REASONS_AWE_LOWER_THAN_LEL = 'AweLowerThanLel';
    const ENTITLEMENT_FAILURE_REASONS_NOT_QUALIFIED_IN_PREVIOUS_PIW = 'NotQualifiedInPreviousPiw';
    const ENTITLEMENT_FAILURE_REASONS_EXCEEDED_MAXIMUM_ENTITLEMENT_WEEKS_OF_SSP = 'ExceededMaximumEntitlementWeeksOfSsp';
    const ENTITLEMENT_FAILURE_REASONS_EXCEEDED_MAXIMUM_DURATION_OF_PIW = 'ExceededMaximumDurationOfPiw';
    const ENTITLEMENT_FAILURE_REASONS_SUFFICIENT_NOTICE_NOT_GIVEN = 'SufficientNoticeNotGiven';


    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getEntitlementFailureReasonsAllowableValues()
    {
        return [
            self::ENTITLEMENT_FAILURE_REASONS_UNABLE_TO_CALCULATE_AWE,
            self::ENTITLEMENT_FAILURE_REASONS_AWE_LOWER_THAN_LEL,
            self::ENTITLEMENT_FAILURE_REASONS_NOT_QUALIFIED_IN_PREVIOUS_PIW,
            self::ENTITLEMENT_FAILURE_REASONS_EXCEEDED_MAXIMUM_ENTITLEMENT_WEEKS_OF_SSP,
            self::ENTITLEMENT_FAILURE_REASONS_EXCEEDED_MAXIMUM_DURATION_OF_PIW,
            self::ENTITLEMENT_FAILURE_REASONS_SUFFICIENT_NOTICE_NOT_GIVEN,
        ];
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['statutory_leave_id'] = isset($data['statutory_leave_id']) ? $data['statutory_leave_id'] : null;
        $this->container['employee_id'] = isset($data['employee_id']) ? $data['employee_id'] : null;
        $this->container['leave_type_id'] = isset($data['leave_type_id']) ? $data['leave_type_id'] : null;
        $this->container['start_date'] = isset($data['start_date']) ? $data['start_date'] : null;
        $this->container['end_date'] = isset($data['end_date']) ? $data['end_date'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['work_pattern'] = isset($data['work_pattern']) ? $data['work_pattern'] : null;
        $this->container['is_pregnancy_related'] = isset($data['is_pregnancy_related']) ? $data['is_pregnancy_related'] : null;
        $this->container['sufficient_notice'] = isset($data['sufficient_notice']) ? $data['sufficient_notice'] : null;
        $this->container['is_entitled'] = isset($data['is_entitled']) ? $data['is_entitled'] : null;
        $this->container['entitlement_weeks_requested'] = isset($data['entitlement_weeks_requested']) ? $data['entitlement_weeks_requested'] : null;
        $this->container['entitlement_weeks_qualified'] = isset($data['entitlement_weeks_qualified']) ? $data['entitlement_weeks_qualified'] : null;
        $this->container['entitlement_weeks_remaining'] = isset($data['entitlement_weeks_remaining']) ? $data['entitlement_weeks_remaining'] : null;
        $this->container['overlaps_with_other_leave'] = isset($data['overlaps_with_other_leave']) ? $data['overlaps_with_other_leave'] : null;
        $this->container['entitlement_failure_reasons'] = isset($data['entitlement_failure_reasons']) ? $data['entitlement_failure_reasons'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['employee_id'] === null) {
            $invalidProperties[] = "'employee_id' can't be null";
        }
        if ($this->container['leave_type_id'] === null) {
            $invalidProperties[] = "'leave_type_id' can't be null";
        }
        if ($this->container['start_date'] === null) {
            $invalidProperties[] = "'start_date' can't be null";
        }
        if ($this->container['end_date'] === null) {
            $invalidProperties[] = "'end_date' can't be null";
        }
        if ($this->container['work_pattern'] === null) {
            $invalidProperties[] = "'work_pattern' can't be null";
        }
        if ($this->container['is_pregnancy_related'] === null) {
            $invalidProperties[] = "'is_pregnancy_related' can't be null";
        }
        if ($this->container['sufficient_notice'] === null) {
            $invalidProperties[] = "'sufficient_notice' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets statutory_leave_id
     *
     * @return string|null
     */
    public function getStatutoryLeaveId()
    {
        return $this->container['statutory_leave_id'];
    }

    /**
     * Sets statutory_leave_id
     *
     * @param string|null $statutory_leave_id The unique identifier (guid) of a statutory leave
     *
     * @return $this
     */
    public function setStatutoryLeaveId($statutory_leave_id)
    {

        $this->container['statutory_leave_id'] = $statutory_leave_id;

        return $this;
    }


    /**
     * Gets employee_id
     *
     * @return string
     */
    public function getEmployeeId()
    {
        return $this->container['employee_id'];
    }

    /**
     * Sets employee_id
     *
     * @param string $employee_id The unique identifier (guid) of the employee
     *
     * @return $this
     */
    public function setEmployeeId($employee_id)
    {

        $this->container['employee_id'] = $employee_id;

        return $this;
    }


    /**
     * Gets leave_type_id
     *
     * @return string
     */
    public function getLeaveTypeId()
    {
        return $this->container['leave_type_id'];
    }

    /**
     * Sets leave_type_id
     *
     * @param string $leave_type_id The unique identifier (guid) of the \"Statutory Sick Leave (non-pensionable)\" pay item
     *
     * @return $this
     */
    public function setLeaveTypeId($leave_type_id)
    {

        $this->container['leave_type_id'] = $leave_type_id;

        return $this;
    }


    /**
     * Gets start_date
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->container['start_date'];
    }

    /**
     * Sets start_date
     *
     * @param \DateTime $start_date The date when the leave starts
     *
     * @return $this
     */
    public function setStartDate($start_date)
    {

        $this->container['start_date'] = $start_date;

        return $this;
    }


    /**
     * Gets end_date
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->container['end_date'];
    }

    /**
     * Sets end_date
     *
     * @param \DateTime $end_date The date when the leave ends
     *
     * @return $this
     */
    public function setEndDate($end_date)
    {

        $this->container['end_date'] = $end_date;

        return $this;
    }


    /**
     * Gets type
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string|null $type the type of statutory leave
     *
     * @return $this
     */
    public function setType($type)
    {

        $this->container['type'] = $type;

        return $this;
    }


    /**
     * Gets status
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string|null $status the type of statutory leave
     *
     * @return $this
     */
    public function setStatus($status)
    {

        $this->container['status'] = $status;

        return $this;
    }


    /**
     * Gets work_pattern
     *
     * @return string[]
     */
    public function getWorkPattern()
    {
        return $this->container['work_pattern'];
    }

    /**
     * Sets work_pattern
     *
     * @param string[] $work_pattern The days of the work week the employee is scheduled to work at the time the leave is taken
     *
     * @return $this
     */
    public function setWorkPattern($work_pattern)
    {

        $this->container['work_pattern'] = $work_pattern;

        return $this;
    }


    /**
     * Gets is_pregnancy_related
     *
     * @return bool
     */
    public function getIsPregnancyRelated()
    {
        return $this->container['is_pregnancy_related'];
    }

    /**
     * Sets is_pregnancy_related
     *
     * @param bool $is_pregnancy_related Whether the sick leave was pregnancy related
     *
     * @return $this
     */
    public function setIsPregnancyRelated($is_pregnancy_related)
    {

        $this->container['is_pregnancy_related'] = $is_pregnancy_related;

        return $this;
    }


    /**
     * Gets sufficient_notice
     *
     * @return bool
     */
    public function getSufficientNotice()
    {
        return $this->container['sufficient_notice'];
    }

    /**
     * Sets sufficient_notice
     *
     * @param bool $sufficient_notice Whether the employee provided sufficent notice and documentation as required by the employer supporting the sick leave request
     *
     * @return $this
     */
    public function setSufficientNotice($sufficient_notice)
    {

        $this->container['sufficient_notice'] = $sufficient_notice;

        return $this;
    }


    /**
     * Gets is_entitled
     *
     * @return bool|null
     */
    public function getIsEntitled()
    {
        return $this->container['is_entitled'];
    }

    /**
     * Sets is_entitled
     *
     * @param bool|null $is_entitled Whether the leave was entitled to receive payment
     *
     * @return $this
     */
    public function setIsEntitled($is_entitled)
    {

        $this->container['is_entitled'] = $is_entitled;

        return $this;
    }


    /**
     * Gets entitlement_weeks_requested
     *
     * @return double|null
     */
    public function getEntitlementWeeksRequested()
    {
        return $this->container['entitlement_weeks_requested'];
    }

    /**
     * Sets entitlement_weeks_requested
     *
     * @param double|null $entitlement_weeks_requested The amount of requested time (in weeks)
     *
     * @return $this
     */
    public function setEntitlementWeeksRequested($entitlement_weeks_requested)
    {

        $this->container['entitlement_weeks_requested'] = $entitlement_weeks_requested;

        return $this;
    }


    /**
     * Gets entitlement_weeks_qualified
     *
     * @return double|null
     */
    public function getEntitlementWeeksQualified()
    {
        return $this->container['entitlement_weeks_qualified'];
    }

    /**
     * Sets entitlement_weeks_qualified
     *
     * @param double|null $entitlement_weeks_qualified The amount of statutory sick leave time off (in weeks) that is available to take at the time the leave was requested
     *
     * @return $this
     */
    public function setEntitlementWeeksQualified($entitlement_weeks_qualified)
    {

        $this->container['entitlement_weeks_qualified'] = $entitlement_weeks_qualified;

        return $this;
    }


    /**
     * Gets entitlement_weeks_remaining
     *
     * @return double|null
     */
    public function getEntitlementWeeksRemaining()
    {
        return $this->container['entitlement_weeks_remaining'];
    }

    /**
     * Sets entitlement_weeks_remaining
     *
     * @param double|null $entitlement_weeks_remaining A calculated amount of time (in weeks) that remains for the statutory sick leave period
     *
     * @return $this
     */
    public function setEntitlementWeeksRemaining($entitlement_weeks_remaining)
    {

        $this->container['entitlement_weeks_remaining'] = $entitlement_weeks_remaining;

        return $this;
    }


    /**
     * Gets overlaps_with_other_leave
     *
     * @return bool|null
     */
    public function getOverlapsWithOtherLeave()
    {
        return $this->container['overlaps_with_other_leave'];
    }

    /**
     * Sets overlaps_with_other_leave
     *
     * @param bool|null $overlaps_with_other_leave Whether another leave (Paternity, Shared Parental specifically) occurs during the requested leave's period. While this is allowed it could affect payment amounts
     *
     * @return $this
     */
    public function setOverlapsWithOtherLeave($overlaps_with_other_leave)
    {

        $this->container['overlaps_with_other_leave'] = $overlaps_with_other_leave;

        return $this;
    }


    /**
     * Gets entitlement_failure_reasons
     *
     * @return string[]|null
     */
    public function getEntitlementFailureReasons()
    {
        return $this->container['entitlement_failure_reasons'];
    }

    /**
     * Sets entitlement_failure_reasons
     *
     * @param string[]|null $entitlement_failure_reasons If the leave requested was considered \"not entitled\", the reasons why are listed here.
     *
     * @return $this
     */
    public function setEntitlementFailureReasons($entitlement_failure_reasons)
    {
        $allowedValues = $this->getEntitlementFailureReasonsAllowableValues();
        if (!is_null($entitlement_failure_reasons) && array_diff($entitlement_failure_reasons, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'entitlement_failure_reasons', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }

        $this->container['entitlement_failure_reasons'] = $entitlement_failure_reasons;

        return $this;
    }


    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed $value Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            PayrollUkObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }
}


