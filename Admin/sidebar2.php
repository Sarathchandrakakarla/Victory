<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Victory/link.php';
$menu_query = mysqli_query($link, "SELECT Menu_Id, Display_Name, Parent_Flag, Par_Menu_Id, Route, Icon, Menu_Type, Sequence_Id FROM menus WHERE Active_Flag = 1 AND Login_Type = 'Admin' ORDER BY (CASE WHEN Parent_Flag = 1 THEN Sequence_Id ELSE 999999 END), Par_Menu_Id, FIELD(Menu_Type, 'Entry', 'View'), Sequence_Id");
$parents = [];
$children = [];
while ($menu_row = mysqli_fetch_assoc($menu_query)) {
    $id = (int)$menu_row['Menu_Id'];
    if ((int)$menu_row['Parent_Flag'] === 1) {
        $parents[$id] = $menu_row;
    } else {
        $parId = $menu_row['Par_Menu_Id'] !== null ? (int)$menu_row['Par_Menu_Id'] : 0;
        if (!isset($children[$parId])) $children[$parId] = [];
        $children[$parId][] = $menu_row;
    }
}
?>
<nav>
    <div class="logo">
        <img src="/Victory/Images/Victory Logo.png" alt="..." width="70px">
    </div>
    <div class="heading">
        <h3>Victory Schools, Kodur</h3>
    </div>
    <input type="checkbox" id="click" />
    <label for="click" class="menu-btn">
        <i class="fas fa-bars"></i>
    </label>
    <ul>
        <li>
            <img src="/Victory/Images/<?php echo $_SESSION['Admin_Id_No']; ?>.jpg" alt="Admin Image">
        </li>
        <li>
            <a href="#"><?php echo $_SESSION['Admin_Id_No'];
                        if ($_SESSION['Role'] == "Admin") {
                            echo "(Administrator)";
                        } else {
                            echo "(Super Admin)";
                        } ?></a>
            <ul class="login-sub-menu sub-menu">
                <li>
                    <p style="color: #f2f2f2;">Upload New Photo</p>
                    <input type='file' id="getFile" name="img" accept=".png,.jpg,.jpeg" onchange="saveImg()">
                </li>
                <li><a href="/Victory/php/logout.php">Sign Out</a></li>
            </ul>
        </li>
        <li id="sign-out"><a href="/Victory/php/logout.php">Sign Out</a></li>
    </ul>
</nav>
<div class="sidebar close">
    <div class="logo-details">
        <i class="bx bx-menu"></i>
        <span class="logo_name">Administrator</span>
    </div>
    <ul class="nav-links">
        <?php foreach ($parents as $parent):
            $pid   = (int)$parent['Menu_Id'];
            $pname = htmlspecialchars($parent['Display_Name'], ENT_QUOTES, 'UTF-8');
            $proute = htmlspecialchars($parent['Route'] ?? '#', ENT_QUOTES, 'UTF-8');
            $picon  = htmlspecialchars($parent['Icon'] ?? 'question', ENT_QUOTES, 'UTF-8');
            $hasSub = !empty($children[$pid]);
        ?>
            <li>
                <div class="iocn-link">
                    <a href="<?= $proute ?>">
                        <i class="bx bx-<?= $picon ?>"></i>
                        <span class="link_name"><?= $pname ?></span>
                    </a>
                    <?php if ($hasSub): ?>
                        <i class="bx bxs-chevron-down arrow"></i>
                    <?php endif; ?>
                </div>

                <?php if ($hasSub):
                    // split children into Entry and View (DB ordering preserved)
                    $entries = [];
                    $views   = [];
                    foreach ($children[$pid] as $c) {
                        if (isset($c['Menu_Type']) && strcasecmp($c['Menu_Type'], 'View') === 0) {
                            $views[] = $c;
                        } else {
                            $entries[] = $c;
                        }
                    }
                ?>
                    <ul class="sub-menu">
                        <li>
                            <a class="link_name" href="#"><label><?= $pname ?></label></a>
                        </li>

                        <?php foreach ($entries as $e):
                            $eroute = htmlspecialchars($e['Route'] ?? '#', ENT_QUOTES, 'UTF-8');
                            $ename  = htmlspecialchars($e['Display_Name'] ?? '', ENT_QUOTES, 'UTF-8');
                        ?>
                            <li><a href="<?= $eroute ?>"><?= $ename ?></a></li>
                        <?php endforeach; ?>

                        <?php if (!empty($views)): ?>
                            <li>
                                <a class="link_name" href="#" id="view"><label>View</label></a>
                            </li>
                            <?php foreach ($views as $v):
                                $vroute = htmlspecialchars($v['Route'] ?? '#', ENT_QUOTES, 'UTF-8');
                                $vname  = htmlspecialchars($v['Display_Name'] ?? '', ENT_QUOTES, 'UTF-8');
                            ?>
                                <li><a href="<?= $vroute ?>"><?= $vname ?></a></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<script src="/Victory/js/script.js"></script>