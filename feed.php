<?php
require_once('main.php');
$db = Db::getInstance();
$keyword = $_POST['keyword'];
$records = $db->query("SELECT * FROM dict_word WHERE word LIKE '%$keyword%' LIMIT 10");
$out['html'] = '';
$out['raw'] = array();
foreach($records as $records){
//  $out['html'] .= '<strong>' . $records['word'] . '</strong><br><span>' . $records['meaning'] . '</span><hr>';
  $out['raw'][] = $records;
}

echo json_encode($out);
?>