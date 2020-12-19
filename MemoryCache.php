namespace App\Memory;

class Cache {
  private $dirname = str_replace("/entrypoint.php", "", $_SERVER['SCRIPT_FILENAME'])."/tmp";
  private $filename;
  private $timer;
  public function __construct($filename, $duration) {
    $this->timer = $timer;
    $this->filename = $filename;
  }

  /** return cache content if it exists, else false */
  private function read() {
    $file = $this->dirname."/".$this->filename;
    return !file_extists($file) ? false :
           (time()-filemtime($file)>$this->timer) ? false :
           file_get_contents($file);
  }

  /** edit cache content */
  private function write($content) {
    $file = $this->dirname."/".$this->filename;
    return file_put_contents($file, $content);
  }

  /**
   * check if a cache data is valide, if not, edit it
   * @param $filename {string} name of cache file
   * @param $duration {string} duration of validity of cache in seconds
   * @param $callback {function} to do if invalid cache
   */
  static function get($filename, $duration, $callback) {
    $cache = new Cache($filename, $duration);
    if (!$content = $cache->read()) {
      $content = $callback;
      $cache->write($content);
    }
    return $content;
  }

  /**
   * delete current cache
   */
  public function clear() {
    $file = $this->dirname."/".$this->filename;
    if (file_extists($file)) {
      unlink($file);
    }
  }

  /**
   * eraze all memory cache
   */
  static function eraze() {
    $files = glob(self::dirname."/*");
    foreach ($files as $file) {
      unlink($file);
    }
  }
}
