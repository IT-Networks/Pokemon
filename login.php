<html>
<head>
</head>
<body>
<form action="login.php" method="post">
 <p>Ihr Name: <input type="text" name="name" /></p>
 <p>Ihr Alter: <input type="text" name="alter" /></p>
 <p><input type="submit" /></p>
</form>
Hallo <?php echo htmlspecialchars($_POST['name']); ?>.
Sie sind <?php echo (int)$_POST['alter']; ?> Jahre alt.

</body>


</html>


