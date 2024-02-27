<h1>ОСОБИСТИЙ КАБИНЕТ <b><?= var_export($user[2], true)?></b></h1>
<p>
    Кабінет користувача <span><?= var_export($user[2], true) ?></span>
</p>
<div class="row" style="background-color: navy;">
    <div class="col s12 m7">
        <div class="card">
            <div class="card-image"><?php echo "<img src='/avatars/{$user[4]}'/>" ?></div>
        </div>
    </div>
    <div class="col s12 m5" >
        <ul>
            <li><span>Name: </span><span contenteditable="true"><?php echo "<span>$user[2]</span>" ?></span></li>
            <li><span>Email: </span><span contenteditable="true"><?php echo "<span>$user[1]</span>" ?></span></li>
            <li><span>Name2: </span><span><?php echo "<input name='profile-name' value='$user[2]'/>" ?></span></li>
            <li><span>Email2: </span><span><?php echo "<input name='profile-email' value='$user[1]'/>" ?></span></li>
        </ul>
        <button id="profile-save-button" type="button">Зберігти</button>
        <button id="profile-exit-button" type="button">ВИХІД</button>
        <button id="profile-delete-button" type="button">Видалення профілю</button>
    </div>
</div>