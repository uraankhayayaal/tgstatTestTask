Здесь [common/modules/shortlink/controllers/ShortlinkController.phpL48](common/modules/shortlink/controllers/ShortlinkController.phpL48) будем собирать логи.

Создается таблица `link_stats` в БД с полями: 
- hash: CHAR(5)
- date: DATE()
- count: BIGINT()

С первичным ключом: 
- PRIMARY KEY(hash, date)


Чтобы часто к базе не обращаться используем кэш (Redis)
Каждый раз когда перешли по ссылке увеличиваем значение с помощью `incrby`. (если хэша еще нет, поставится 0 по дефолту перед инкрементом).
Было бы классно если incrby мог создавать записи с expiredat 00:00, но мы можем каждую полночь удалять хэши. (новый день с новых значений).


Создаем Job, который каждую минуту берет значения из кэша и записывает в БД, используем команду:
```sql
INSERT INTO link_stats (hash, date, count) VALUES
    ('HSgf3', '2024-12-04', 22),
    ('uuuu4', '2024-12-04', 22),
    ('ddddd', '2024-12-04', 22),
    ....
ON DUPLICATE KEY UPDATE count = VALUES(count);
```
Если в бд уже есть такая запись, мы просто перезаписываем его.


А пользователям показываем:
- общее количество переходов: `SELECT sum(count) FROM link_stats WHERE hash = 'uuuu4' GROUP BY hash`
- по дням: `SELECT count FROM link_stats WHERE hash = 'uuuu4' and date = '2024-12-04'`

