<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$route['saas/dashboard'] = 'saas/index';
$route['assignPackage'] = 'saas/gb/assignPackage';
$route['updatePackage'] = 'saas/gb/assignPackage';
$route['checkoutPayment'] = 'saas/gb/checkoutPayment';
$route['privacy'] = 'saas/gb/privacy';
$route['tos'] = 'saas/gb/tos';
$route['save_faq'] = 'saas/frontcms/home/save_faq/$1';
$route['front/contacts'] = 'settings/get_contacts';
$route['front/(:any)'] = 'saas/frontcms/home/page/$1';
$route['frontcms/(:any)'] = 'saas/frontcms/home/page/$1';
$route['front'] = 'saas/frontcms/home/index';
$route['home'] = 'saas/frontcms/home/index';
$route['signed_up'] = 'saas/gb/signed_up';
$route['setup'] = 'saas/setup';
$route['upgrade'] = 'saas/gb/upgrade';
$route['get_package_info'] = 'saas/gb/get_package_info';
$route['check_coupon_code'] = 'saas/gb/check_coupon_code';
$route['package_details/(:any)'] = 'saas/gb/package_details/$1';
$route['subs_package_details/(:any)/(:any)'] = 'saas/gb/package_details/$1/$2';
$route['proceedPayment/(:any)'] = 'saas/gb/proceedPayment/$1';
$route['proceedPayment'] = 'saas/gb/proceedPayment';
$route['completePaypalPayment/(:any)'] = 'saas/gb/completePaypalPayment/$1';
$route['stipePaymentSuccess/(:any)'] = 'saas/gb/stipePaymentSuccess/$1';
$route['paymentCancel/(:any)'] = 'saas/gb/paymentCancel/$1';
$route['companyHistoryList/(:any)'] = 'saas/gb/companyHistoryList/$1';
$route['companyPaymentList/(:any)'] = 'saas/gb/companyPaymentList/$1';
$route['billing'] = 'saas/gb/billing';
$route['domain-not-available'] = "saas/setup/domain_not_available";

// check is_subdomain function is exist or not
if (!function_exists('is_subdomain')) {
    function is_subdomain($domain = null)
    {
        $isIP = @($_SERVER['SERVER_ADDR'] === trim($_SERVER['HTTP_HOST'], '[]'));
        if (!empty($isIP)) {
            return false;
        }
        $config_path = MODULES_PATH . 'saas/config/conf.php';
        // read data from file
        $default_url = file_get_contents($config_path);
        // get string which start with '$config['default_url']' and end with ';'
        $default_url = substr($default_url, strpos($default_url, '$config[\'default_url\']'));
        $default_url = substr($default_url, 0, strpos($default_url, ';'));
        // remove '$config['default_url']' and ';'
        $default_url = str_replace(['$config[\'default_url\']', ';'], '', $default_url);
        $default_url = str_replace('=', '', $default_url);
        $default_url = str_replace("'", '', $default_url);
        $default_url = str_replace(' ', '', $default_url);
        $base_url = guess_base_url();

        $scheme = parse_url($default_url, PHP_URL_SCHEME);
        if (empty($scheme)) {
            $default_url = 'http://' . $default_url;
        }
        $default_url = parse_url($default_url, PHP_URL_HOST);
        $base_url = parse_url($base_url, PHP_URL_HOST);
        // check www exist in base_url then remove it
        if (strpos($base_url, 'www.') !== false) {
            $base_url = str_replace('www.', '', $base_url);
        }
        // check www exist in default_url then remove it
        if (strpos($default_url, 'www.') !== false) {
            $default_url = str_replace('www.', '', $default_url);
        }
        // check default_url and base_url is not same then return the subdomain
        if ($default_url != $base_url) {
            // return first subdomain
            $subdomain = explode('.', $base_url);
            return $subdomain[0];
        }
        return false;
    }
}

if (empty(is_subdomain())) {
    $route['default_controller'] = 'saas/frontcms/home/index';
}




