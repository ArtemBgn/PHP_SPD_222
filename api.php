<h1>API та бекенд</h1>
<div class="card-panel red">
    <button class="btn" onclick="getClick()">CREATE</button>
    <button class="btn indigo" onclick="postClick()">POST</button>
    <div id="api-result"></div>
</div>
<h1>Робота з БД</h1>
<p>
    Підготовчі роботи.<br/>
    Встановлюємо СУБД (MySQL/MariaDB).<br/>
    Створюємо окрему базу даних проєкту, користувача для неї.<br/>
    <code>CREATE DATABASE php_spd_111;</code><br/>
    <code>CREATE USER 'spd_111_user'@'localhost' IDENTIFIED BY 'spd_pass';</code><br/>
    Даемо права доступу<br/>
    <code>GRANT ALL PRIVILEGES ON php_spd_111.* TO 'spd_111_user'@'localhost';</code><br/>
    Оновлюємо таблицю доступу <br/>
    <code>FLUSH PRIVILEGES;</code>
</p>
<p>
    Підключення.<br/>
    Є дві групи технологій роботи з БД:<br/>
    <code>"індивідуальні"</code> - набори команд під кожну БД окремо;<br/>
    <code>"універсальна"</code> - технологія PDO (аналог ADO у .NET).
    Далі розглядаємо PDO.
</p>

<script>
    function getClick() {
        fetch("/test")
        .then(r=>r.text())
        .then(t=>{
            document.getElementById("api-result").innerText = t;
        })
    }
    function postClick() {
        fetch("/test", {method: 'POST'})
        .then(r=>r.text())
        .then(t=>{
            document.getElementById("api-result").innerText = t;
        })
    }
</script>
<div></div>
<div></div>
<div></div>
<code></code>
<code></code>
<code></code>
<code></code>
<code></code>
<p></p>
<p></p>
<p></p>
<p></p>
<p></p>
<ul>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
</ul>