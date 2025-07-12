<?php
session_start();
class Customer {
    public $id, $username, $password, $fullname, $address, $phone, $gender, $birthday;

    public function __construct($id, $username, $password, $fullname, $address, $phone, $gender, $birthday) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->fullname = $fullname;
        $this->address = $address;
        $this->phone = $phone;
        $this->gender = $gender;
        $this->birthday = $birthday;
    }
}
if (!isset($_SESSION['customers'])) {
    $_SESSION['customers'] = [];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id       = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $address  = $_POST['address'];
    $phone    = $_POST['phone'];
    $gender   = $_POST['gender'];
    $birthday = $_POST['birthday'];

    $newCustomer = new Customer($id, $username, $password, $fullname, $address, $phone, $gender, $birthday);
    $_SESSION['customers'][] = $newCustomer;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer Info</title>
</head>
<body>

<h2>Add New Customer</h2>
<form method="POST">
    <label>ID:</label><input type="text" name="id" required /><br/>
    <label>Username:</label><input type="text" name="username" required /><br/>
    <label>Password:</label><input type="password" name="password" required /><br/>
    <label>Fullname:</label><input type="text" name="fullname" required /><br/>
    <label>Address:</label><input type="text" name="address" /><br/>
    <label>Phone:</label><input type="text" name="phone" /><br/>
    <label>Gender:</label>
    <select name="gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select><br/>
    <label>Birthday:</label><input type="date" name="birthday" /><br/>
    <input type="submit" value="Add Customer" />
</form>
<hr/>
<h2>Customer List</h2>
<?php if (!empty($_SESSION['customers'])): ?>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th><th>Username</th><th>Password</th><th>Fullname</th>
        <th>Address</th><th>Phone</th><th>Gender</th><th>Birthday</th>
    </tr>
    <?php foreach ($_SESSION['customers'] as $cus): ?>
    <tr>
        <td><?= $cus->id ?></td>
        <td><?= $cus->username ?></td>
        <td><?= $cus->password ?></td>
        <td><?= $cus->fullname ?></td>
        <td><?= $cus->address ?></td>
        <td><?= $cus->phone ?></td>
        <td><?= $cus->gender ?></td>
        <td><?= $cus->birthday ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p>No customer added yet.</p>
<?php endif; ?>
</body>
</html>
