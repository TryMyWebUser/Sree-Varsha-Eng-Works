<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Document Title -->
    <title>Raes Boutique</title>

    <!-- Favicons -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="theme-color" content="#ffffff">

    <!-- Scripts -->
    <script src="assets/js/config.js"></script>
    <script src="vendors/simplebar/simplebar.min.js"></script>

    <!-- Stylesheets -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <link href="vendors/simplebar/simplebar.min.css" rel="stylesheet">
    <link href="assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl">
    <link href="assets/css/theme.min.css" rel="stylesheet" id="style-default">
    <link href="assets/css/user-rtl.min.css" rel="stylesheet" id="user-style-rtl">
    <link href="assets/css/user.min.css" rel="stylesheet" id="user-style-default">
    <link href="vendors/dropzone/dropzone.css" rel="stylesheet">
    <link href="vendors/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- RTL Handling -->
    <script>
        var isRTL = JSON.parse(localStorage.getItem("isRTL"));
        if (isRTL) {
            document.getElementById("style-default").setAttribute("disabled", true);
            document.getElementById("user-style-default").setAttribute("disabled", true);
            document.querySelector("html").setAttribute("dir", "rtl");
        } else {
            document.getElementById("style-rtl").setAttribute("disabled", true);
            document.getElementById("user-style-rtl").setAttribute("disabled", true);
        }
    </script>


    <!-- ===============================================--><!--    Stylesheets--><!-- ===============================================-->
    <link href="vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
</head>