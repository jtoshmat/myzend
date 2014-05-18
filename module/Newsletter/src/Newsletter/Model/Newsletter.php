<?php
namespace Newsletter\Model;

use Zend\Db\Adapter\Adapter;
use Application\Model\MYSQLDB;
class Newsletter extends MYSQLDB
{
    public $email;
    public $ip;
    public $cur_date;
    public $browser;
    public function __construct(){
        $this->ip = $this->getIpAddress();
        $this->cur_date = date('Y-m-d G:i:s');
        $this->browser = $this->getBrowser();
    }

    public function getBrowser(){
            $u_agent = $_SERVER['HTTP_USER_AGENT'];
            $bname = 'Unknown';
            $platform = 'Unknown';
            $version= "";

            //First get the platform?
            if (preg_match('/linux/i', $u_agent)) {
                $platform = 'linux';
            }
            elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
                $platform = 'mac';
            }
            elseif (preg_match('/windows|win32/i', $u_agent)) {
                $platform = 'windows';
            }

            // Next get the name of the useragent yes seperately and for good reason
            if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
            {
                $bname = 'Internet Explorer';
                $ub = "MSIE";
            }
            elseif(preg_match('/Firefox/i',$u_agent))
            {
                $bname = 'Mozilla Firefox';
                $ub = "Firefox";
            }
            elseif(preg_match('/Chrome/i',$u_agent))
            {
                $bname = 'Google Chrome';
                $ub = "Chrome";
            }
            elseif(preg_match('/Safari/i',$u_agent))
            {
                $bname = 'Apple Safari';
                $ub = "Safari";
            }
            elseif(preg_match('/Opera/i',$u_agent))
            {
                $bname = 'Opera';
                $ub = "Opera";
            }
            elseif(preg_match('/Netscape/i',$u_agent))
            {
                $bname = 'Netscape';
                $ub = "Netscape";
            }

            // finally get the correct version number
            $known = array('Version', $ub, 'other');
            $pattern = '#(?<browser>' . join('|', $known) .
                ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
            if (!preg_match_all($pattern, $u_agent, $matches)) {
                // we have no matching number just continue
            }

            // see how many we have
            $i = count($matches['browser']);
            if ($i != 1) {
                //we will have two since we are not using 'other' argument yet
                //see if version is before or after the name
                if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                    $version= $matches['version'][0];
                }
                else {
                    $version= $matches['version'][1];
                }
            }
            else {
                $version= $matches['version'][0];
            }

            // check if we have a number
            if ($version==null || $version=="") {$version="?";}

            return array(
                'userAgent' => $u_agent,
                'name'      => $bname,
                'version'   => $version,
                'platform'  => $platform,
                'language'  => substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
                'country'   => $this->getCountryName(),
            );
    }

    public function getCountryName(){
        $ip = $_SERVER["REMOTE_ADDR"];
        if(filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        if(filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        $result = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip))
            ->geoplugin_countryName;
        return $result <> NULL ? $result : "Unknown";
    }

    protected function cleanData($string){
        $string = strip_tags($string);
        $string = trim($string);
        return $string;
    }

    public function getIpAddress(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function checkForDuplicate($email){
         if (!isset($email) || $email==''){return false;}
         $email = $this->cleanData($email);
         $this->email = $email;
         $sql = ("SELECT email_address, subscribe FROM newsletters where email_address =? LIMIT 1");
         return $this->setConn()->query($sql)->execute(array($email))->next();
    }


    public function subscribe($email){
        $result = $this->checkForDuplicate($email);

        if ($result['email_address']===$this->email && $result['subscribe']==1){
            //Do nothing, because email is already registered and active
            return array('code'=>0,'message'=>'Your email is already registered and active');
        }else{
            if ($result['email_address']===$this->email && $result['subscribe']==0){
                //email registered but not active
                $code = $this->update(1);
                return array('code'=>$code,'message'=>'Your email has been activated');
            }
            if ($result['email_address']!==$this->email){
                //email is not registered
                $code = $this->insert();
                return array('code'=>$code,'message'=>'Your email has been subscribed');
            }
        }
    }

    public function unsubscribe($email){
        $result = $this->checkForDuplicate($email);
        if (!$result){return array('code'=>0,'message'=>'Your email is not found');}
        else{
            if ($result['email_address']===$this->email && $result['subscribe']==1){
                $code = $this->update(0);
                return array('code'=>$code,'message'=>'Your email has been unsubscribed');
            }else{
                return array('code'=>0,'message'=>'Subscription updated');
            }
        }
    }

    protected function update($subscribe=0){
        if (!isset($this->email) || $this->email==''){return false;}
        $browser = print_r($this->browser,true);
        $sql = ("
          UPDATE newsletters
                SET subscribe=$subscribe, ip_address = '$this->ip', modified_date = '$this->cur_date', browser_settings ='$browser'
                WHERE email_address=?;
        ");
        $results = $this->setConn()->query($sql)->execute(array($this->email));
        return $results->getAffectedRows();
    }

    protected function insert(){
        if (!isset($this->email) || $this->email==''){return false;}
        $browser = print_r($this->browser,true);
        $sql = ("
             INSERT INTO newsletters (email_address,ip_address,subscribe,browser_settings)
             VALUES ('$this->email','$this->ip',1,'$browser');
        ");
        $results = $this->setConn()->query($sql)->execute();
        return $results->getAffectedRows();
    }


    // Add content to these methods:
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'email',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 10,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));



            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}