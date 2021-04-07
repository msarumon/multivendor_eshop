<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH.'/libraries/hybridauth/src/autoload.php';
use Hybridauth\Hybridauth;

class Social extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        //Load URL helper
        $this->load->helper('url');

        //Load session library
        $this->load->library('session');
    }

    //Displays social login links
    function index()
    {
        //Instantiate Hybridauth's classes
        $hybrid = new Hybridauth($this->getHybridConfig());

        //Get enabled providers array
        $providers = $hybrid->getProviders();

        //List a link to login
        foreach ($providers as $provider)
        {
            $href = sprintf(base_url('%s/auth/%s/') , strtolower($this->router->fetch_class()) , $provider);
            printf('<p><a href="%s">Login with %s</p>', $href, $provider);
        }
    }

    //Processes social login
    function auth($provider = NULL)
    {
        $service = NULL;

        try
        {
            //Instantiate Hybridauth's classes
            $hybrid = new Hybridauth($this->getHybridConfig());


                $service = $hybrid->authenticate("Facebook");
                if ($service->isConnected())
                {
                    //Get user profile
                    $profile = $service->getUserProfile();

                    //Get user contacts
                    $contacts = $service->getUserContacts();

                    /*
                    Disconnect the service else HA would reuse stored session data
                    rather making a fresh request in case the user has denied permissions
                    in the previous authorization request
                    */
                    $service->disconnect();

                    //$this->session->unset_userdata('provider');

                    //Display the profile data
                    echo 'Name: ' . $profile->displayName;
                    print_r($profile);

            }
        }
        catch(Exception $e)
        {
            if (isset($service) && $service->isConnected())
                $service->disconnect();

            $error = 'Sorry! We couldn\'t authenticate you.';
            $this->session->set_flashdata('showmsg', array('msg' => $error));
            $error .= '\nError Code: ' . $e->getCode();
            $error .= '\nError Message: ' . $e->getMessage();

            log_message('error', $error);
        }

        //redirect();
    }

    //Hybridauth configuration
    private function getHybridConfig()
    {
        $config = array(

            'callback' => base_url().'test/auth/' ,

            'providers' => array(
                'Google' => array(
                    'enabled' => true,
                    'keys' => array(
                        'id' => 'YOUR_CLIENT_ID',
                        'secret' => 'YOUR_CLIENT_SECRET'
                    ) ,
                    'scope' => 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
                ) ,

                'Facebook' => array(
                    'enabled' => true,
                    'keys' => array(
                        'id' => (ENVIRONMENT == 'development') ? 'DEVELOPMENT_APP_ID' : 'PRODUCTION_APP_ID',
                        'secret' => (ENVIRONMENT == 'development') ? 'DEVELOPMENT_APP_SECRET' : 'PRODUCTION_APP_SECRET'
                    ) ,
                    'scope' => 'email, public_profile'
                ) ,

                'Twitter' => array(
                    'enabled' => true,
                    'keys' => array(
                        'key' => 'APP_KEY',
                        'secret' => 'APP_SECRET'
                    )
                )
            ) ,

            'hybrid_debug' => array(
                'debug_mode' => 'info', /* none, debug, info, error */
                'debug_file' => APPPATH . '/logs/log-' . date('Y-m-d') . '.php'
            )
        );

        return $config;
    }
}
