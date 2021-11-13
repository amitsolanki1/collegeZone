<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>books</title>
    <link rel="stylesheet" href="bootstrap.css" type="text/css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="csslogin.css">
</head>
<style>
    .navbar#navbar.active {
        filter: blur(5px);
        pointer-events: none;
        user-select: none;
    }

    #theme.active {
        filter: blur(5px);
        pointer-events: none;
        user-select: none;
    }

    #btn {
        position: absolute;
        /* top: -9rem; */
        font-size: 25px;
        right: 2rem;
        float: right;
        height: 45px;
        width: 90px;
        border-radius: 50%;
        border: 1px inset yellow;

    }
</style>

<body>
    <div id="navbar" class="navbar navbar-expand navbar-dark bg-dark">
        <div class="collapse navbar-collapse  " id="navbarSupportedContent">
            <ul class="navbar-nav ">
                <li class="nav-item active">
                    <a href="" class="nav-link nav-tabs">Home</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#" tabindex="-1" aria-disabled="true">Contact
                    </a>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link btn " id="loginbtn">Login</button>
                </li>
                <li class="nav-item">
                    <button id="btn" type="button" class="bg-dark text-white" onclick="post()">Post</button>
                </li>
            </ul>

        </div>
    </div>
    <div id="theme">
        <h1>Books</h1>
        <div class="video ">
            <div class="overlay"></div>
            <video autoplay muted>
                <source src="1.mp4" type="video/mp4" />
            </video>
        </div>


    </div>

<div class="content">
    <h1>heelo</h1>
</div>

    <div class="modal fadeOut " id="mymodal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h3 class="text-primary">Login </h3>
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                </div>
                <form action="post">
                    <div class="modal-body">
                        <form action="">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label><i>fa fa emnmail</i>Email:</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control">
                            </div>
                            <div>
                            
                                <button type="button" class="btn btn1 btn-secondary" data-dismiss="modal">login</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>


    <h4 id="demo"></h4>
    <script src="jquery.js"></script>
    <script src="modal.js"></script>
    <script src="js.js"></script>
</body>
<script>
    function post() {
        window.location = "post1.php";
    }
</script>

</html>