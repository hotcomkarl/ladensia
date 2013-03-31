<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */
/**
 * UserService.php
 *
 * @category            Ladensia
 * @package             CoreBundle
 * @subpackage          Service
 */

namespace Ladensia\CoreBundle\Service;

//use Application\TicketBundle\Model\Ticket;
//use Application\TicketBundle\Model\Ticket\Mapper;
//use Application\UserBundle\Model\User;


class UserService {

   /**
   * Checks if the session is still valid
   *
   */
    public function checkUser() {
        // if the session id is not set, redirect to login page
        if (!isset($_SESSION['plaincart_user_id'])) {
            header('Location: ' . WEB_ROOT . 'admin/login.php');
            exit;
        }

        // the user want to logout
        if (isset($_GET['logout'])) {
            doLogout();
        }
    }
    
   /**
   * User Login
   *
   * @return string $errorMessage
   */

    public function doLogin() {
        // if we found an error save the error message in this variable
        $errorMessage = '';

        $userName = $_POST['txtUserName'];
        $password = $_POST['txtPassword'];

        // first, make sure the username & password are not empty
        if ($userName == '') {
            $errorMessage = 'Bitte geben Sie einen Usernamen ein.';
        } else if ($password == '') {
            $errorMessage = 'Bitte geben Sie ein Passwort ein.';
        } else {
            // check the database and see if the username and password combo do match
            $sql = "SELECT user_id
		        FROM tbl_user 
				WHERE user_name = '$userName' AND user_password = md5('$password')";
            $result = dbQuery($sql);

            if (dbNumRows($result) == 1) {
                $row = dbFetchAssoc($result);
                $_SESSION['plaincart_user_id'] = $row['user_id'];

                // log the time when the user last login
                $sql = "UPDATE tbl_user 
			        SET user_last_login = NOW() 
					WHERE user_id = '{$row['user_id']}'";
                dbQuery($sql);

                // now that the user is verified we move on to the next page
                // if the user had been in the admin pages before we move to
                // the last page visited
                if (isset($_SESSION['login_return_url'])) {
                    header('Location: ' . $_SESSION['login_return_url']);
                    exit;
                } else {
                    header('Location: index.php');
                    exit;
                }
            } else {
                $errorMessage = 'Falscher Username oder Passwort';
            }
        }

        return $errorMessage;
    }

   /**
   * User Logout
   *
   */

    public function doLogout() {
        if (isset($_SESSION['plaincart_user_id'])) {
            unset($_SESSION['plaincart_user_id']);
            session_unregister('plaincart_user_id');
        }

        header('Location: login.php');
        exit;
    }

}