| ![Shape1](RackMultipart20231130-1-5kws98_html_904eee65b90bad8f.gif)
 | ![](RackMultipart20231130-1-5kws98_html_bcb1f6e042b3a45.png)
 |
| --- | --- |
|
 | ![](RackMultipart20231130-1-5kws98_html_72db73613db6cad2.png) |

Система валидации

Техническое описание системы валидации 2.2

1. **Содержание**

**[1.](#_Toc124520619)****Содержание 2**

[1.1.История версий 2](#_Toc124520620)

**[2.](#_Toc124520621)****Терминология 3**

**[3.](#_Toc124520622)****Основные принципы 4**

[3.1.Архитектура 4](#_Toc124520623)

[3.2.Возможные ошибки 4](#_Toc124520624)

[3.3.Пользование системой 6](#_Toc124520625)

**[4.](#_Toc124520626)****Файловая структура 7**

**[5.](#_Toc124520627)****SimBASE API 8**

[5.1.Общие сведения 8](#_Toc124520628)

[5.2.Запрос в SimBASE 8](#_Toc124520629)

**[6.](#_Toc124520630)****Допустимые статусы 14**

**[7.](#_Toc124520631)****Установка 15**

[7.1.Файл конфигурации 15](#_Toc124520632)

  1. **История версий**

| **Версия** | **Дата** | Заметки |
| --- | --- | --- |
| 1 | 02.02.2019 | Документация по системе валидации изначальной версии 1.0. |
| 2 | 10.05.2019 | Внесены изменения в соответствии с новой версией 2.0. Проведен рефакторинг. |
| 3 | 13.01.2023 | Добавлен раздел со списком допустимых статусов электронных документов. |
| 4 | 02.05.2023 | Добавлена возможность использовать произвольную (custom)иконку статуса и цвет статуса, более подробно в разделе 6.Допустимые статусы. |

1. **Терминология**

В документе используются следующие термины и акронимы:

**API** - ApplicationProgrammingInterface (интерфейс прикладного программирования).

**XML** – ExtensibleMarkupLanguage (расширяемый язык разметки).

**JSON** – JavaScriptObjectNotation (текстовый формат обмена данными, основанный на JavaScript).

**HTML** - HyperTextMarkupLanguage (язык гипертекстовой разметки).

**QR**** -код** -двухмерный штрихкод (бар-код), предоставляющий информацию для быстрого ее распознавания с помощью камеры на мобильном телефоне.

**SimBASE**** , **** SB**- система управления бизнес-процессами.

**Валидатор** - система валидации документов.

1. **Основные принципы**

Система валидации документов позволяет быстро и легко получить данные нужного документа из системы SimBASE. Для ее использования требуется только доступ в интернет. Системой удобно пользоваться как с мобильного телефона, так и с компьютера. Система валидации корректно работает, начиная со следующих версии компьютерных браузеров: Google Chrome 5.0, Firefox 4.0, MicrosoftEdge 10.0, Safari 10.1, Opera 9.6. Так же поддерживается мультиязычность c произвольным набором языков.

  1. **Архитектура**

Валидатор написан на языке программирования PHP 7, а для упрощения процесса по улучшению/изменению кода, была выбрана модель проектирования MVC.

**MVC** (англ. "_Model-View-Controller_"; русс. _Модель-Представление-Контроллер_) — это схема разделения данных приложения, пользовательского интерфейса и управляющей логики на три отдельных компонента: _Модель, Представление_ и _Контроллер_ — таким образом, что модификация каждого компонента может осуществляться независимо друг от друга.

Каждый элемент MVC выполняет свою роль:

- _Модель_ содержит в себе данные полученные из SimBASE и весь функционал валидатора. Реагируя на команды _Контроллера_, изменяет свое состояние.
- _Представление_ отвечает за подготовку HTML страницы, которую передает _Контроллеру_ на вывод пользователю.
- _Контроллер_ обрабатывает действия пользователя, отправляя команды _Модели_ на выполнение требуемой функции, либо _Представлению_ на подготовку нужного содержимого веб-страницы.

![Shape3](RackMultipart20231130-1-5kws98_html_bf2365c79d49ec88.gif)
**Рис. 1. Внутренняя схема валидатора по шаблону MVC.**

  1. **Возможные ошибки**

В системе подготовлены две страницы ошибок:

- Ошибка _ **Документ не найден** _ показывается, когда формат номера документа введен правильно, но при поиске документ не был обнаружен в системе.

![](RackMultipart20231130-1-5kws98_html_acb25a8ba7a39aa0.png)

**Рис. 2. Страница ошибки «Документ не найден».**

- _ **Что-то пошло не так** _ — это техническая ошибка. Сюда входят ошибки, которые могут возникнуть при формировании данных документа или при отправке запроса. Более подробную информацию о запросе можно найти в разделе 5.2.

![](RackMultipart20231130-1-5kws98_html_6779d807c212e887.png)

**Рис. 3. Страница технической ошибки «Что-то пошло не так».**

  1. **Пользование системой**

Для того, чтобы открыть страницу валидатора, необходимо перейти по адресу: _https __://__ validate __.__ simourg __.__ com_.

Чтобы найти документ, необходимо ввести его номер в строке ввода и нажать на кнопку поиска, после чего откроется страница с данными документа, либо страница с ошибкой.

Поле ввода на странице поиска имеет ограничения на вводимые символы. Номер документа должен состоять из 10 символов (пример: XY190508В9). Первые 2 символа должны быть буквенными. Далее следует 6 цифр, а последние 2 символа могут содержать буквы и цифры (a-z; A-Z; 0-9). Если введенный номер не соответствует формату, то всплывет сообщение об ошибке. Сообщения отличаются в зависимости от браузера.

![](RackMultipart20231130-1-5kws98_html_acfb45c1165a93aa.png)

**Рис. 4. Страница поиска документа.**

Для возможности быстро убедиться в подлинности с помощью мобильного телефона, каждому документу присвоен QR-код, сканируя который, можно получить готовую ссылку на страницу с данными искомого документа.

![](RackMultipart20231130-1-5kws98_html_960a8b816bd6192c.png)

**Рис. 3. Схема использования валидатора с телефона.**

1. **Файловая структура**

![](RackMultipart20231130-1-5kws98_html_8d8c3e58af28300f.png)

**Рис. 4. Общая структура файлов валидатора.**

Файловая структура системы валидации устроена таким образом, чтобы изолировать данные и обеспечить внешнему пользователю всего одну точку доступа к системе через файл "_index __.__ php_". Сам файл и вся клиентская часть хранится в папке "_public_". Пользователь не имеет доступа к другим файлам за ее пределами, что является безопасным и надежным решением.

- файл "_model __.__ php_" содержит исходной код _Модели,_
- файл "_controller __.__ php_" содержит исходной код _Контроллера_,
- файл "_request __.__ xml_" содержит изначальный текст запроса к API,
- файл "_config __.__ php_" содержит параметры сайта и настройки доступа к API,
- папка "_public__/_" является публичной для пользователя, содержит клиентскую частью,
- папка "_html__/_" хранит файлы, которые содержат исходной код _Представления_,
- файл "_public __/__ index __.__ php_" входящая точка для пользователя.

1. **SimBASE API**
  1. **Общие сведения**

Основной целью SimBASEAPI является предоставление структуры интеграции сторонним разработчикам, которым необходимо обеспечить интероперабельность между SimBASE и сторонними системами.

Интерфейс прикладного программирования SimBASE строится как XML веб-API. Он включает в себя ограниченное количество функций, необходимых для выполнения обмена данными и для манипуляции процессами в системе SimBASE. Действия, которые могут быть выполнены в системе SimBASE через интерфейс API, делятся на 11 типов сообщений:

- 3000: запуск процесса,
- 3010: смена состояния объекта,
- 3020: запрос данных объектов,
- 3030: редактирование данных объектов,
- 3100: запрос данных справочников,
- 3110: добавление элементов справочника,
- 3120: редактирование данных элементов справочника,
- 3130: смена статуса элемента справочника,
- 4000: запрос метрик,
- 9000: эхо-тест,
- 9010: регистрация событий API.

API не предназначен для использования в административных целях и не обеспечивает никакой функциональности для системного администрирования или технического обслуживания системы SimBASE.

![Shape4](RackMultipart20231130-1-5kws98_html_8ee2c4c8f52ca242.gif)

**Рис. 5. Cхема взаимодействия валидатора с системной SimBASE.**

  1. **Запрос в SimBASE**

Файл содержащий в себе текст запроса называется "_request.xml_". Он находится в корневой папке валидатора. Для получения данных из SimBASE, в запросе используется тип сообщения: запрос данных объектов (3020). Данный тип сообщения позволяет искать и возвращает указанные данные информационных объектов SimBASE.

    1. **Структура запроса**

XML запрос состоит из тегов, внутри которых есть обязательные и необязательные атрибуты. В таблицах ниже описаны все используемые теги вместе с атрибутами.

Для обозначения обязательности какого-либо параметра, в таблицах имеется колонка "_М_". Если не указано иначе, символ "_М_" (англ. _mandatory_) после переменной, тэга или атрибута означает, что он является обязательным, "O" (англ. _optional_) – необязательным.

**Таблица1. Общая структура запроса**

| **Тег** | **M** | **Атрибуты** | **Описание** |
| --- | --- | --- | --- |
| sbapi | M | - | Корневой элемент. |
| --- | --- | --- | --- |
| header | M | - | Секция заголовка. |
| body | М | - | Секция тела. |

**Таблица 2. Структура заголовка запроса "_header_"**

| **Тег** | **М** | **Атрибуты** | **Описание** |
| --- | --- | --- | --- |
| interface | M | id | Уникальный идентификатор интерфейса (любой интерфейс должен быть зарегистрирован в ядре SimBASE, который генерирует свой ID). |
| --- | --- | --- | --- |
| М | version | Версия интерфейса. |
| message | M | id | Уникальный идентификатор сообщения в удаленной системе. |
| М | type | Тип сообщения. |
| М | created | Время создания сообщения. |
| error | M | id | Цифровой код ошибки (ID). |
| auth | О | pwd | Тип передачи пароля. |
| authdata | M | user | Имяпользователя SimBASE. |
| M | password | Парольпользователя SimBASE. |
| M | msg\_id | ID текущегосообщения. |
| M | msg\_type | Типтекущегосообщения. |
| M | user\_ip | IP-адрес компьютера или IP системы клиента. |

**Таблица 3. Структура тела запроса "_body_"**

| **Тег** | **М** | **Атрибуты** | **Описание** |
| --- | --- | --- | --- |
| search | - | - | Критерии выборки. Все элементы выборки будут объединены логическим И, т.е. в ответе вернутся только те объекты, которые соответствуют всем критериям выборки. |
| --- | --- | --- | --- |
| data | M | limit | Максимальное количество возвращаемых объектов. |
| О | total | Если включен, то в ответе вернется общее количество записей, которые соответствуют критериям выборки. Допустимые значения: "on" – общее количество будет возвращаться, "off" - общее количество не будет возвращаться. |
| field | M | name | Наименование поля (переменная). |
| M | operator | Тип проверки, совершаемый со значением поля и посылаемым значением. |
| O | value | Значение, которое сравнивают с полем через выбранный оператор. |

    1. **Пример запроса**

**\<?xml version="1.0" encoding="UTF-8"?\>**

**\<sbapi\>**

**\<header\>**

**\<interface id="INTERFACE\_ID\_S" version="4" /\>**

**\<message id="MSG\_ID\_S" type="3020" created="SESSION\_CREATED\_S"/\>**

**\<error id="0" /\>**

**\<auth pwd="open"\>AUTHDATA\_S\</auth\>**

**\</header\>**

**\<body\>**

**\<search\>**

**\<field name="TOKEN\_REQUEST\_FIELD\_S" operator="==" value="TOKEN\_VALUE\_S" /\>**

**\</search\>**

**\<data limit="1"\>**

**\<field name="SEACH\_FIELD\_S"/\>**

**\</data\>**

**\</body\>**

**\</sbapi\>**

Значения, помеченные красным цветом, являются временными, которые в момент подготовки запроса замещаются значениями из конфигурационного файла. Больше информации о файле конфигурации в разделе 7.1.

**Таблица4. Временные значения**

| **Значение** | **М** | **Описание** |
| --- | --- | --- |
| INTERFACE\_ID\_S | M | идентификатор интерфейса. |
| --- | --- | --- |
| MSG\_ID\_S | М | идентификатор сообщения. |
| SESSION\_CREATED\_S | M | время создания сообщения. |
| AUTHDATA\_S | М | данные аутентификации для доступа к API |
| TOKEN\_REQUEST\_FIELD\_S | М | переменная поля номера документа в SimBASE. |
| TOKEN\_VALUE\_S | M | значение поля номера документа в SimBASE. |
| SEACH\_FIELD\_S | М | переменная поля с данными документа в JSON |

Пример готового запроса:

**\<?xmlversion="1.0" encoding="UTF-8"?\>**

**\<sbapi\>**

**\<header\>**

**\<interface id="321" version="4" /\>**

**\<message id="1" type="3020" created="2019-05-07T09:00:00Z"/\>**

**\<error id="0" /\>**

**\<auth pwd="open"\>**

**\<authdata msg\_id="1" user="username" password="'12345" msg\_type="3020" user\_ip="192.168.0.1"/\>**

**\</auth\>**

**\</header\>**

**\<body\>**

**\<search\>**

**\<field name="o\_token" operator="==" value="XY12345678" /\>**

**\</search\>**

**\<data limit="1"\>**

**\<field name="o\_json"/\>**

**\</data\>**

**\</body\>**

**\</sbapi\>**

    1. **Структура ответа**

SimBASE в ответе на запрос возвращает объект JSON, который содержит структурированные данные документа.

**Таблица5. Общая структура ответа**

| **Ключ** | **Тип** | **Описание** |
| --- | --- | --- |
| SIMBASE\_SERVICE\_KEY | Текст | Сервисный ключ в системе. |
| --- | --- | --- |
| SIMBASE\_OBJECT\_NUMBER | Текст | Номер документа. |
| SIMBASE\_OBJECT\_STATUS\_CODE | Текст | Код статуса документа. |
| SIMBASE\_OBJECT\_STATUS\_IMAGE | Текст | Изображение статуса документа закодированное в BASE64.
Поле **обязательное** , если_ **SIMBASE\_OBJECT\_STATUS\_CODE** _ равно **"custom".** |
| SIMBASE\_OBJECT\_STATUS\_COLOR | Текст | Цвет наименования статуса документа в HEX формате.
Поле **обязательное** , если_ **SIMBASE\_OBJECT\_STATUS\_CODE** _ равно **"custom".** |
| VALIDATOR\_DATA | Объект | Данные документа на всех доступных зыках в виде объекта JSON. |

**Таблица 6. Структура объекта "_VALIDATOR __\___ DATA_"**

| **Ключ** | **Тип** | **Описание** |
| --- | --- | --- |
| EN | Массив | Массив JSON с данными документа на английском языке. |
| --- | --- | --- |
| RU | Массив | Массив JSON с данными документа на русском языке. |

Система не ограничена двумя языками. Количество языков редактируется в SimBASE.

**Таблица 7. Структура данных документа конкретного языка**

| **Ключ** | **Тип** | **Описание** |
| --- | --- | --- |
| SIMBASE\_OBJECT\_STATUS\_NAME | Текст | Статус документа. |
| --- | --- | --- |
| NAME | Текст | ФИО обладателя документа. |
| COURSE NAME | Текст | Название пройденного курса. |
| TRAINING PERIOD | Текст | Период обучения. |
| GRADE | Текст | Оценка за пройденный курс. |

    1. **Пример ответа**

**{**

**"simbase\_service\_key": "simbase\_validator\_data",**

**"simbase\_object\_number": "ED18122401",**

**"simbase\_object\_status\_code": "pending",**

**"simbase\_object\_status\_image": "image base64",**

**"simbase\_object\_status\_color": "#ffffff",**

**"validator\_data": {**

**"en": [**

**[**

**"simbase\_object\_status\_name",**

**"Pending"**

**],**

**[**

**"Name",**

**"Ivan Susanin"**

**],**

**[**

**"Course name",**

**"Business processes' analysis"**

**],**

**[**

**"Training period",**

**"10.12.2018 - 14.12.2018"**

**],**

**[**

**"Grade",**

**"Excellent (91-100%)"**

**]**

**],**

**"ru": [**

**[**

**"simbase\_object\_status\_name",**

**"Ожидание"**

**],**

**[**

**"Имя",**

**"Сусанин Иван Петрович"**

**],**

**[**

**"Наименование курса",**

**"Анализ бизнес-процессов"**

**],**

**[**

**"Период обучения",**

**"10.12.2018 - 14.12.2018"**

**],**

**[**

**"Уровень знаний",**

**"Отлично (91-100%)"**

**]**

**]**

**}**

**}**

1. **Допустимые статусы**

Статус нужно писать в ключе _ **simbase** __**\_**__ **object** __**\_**__ **status** __**\_**__ **code** _. Там используется точное совпадение и по указанному наименованию выбирается изображение для статуса.

**Таблица 8. Список возможных статусов электронных документов**

| **Наименование статуса** | **Изображение** | **Описание** |
| --- | --- | --- |
| valid | ![](RackMultipart20231130-1-5kws98_html_4aef6735ac76ed3f.png) | Валиданый. |
| --- | --- | --- |
| expired | ![](RackMultipart20231130-1-5kws98_html_7d420954e9594ec3.png) | Истёк срок валидности. |
| pending | ![](RackMultipart20231130-1-5kws98_html_93006eb316e178d.png) | В ожидании. |
| сancelled | ![](RackMultipart20231130-1-5kws98_html_622c01a70beba09.png) | Отменен. |
| archived | ![](RackMultipart20231130-1-5kws98_html_47b747beee3338ae.png) | Архивирован. |
| error | ![](RackMultipart20231130-1-5kws98_html_ee5c98686660a65c.png) | Ошибка. |
| custom | Произвольное изображение | Данный код указывается, когда необходимо применить произвольный стиль статуса.

- В корне JSON, в ключе _ **simbase** __**\_**__ **object** __**\_**__ **status** __**\_**__ **code** _ указывается значение « **custom** ».
- Затем обязательно необходимо добавить еще два ключа: _ **simbase\_object\_status\_color** _ и _ **simbase\_object\_status\_image** _.
- В ключе _ **simbase** __**\_**__ **object** __**\_**__ **status** __**\_**__ **color** _ укажите цвет в **hex** формате вместе с символом решетки (#).
- В ключе _ **simbase** __**\_**__ **object** __**\_**__ **status** __**\_**__ **image** _ укажите BASE64 изображения статуса. Рекомендованный размер 50х50 пикселей.
 |

1. **Установка**

Установка проходит путем копирования файлов в корневую папку веб-сервера (например: для сервера "_apache_" папка называется "_www_"). Нужно настроить сервер так, чтобы все запросы переходили только на "_index.php_", а доступ пользователю сделать только для папки "_public_". После установки нужно заменить данные для подключения к API в [файле конфигураций](#%D0%A1%D1%82%D1%80%D1%83%D0%BA%D1%82%D1%83%D1%80%D0%B0).

  1. **Файл конфигурации**

Файл конфигураций - является одним из основных файлов в корневой системе валидатора и имеет название "_config.php_". Он содержит в себе основные параметры для настройки валидатора.

**Таблица 9. Структура файла конфигураций**

| **Переменная (параметр)** | **Описание** |
| --- | --- |
| $api\_url | API для подачи запроса. |
| --- | --- |
| $api\_usr | Имя пользователя для доступа к API. |
| $api\_pwd | Пароль пользователя для доступа к API. |
| $api\_interface\_id | Идентификатор API интерфейса в системе. |
| $token\_req\_field | Переменная поля с номером документа в системе. |
| $search\_field | Переменная поля с данными документа в системе. |
| $title | Заголовок страницы. |

| ![Shape2](RackMultipart20231130-1-5kws98_html_9e521247907eecea.gif)№ XY11223344
 | Май, 2023 |
| --- | --- |
|
 |
© 2003-2023 Simourg Limited. All rights reserved. This document is the property of Simourg Limited. Unless otherwise specified, no part of this document may be reproduced or utilized in any form or by any means, without prior written consent of Simourg Limited. |

![](RackMultipart20231130-1-5kws98_html_fd627046cc551715.png)