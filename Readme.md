index.php - это скрипт, который берёт данные с предложенных файлов, и загружает их в бд, а также выводит информацию о количестве записей и коментариев  
comments.json, posts.json - скачанные файлы  
search.php - поисковая строка для поиска данных из бд в соответствии с ТЗ.  
ПРИМЕЧАНИЕ!!! Сначала файл search.php нужно отключить или убрать из директории, чтобы загрузить данные в бд, затем наоборот, нужно будет отключить файл 
index.php или убрать его из директории и подключить search.php.
Также напомню про подключение базы данных: $connect = pg_connect('host=localhost port=5432 dbname=inlinedatabase user=postgres password=...'); 
здесь нужно заполнять свои параметры