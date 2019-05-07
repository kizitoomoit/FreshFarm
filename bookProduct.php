<!DOCtype html>
<html>
<?php
session_start();
?>;

<?php
if($_SESSION["ID"]!=null) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "FreshFarm";
//Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = " use FreshFarm";
    if ($conn->query($sql) === TRUE) {
        $stmt = $conn->prepare("select * from buyer Where user_id=? ");
        $stmt->bind_param("s", $_SESSION['ID']);
        $stmt->execute();
        $stmt->bind_result($ID_no, $first_name, $last_name, $email, $buyer_password, $date, $user_id);
        $stmt->fetch();
        $stmt->close();

        echo $_SESSION['ID'];
       // if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //get from db


       //  if(isset($_POST['btnbook'])){
             $getProd = $_GET['product_id'];
            $quantity = $_POST["quantity"];
// prepare and bind
            $stmt = $conn->prepare("insert into bookprduct (prod_id,quantity,veiw,owner_id) values (?,?,?,?)");
            $view='no';
            $owner_id = $_SESSION['ID'];
            $stmt->bind_param("ssss",$getProd,  $quantity,$view, $owner_id);
            $stmt->execute();
            echo '<div class="alert alert-danger alert-dismissible fade show w-100"> Product Book successfull.
                       <button class="close" role="button" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                      </div>';
            //header("location:shop.php");
             $stmt->close();

     //   } else {


       // }
    }
}else{
    echo $stmt->error;
}
?>;

<body>
<form action="<?php //echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

   <div class="form-group">
       <label for=" quantity">Quantity</label>
       <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity " required>
   </div>
</form>
</body>
</html