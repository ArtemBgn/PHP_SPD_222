<pre>
PHP
Hypertext Preprocessor
Мова програмування початково призначена для покращення можливостей
HTML (змінні, інструкції, вирази, файли/шаблони)
На сьогодні повноцінна мова програмування, яка частіше за все
використовується для задач back-end[у].

За приблизною аналогією з JS, PHP має подвійне розуміння
- частина (модуль) веб-сервера, яка продовжує оброблення запитів
- самостійний продукт виконання программ

Для встановлення краще за все використати збірку (налаштовані
між собоою веб-сервер, PHP, СУБД та інше). Таким
є ХАМРР, OpenServer, Danver, ...

    |   |   |   |   |   |   |   |   |   сайт 1 (index.php)
веб-запит --> [Apache(веб-сервер)] < ....
    |   |   |   |   |   |   |   |   |   сайт N (index.php)
веб-сервер приймає запит, розбирає його (виділяє метод, заголовки,
передані форми, файли тощо) та запускає PHP файл у запитаному сайті.

Те, що виводить PHP передається сервером, як відповідь на запит.
!! Виведення PHP потряпляє не на "екран", а в тіло HTML.

Тип мови - інтерпритатор (REPL);
покоління - 4GL;
парадигма - процедурна (з підтримкою ООП).
==========================================

Для зручності роботи з кількома проектами (сайтами) бажано налаштувати
локальний хостінг.
- папка з конфігурацією сервера
- відкриваємо у редакторі C:\xampp\apache\conf\extra
- за зразком, наведеним у конфігурації, створюємо запис для нашого сайту
- 
- C:/Windows/System32/drivers/etc
</pre>