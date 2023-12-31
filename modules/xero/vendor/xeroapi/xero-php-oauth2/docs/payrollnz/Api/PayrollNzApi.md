# XeroAPI\XeroPHP\PayrollNzApi

All URIs are relative to *https://api.xero.com/payroll.xro/2.0*

 Method                                                                                               | HTTP request                                                                    | Description                                                                                                                           
------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------
 [**approveTimesheet**](PayrollNzApi.md#approveTimesheet)                                             | **POST** /Timesheets/{TimesheetID}/Approve                                      | approve a timesheet                                                                                                                   
 [**createDeduction**](PayrollNzApi.md#createDeduction)                                               | **POST** /Deductions                                                            | create a new deduction                                                                                                                
 [**createEarningsRate**](PayrollNzApi.md#createEarningsRate)                                         | **POST** /EarningsRates                                                         | create a new earnings rate                                                                                                            
 [**createEmployee**](PayrollNzApi.md#createEmployee)                                                 | **POST** /Employees                                                             | creates employees                                                                                                                     
 [**createEmployeeEarningsTemplate**](PayrollNzApi.md#createEmployeeEarningsTemplate)                 | **POST** /Employees/{EmployeeId}/PayTemplates/earnings                          | creates employee earnings template records                                                                                            
 [**createEmployeeLeave**](PayrollNzApi.md#createEmployeeLeave)                                       | **POST** /Employees/{EmployeeId}/Leave                                          | creates employee leave records                                                                                                        
 [**createEmployeeLeaveSetup**](PayrollNzApi.md#createEmployeeLeaveSetup)                             | **POST** /Employees/{EmployeeId}/leaveSetup                                     | Allows you to set-up leave for a specific employee. This is required before viewing, configuring and requesting leave for an employee 
 [**createEmployeeLeaveType**](PayrollNzApi.md#createEmployeeLeaveType)                               | **POST** /Employees/{EmployeeId}/LeaveTypes                                     | creates employee leave type records                                                                                                   
 [**createEmployeeOpeningBalances**](PayrollNzApi.md#createEmployeeOpeningBalances)                   | **POST** /Employees/{EmployeeId}/openingBalances                                | creates employee opening balances                                                                                                     
 [**createEmployeePaymentMethod**](PayrollNzApi.md#createEmployeePaymentMethod)                       | **POST** /Employees/{EmployeeId}/PaymentMethods                                 | creates employee payment method                                                                                                       
 [**createEmployeeSalaryAndWage**](PayrollNzApi.md#createEmployeeSalaryAndWage)                       | **POST** /Employees/{EmployeeId}/SalaryAndWages                                 | creates employee salary and wage record                                                                                               
 [**createEmployment**](PayrollNzApi.md#createEmployment)                                             | **POST** /Employees/{EmployeeId}/Employment                                     | creates employment                                                                                                                    
 [**createLeaveType**](PayrollNzApi.md#createLeaveType)                                               | **POST** /LeaveTypes                                                            | create a new leave type                                                                                                               
 [**createMultipleEmployeeEarningsTemplate**](PayrollNzApi.md#createMultipleEmployeeEarningsTemplate) | **POST** /Employees/{EmployeeId}/paytemplateearnings                            | creates multiple employee earnings template records                                                                                   
 [**createPayRun**](PayrollNzApi.md#createPayRun)                                                     | **POST** /PayRuns                                                               | create a pay run                                                                                                                      
 [**createPayRunCalendar**](PayrollNzApi.md#createPayRunCalendar)                                     | **POST** /PayRunCalendars                                                       | create a new payrun calendar                                                                                                          
 [**createReimbursement**](PayrollNzApi.md#createReimbursement)                                       | **POST** /Reimbursements                                                        | create a new reimbursement                                                                                                            
 [**createSuperannuation**](PayrollNzApi.md#createSuperannuation)                                     | **POST** /superannuations                                                       | create a new superannuation                                                                                                           
 [**createTimesheet**](PayrollNzApi.md#createTimesheet)                                               | **POST** /Timesheets                                                            | create a new timesheet                                                                                                                
 [**createTimesheetLine**](PayrollNzApi.md#createTimesheetLine)                                       | **POST** /Timesheets/{TimesheetID}/Lines                                        | create a new timesheet line                                                                                                           
 [**deleteEmployeeEarningsTemplate**](PayrollNzApi.md#deleteEmployeeEarningsTemplate)                 | **DELETE** /Employees/{EmployeeId}/PayTemplates/earnings/{PayTemplateEarningID} | deletes an employee earnings template record                                                                                          
 [**deleteEmployeeLeave**](PayrollNzApi.md#deleteEmployeeLeave)                                       | **DELETE** /Employees/{EmployeeId}/Leave/{LeaveID}                              | deletes an employee leave record                                                                                                      
 [**deleteEmployeeSalaryAndWage**](PayrollNzApi.md#deleteEmployeeSalaryAndWage)                       | **DELETE** /Employees/{EmployeeId}/SalaryAndWages/{SalaryAndWagesID}            | deletes an employee salary and wages record                                                                                           
 [**deleteTimesheet**](PayrollNzApi.md#deleteTimesheet)                                               | **DELETE** /Timesheets/{TimesheetID}                                            | delete a timesheet                                                                                                                    
 [**deleteTimesheetLine**](PayrollNzApi.md#deleteTimesheetLine)                                       | **DELETE** /Timesheets/{TimesheetID}/Lines/{TimesheetLineID}                    | delete a timesheet line                                                                                                               
 [**getDeduction**](PayrollNzApi.md#getDeduction)                                                     | **GET** /Deductions/{deductionId}                                               | retrieve a single deduction by id                                                                                                     
 [**getDeductions**](PayrollNzApi.md#getDeductions)                                                   | **GET** /Deductions                                                             | searches deductions                                                                                                                   
 [**getEarningsRate**](PayrollNzApi.md#getEarningsRate)                                               | **GET** /EarningsRates/{EarningsRateID}                                         | retrieve a single earnings rates by id                                                                                                
 [**getEarningsRates**](PayrollNzApi.md#getEarningsRates)                                             | **GET** /EarningsRates                                                          | searches earnings rates                                                                                                               
 [**getEmployee**](PayrollNzApi.md#getEmployee)                                                       | **GET** /Employees/{EmployeeId}                                                 | searches employees                                                                                                                    
 [**getEmployeeLeaveBalances**](PayrollNzApi.md#getEmployeeLeaveBalances)                             | **GET** /Employees/{EmployeeId}/LeaveBalances                                   | search employee leave balances                                                                                                        
 [**getEmployeeLeavePeriods**](PayrollNzApi.md#getEmployeeLeavePeriods)                               | **GET** /Employees/{EmployeeId}/LeavePeriods                                    | searches employee leave periods                                                                                                       
 [**getEmployeeLeaveTypes**](PayrollNzApi.md#getEmployeeLeaveTypes)                                   | **GET** /Employees/{EmployeeId}/LeaveTypes                                      | searches employee leave types                                                                                                         
 [**getEmployeeLeaves**](PayrollNzApi.md#getEmployeeLeaves)                                           | **GET** /Employees/{EmployeeId}/Leave                                           | search employee leave records                                                                                                         
 [**getEmployeeOpeningBalances**](PayrollNzApi.md#getEmployeeOpeningBalances)                         | **GET** /Employees/{EmployeeId}/openingBalances                                 | retrieve employee openingbalances                                                                                                     
 [**getEmployeePayTemplates**](PayrollNzApi.md#getEmployeePayTemplates)                               | **GET** /Employees/{EmployeeId}/PayTemplates                                    | searches employee pay templates                                                                                                       
 [**getEmployeePaymentMethod**](PayrollNzApi.md#getEmployeePaymentMethod)                             | **GET** /Employees/{EmployeeId}/PaymentMethods                                  | retrieves an employee&#39;s payment method                                                                                            
 [**getEmployeeSalaryAndWage**](PayrollNzApi.md#getEmployeeSalaryAndWage)                             | **GET** /Employees/{EmployeeId}/SalaryAndWages/{SalaryAndWagesID}               | get employee salary and wages record by id                                                                                            
 [**getEmployeeSalaryAndWages**](PayrollNzApi.md#getEmployeeSalaryAndWages)                           | **GET** /Employees/{EmployeeId}/SalaryAndWages                                  | retrieves an employee&#39;s salary and wages                                                                                          
 [**getEmployeeTax**](PayrollNzApi.md#getEmployeeTax)                                                 | **GET** /Employees/{EmployeeId}/Tax                                             | searches tax records for an employee                                                                                                  
 [**getEmployees**](PayrollNzApi.md#getEmployees)                                                     | **GET** /Employees                                                              | searches employees                                                                                                                    
 [**getLeaveType**](PayrollNzApi.md#getLeaveType)                                                     | **GET** /LeaveTypes/{LeaveTypeID}                                               | retrieve a single leave type by id                                                                                                    
 [**getLeaveTypes**](PayrollNzApi.md#getLeaveTypes)                                                   | **GET** /LeaveTypes                                                             | searches leave types                                                                                                                  
 [**getPayRun**](PayrollNzApi.md#getPayRun)                                                           | **GET** /PayRuns/{PayRunID}                                                     | retrieve a single pay run by id                                                                                                       
 [**getPayRunCalendar**](PayrollNzApi.md#getPayRunCalendar)                                           | **GET** /PayRunCalendars/{PayrollCalendarID}                                    | retrieve a single payrun calendar by id                                                                                               
 [**getPayRunCalendars**](PayrollNzApi.md#getPayRunCalendars)                                         | **GET** /PayRunCalendars                                                        | searches payrun calendars                                                                                                             
 [**getPayRuns**](PayrollNzApi.md#getPayRuns)                                                         | **GET** /PayRuns                                                                | searches pay runs                                                                                                                     
 [**getPaySlip**](PayrollNzApi.md#getPaySlip)                                                         | **GET** /PaySlips/{PaySlipID}                                                   | retrieve a single payslip by id                                                                                                       
 [**getPaySlips**](PayrollNzApi.md#getPaySlips)                                                       | **GET** /PaySlips                                                               | searches payslips                                                                                                                     
 [**getReimbursement**](PayrollNzApi.md#getReimbursement)                                             | **GET** /Reimbursements/{ReimbursementID}                                       | retrieve a single reimbursement by id                                                                                                 
 [**getReimbursements**](PayrollNzApi.md#getReimbursements)                                           | **GET** /Reimbursements                                                         | searches reimbursements                                                                                                               
 [**getSettings**](PayrollNzApi.md#getSettings)                                                       | **GET** /Settings                                                               | searches settings                                                                                                                     
 [**getStatutoryDeduction**](PayrollNzApi.md#getStatutoryDeduction)                                   | **GET** /StatutoryDeductions/{Id}                                               | retrieve a single statutory deduction by id                                                                                           
 [**getStatutoryDeductions**](PayrollNzApi.md#getStatutoryDeductions)                                 | **GET** /StatutoryDeductions                                                    | searches statutory deductions                                                                                                         
 [**getSuperannuation**](PayrollNzApi.md#getSuperannuation)                                           | **GET** /superannuations/{SuperannuationID}                                     | searches for a unique superannuation                                                                                                  
 [**getSuperannuations**](PayrollNzApi.md#getSuperannuations)                                         | **GET** /superannuations                                                        | searches statutory deductions                                                                                                         
 [**getTimesheet**](PayrollNzApi.md#getTimesheet)                                                     | **GET** /Timesheets/{TimesheetID}                                               | retrieve a single timesheet by id                                                                                                     
 [**getTimesheets**](PayrollNzApi.md#getTimesheets)                                                   | **GET** /Timesheets                                                             | searches timesheets                                                                                                                   
 [**getTrackingCategories**](PayrollNzApi.md#getTrackingCategories)                                   | **GET** /settings/trackingCategories                                            | searches tracking categories                                                                                                          
 [**revertTimesheet**](PayrollNzApi.md#revertTimesheet)                                               | **POST** /Timesheets/{TimesheetID}/RevertToDraft                                | revert a timesheet to draft                                                                                                           
 [**updateEmployee**](PayrollNzApi.md#updateEmployee)                                                 | **PUT** /Employees/{EmployeeId}                                                 | updates employee                                                                                                                      
 [**updateEmployeeEarningsTemplate**](PayrollNzApi.md#updateEmployeeEarningsTemplate)                 | **PUT** /Employees/{EmployeeId}/PayTemplates/earnings/{PayTemplateEarningID}    | updates employee earnings template records                                                                                            
 [**updateEmployeeLeave**](PayrollNzApi.md#updateEmployeeLeave)                                       | **PUT** /Employees/{EmployeeId}/Leave/{LeaveID}                                 | updates employee leave records                                                                                                        
 [**updateEmployeeSalaryAndWage**](PayrollNzApi.md#updateEmployeeSalaryAndWage)                       | **PUT** /Employees/{EmployeeId}/SalaryAndWages/{SalaryAndWagesID}               | updates employee salary and wages record                                                                                              
 [**updateEmployeeTax**](PayrollNzApi.md#updateEmployeeTax)                                           | **POST** /Employees/{EmployeeId}/Tax                                            | updates the tax records for an employee                                                                                               
 [**updatePayRun**](PayrollNzApi.md#updatePayRun)                                                     | **PUT** /PayRuns/{PayRunID}                                                     | update a pay run                                                                                                                      
 [**updatePaySlipLineItems**](PayrollNzApi.md#updatePaySlipLineItems)                                 | **PUT** /PaySlips/{PaySlipID}                                                   | creates employee pay slip                                                                                                             
 [**updateTimesheetLine**](PayrollNzApi.md#updateTimesheetLine)                                       | **PUT** /Timesheets/{TimesheetID}/Lines/{TimesheetLineID}                       | update a timesheet line                                                                                                               

# **approveTimesheet**

> \XeroAPI\XeroPHP\Models\PayrollNz\TimesheetObject approveTimesheet($xero_tenant_id, $timesheet_id)

approve a timesheet

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$timesheet_id = 'timesheet_id_example'; // string | Identifier for the timesheet

try {
    $result = $apiInstance->approveTimesheet($xero_tenant_id, $timesheet_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->approveTimesheet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                  | Notes 
--------------------|----------------------------|------------------------------|-------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant   |
 **timesheet_id**   | [**string**](../Model/.md) | Identifier for the timesheet |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\TimesheetObject**](../Model/TimesheetObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createDeduction**

> \XeroAPI\XeroPHP\Models\PayrollNz\DeductionObject createDeduction($xero_tenant_id, $deduction)

create a new deduction

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$deduction = { "deductionName": "My new deducation", "deductionCategory": "NzOther", "liabilityAccountId": "568f2e9a-0870-46cc-8678-f83f132ed4e3" }; // \XeroAPI\XeroPHP\Models\PayrollNz\Deduction | 

try {
    $result = $apiInstance->createDeduction($xero_tenant_id, $deduction);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->createDeduction: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                                                                     | Description                | Notes 
--------------------|--------------------------------------------------------------------------|----------------------------|-------
 **xero_tenant_id** | **string**                                                               | Xero identifier for Tenant |
 **deduction**      | [**\XeroAPI\XeroPHP\Models\PayrollNz\Deduction**](../Model/Deduction.md) |                            |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\DeductionObject**](../Model/DeductionObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createEarningsRate**

> \XeroAPI\XeroPHP\Models\PayrollNz\EarningsRateObject createEarningsRate($xero_tenant_id, $earnings_rate)

create a new earnings rate

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$earnings_rate = { "name": "My Earnings Rate", "earningsType": "RegularEarnings", "rateType": "RatePerUnit", "typeOfUnits": "hours", "expenseAccountID": "e4eb36f6-97e3-4427-a394-dd4e1b355c2e" }; // \XeroAPI\XeroPHP\Models\PayrollNz\EarningsRate | 

try {
    $result = $apiInstance->createEarningsRate($xero_tenant_id, $earnings_rate);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->createEarningsRate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                                                                           | Description                | Notes 
--------------------|--------------------------------------------------------------------------------|----------------------------|-------
 **xero_tenant_id** | **string**                                                                     | Xero identifier for Tenant |
 **earnings_rate**  | [**\XeroAPI\XeroPHP\Models\PayrollNz\EarningsRate**](../Model/EarningsRate.md) |                            |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EarningsRateObject**](../Model/EarningsRateObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createEmployee**

> \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeObject createEmployee($xero_tenant_id, $employee)

creates employees

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee = { "title": "Mr", "firstName": "Mike", "lastName": "Johntzxzpxhmkgson", "dateOfBirth": "2000-01-01", "address": { "addressLine1": "101 Green St", "city": "San Francisco", "postCode": "4351", "countryName": "United Kingdom" }, "email": "83139@starkindustries.com", "gender": "M" }; // \XeroAPI\XeroPHP\Models\PayrollNz\Employee | 

try {
    $result = $apiInstance->createEmployee($xero_tenant_id, $employee);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->createEmployee: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                                                                   | Description                | Notes 
--------------------|------------------------------------------------------------------------|----------------------------|-------
 **xero_tenant_id** | **string**                                                             | Xero identifier for Tenant |
 **employee**       | [**\XeroAPI\XeroPHP\Models\PayrollNz\Employee**](../Model/Employee.md) |                            |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeObject**](../Model/EmployeeObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createEmployeeEarningsTemplate**

> \XeroAPI\XeroPHP\Models\PayrollNz\EarningsTemplateObject createEmployeeEarningsTemplate($xero_tenant_id, $employee_id,
> $earnings_template)

creates employee earnings template records

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object
$earnings_template = { "ratePerUnit": 20, "numberOfUnits": 8, "earningsRateID": "f9d8f5b5-9049-47f4-8541-35e200f750a5", "name": "My New One" }; // \XeroAPI\XeroPHP\Models\PayrollNz\EarningsTemplate | 

try {
    $result = $apiInstance->createEmployeeEarningsTemplate($xero_tenant_id, $employee_id, $earnings_template);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->createEmployeeEarningsTemplate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name                  | Type                                                                                   | Description                   | Notes 
-----------------------|----------------------------------------------------------------------------------------|-------------------------------|-------
 **xero_tenant_id**    | **string**                                                                             | Xero identifier for Tenant    |
 **employee_id**       | [**string**](../Model/.md)                                                             | Employee id for single object |
 **earnings_template** | [**\XeroAPI\XeroPHP\Models\PayrollNz\EarningsTemplate**](../Model/EarningsTemplate.md) |                               |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EarningsTemplateObject**](../Model/EarningsTemplateObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createEmployeeLeave**

> \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeaveObject createEmployeeLeave($xero_tenant_id, $employee_id,
> $employee_leave)

creates employee leave records

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object
$employee_leave = { "leaveTypeID": "b0b1b79e-2a25-46c2-ad08-ca25ef48d7e4", "description": "Creating a Desription", "startDate": "2020-04-24", "endDate": "2020-04-26" }; // \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeave | 

try {
    $result = $apiInstance->createEmployeeLeave($xero_tenant_id, $employee_id, $employee_leave);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->createEmployeeLeave: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                                                                             | Description                   | Notes 
--------------------|----------------------------------------------------------------------------------|-------------------------------|-------
 **xero_tenant_id** | **string**                                                                       | Xero identifier for Tenant    |
 **employee_id**    | [**string**](../Model/.md)                                                       | Employee id for single object |
 **employee_leave** | [**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeave**](../Model/EmployeeLeave.md) |                               |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeaveObject**](../Model/EmployeeLeaveObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createEmployeeLeaveSetup**

> \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeaveSetupObject createEmployeeLeaveSetup($xero_tenant_id, $employee_id,
> $employee_leave_setup)

Allows you to set-up leave for a specific employee. This is required before viewing, configuring and requesting leave
for an employee

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object
$employee_leave_setup = { "holidayPayOpeningBalance": 10, "annualLeaveOpeningBalance": 100, "sickLeaveHoursToAccrueAnnually": 20, "sickLeaveOpeningBalance": 10 }; // \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeaveSetup | 

try {
    $result = $apiInstance->createEmployeeLeaveSetup($xero_tenant_id, $employee_id, $employee_leave_setup);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->createEmployeeLeaveSetup: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name                     | Type                                                                                       | Description                   | Notes 
--------------------------|--------------------------------------------------------------------------------------------|-------------------------------|-------
 **xero_tenant_id**       | **string**                                                                                 | Xero identifier for Tenant    |
 **employee_id**          | [**string**](../Model/.md)                                                                 | Employee id for single object |
 **employee_leave_setup** | [**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeaveSetup**](../Model/EmployeeLeaveSetup.md) |                               |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeaveSetupObject**](../Model/EmployeeLeaveSetupObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createEmployeeLeaveType**

> \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeaveTypeObject createEmployeeLeaveType($xero_tenant_id, $employee_id,
> $employee_leave_type)

creates employee leave type records

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object
$employee_leave_type = { "leaveTypeID": "35da97ae-05b9-427f-9a98-69157ba42cec", "scheduleOfAccrual": "AnnuallyAfter6Months", "hoursAccruedAnnually": 10, "maximumToAccrue": 80, "openingBalance": 100, "rateAccruedHourly": 3.5 }; // \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeaveType | 

try {
    $result = $apiInstance->createEmployeeLeaveType($xero_tenant_id, $employee_id, $employee_leave_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->createEmployeeLeaveType: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name                    | Type                                                                                     | Description                   | Notes 
-------------------------|------------------------------------------------------------------------------------------|-------------------------------|-------
 **xero_tenant_id**      | **string**                                                                               | Xero identifier for Tenant    |
 **employee_id**         | [**string**](../Model/.md)                                                               | Employee id for single object |
 **employee_leave_type** | [**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeaveType**](../Model/EmployeeLeaveType.md) |                               |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeaveTypeObject**](../Model/EmployeeLeaveTypeObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createEmployeeOpeningBalances**

> \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeOpeningBalancesObject createEmployeeOpeningBalances($xero_tenant_id,
> $employee_id, $employee_opening_balance)

creates employee opening balances

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object
$employee_opening_balance = [{"periodEndDate":"2020-10-01","daysPaid":3,"unpaidWeeks":2,"grossEarnings":40.0}]; // \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeOpeningBalance[] | 

try {
    $result = $apiInstance->createEmployeeOpeningBalances($xero_tenant_id, $employee_id, $employee_opening_balance);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->createEmployeeOpeningBalances: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name                         | Type                                                                                                 | Description                   | Notes 
------------------------------|------------------------------------------------------------------------------------------------------|-------------------------------|-------
 **xero_tenant_id**           | **string**                                                                                           | Xero identifier for Tenant    |
 **employee_id**              | [**string**](../Model/.md)                                                                           | Employee id for single object |
 **employee_opening_balance** | [**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeOpeningBalance[]**](../Model/EmployeeOpeningBalance.md) |                               |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeOpeningBalancesObject**](../Model/EmployeeOpeningBalancesObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createEmployeePaymentMethod**

> \XeroAPI\XeroPHP\Models\PayrollNz\PaymentMethodObject createEmployeePaymentMethod($xero_tenant_id, $employee_id,
> $payment_method)

creates employee payment method

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object
$payment_method = new \XeroAPI\XeroPHP\Models\PayrollNz\PaymentMethod(); // \XeroAPI\XeroPHP\Models\PayrollNz\PaymentMethod | 

try {
    $result = $apiInstance->createEmployeePaymentMethod($xero_tenant_id, $employee_id, $payment_method);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->createEmployeePaymentMethod: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                                                                             | Description                   | Notes 
--------------------|----------------------------------------------------------------------------------|-------------------------------|-------
 **xero_tenant_id** | **string**                                                                       | Xero identifier for Tenant    |
 **employee_id**    | [**string**](../Model/.md)                                                       | Employee id for single object |
 **payment_method** | [**\XeroAPI\XeroPHP\Models\PayrollNz\PaymentMethod**](../Model/PaymentMethod.md) |                               |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\PaymentMethodObject**](../Model/PaymentMethodObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createEmployeeSalaryAndWage**

> \XeroAPI\XeroPHP\Models\PayrollNz\SalaryAndWageObject createEmployeeSalaryAndWage($xero_tenant_id, $employee_id,
> $salary_and_wage)

creates employee salary and wage record

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object
$salary_and_wage = { "earningsRateID": "f9d8f5b5-9049-47f4-8541-35e200f750a5", "numberOfUnitsPerWeek": 2, "ratePerUnit": 10, "numberOfUnitsPerDay": 2, "daysPerWeek": 1, "effectiveFrom": "2020-05-01", "annualSalary": 100, "status": "Active", "paymentType": "Salary" }; // \XeroAPI\XeroPHP\Models\PayrollNz\SalaryAndWage | 

try {
    $result = $apiInstance->createEmployeeSalaryAndWage($xero_tenant_id, $employee_id, $salary_and_wage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->createEmployeeSalaryAndWage: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name                | Type                                                                             | Description                   | Notes 
---------------------|----------------------------------------------------------------------------------|-------------------------------|-------
 **xero_tenant_id**  | **string**                                                                       | Xero identifier for Tenant    |
 **employee_id**     | [**string**](../Model/.md)                                                       | Employee id for single object |
 **salary_and_wage** | [**\XeroAPI\XeroPHP\Models\PayrollNz\SalaryAndWage**](../Model/SalaryAndWage.md) |                               |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\SalaryAndWageObject**](../Model/SalaryAndWageObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createEmployment**

> \XeroAPI\XeroPHP\Models\PayrollNz\EmploymentObject createEmployment($xero_tenant_id, $employee_id, $employment)

creates employment

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object
$employment = { "payrollCalendarID": "9aa56064-990f-4ad3-a189-d966d8f6a030", "startDate": "2020-09-02" }; // \XeroAPI\XeroPHP\Models\PayrollNz\Employment | 

try {
    $result = $apiInstance->createEmployment($xero_tenant_id, $employee_id, $employment);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->createEmployment: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                                                                       | Description                   | Notes 
--------------------|----------------------------------------------------------------------------|-------------------------------|-------
 **xero_tenant_id** | **string**                                                                 | Xero identifier for Tenant    |
 **employee_id**    | [**string**](../Model/.md)                                                 | Employee id for single object |
 **employment**     | [**\XeroAPI\XeroPHP\Models\PayrollNz\Employment**](../Model/Employment.md) |                               |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EmploymentObject**](../Model/EmploymentObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createLeaveType**

> \XeroAPI\XeroPHP\Models\PayrollNz\LeaveTypeObject createLeaveType($xero_tenant_id, $leave_type)

create a new leave type

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$leave_type = { "name": "My wqwhhiktun Leave", "isPaidLeave": false, "showOnPayslip": true }; // \XeroAPI\XeroPHP\Models\PayrollNz\LeaveType | 

try {
    $result = $apiInstance->createLeaveType($xero_tenant_id, $leave_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->createLeaveType: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                                                                     | Description                | Notes 
--------------------|--------------------------------------------------------------------------|----------------------------|-------
 **xero_tenant_id** | **string**                                                               | Xero identifier for Tenant |
 **leave_type**     | [**\XeroAPI\XeroPHP\Models\PayrollNz\LeaveType**](../Model/LeaveType.md) |                            |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\LeaveTypeObject**](../Model/LeaveTypeObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createMultipleEmployeeEarningsTemplate**

> \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeEarningsTemplates createMultipleEmployeeEarningsTemplate($xero_tenant_id,
> $employee_id, $earnings_template)

creates multiple employee earnings template records

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object
$earnings_template = [{"ratePerUnit":20.0,"numberOfUnits":8.0,"earningsRateID":"f9d8f5b5-9049-47f4-8541-35e200f750a5"},{"ratePerUnit":0.0,"numberOfUnits":8.0,"earningsRateID":"65b83d94-f20f-45e1-85ae-387fcf460c26"}]; // \XeroAPI\XeroPHP\Models\PayrollNz\EarningsTemplate[] | 

try {
    $result = $apiInstance->createMultipleEmployeeEarningsTemplate($xero_tenant_id, $employee_id, $earnings_template);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->createMultipleEmployeeEarningsTemplate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name                  | Type                                                                                     | Description                   | Notes 
-----------------------|------------------------------------------------------------------------------------------|-------------------------------|-------
 **xero_tenant_id**    | **string**                                                                               | Xero identifier for Tenant    |
 **employee_id**       | [**string**](../Model/.md)                                                               | Employee id for single object |
 **earnings_template** | [**\XeroAPI\XeroPHP\Models\PayrollNz\EarningsTemplate[]**](../Model/EarningsTemplate.md) |                               |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeEarningsTemplates**](../Model/EmployeeEarningsTemplates.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createPayRun**

> \XeroAPI\XeroPHP\Models\PayrollNz\PayRunObject createPayRun($xero_tenant_id, $pay_run)

create a pay run

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$pay_run = { "payrollCalendarID": "9aa56064-990f-4ad3-a189-d966d8f6a030", "periodStartDate": "2020-09-08", "periodEndDate": "2020-09-15", "paymentDate": "2020-09-20", "payRunStatus": "Draft", "payRunType": "Scheduled", "calendarType": "Weekly" }; // \XeroAPI\XeroPHP\Models\PayrollNz\PayRun | 

try {
    $result = $apiInstance->createPayRun($xero_tenant_id, $pay_run);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->createPayRun: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                                                               | Description                | Notes 
--------------------|--------------------------------------------------------------------|----------------------------|-------
 **xero_tenant_id** | **string**                                                         | Xero identifier for Tenant |
 **pay_run**        | [**\XeroAPI\XeroPHP\Models\PayrollNz\PayRun**](../Model/PayRun.md) |                            |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\PayRunObject**](../Model/PayRunObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createPayRunCalendar**

> \XeroAPI\XeroPHP\Models\PayrollNz\PayRunCalendarObject createPayRunCalendar($xero_tenant_id, $pay_run_calendar)

create a new payrun calendar

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$pay_run_calendar = { "name": "My Weekly Cal", "calendarType": "Weekly", "periodStartDate": "2020-05-01", "paymentDate": "2020-05-15" }; // \XeroAPI\XeroPHP\Models\PayrollNz\PayRunCalendar | 

try {
    $result = $apiInstance->createPayRunCalendar($xero_tenant_id, $pay_run_calendar);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->createPayRunCalendar: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name                 | Type                                                                               | Description                | Notes 
----------------------|------------------------------------------------------------------------------------|----------------------------|-------
 **xero_tenant_id**   | **string**                                                                         | Xero identifier for Tenant |
 **pay_run_calendar** | [**\XeroAPI\XeroPHP\Models\PayrollNz\PayRunCalendar**](../Model/PayRunCalendar.md) |                            |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\PayRunCalendarObject**](../Model/PayRunCalendarObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createReimbursement**

> \XeroAPI\XeroPHP\Models\PayrollNz\ReimbursementObject createReimbursement($xero_tenant_id, $reimbursement)

create a new reimbursement

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$reimbursement = { "name": "My new Reimburse", "accountID": "fa5cdc43-643b-4ad8-b4ac-3ffe0d0f4488", "reimbursementCategory": "GSTInclusive", "calculationType": "FixedAmount" }; // \XeroAPI\XeroPHP\Models\PayrollNz\Reimbursement | 

try {
    $result = $apiInstance->createReimbursement($xero_tenant_id, $reimbursement);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->createReimbursement: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                                                                             | Description                | Notes 
--------------------|----------------------------------------------------------------------------------|----------------------------|-------
 **xero_tenant_id** | **string**                                                                       | Xero identifier for Tenant |
 **reimbursement**  | [**\XeroAPI\XeroPHP\Models\PayrollNz\Reimbursement**](../Model/Reimbursement.md) |                            |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\ReimbursementObject**](../Model/ReimbursementObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createSuperannuation**

> \XeroAPI\XeroPHP\Models\PayrollNz\SuperannuationObject createSuperannuation($xero_tenant_id, $benefit)

create a new superannuation

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$benefit = { "name": "SidSaver", "category": "Other", "liabilityAccountId": "568f2e9a-0870-46cc-8678-f83f132ed4e3", "expenseAccountId": "e4eb36f6-97e3-4427-a394-dd4e1b355c2e", "CalculationTypeNZ": "FixedAmount", "standardAmount": 10 }; // \XeroAPI\XeroPHP\Models\PayrollNz\Benefit | 

try {
    $result = $apiInstance->createSuperannuation($xero_tenant_id, $benefit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->createSuperannuation: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                                                                 | Description                | Notes 
--------------------|----------------------------------------------------------------------|----------------------------|-------
 **xero_tenant_id** | **string**                                                           | Xero identifier for Tenant |
 **benefit**        | [**\XeroAPI\XeroPHP\Models\PayrollNz\Benefit**](../Model/Benefit.md) |                            |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\SuperannuationObject**](../Model/SuperannuationObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createTimesheet**

> \XeroAPI\XeroPHP\Models\PayrollNz\TimesheetObject createTimesheet($xero_tenant_id, $timesheet)

create a new timesheet

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$timesheet = { "payrollCalendarID": "9aa56064-990f-4ad3-a189-d966d8f6a030", "employeeID": "68342973-c405-4b86-b5d3-d7b877c27995", "startDate": "2020-04-13", "endDate": "2020-04-19", "timesheetLines": [ { "date": "2020-04-13", "earningsRateID": "f9d8f5b5-9049-47f4-8541-35e200f750a5", "numberOfUnits": 8 }, { "date": "2020-04-15", "earningsRateID": "f9d8f5b5-9049-47f4-8541-35e200f750a5", "numberOfUnits": 6 } ] }; // \XeroAPI\XeroPHP\Models\PayrollNz\Timesheet | 

try {
    $result = $apiInstance->createTimesheet($xero_tenant_id, $timesheet);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->createTimesheet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                                                                     | Description                | Notes 
--------------------|--------------------------------------------------------------------------|----------------------------|-------
 **xero_tenant_id** | **string**                                                               | Xero identifier for Tenant |
 **timesheet**      | [**\XeroAPI\XeroPHP\Models\PayrollNz\Timesheet**](../Model/Timesheet.md) |                            |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\TimesheetObject**](../Model/TimesheetObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createTimesheetLine**

> \XeroAPI\XeroPHP\Models\PayrollNz\TimesheetLineObject createTimesheetLine($xero_tenant_id, $timesheet_id,
> $timesheet_line)

create a new timesheet line

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$timesheet_id = 'timesheet_id_example'; // string | Identifier for the timesheet
$timesheet_line = { "date": "2020-08-03", "earningsRateID": "f9d8f5b5-9049-47f4-8541-35e200f750a5", "numberOfUnits": 1 }; // \XeroAPI\XeroPHP\Models\PayrollNz\TimesheetLine | 

try {
    $result = $apiInstance->createTimesheetLine($xero_tenant_id, $timesheet_id, $timesheet_line);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->createTimesheetLine: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                                                                             | Description                  | Notes 
--------------------|----------------------------------------------------------------------------------|------------------------------|-------
 **xero_tenant_id** | **string**                                                                       | Xero identifier for Tenant   |
 **timesheet_id**   | [**string**](../Model/.md)                                                       | Identifier for the timesheet |
 **timesheet_line** | [**\XeroAPI\XeroPHP\Models\PayrollNz\TimesheetLine**](../Model/TimesheetLine.md) |                              |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\TimesheetLineObject**](../Model/TimesheetLineObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteEmployeeEarningsTemplate**

> \XeroAPI\XeroPHP\Models\PayrollNz\EarningsTemplateObject deleteEmployeeEarningsTemplate($xero_tenant_id, $employee_id,
> $pay_template_earning_id)

deletes an employee earnings template record

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object
$pay_template_earning_id = 3fa85f64-5717-4562-b3fc-2c963f66afa6; // string | Id for single pay template earnings object

try {
    $result = $apiInstance->deleteEmployeeEarningsTemplate($xero_tenant_id, $employee_id, $pay_template_earning_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->deleteEmployeeEarningsTemplate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name                        | Type                       | Description                                | Notes 
-----------------------------|----------------------------|--------------------------------------------|-------
 **xero_tenant_id**          | **string**                 | Xero identifier for Tenant                 |
 **employee_id**             | [**string**](../Model/.md) | Employee id for single object              |
 **pay_template_earning_id** | [**string**](../Model/.md) | Id for single pay template earnings object |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EarningsTemplateObject**](../Model/EarningsTemplateObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteEmployeeLeave**

> \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeaveObject deleteEmployeeLeave($xero_tenant_id, $employee_id, $leave_id)

deletes an employee leave record

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object
$leave_id = c4be24e5-e840-4c92-9eaa-2d86cd596314; // string | Leave id for single object

try {
    $result = $apiInstance->deleteEmployeeLeave($xero_tenant_id, $employee_id, $leave_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->deleteEmployeeLeave: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                   | Notes 
--------------------|----------------------------|-------------------------------|-------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant    |
 **employee_id**    | [**string**](../Model/.md) | Employee id for single object |
 **leave_id**       | [**string**](../Model/.md) | Leave id for single object    |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeaveObject**](../Model/EmployeeLeaveObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteEmployeeSalaryAndWage**

> \XeroAPI\XeroPHP\Models\PayrollNz\SalaryAndWageObject deleteEmployeeSalaryAndWage($xero_tenant_id, $employee_id,
> $salary_and_wages_id)

deletes an employee salary and wages record

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object
$salary_and_wages_id = 3fa85f64-5717-4562-b3fc-2c963f66afa6; // string | Id for single salary and wages object

try {
    $result = $apiInstance->deleteEmployeeSalaryAndWage($xero_tenant_id, $employee_id, $salary_and_wages_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->deleteEmployeeSalaryAndWage: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name                    | Type                       | Description                           | Notes 
-------------------------|----------------------------|---------------------------------------|-------
 **xero_tenant_id**      | **string**                 | Xero identifier for Tenant            |
 **employee_id**         | [**string**](../Model/.md) | Employee id for single object         |
 **salary_and_wages_id** | [**string**](../Model/.md) | Id for single salary and wages object |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\SalaryAndWageObject**](../Model/SalaryAndWageObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteTimesheet**

> \XeroAPI\XeroPHP\Models\PayrollNz\TimesheetLine deleteTimesheet($xero_tenant_id, $timesheet_id)

delete a timesheet

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$timesheet_id = 'timesheet_id_example'; // string | Identifier for the timesheet

try {
    $result = $apiInstance->deleteTimesheet($xero_tenant_id, $timesheet_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->deleteTimesheet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                  | Notes 
--------------------|----------------------------|------------------------------|-------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant   |
 **timesheet_id**   | [**string**](../Model/.md) | Identifier for the timesheet |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\TimesheetLine**](../Model/TimesheetLine.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteTimesheetLine**

> \XeroAPI\XeroPHP\Models\PayrollNz\TimesheetLine deleteTimesheetLine($xero_tenant_id, $timesheet_id,
> $timesheet_line_id)

delete a timesheet line

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$timesheet_id = 'timesheet_id_example'; // string | Identifier for the timesheet
$timesheet_line_id = 'timesheet_line_id_example'; // string | Identifier for the timesheet line

try {
    $result = $apiInstance->deleteTimesheetLine($xero_tenant_id, $timesheet_id, $timesheet_line_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->deleteTimesheetLine: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name                  | Type                       | Description                       | Notes 
-----------------------|----------------------------|-----------------------------------|-------
 **xero_tenant_id**    | **string**                 | Xero identifier for Tenant        |
 **timesheet_id**      | [**string**](../Model/.md) | Identifier for the timesheet      |
 **timesheet_line_id** | [**string**](../Model/.md) | Identifier for the timesheet line |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\TimesheetLine**](../Model/TimesheetLine.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getDeduction**

> \XeroAPI\XeroPHP\Models\PayrollNz\DeductionObject getDeduction($xero_tenant_id, $deduction_id)

retrieve a single deduction by id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$deduction_id = 'deduction_id_example'; // string | Identifier for the deduction

try {
    $result = $apiInstance->getDeduction($xero_tenant_id, $deduction_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getDeduction: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                  | Notes 
--------------------|----------------------------|------------------------------|-------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant   |
 **deduction_id**   | [**string**](../Model/.md) | Identifier for the deduction |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\DeductionObject**](../Model/DeductionObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getDeductions**

> \XeroAPI\XeroPHP\Models\PayrollNz\Deductions getDeductions($xero_tenant_id, $page)

searches deductions

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$page = 56; // int | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100.

try {
    $result = $apiInstance->getDeductions($xero_tenant_id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getDeductions: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type       | Description                                                                                                      | Notes      
--------------------|------------|------------------------------------------------------------------------------------------------------------------|------------
 **xero_tenant_id** | **string** | Xero identifier for Tenant                                                                                       |
 **page**           | **int**    | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100. | [optional] 

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\Deductions**](../Model/Deductions.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getEarningsRate**

> \XeroAPI\XeroPHP\Models\PayrollNz\EarningsRateObject getEarningsRate($xero_tenant_id, $earnings_rate_id)

retrieve a single earnings rates by id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$earnings_rate_id = 'earnings_rate_id_example'; // string | Identifier for the earnings rate

try {
    $result = $apiInstance->getEarningsRate($xero_tenant_id, $earnings_rate_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getEarningsRate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name                 | Type                       | Description                      | Notes 
----------------------|----------------------------|----------------------------------|-------
 **xero_tenant_id**   | **string**                 | Xero identifier for Tenant       |
 **earnings_rate_id** | [**string**](../Model/.md) | Identifier for the earnings rate |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EarningsRateObject**](../Model/EarningsRateObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getEarningsRates**

> \XeroAPI\XeroPHP\Models\PayrollNz\EarningsRates getEarningsRates($xero_tenant_id, $page)

searches earnings rates

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$page = 56; // int | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100.

try {
    $result = $apiInstance->getEarningsRates($xero_tenant_id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getEarningsRates: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type       | Description                                                                                                      | Notes      
--------------------|------------|------------------------------------------------------------------------------------------------------------------|------------
 **xero_tenant_id** | **string** | Xero identifier for Tenant                                                                                       |
 **page**           | **int**    | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100. | [optional] 

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EarningsRates**](../Model/EarningsRates.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getEmployee**

> \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeObject getEmployee($xero_tenant_id, $employee_id)

searches employees

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object

try {
    $result = $apiInstance->getEmployee($xero_tenant_id, $employee_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getEmployee: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                   | Notes 
--------------------|----------------------------|-------------------------------|-------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant    |
 **employee_id**    | [**string**](../Model/.md) | Employee id for single object |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeObject**](../Model/EmployeeObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getEmployeeLeaveBalances**

> \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeaveBalances getEmployeeLeaveBalances($xero_tenant_id, $employee_id)

search employee leave balances

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object

try {
    $result = $apiInstance->getEmployeeLeaveBalances($xero_tenant_id, $employee_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getEmployeeLeaveBalances: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                   | Notes 
--------------------|----------------------------|-------------------------------|-------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant    |
 **employee_id**    | [**string**](../Model/.md) | Employee id for single object |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeaveBalances**](../Model/EmployeeLeaveBalances.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getEmployeeLeavePeriods**

> \XeroAPI\XeroPHP\Models\PayrollNz\LeavePeriods getEmployeeLeavePeriods($xero_tenant_id, $employee_id, $start_date,
> $end_date)

searches employee leave periods

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object
$start_date = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | Filter by start date
$end_date = Johnson; // \DateTime | Filter by end date

try {
    $result = $apiInstance->getEmployeeLeavePeriods($xero_tenant_id, $employee_id, $start_date, $end_date);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getEmployeeLeavePeriods: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                   | Notes      
--------------------|----------------------------|-------------------------------|------------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant    |
 **employee_id**    | [**string**](../Model/.md) | Employee id for single object |
 **start_date**     | **\DateTime**              | Filter by start date          | [optional] 
 **end_date**       | **\DateTime**              | Filter by end date            | [optional] 

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\LeavePeriods**](../Model/LeavePeriods.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getEmployeeLeaveTypes**

> \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeaveTypes getEmployeeLeaveTypes($xero_tenant_id, $employee_id)

searches employee leave types

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object

try {
    $result = $apiInstance->getEmployeeLeaveTypes($xero_tenant_id, $employee_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getEmployeeLeaveTypes: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                   | Notes 
--------------------|----------------------------|-------------------------------|-------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant    |
 **employee_id**    | [**string**](../Model/.md) | Employee id for single object |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeaveTypes**](../Model/EmployeeLeaveTypes.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getEmployeeLeaves**

> \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeaves getEmployeeLeaves($xero_tenant_id, $employee_id)

search employee leave records

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object

try {
    $result = $apiInstance->getEmployeeLeaves($xero_tenant_id, $employee_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getEmployeeLeaves: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                   | Notes 
--------------------|----------------------------|-------------------------------|-------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant    |
 **employee_id**    | [**string**](../Model/.md) | Employee id for single object |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeaves**](../Model/EmployeeLeaves.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getEmployeeOpeningBalances**

> \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeOpeningBalancesObject getEmployeeOpeningBalances($xero_tenant_id,
> $employee_id)

retrieve employee openingbalances

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object

try {
    $result = $apiInstance->getEmployeeOpeningBalances($xero_tenant_id, $employee_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getEmployeeOpeningBalances: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                   | Notes 
--------------------|----------------------------|-------------------------------|-------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant    |
 **employee_id**    | [**string**](../Model/.md) | Employee id for single object |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeOpeningBalancesObject**](../Model/EmployeeOpeningBalancesObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getEmployeePayTemplates**

> \XeroAPI\XeroPHP\Models\PayrollNz\EmployeePayTemplates getEmployeePayTemplates($xero_tenant_id, $employee_id)

searches employee pay templates

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object

try {
    $result = $apiInstance->getEmployeePayTemplates($xero_tenant_id, $employee_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getEmployeePayTemplates: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                   | Notes 
--------------------|----------------------------|-------------------------------|-------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant    |
 **employee_id**    | [**string**](../Model/.md) | Employee id for single object |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeePayTemplates**](../Model/EmployeePayTemplates.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getEmployeePaymentMethod**

> \XeroAPI\XeroPHP\Models\PayrollNz\PaymentMethodObject getEmployeePaymentMethod($xero_tenant_id, $employee_id)

retrieves an employee's payment method

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object

try {
    $result = $apiInstance->getEmployeePaymentMethod($xero_tenant_id, $employee_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getEmployeePaymentMethod: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                   | Notes 
--------------------|----------------------------|-------------------------------|-------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant    |
 **employee_id**    | [**string**](../Model/.md) | Employee id for single object |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\PaymentMethodObject**](../Model/PaymentMethodObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getEmployeeSalaryAndWage**

> \XeroAPI\XeroPHP\Models\PayrollNz\SalaryAndWages getEmployeeSalaryAndWage($xero_tenant_id, $employee_id,
> $salary_and_wages_id)

get employee salary and wages record by id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object
$salary_and_wages_id = 3fa85f64-5717-4562-b3fc-2c963f66afa6; // string | Id for single pay template earnings object

try {
    $result = $apiInstance->getEmployeeSalaryAndWage($xero_tenant_id, $employee_id, $salary_and_wages_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getEmployeeSalaryAndWage: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name                    | Type                       | Description                                | Notes 
-------------------------|----------------------------|--------------------------------------------|-------
 **xero_tenant_id**      | **string**                 | Xero identifier for Tenant                 |
 **employee_id**         | [**string**](../Model/.md) | Employee id for single object              |
 **salary_and_wages_id** | [**string**](../Model/.md) | Id for single pay template earnings object |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\SalaryAndWages**](../Model/SalaryAndWages.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getEmployeeSalaryAndWages**

> \XeroAPI\XeroPHP\Models\PayrollNz\SalaryAndWages getEmployeeSalaryAndWages($xero_tenant_id, $employee_id, $page)

retrieves an employee's salary and wages

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object
$page = 56; // int | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100.

try {
    $result = $apiInstance->getEmployeeSalaryAndWages($xero_tenant_id, $employee_id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getEmployeeSalaryAndWages: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                                                                                                      | Notes      
--------------------|----------------------------|------------------------------------------------------------------------------------------------------------------|------------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant                                                                                       |
 **employee_id**    | [**string**](../Model/.md) | Employee id for single object                                                                                    |
 **page**           | **int**                    | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100. | [optional] 

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\SalaryAndWages**](../Model/SalaryAndWages.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getEmployeeTax**

> \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeTaxObject getEmployeeTax($xero_tenant_id, $employee_id)

searches tax records for an employee

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object

try {
    $result = $apiInstance->getEmployeeTax($xero_tenant_id, $employee_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getEmployeeTax: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                   | Notes 
--------------------|----------------------------|-------------------------------|-------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant    |
 **employee_id**    | [**string**](../Model/.md) | Employee id for single object |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeTaxObject**](../Model/EmployeeTaxObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getEmployees**

> \XeroAPI\XeroPHP\Models\PayrollNz\Employees getEmployees($xero_tenant_id, $first_name, $last_name, $page)

searches employees

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$first_name = John; // string | Filter by first name
$last_name = Johnson; // string | Filter by last name
$page = 56; // int | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100.

try {
    $result = $apiInstance->getEmployees($xero_tenant_id, $first_name, $last_name, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getEmployees: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type       | Description                                                                                                      | Notes      
--------------------|------------|------------------------------------------------------------------------------------------------------------------|------------
 **xero_tenant_id** | **string** | Xero identifier for Tenant                                                                                       |
 **first_name**     | **string** | Filter by first name                                                                                             | [optional] 
 **last_name**      | **string** | Filter by last name                                                                                              | [optional] 
 **page**           | **int**    | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100. | [optional] 

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\Employees**](../Model/Employees.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getLeaveType**

> \XeroAPI\XeroPHP\Models\PayrollNz\LeaveTypeObject getLeaveType($xero_tenant_id, $leave_type_id)

retrieve a single leave type by id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$leave_type_id = 'leave_type_id_example'; // string | Identifier for the leave type

try {
    $result = $apiInstance->getLeaveType($xero_tenant_id, $leave_type_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getLeaveType: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                   | Notes 
--------------------|----------------------------|-------------------------------|-------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant    |
 **leave_type_id**  | [**string**](../Model/.md) | Identifier for the leave type |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\LeaveTypeObject**](../Model/LeaveTypeObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getLeaveTypes**

> \XeroAPI\XeroPHP\Models\PayrollNz\LeaveTypes getLeaveTypes($xero_tenant_id, $page, $active_only)

searches leave types

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$page = 56; // int | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100.
$active_only = True; // bool | Filters leave types by active status. By default the API returns all leave types.

try {
    $result = $apiInstance->getLeaveTypes($xero_tenant_id, $page, $active_only);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getLeaveTypes: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type       | Description                                                                                                      | Notes      
--------------------|------------|------------------------------------------------------------------------------------------------------------------|------------
 **xero_tenant_id** | **string** | Xero identifier for Tenant                                                                                       |
 **page**           | **int**    | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100. | [optional] 
 **active_only**    | **bool**   | Filters leave types by active status. By default the API returns all leave types.                                | [optional] 

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\LeaveTypes**](../Model/LeaveTypes.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getPayRun**

> \XeroAPI\XeroPHP\Models\PayrollNz\PayRunObject getPayRun($xero_tenant_id, $pay_run_id)

retrieve a single pay run by id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$pay_run_id = 'pay_run_id_example'; // string | Identifier for the pay run

try {
    $result = $apiInstance->getPayRun($xero_tenant_id, $pay_run_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getPayRun: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                | Notes 
--------------------|----------------------------|----------------------------|-------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant |
 **pay_run_id**     | [**string**](../Model/.md) | Identifier for the pay run |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\PayRunObject**](../Model/PayRunObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getPayRunCalendar**

> \XeroAPI\XeroPHP\Models\PayrollNz\PayRunCalendarObject getPayRunCalendar($xero_tenant_id, $payroll_calendar_id)

retrieve a single payrun calendar by id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$payroll_calendar_id = 'payroll_calendar_id_example'; // string | Identifier for the payrun calendars

try {
    $result = $apiInstance->getPayRunCalendar($xero_tenant_id, $payroll_calendar_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getPayRunCalendar: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name                    | Type                       | Description                         | Notes 
-------------------------|----------------------------|-------------------------------------|-------
 **xero_tenant_id**      | **string**                 | Xero identifier for Tenant          |
 **payroll_calendar_id** | [**string**](../Model/.md) | Identifier for the payrun calendars |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\PayRunCalendarObject**](../Model/PayRunCalendarObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getPayRunCalendars**

> \XeroAPI\XeroPHP\Models\PayrollNz\PayRunCalendars getPayRunCalendars($xero_tenant_id, $page)

searches payrun calendars

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$page = 56; // int | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100.

try {
    $result = $apiInstance->getPayRunCalendars($xero_tenant_id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getPayRunCalendars: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type       | Description                                                                                                      | Notes      
--------------------|------------|------------------------------------------------------------------------------------------------------------------|------------
 **xero_tenant_id** | **string** | Xero identifier for Tenant                                                                                       |
 **page**           | **int**    | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100. | [optional] 

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\PayRunCalendars**](../Model/PayRunCalendars.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getPayRuns**

> \XeroAPI\XeroPHP\Models\PayrollNz\PayRuns getPayRuns($xero_tenant_id, $page, $status)

searches pay runs

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$page = 56; // int | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100.
$status = 'status_example'; // string | By default get payruns will return all the payruns for an organization. You can add GET https://api.xero.com/payroll.xro/2.0/payRuns?statu={PayRunStatus} to filter the payruns by status.

try {
    $result = $apiInstance->getPayRuns($xero_tenant_id, $page, $status);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getPayRuns: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type       | Description                                                                                                                                                                                     | Notes      
--------------------|------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|------------
 **xero_tenant_id** | **string** | Xero identifier for Tenant                                                                                                                                                                      |
 **page**           | **int**    | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100.                                                                                | [optional] 
 **status**         | **string** | By default get payruns will return all the payruns for an organization. You can add GET https://api.xero.com/payroll.xro/2.0/payRuns?statu&#x3D;{PayRunStatus} to filter the payruns by status. | [optional] 

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\PayRuns**](../Model/PayRuns.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getPaySlip**

> \XeroAPI\XeroPHP\Models\PayrollNz\PaySlipObject getPaySlip($xero_tenant_id, $pay_slip_id)

retrieve a single payslip by id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$pay_slip_id = 'pay_slip_id_example'; // string | Identifier for the payslip

try {
    $result = $apiInstance->getPaySlip($xero_tenant_id, $pay_slip_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getPaySlip: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                | Notes 
--------------------|----------------------------|----------------------------|-------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant |
 **pay_slip_id**    | [**string**](../Model/.md) | Identifier for the payslip |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\PaySlipObject**](../Model/PaySlipObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getPaySlips**

> \XeroAPI\XeroPHP\Models\PayrollNz\PaySlips getPaySlips($xero_tenant_id, $pay_run_id, $page)

searches payslips

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$pay_run_id = 'pay_run_id_example'; // string | PayrunID which specifies the containing payrun of payslips to retrieve. By default, the API does not group payslips by payrun.
$page = 56; // int | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100.

try {
    $result = $apiInstance->getPaySlips($xero_tenant_id, $pay_run_id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getPaySlips: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                                                                                                                    | Notes      
--------------------|----------------------------|--------------------------------------------------------------------------------------------------------------------------------|------------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant                                                                                                     |
 **pay_run_id**     | [**string**](../Model/.md) | PayrunID which specifies the containing payrun of payslips to retrieve. By default, the API does not group payslips by payrun. |
 **page**           | **int**                    | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100.               | [optional] 

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\PaySlips**](../Model/PaySlips.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getReimbursement**

> \XeroAPI\XeroPHP\Models\PayrollNz\ReimbursementObject getReimbursement($xero_tenant_id, $reimbursement_id)

retrieve a single reimbursement by id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$reimbursement_id = 'reimbursement_id_example'; // string | Identifier for the reimbursement

try {
    $result = $apiInstance->getReimbursement($xero_tenant_id, $reimbursement_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getReimbursement: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name                 | Type                       | Description                      | Notes 
----------------------|----------------------------|----------------------------------|-------
 **xero_tenant_id**   | **string**                 | Xero identifier for Tenant       |
 **reimbursement_id** | [**string**](../Model/.md) | Identifier for the reimbursement |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\ReimbursementObject**](../Model/ReimbursementObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getReimbursements**

> \XeroAPI\XeroPHP\Models\PayrollNz\Reimbursements getReimbursements($xero_tenant_id, $page)

searches reimbursements

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$page = 56; // int | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100.

try {
    $result = $apiInstance->getReimbursements($xero_tenant_id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getReimbursements: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type       | Description                                                                                                      | Notes      
--------------------|------------|------------------------------------------------------------------------------------------------------------------|------------
 **xero_tenant_id** | **string** | Xero identifier for Tenant                                                                                       |
 **page**           | **int**    | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100. | [optional] 

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\Reimbursements**](../Model/Reimbursements.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getSettings**

> \XeroAPI\XeroPHP\Models\PayrollNz\Settings getSettings($xero_tenant_id)

searches settings

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant

try {
    $result = $apiInstance->getSettings($xero_tenant_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getSettings: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type       | Description                | Notes 
--------------------|------------|----------------------------|-------
 **xero_tenant_id** | **string** | Xero identifier for Tenant |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\Settings**](../Model/Settings.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getStatutoryDeduction**

> \XeroAPI\XeroPHP\Models\PayrollNz\StatutoryDeductionObject getStatutoryDeduction($xero_tenant_id, $id)

retrieve a single statutory deduction by id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$id = 'id_example'; // string | Identifier for the statutory deduction

try {
    $result = $apiInstance->getStatutoryDeduction($xero_tenant_id, $id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getStatutoryDeduction: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                            | Notes 
--------------------|----------------------------|----------------------------------------|-------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant             |
 **id**             | [**string**](../Model/.md) | Identifier for the statutory deduction |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\StatutoryDeductionObject**](../Model/StatutoryDeductionObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getStatutoryDeductions**

> \XeroAPI\XeroPHP\Models\PayrollNz\StatutoryDeductions getStatutoryDeductions($xero_tenant_id, $page)

searches statutory deductions

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$page = 56; // int | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100.

try {
    $result = $apiInstance->getStatutoryDeductions($xero_tenant_id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getStatutoryDeductions: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type       | Description                                                                                                      | Notes      
--------------------|------------|------------------------------------------------------------------------------------------------------------------|------------
 **xero_tenant_id** | **string** | Xero identifier for Tenant                                                                                       |
 **page**           | **int**    | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100. | [optional] 

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\StatutoryDeductions**](../Model/StatutoryDeductions.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getSuperannuation**

> \XeroAPI\XeroPHP\Models\PayrollNz\SuperannuationObject getSuperannuation($xero_tenant_id, $superannuation_id)

searches for a unique superannuation

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$superannuation_id = 'superannuation_id_example'; // string | Identifier for the superannuation

try {
    $result = $apiInstance->getSuperannuation($xero_tenant_id, $superannuation_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getSuperannuation: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name                  | Type                       | Description                       | Notes 
-----------------------|----------------------------|-----------------------------------|-------
 **xero_tenant_id**    | **string**                 | Xero identifier for Tenant        |
 **superannuation_id** | [**string**](../Model/.md) | Identifier for the superannuation |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\SuperannuationObject**](../Model/SuperannuationObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getSuperannuations**

> \XeroAPI\XeroPHP\Models\PayrollNz\Superannuations getSuperannuations($xero_tenant_id, $page)

searches statutory deductions

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$page = 56; // int | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100.

try {
    $result = $apiInstance->getSuperannuations($xero_tenant_id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getSuperannuations: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type       | Description                                                                                                      | Notes      
--------------------|------------|------------------------------------------------------------------------------------------------------------------|------------
 **xero_tenant_id** | **string** | Xero identifier for Tenant                                                                                       |
 **page**           | **int**    | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100. | [optional] 

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\Superannuations**](../Model/Superannuations.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getTimesheet**

> \XeroAPI\XeroPHP\Models\PayrollNz\TimesheetObject getTimesheet($xero_tenant_id, $timesheet_id)

retrieve a single timesheet by id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$timesheet_id = 'timesheet_id_example'; // string | Identifier for the timesheet

try {
    $result = $apiInstance->getTimesheet($xero_tenant_id, $timesheet_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getTimesheet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                  | Notes 
--------------------|----------------------------|------------------------------|-------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant   |
 **timesheet_id**   | [**string**](../Model/.md) | Identifier for the timesheet |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\TimesheetObject**](../Model/TimesheetObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getTimesheets**

> \XeroAPI\XeroPHP\Models\PayrollNz\Timesheets getTimesheets($xero_tenant_id, $page, $employee_id, $payroll_calendar_id)

searches timesheets

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$page = 56; // int | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100.
$employee_id = 'employee_id_example'; // string | By default get Timesheets will return the timesheets for all employees in an organization. You can add GET https://…/timesheets?filter=employeeId=={EmployeeId} to get only the timesheets of a particular employee.
$payroll_calendar_id = 'payroll_calendar_id_example'; // string | By default get Timesheets will return all the timesheets for an organization. You can add GET https://…/timesheets?filter=payrollCalendarId=={PayrollCalendarID} to filter the timesheets by payroll calendar id

try {
    $result = $apiInstance->getTimesheets($xero_tenant_id, $page, $employee_id, $payroll_calendar_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getTimesheets: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name                    | Type                       | Description                                                                                                                                                                                                                         | Notes      
-------------------------|----------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|------------
 **xero_tenant_id**      | **string**                 | Xero identifier for Tenant                                                                                                                                                                                                          |
 **page**                | **int**                    | Page number which specifies the set of records to retrieve. By default the number of the records per set is 100.                                                                                                                    | [optional] 
 **employee_id**         | [**string**](../Model/.md) | By default get Timesheets will return the timesheets for all employees in an organization. You can add GET https://…/timesheets?filter&#x3D;employeeId&#x3D;&#x3D;{EmployeeId} to get only the timesheets of a particular employee. | [optional] 
 **payroll_calendar_id** | [**string**](../Model/.md) | By default get Timesheets will return all the timesheets for an organization. You can add GET https://…/timesheets?filter&#x3D;payrollCalendarId&#x3D;&#x3D;{PayrollCalendarID} to filter the timesheets by payroll calendar id     | [optional] 

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\Timesheets**](../Model/Timesheets.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getTrackingCategories**

> \XeroAPI\XeroPHP\Models\PayrollNz\TrackingCategories getTrackingCategories($xero_tenant_id)

searches tracking categories

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant

try {
    $result = $apiInstance->getTrackingCategories($xero_tenant_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->getTrackingCategories: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type       | Description                | Notes 
--------------------|------------|----------------------------|-------
 **xero_tenant_id** | **string** | Xero identifier for Tenant |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\TrackingCategories**](../Model/TrackingCategories.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **revertTimesheet**

> \XeroAPI\XeroPHP\Models\PayrollNz\TimesheetObject revertTimesheet($xero_tenant_id, $timesheet_id)

revert a timesheet to draft

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$timesheet_id = 'timesheet_id_example'; // string | Identifier for the timesheet

try {
    $result = $apiInstance->revertTimesheet($xero_tenant_id, $timesheet_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->revertTimesheet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                       | Description                  | Notes 
--------------------|----------------------------|------------------------------|-------
 **xero_tenant_id** | **string**                 | Xero identifier for Tenant   |
 **timesheet_id**   | [**string**](../Model/.md) | Identifier for the timesheet |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\TimesheetObject**](../Model/TimesheetObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateEmployee**

> \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeObject updateEmployee($xero_tenant_id, $employee_id, $employee)

updates employee

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object
$employee = { "title": "Mr", "firstName": "Tony", "lastName": "Starkgtrzgquusrson", "dateOfBirth": "1999-01-01", "address": { "addressLine1": "101 Green St", "city": "San Francisco", "postCode": "4432", "countryName": "United Kingdom" }, "email": "58315@starkindustries.com", "gender": "M" }; // \XeroAPI\XeroPHP\Models\PayrollNz\Employee | 

try {
    $result = $apiInstance->updateEmployee($xero_tenant_id, $employee_id, $employee);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->updateEmployee: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                                                                   | Description                   | Notes 
--------------------|------------------------------------------------------------------------|-------------------------------|-------
 **xero_tenant_id** | **string**                                                             | Xero identifier for Tenant    |
 **employee_id**    | [**string**](../Model/.md)                                             | Employee id for single object |
 **employee**       | [**\XeroAPI\XeroPHP\Models\PayrollNz\Employee**](../Model/Employee.md) |                               |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeObject**](../Model/EmployeeObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateEmployeeEarningsTemplate**

> \XeroAPI\XeroPHP\Models\PayrollNz\EarningsTemplateObject updateEmployeeEarningsTemplate($xero_tenant_id, $employee_id,
> $pay_template_earning_id, $earnings_template)

updates employee earnings template records

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object
$pay_template_earning_id = 3fa85f64-5717-4562-b3fc-2c963f66afa6; // string | Id for single pay template earnings object
$earnings_template = { "ratePerUnit": 25, "numberOfUnits": 4, "earningsRateID": "f9d8f5b5-9049-47f4-8541-35e200f750a5" }; // \XeroAPI\XeroPHP\Models\PayrollNz\EarningsTemplate | 

try {
    $result = $apiInstance->updateEmployeeEarningsTemplate($xero_tenant_id, $employee_id, $pay_template_earning_id, $earnings_template);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->updateEmployeeEarningsTemplate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name                        | Type                                                                                   | Description                                | Notes 
-----------------------------|----------------------------------------------------------------------------------------|--------------------------------------------|-------
 **xero_tenant_id**          | **string**                                                                             | Xero identifier for Tenant                 |
 **employee_id**             | [**string**](../Model/.md)                                                             | Employee id for single object              |
 **pay_template_earning_id** | [**string**](../Model/.md)                                                             | Id for single pay template earnings object |
 **earnings_template**       | [**\XeroAPI\XeroPHP\Models\PayrollNz\EarningsTemplate**](../Model/EarningsTemplate.md) |                                            |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EarningsTemplateObject**](../Model/EarningsTemplateObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateEmployeeLeave**

> \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeaveObject updateEmployeeLeave($xero_tenant_id, $employee_id, $leave_id,
> $employee_leave)

updates employee leave records

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object
$leave_id = c4be24e5-e840-4c92-9eaa-2d86cd596314; // string | Leave id for single object
$employee_leave = { "leaveTypeID": "b0b1b79e-2a25-46c2-ad08-ca25ef48d7e4", "description": "Creating a Desription", "startDate": "2020-04-24", "endDate": "2020-04-26", "periods": [ { "periodStartDate": "2020-04-20", "periodEndDate": "2020-04-26", "numberOfUnits": 1, "periodStatus": "Approved" } ] }; // \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeave | 

try {
    $result = $apiInstance->updateEmployeeLeave($xero_tenant_id, $employee_id, $leave_id, $employee_leave);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->updateEmployeeLeave: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                                                                             | Description                   | Notes 
--------------------|----------------------------------------------------------------------------------|-------------------------------|-------
 **xero_tenant_id** | **string**                                                                       | Xero identifier for Tenant    |
 **employee_id**    | [**string**](../Model/.md)                                                       | Employee id for single object |
 **leave_id**       | [**string**](../Model/.md)                                                       | Leave id for single object    |
 **employee_leave** | [**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeave**](../Model/EmployeeLeave.md) |                               |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeLeaveObject**](../Model/EmployeeLeaveObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateEmployeeSalaryAndWage**

> \XeroAPI\XeroPHP\Models\PayrollNz\SalaryAndWageObject updateEmployeeSalaryAndWage($xero_tenant_id, $employee_id,
> $salary_and_wages_id, $salary_and_wage)

updates employee salary and wages record

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object
$salary_and_wages_id = 3fa85f64-5717-4562-b3fc-2c963f66afa6; // string | Id for single pay template earnings object
$salary_and_wage = { "earningsRateID": "f9d8f5b5-9049-47f4-8541-35e200f750a5", "numberOfUnitsPerWeek": 3, "ratePerUnit": 11, "numberOfUnitsPerDay": 3, "daysPerWeek": 1, "effectiveFrom": "2020-05-15", "annualSalary": 101, "status": "Active", "paymentType": "Salary" }; // \XeroAPI\XeroPHP\Models\PayrollNz\SalaryAndWage | 

try {
    $result = $apiInstance->updateEmployeeSalaryAndWage($xero_tenant_id, $employee_id, $salary_and_wages_id, $salary_and_wage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->updateEmployeeSalaryAndWage: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name                    | Type                                                                             | Description                                | Notes 
-------------------------|----------------------------------------------------------------------------------|--------------------------------------------|-------
 **xero_tenant_id**      | **string**                                                                       | Xero identifier for Tenant                 |
 **employee_id**         | [**string**](../Model/.md)                                                       | Employee id for single object              |
 **salary_and_wages_id** | [**string**](../Model/.md)                                                       | Id for single pay template earnings object |
 **salary_and_wage**     | [**\XeroAPI\XeroPHP\Models\PayrollNz\SalaryAndWage**](../Model/SalaryAndWage.md) |                                            |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\SalaryAndWageObject**](../Model/SalaryAndWageObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateEmployeeTax**

> \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeTaxObject updateEmployeeTax($xero_tenant_id, $employee_id, $employee_tax)

updates the tax records for an employee

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$employee_id = 4ff1e5cc-9835-40d5-bb18-09fdb118db9c; // string | Employee id for single object
$employee_tax = new \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeTax(); // \XeroAPI\XeroPHP\Models\PayrollNz\EmployeeTax | 

try {
    $result = $apiInstance->updateEmployeeTax($xero_tenant_id, $employee_id, $employee_tax);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->updateEmployeeTax: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                                                                         | Description                   | Notes 
--------------------|------------------------------------------------------------------------------|-------------------------------|-------
 **xero_tenant_id** | **string**                                                                   | Xero identifier for Tenant    |
 **employee_id**    | [**string**](../Model/.md)                                                   | Employee id for single object |
 **employee_tax**   | [**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeTax**](../Model/EmployeeTax.md) |                               |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\EmployeeTaxObject**](../Model/EmployeeTaxObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updatePayRun**

> \XeroAPI\XeroPHP\Models\PayrollNz\PayRunObject updatePayRun($xero_tenant_id, $pay_run_id, $pay_run)

update a pay run

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$pay_run_id = 'pay_run_id_example'; // string | Identifier for the pay run
$pay_run = { "paymentDate": "2019-07-01" }; // \XeroAPI\XeroPHP\Models\PayrollNz\PayRun | 

try {
    $result = $apiInstance->updatePayRun($xero_tenant_id, $pay_run_id, $pay_run);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->updatePayRun: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                                                               | Description                | Notes 
--------------------|--------------------------------------------------------------------|----------------------------|-------
 **xero_tenant_id** | **string**                                                         | Xero identifier for Tenant |
 **pay_run_id**     | [**string**](../Model/.md)                                         | Identifier for the pay run |
 **pay_run**        | [**\XeroAPI\XeroPHP\Models\PayrollNz\PayRun**](../Model/PayRun.md) |                            |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\PayRunObject**](../Model/PayRunObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updatePaySlipLineItems**

> \XeroAPI\XeroPHP\Models\PayrollNz\PaySlipObject updatePaySlipLineItems($xero_tenant_id, $pay_slip_id, $pay_slip)

creates employee pay slip

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$pay_slip_id = 'pay_slip_id_example'; // string | Identifier for the payslip
$pay_slip = { "earningsLines": [ { "earningsLineID": "f9d8f5b5-9049-47f4-8541-35e200f750a5", "earningsRateID": "f9d8f5b5-9049-47f4-8541-35e200f750a5", "displayName": "Ordinary Time", "ratePerUnit": 25, "numberOfUnits": 0, "amount": 0, "isLinkedToTimesheet": false, "isSystemGenerated": true }, { "earningsLineID": "65b83d94-f20f-45e1-85ae-387fcf460c26", "earningsRateID": "65b83d94-f20f-45e1-85ae-387fcf460c26", "displayName": "Salary", "ratePerUnit": 0, "numberOfUnits": 8, "amount": 0, "isLinkedToTimesheet": false, "isSystemGenerated": false } ], "leaveEarningsLines": [ { "earningsLineID": "0441497f-5dc7-4cd3-a90d-f2e07e21b2a6", "earningsRateID": "39b3560a-5d2f-4538-924a-4349dc86396e", "displayName": "Holiday Pay", "fixedAmount": 268.8, "amount": 268.8, "isLinkedToTimesheet": false, "isSystemGenerated": true } ], "deductionLines": [ { "deductionTypeID": "a3760fe4-68a4-4e38-8326-fe616af7dc74", "amount": 100 } ], "leaveAccrualLines": [ { "leaveTypeID": "0441497f-5dc7-4cd3-a90d-f2e07e21b2a6", "numberOfUnits": 268.8 }, { "leaveTypeID": "b0b1b79e-2a25-46c2-ad08-ca25ef48d7e4", "numberOfUnits": 0 }, { "leaveTypeID": "f2f994cf-1899-46f3-ad4f-5d92d78c3719", "numberOfUnits": 0 }, { "leaveTypeID": "34129765-11cb-4d8c-b568-84a2219beda3", "numberOfUnits": 0 } ], "superannuationLines": [ { "superannuationTypeID": "563273ea-0dae-4f82-86a4-e0db77c008ea", "displayName": "KiwiSaver", "amount": 108.86, "fixedAmount": 3, "percentage": 3, "manualAdjustment": false } ], "employeeTaxLines": [ { "taxLineID": "1084146b-e890-489c-aed3-06de80f63d84", "amount": 1057.22, "globalTaxTypeID": "11", "manualAdjustment": false } ], "employerTaxLines": [ { "taxLineID": "6f9eb8cd-0f4a-440b-939c-bdb0f6ad694c", "amount": 18.9, "globalTaxTypeID": "10", "manualAdjustment": false } ], "statutoryDeductionLines": [ { "statutoryDeductionTypeID": "b5efd8d1-0c93-4a14-a314-b5cba4a4e6b3", "amount": 108.86 } ], "grossEarningsHistory": { "daysPaid": 3, "unpaidWeeks": 0 } }; // \XeroAPI\XeroPHP\Models\PayrollNz\PaySlip | 

try {
    $result = $apiInstance->updatePaySlipLineItems($xero_tenant_id, $pay_slip_id, $pay_slip);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->updatePaySlipLineItems: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name               | Type                                                                 | Description                | Notes 
--------------------|----------------------------------------------------------------------|----------------------------|-------
 **xero_tenant_id** | **string**                                                           | Xero identifier for Tenant |
 **pay_slip_id**    | [**string**](../Model/.md)                                           | Identifier for the payslip |
 **pay_slip**       | [**\XeroAPI\XeroPHP\Models\PayrollNz\PaySlip**](../Model/PaySlip.md) |                            |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\PaySlipObject**](../Model/PaySlipObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateTimesheetLine**

> \XeroAPI\XeroPHP\Models\PayrollNz\TimesheetLineObject updateTimesheetLine($xero_tenant_id, $timesheet_id,
> $timesheet_line_id, $timesheet_line)

update a timesheet line

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure OAuth2 access token for authorization: OAuth2
$config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

$apiInstance = new XeroAPI\XeroPHP\Api\PayrollNzApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xero_tenant_id = 'xero_tenant_id_example'; // string | Xero identifier for Tenant
$timesheet_id = 'timesheet_id_example'; // string | Identifier for the timesheet
$timesheet_line_id = 'timesheet_line_id_example'; // string | Identifier for the timesheet line
$timesheet_line = { "date": "2020-08-04", "earningsRateID": "f9d8f5b5-9049-47f4-8541-35e200f750a5", "numberOfUnits": 2 }; // \XeroAPI\XeroPHP\Models\PayrollNz\TimesheetLine | 

try {
    $result = $apiInstance->updateTimesheetLine($xero_tenant_id, $timesheet_id, $timesheet_line_id, $timesheet_line);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PayrollNzApi->updateTimesheetLine: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

 Name                  | Type                                                                             | Description                       | Notes 
-----------------------|----------------------------------------------------------------------------------|-----------------------------------|-------
 **xero_tenant_id**    | **string**                                                                       | Xero identifier for Tenant        |
 **timesheet_id**      | [**string**](../Model/.md)                                                       | Identifier for the timesheet      |
 **timesheet_line_id** | [**string**](../Model/.md)                                                       | Identifier for the timesheet line |
 **timesheet_line**    | [**\XeroAPI\XeroPHP\Models\PayrollNz\TimesheetLine**](../Model/TimesheetLine.md) |                                   |

### Return type

[**\XeroAPI\XeroPHP\Models\PayrollNz\TimesheetLineObject**](../Model/TimesheetLineObject.md)

### Authorization

[OAuth2](../../README.md#OAuth2)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

