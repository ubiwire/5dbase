<?php

/**
 * HttpAuthFilter class file.
 *
 * @license BSD
 */

/**
 * HttpAuthFilter performs authorization checks using http authentication
 *
 * By enabling this filter, controller actions can be limited to a couple of users.
 * It is very simple, supply a list of usernames and passwords and the controller actions 
 * will be restricted to only those. Nothing fancy, it just keeps out users.
 * 
 * To specify the authorized users specify the 'users' property of the filter
 * Example:
 * <pre>
 *
 * 	public function filters()
 * 	{
 * 		return array(
 *           array(
 * 			'HttpAuthFilter',
 *                'users'=>array('admin'=>'admin'), 
 *                'realm'=>'Admin section'
 *                  )  
 *            );
 * 	}
 * The default section for the users property is 'admin'=>'admin' change it
 *
 */
class HttpAuthFilter extends CFilter {

    /**
     * @return array list of authorized users/passwords
     */
    public $users = array('snfang' => 'admin',);

    /**
     * @return string authentication realm
     */
    public $realm = 'Authentication needed';

    /**
     * Performs the pre-action filtering.
     * @param CFilterChain the filter chain that the filter is on.
     * @return boolean whether the filtering process should continue and the action
     * should be executed.
     */
    protected function preFilter($filterChain) {
        if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
            $username = $_SERVER['PHP_AUTH_USER'];
            $password = $_SERVER['PHP_AUTH_PW'];
            $user = User::model()->notsafe()->find('LOWER(username)=?', array(strtolower($username)));
            if ($user === null) {
                // Error: Unauthorized
                $this->_sendResponse(401, 'Error: User Name is invalid');
            } else if (Yii::app()->getModule('user')->encrypting($password) !== $user->password) {
                // Error: Unauthorized
                $this->_sendResponse(401, 'Error: User Password is invalid');
            } else {
                $_SERVER['USER_ID'] = $user->id;
                $_SERVER['ORG_ID'] = $user->org_id;
                return true;
            }
        }
        header("WWW-Authenticate: Basic realm=\"" . $this->realm . "\"");
        throw new CHttpException(401, Yii::t('yii', 'You are not authorized to perform this action.'));
    }

    public function _sendResponse($status = 200, $body = '', $content_type = 'text/html') {
        // set the status
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        header($status_header);
        // and the content type
        header('Content-type: ' . $content_type);

        // pages with body are easy
        if ($body != '') {
            // send the body
            echo $body;
        }
        // we need to create the body if none is passed
        else {
            // create some body messages
            $message = '';

            // this is purely optional, but makes the pages a little nicer to read
            // for your users.  Since you won't likely send a lot of different status codes,
            // this also shouldn't be too ponderous to maintain
            switch ($status) {
                case 401:
                    $message = 'You must be authorized to view this page.';
                    break;
                case 404:
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                    break;
                case 500:
                    $message = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $message = 'The requested method is not implemented.';
                    break;
            }

            // servers don't always have a signature turned on 
            // (this is an apache directive "ServerSignature On")
            $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

            // this should be templated in a real-world solution
            $body = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8">
    <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
</head>
<body>
    <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
    <p>' . $message . '</p>
    <hr />
    <address>' . $signature . '</address>
</body>
</html>';

            echo $body;
        }
        Yii::app()->end();
    }

    public function _getStatusCodeMessage($status) {
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = Array(
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

}
