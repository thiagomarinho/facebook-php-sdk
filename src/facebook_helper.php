<?php

class FacebookHelper
{
  protected $facebookAPI = null;

  private static $instance = null;
  protected static $appId = '';
  protected static $secret = '';

  private function __construct()
  {
    if (!class_exists('Facebook'))
    {
      require 'lib/facebook/facebook.php';
    }

    $this->facebookAPI = new Facebook(array(
      'appId' => self::$appId,
      'secret' => self::$secret
    ));
  }

  public static function getInstance()
  {
    if (self::$instance === null)
    {
      self::$instance = new FacebookHelper;
    }

    return self::$instance;
  }

  public function getFacebookAPI()
  {
    return $this->facebookAPI;
  }

  public function getFBapi()
  {
    return $this->facebookAPI;
  }

  public function postToWall($post)
  {
    return $this->facebookAPI->api('/me/feed', 'post', $post);
  }

  public function getUser()
  {
    return $this->facebookAPI->api('/me');
  }

  public function api()
  {
    # TODO
  }

  public function test()
  {
    try
    {
      $this->facebookAPI->api('/me');

      return true;
    }
    catch (FacebookApiException $e)
    {
      return false;
    }
    catch (Exception $e)
    {
      throw $e;
    }
  }

  public function getLoginUrl($scopes = '')
  {
    return $this->facebookAPI->getLoginUrl(array('scope' => $scopes));
  }

  public function getLogoutUrl()
  {
    return $this->facebookAPI->getLogoutUrl();
  }
}