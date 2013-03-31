<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\AdminBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CommonController extends Controller {
    
    /**
     * test function
     *
     * @return text
     */
    public function testAction($name) {
        
        return new Response('Hello there ' . $name . '!');
    }
    
    /**
     * Make sure each key name in $requiredField exist
     * in $_POST and the value is not empty
     *
     * @return $allFieldExist
     */
    function checkRequiredPost($requiredField) {
        $numRequired = count($requiredField);
        $keys = array_keys($_POST);

        $allFieldExist = true;
        for ($i = 0; $i < $numRequired && $allFieldExist; $i++) {
            if (!in_array($requiredField[$i], $keys) || $_POST[$requiredField[$i]] == '') {
                $allFieldExist = false;
            }
        }

        return $allFieldExist;
    }

    /**
     * test function
     *
     * @return text
     */
    function getShopConfig() {
        // get current configuration
        $sql = "SELECT sc_name, sc_address, sc_phone, sc_email, sc_shipping_cost, sc_order_email, cy_symbol 
			FROM tbl_shop_config sc, tbl_currency cy
			WHERE sc_currency = cy_id";
        $result = dbQuery($sql);
        $row = dbFetchAssoc($result);

        if ($row) {
            extract($row);

            $shopConfig = array('name' => $sc_name,
                'address' => $sc_address,
                'phone' => $sc_phone,
                'email' => $sc_email,
                'sendOrderEmail' => $sc_order_email,
                'shippingCost' => $sc_shipping_cost,
                'currency' => $cy_symbol);
        } else {
            $shopConfig = array('name' => '',
                'address' => '',
                'phone' => '',
                'email' => '',
                'sendOrderEmail' => '',
                'shippingCost' => '',
                'currency' => '');
        }

        return $shopConfig;
    }

    function displayAmount($amount) {
        global $shopConfig;
        return number_format($amount) . $shopConfig['currency'];
    }

    /*
      Join up the key value pairs in $_GET
      into a single query string
     */

    function queryString() {
        $qString = array();

        foreach ($_GET as $key => $value) {
            if (trim($value) != '') {
                $qString[] = $key . '=' . trim($value);
            } else {
                $qString[] = $key;
            }
        }

        $qString = implode('&', $qString);

        return $qString;
    }

    /*
      Put an error message on session
     */

    function setError($errorMessage) {
        if (!isset($_SESSION['plaincart_error'])) {
            $_SESSION['plaincart_error'] = array();
        }

        $_SESSION['plaincart_error'][] = $errorMessage;
    }

    /*
      print the error message
     */

    function displayError() {
        if (isset($_SESSION['plaincart_error']) && count($_SESSION['plaincart_error'])) {
            $numError = count($_SESSION['plaincart_error']);

            echo '<table id="errorMessage" width="550" align="center" cellpadding="20" cellspacing="0"><tr><td>';
            for ($i = 0; $i < $numError; $i++) {
                echo '&#8226; ' . $_SESSION['plaincart_error'][$i] . "<br>\r\n";
            }
            echo '</td></tr></table>';

            // remove all error messages from session
            $_SESSION['plaincart_error'] = array();
        }
    }

}
