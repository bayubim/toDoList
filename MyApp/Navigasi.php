<?php
namespace MyApp;

class Navigasi{
    public static function render() {
?>
<nav class="sidebar">
    <ul>
        <li class="logo ms-5"><img src="img/logo.png"></li>
        <li><a href="listAktivitas.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="formAktivitas.php"><i class="fas fa-plus-circle"></i> Add Activity</a></li>
    </ul>
    <a onClick="return confirmLogout()"><button class="btn btn-three">Log Out</button> </a>
</nav>

<?php
    }
}