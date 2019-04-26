<nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Document Management Systems (DMS)</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="?p=home">Shared File</a></li>
                    <li class="active"><a href="?p=uploadfile">Upload File</a></li>
                    <li>
                        <a href="?p=folder">
                            <?php
                            if (isset($fetchDataUserBySesion)) {
                                echo ucfirst($fetchDataUserBySesion['nama']);
                            }
                            ?> File
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="?p=notif">Notification <i class="material-icons"><b id="datas" style="color:red">0</b></i></a></li>

                    <li class="dropdown ">                     
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Account <span class="caret"></span></a>
                        
                        <ul class="dropdown-menu">
                            <li><a href="?p=Repass">Change Password</a></li>
                            
                            <?php
                            if (isset($fetchDataUserBySesion['departemen'])) {
                                if ($fetchDataUserBySesion['departemen'] == 2) {
                                    echo '<li><a href="?p=staff">Data Staff</a></li>';
                                }
                            }
                            ?>

                        </ul>
                    </li>
                    <li><a href="?p=out"><span class="glyphicon glyphicon-log-in"></span>  Sign Out</a></li>
                </ul>
            </div>
        </div>
    </nav> 