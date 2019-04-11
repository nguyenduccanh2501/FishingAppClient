<?php
class DB_Functions{
    private $conn;
    function __construct()
    {
        require_once 'db_connect.php';
        $db = new DB_Connect();
        $this->conn = $db->connect();
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    /*
     * Check user exists
     * return true/false
     */

    function checkExistsUser($phone){
        $stmt = $this->conn->prepare("SELECT * FROM User WHERE Phone=?");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0){
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }

    }

    /*
     * Register new user
     * return User object if user was created
     * return error message if have exception
     */

    public function registerNewUser($phone,$name,$birthday,$address){
        $stmt = $this->conn->prepare("INSERT INTO User(Phone,Name,Birthday,Address) VALUES(?,?,?,?)");
        $stmt->bind_param("ssss", $phone,$name,$birthday,$address);
        $result=$stmt->execute();
        $stmt->close();

        if ($result){
            $stmt = $this->conn->prepare("SELECT * FROM User WHERE Phone = ?");
            $stmt->bind_param("s", $phone);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else
            return false;

    }

    /*
     * Get user information
     * return User object if user exist
     * return null if user is not exist
     */
    public function getUserInformation($phone){
        $stmt = $this->conn->prepare("SELECT * FROM User WHERE Phone=?");
        $stmt->bind_param("s", $phone);
        if ($stmt->execute()){
            $user=$stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        } else return NULL;
    }

    /*
     * Get banner
     * return list of banner
     */
    public function getBanner(){
        $result = $this->conn->query("SELECT * FROM Banner ORDER BY ID LIMIT 3 ");
        $banners=array();
        while ($item=$result->fetch_assoc()){
            $banners[]=$item;

        }
        return $banners;

    }

    /*
     * Get menu
     * return list of category
     */
    public function getMenu()
    {
        $result = $this->conn->query("SELECT * FROM Trasua");
        $menu=array();
        while ($item=$result->fetch_assoc()){
            $menu[]=$item;

        }
        return $menu;

    }


    /*
     * Get mission by mission_category
     * return list of mission
     */
    public function getMissionById($trasuaId)
    {
        $query="SELECT * FROM mission WHERE TraSuaId='".$trasuaId."'";
        $result = $this->conn->query($query);
        $mission=array();
        while ($item=$result->fetch_assoc()){
            $mission[]=$item;
        }
        return $mission;
    }

    /*
     * Update avatar
     * return true hoặc false
     */
    public function upLoadAvatar($phone, $filename)
    {
        return $result = $this->conn->query("UPDATE user SET Avatar='$filename' WHERE Phone='$phone'");
    }

    /*
     * Insert new OrderMission
     * return true hoặc false
     */
    public function insertNewOrder($orderDetail, $userPhone)
    {
        $stmt = $this->conn->prepare("INSERT INTO `ordermission`(`OrderStatus`, `OrderDetail`,`UserPhone`) VALUES (0,?,?)")
        or die($this->conn->error);
        $stmt->bind_param("ss", $orderDetail,$userPhone);
        $result=$stmt->execute();
        $stmt->close();
        if ($result)
            return true;
        else
            return false;
    }
}
?>