<?
class Db {
  private $connection; // �?� �� �� �?� �ǘ�� ��?���� ������� ��� �� ����� ��? �?� ����
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
// ?� ����� �� ��? �� �?� �� ����� �?�� � ���� ����� �?��� �?��
    $this->connection = new mysqli($host, $user, $pass, $name);// ����� �� �?��� �?� ��? �� �?� �� �? ���?� � �� �?� ����� �?���
    if ($this->connection->connect_error) {
      echo "Connection failed: " . $this->connection->connect_error;// ���� �����? �� �?�� �����
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
    // �� �?� ����� �?�?� �?���� ��� ?��? ?� �?��? �� ����? ��� �� �� ���� ?� ��� �?���?� Ȑ?�?�
    return $this->connection;
  }

  public function close(){
    $this->connection->close();// ��� ����� ���� �� ��? �?�� ����� ���� ��
  }
}