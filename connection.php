<html>

<body>
    <?php //Database Connection & Declaration
    $conn = mysqli_connect('localhost', 'root', '');
    mysqli_select_db($conn, 'smartiesproject1');

    if (mysqli_connect_errno()) {
        printf("Connection failed: %s\n", mysqli_connect_error());
        exit();
    }
    ?>

</html>
</body>