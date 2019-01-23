<div class="col-md-4 col-sm-12 testnav" id="navb">
    <div class="text-center"><img src="images/sun.png" width="250px" style="height: auto; padding-top: 15px"
                                  class="img-fluid" alt="Responsive image"></div>


    <div class="row">

        <div class="col text-center">


            <a href="?page=start" id="startbtn" name="start" class="col btn btn-group-lg button-1">ST​ART</a>


        </div>

    </div>


    <?php if (isset($_SESSION['logged_in'])): ?>
        <div class="row">
            <div class="col text-center">
                <a href="?page=berichtsheft" id="berichtsheftbtn" class="col btn btn-group-lg button-3">BERICHTSHEFT</a>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <a href="?page=settings" id="settingsbtn" class="col btn btn-group-lg button-3">EINSTELLUNGEN</a>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <a href="?page=logout" id="logoutbutton" name="logoutbutton" class="col btn btn-group-lg button-2">LOGOUT</a>
            </div>
        </div>

    <?php else: ?>
        <div class="row">
            <div class="col text-center">
                <a href="?page=login" id="loginbtn" class="col btn btn-group-lg button-2">L​​​​OGIN</a>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <a href="?page=registrieren" id="registerbtn" class="col btn btn-group-lg button-3">REGISTRIEREN</a>
            </div>
        </div>
    <?php endif; ?>




    <div class="row">

        <div class="col text-center">

            <a href="?page=impressum" id="impressumbtn" class="col btn btn-group-lg button-4">IMPRESSUM</a>


        </div>


    </div>


    <div class="row">

        <div class="col text-center">

            <a href="?page=datenschutz" id="datenschutzbtn" class="col btn btn-group-lg button-5">DATENSCHUTZ</a>


        </div>


    </div>


</div>