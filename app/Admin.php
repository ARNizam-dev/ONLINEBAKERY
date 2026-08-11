<?php
class Admin extends Main {
    
    public function cud($query, $message) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            if(!empty($message)) {
                echo "<script>alert('$message');</script>";
            }
            return true;
        } catch(PDOException $e) {
            echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
            return false;
        }
    }

    public function Rcud($query) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $this->conn->lastInsertId();
        } catch(PDOException $e) {
            echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
            return false;
        }
    }

    public function ret($query) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        } catch(PDOException $e) {
            echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
            return false;
        }
    }
}
?>
