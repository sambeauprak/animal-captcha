<?PHP
// Original PHP code by Chirp Internet: www.chirp.com.au
// Please acknowledge use of this code by including this header.
require 'CaptchaNoCookie.php';

class CaptchaNonceNoCookie extends CaptchaNoCookie
{

  private static function tempfile($crypted)
  {
    return sys_get_temp_dir() . DIRECTORY_SEPARATOR . str_replace(DIRECTORY_SEPARATOR, "_", $crypted);
  }

  public function display()
  {
    touch(self::tempfile($this->crypted));
    return parent::display();
  }

  public static function validate($crypted, $user_input)
  {
    if(file_exists(self::tempfile($crypted))) {
      if(parent::validate($crypted, $user_input)) {
        unlink(self::tempfile($crypted));
        return TRUE;
      } else {
        // validation failed
      }
    } else {
      // code already used or expired
    }
    return FALSE;
  }

}
?>