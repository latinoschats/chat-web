<?php
session_start();
$file = 'comments.txt';
$reverse = true;
 
if(!empty($_POST['token']) && !empty($_SESSION['token']) && $_SESSION['token'] != $_POST['token']){
    $txt = array();
    foreach($_POST as $key => $val){ $txt[$key] = $val; }
    $txt['ip'] = $_SERVER['REMOTE_ADDR'];
    file_put_contents($file, serialize($txt) . PHP_EOL, FILE_APPEND);
}
$_SESSION['token'] = !empty($_POST['token']) ? $_POST['token'] : mt_rand();
?>
 
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="hidden" name="token" value="<?php echo mt_rand(); ?>" />
    <input type="text" name="Name" /><br />
    <textarea name="comment" cols="30" rows="5"></textarea><br />
    <input type="submit" />
</form>
 
<?php
if(file_exists($file)){
    $comments = $reverse ? array_reverse(file($file)) : file($file);
    foreach($comments as $val){
        $data = unserialize($val);
?>
    <fieldset>
        <legend><?php echo $data['Name'] . ' ' . $data['ip']; ?></legend>
        <?php echo $data['comment']; ?>
    </fieldset>
<?php
    }
}
?>
