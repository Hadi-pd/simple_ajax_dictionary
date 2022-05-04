<?
class Db {
  private $connection; // Â?ç ò” «“ «?‰ ò«ò‘‰ ‰„? Ê‰Â «” ›«œÂ ò‰Â Ã“ ›«‰ò‘‰ Â«? «?‰ ò·«”
  private static $db;

  public static function getInstance(){
    if(self::$db== null){
      self::$db =new Db();
    }
    return self::$db;
  }

  public function __construct($option = null){
    if ($option != null){
      $host = $option['host'];
      $user = $option['user'];
      $pass = $option['pass'];
      $name = $option['name'];
    } else {
      global $config;
      $host = $config['db']['host'];
      $user = $config['db']['user'];
      $pass = $config['db']['pass'];
      $name = $config['db']['name'];
    }
// ?ò ‰„Ê‰Â «“ „«? «” ò?Ê «· ”«Œ Â „?‘Â Ê œ«Œ· ò«‰ò‘‰ —?Œ Â „?‘Â
    $this->connection = new mysqli($host, $user, $pass, $name);// ò«‰ò‘‰ —Ê «?‰Ã« ‰?Ê „«? «” ò?Ê «· ¬? ò—œ?„ Ê »Â «?‰ «‘«—Â „?ò‰Â
    if ($this->connection->connect_error) {
      echo "Connection failed: " . $this->connection->connect_error;// ‰ÕÊÂ œ” —”? »Â ›?·œ ò«‰ò‘‰
      exit;
    }
    $this->connection->query("SET NAMES 'utf8'");

  }

  public function first($sql){
    $records = $this->query($sql);
    if ($records == null){
      return null;
    }

    return $records[0];
  }

  public  function modify($sql){
    $result = $this->connection->query($sql);
    if(!$result){
      echo "Query: " . $sql . " failed due to " . mysqli_errno($this->connection);
      exit;
    }
    return $result;
  }


  public function insert($sql){
    $result = $this->connection->query($sql);
    if(!$result){
      echo "Query: " . $sql . " failed due to " . mysqli_errno($this->connection);
      exit;
    }
    return $result;
  }

  public function query($sql){
    $result = $this->connection->query($sql);
    if(!$result){
      echo "Query: " . $sql . " failed due to " . mysqli_errno($this->connection);
      exit;
    }
    $records = array();

    if ($result->num_rows == 0) {
      return null;
    }

    while($row = $result->fetch_assoc()) {
      $records[] = $row;
    }

    return $records;
  }

  public function connection(){
    // »« «?‰ œ” Ê— „?ê?„ ›?·œ Ê »œÂ ?⁄‰? ?Â ›?·œ? òÂ Œ’Ê’? Â”  —Ê œ— ﬁ«·» ?ò „ œ „? Ê‰?„ »ê?—?„
    return $this->connection;
  }

  public function close(){
    $this->connection->close();// »—Ê œ” Ê— ò·Ê“ —Ê —Ê? ›?·œ ò«‰ò‘‰ «Ã—« ò‰
  }
}