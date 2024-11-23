<?php

class Cart {
    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    // Add to cart
    public function addToCart($quantity, $id) {
        $customer_id = Session::get("cmrId");
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $productId = mysqli_real_escape_string($this->db->link, $id);

        $sId = session_id();

        $squery = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $result = $this->db->select($squery)->fetch_assoc();

        $productName = $result['productName'];
        $price = $result['price'];
        $image = $result['image'];

        $chquery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId='$sId'";
        $getPro = $this->db->select($chquery);
        if ($getPro) {
            $msg = "Product already added!";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_cart(sId, customer_id, productId, productName, price, quantity, image) VALUES('$sId', '$customer_id', '$productId','$productName','$price','$quantity','$image')";
            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
                header("Location:cart.php");
            } else {
                header("Location:404.php");
            }
        }
    }

    // Get cart products
    public function getCartProduct() {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    // Update cart quantity
    public function updateCartQuantity($cartId, $quantity) {
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);

        $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";
        $updated_row = $this->db->update($query);
        if ($updated_row) {
            header("Location:cart.php");
        } else {
            $msg = "<span class='error'>Quantity Not Updated !</span>";
            return $msg;
        }
    }

    // Delete product from cart
    public function delProductByCart($delId) {
        $delId = mysqli_real_escape_string($this->db->link, $delId);
        $query = "DELETE FROM tbl_cart WHERE cartId = '$delId'";
        $deldata = $this->db->delete($query);
        if ($deldata) {
            echo "<script>window.location = 'cart.php';</script>";
        } else {
            $msg = "<span class='error'>Product Not Deleted !</span>";
            return $msg;
        }
    }

    // Check if there are items in the cart
    public function checkCartTable() {
        $sId = session_id(); // Get the session ID
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    // Delete all products in the customer's cart
    public function delCustomerCart() {
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
        $this->db->delete($query);
    }

    // Order the products
    public function orderProduct($cmrId) {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $getPro = $this->db->select($query);
        if ($getPro) {
            while ($result = $getPro->fetch_assoc()) {
                $productId = $result['productId'];
                $productName = $result['productName'];
                $quantity = $result['quantity'];
                $price = $result['price'] * $quantity;
                $image = $result['image'];

                $query = "INSERT INTO tbl_order(cmrId, productId, productName, quantity, price, image) 
                          VALUES('$cmrId', '$productId', '$productName', '$quantity', '$price', '$image')";
                $inserted_row = $this->db->insert($query);
            }
        }
    }

    // Get the total payable amount for the customer
    public function payableAmount($cmrId) {
        $query = "SELECT price FROM tbl_order WHERE cmrId = '$cmrId' AND date = now()";
        $result = $this->db->select($query);
        return $result;
    }

    // Get all ordered products for the customer
    public function getOrderedProduct($cmrId) {
        $query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId' ORDER BY date DESC";
        $result = $this->db->select($query);
        return $result;
    }

    // Check if the customer has any orders
    public function checkOrder($cmrId) {
        $query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId'";
        $result = $this->db->select($query);
        return $result;
    }

    // Get all orders
    public function getAllOrderProduct() {
        $query = "SELECT * FROM tbl_order ORDER BY date DESC";
        $result = $this->db->select($query);
        return $result;
    }

    // Shift product status to shipped
    public function productShifted($id) {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "UPDATE tbl_order SET status ='1' WHERE id = '$id'";

        $updated_row = $this->db->update($query);
        if ($updated_row) {
            $msg = "<span class='success'>Updated Successfully.</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Not Updated !</span>";
            return $msg;
        }
    }

    // Delete shifted product from orders
    public function delProductShifted($id) {
        $id = mysqli_real_escape_string($this->db->link, $id);

        $query = "DELETE FROM tbl_order WHERE id = '$id'";
        $deldata = $this->db->delete($query);
        if ($deldata) {
            $msg = "<span class='success'>Data Deleted Successfully.</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Data Not Deleted !</span>";
            return $msg;
        }
    }

    // Confirm product shipment
    public function productShiftConfirm($id) {
        $id = mysqli_real_escape_string($this->db->link, $id);

        $query = "UPDATE tbl_order SET status ='2' WHERE id = '$id'";

        $updated_row = $this->db->update($query);
        if ($updated_row) {
            $msg = "<span class='success'>Updated Successfully.</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Not Updated !</span>";
            return $msg;
        }
    }
}
?>
