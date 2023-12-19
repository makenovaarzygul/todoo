Техническое задание по методам быстрой разработки
1. Название проекта: Задачник (To-Do List)
2. Функциональные требования
2.1. Регистрация и аутентификация:
Пользователи могут зарегистрировать новый аккаунт, указав имя пользователя, адрес электронной почты и пароль.
Зарегистрированные пользователи могут войти в систему с использованием своих учетных данных.
2.2. Главный интерфейс:
После входа в систему пользователи видят список своих задач.
2.3. Задачи:
Пользователи могут создавать новые задачи, указывая название, описание, срок выполнения, метки и приоритет.
Задачи должны быть отсортированы по сроку выполнения и приоритету.
Пользователи могут редактировать существующие задачи, включая изменение названия, описания, срока выполнения, меток и приоритета.
Пользователи могут отмечать задачи как выполненные.
Пользователи могут удалять задачи.
2.4. Метки (Теги):
Пользователи могут создавать и управлять метками.
Каждая задача может иметь несколько меток.
2.5. Приоритеты:
Пользователи могут устанавливать приоритет для каждой задачи (например, высокий, средний, низкий).
2.6. Фильтрация и сортировка задач:
Пользователи могут фильтровать задачи по меткам и приоритетам.
Должна быть возможность сортировки задач по различным критериям, таким как срок выполнения и приоритет.
2.7. Интеграция с календарем 
2.8. Уведомление: Пользователю на почту приходит сообщение на почту в начале дня
   1)в течении 10 минут до начала всех задач
3. Технические требования
3.1. Фреймворк и язык программирования:
Проект будет разработан с использованием фреймворка Laravel.
Язык программирования - PHP.
3.2. База данных:
Использовать СУБД MySQL для хранения данных о пользователях, задачах, метках и приоритетах.
3.3. Фронтенд:
Использовать HTML, CSS и JavaScript для создания пользовательского интерфейса.
3.4. Аутентификация и авторизация:
Использовать встроенную систему аутентификации Laravel для пользователей.
Доступ к функциональности редактирования и удаления задач должен быть ограничен только для авторизованных пользователей.

ДЛЯ ОТПРАВКИ СООБЩЕНИЙ НА ПОЧТУ ИСПОЛЬЗОВАН СЕРВИС "MAILTRAP" — сервис безопасного тестирования писем. 
Mailtrap - это платформа доставки электронной почты, обеспечивающая безопасную среду для тестирования писем перед их отправкой реальным получателям.
ВНИЗУ ФОТО : я зарегистрирована по своей почте и через сервис в течении 10 минут на почту поступает сообщение о задаче. Для запуска этого сервиса надо на консоли ввести команду - php artisan schedule:work
![image](https://github.com/makenovaarzygul/todoo/assets/111987442/93022832-7d41-4726-aa31-e8aef562ce8e)

Ниже представлена картина главной страницы созданных дел
![image](https://github.com/makenovaarzygul/todoo/assets/111987442/9e16c3cf-ba76-4b01-8eb9-5fec1a2ef969)

Нажав на кнопку "Редактировать" можно отредактировать задачу и так же при нажатии на кнопку удалить задача удалится. Также можно менять приоритеты в 1-2-3. И устанавливать статус выполнен-не закончен-отменен.
![image](https://github.com/makenovaarzygul/todoo/assets/111987442/c7aeebe5-661f-4d62-a2ae-d9657dba9d8b)

К примеру создадим задачу "Сделать МБР" 
![image](https://github.com/makenovaarzygul/todoo/assets/111987442/98001b82-d908-4b42-8203-e05779023966)
Задача успешно создалась на главной странице ![image](https://github.com/makenovaarzygul/todoo/assets/111987442/a180dbf7-f40e-4d35-91ba-2476040c79c0)

Также нажав на раздел КАЛЕНДАРЬ можно фильтровать по МЕСЯЦ-НЕДЕЛЯ-ДЕНЬ-СПИСОК НА НЕДЕЛЮ. НИЖЕ представлена картинка задач на неделю
![image](https://github.com/makenovaarzygul/todoo/assets/111987442/a85a3cb8-2483-4c59-b691-b4e310dd2584)


РУКОВОДСТВО ПРОГРАММИСТА
шаг 1. Composer install
шаг 2. Composer update
шаг 3. Создать бд todo_app
шаг 4. Php artisan migrate
шаг 5. Php artisan serve
шаг 6. php artisan schedule:work

