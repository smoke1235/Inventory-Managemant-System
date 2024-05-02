<?php 


?> 
<head>
    <meta charset="UTF-8">
    
</head>

<body>
<?php
require_once '../src/inc/session_check.php';

class CommentEditor {
     private $con;
    
    public function __construct($con) {
        $this->con = $con;
        
    }

    public function editComment($cid, $message) {
        $sql= "UPDATE comments SET message='$message' WHERE cid ='$cid'";
        $result = $this->con->query($sql);
        header("Location: dashboard.php");
        
    
        exit;
    }
}

$cid = $_POST['cid'];
$name = $_POST['name'];
$data = $_POST['data'];
$message = $_POST['message'];




$commentEditor = new CommentEditor($con);

if (isset($_POST['commentSubmit'])) {
    $commentEditor->editComment($cid, $_POST['message']);
}

echo "<form class='edit-btn' method='POST' action='editcomment.php'>
<input type='hidden' name='cid' value='".$cid."'>
<input type='hidden' name='name' value='".$name."'>
<input type='hidden' name='data' value='".date('Y-m-d H:i:s')."'>
<textarea name='message' required placeholder='Pas uw opmerking aan..'>".$message."</textarea><br>
<button type='submit' name='commentSubmit'>Edit</button>
</form>";
?>

</body>

