1. Для начала создадим консольную команду, назовем ее CheckMemory. В laravel консольная команда создается другой консольной командой - php artisan make:command ИмяКоманды. Итак, создаем:

```bash
php artisan make:command CheckMemory
```

После этого в папке app/Console создалась директория Commands и в ней появился наш класс CheckMemory. В этом классе есть два защищенных свойства signature и description (т.е. как выглядит сама команда и ее описание соответственно) а также метод handle() который будет вызван при запуске команды. При этом свойству signature мы можем задать не только название, но и передать какой-то аргумент (в фгурных скобках через пробел после команды). Количество аргументов может быть любым. Разновидностью аргумента является опция, записывается также в фигурных скобках, но с двоиным дефисом перед названием. Кроме того, через конструктор класса мы можем внедрять нужные нам зависимости.

Присваиваем свойства и пишем реализацию для метода. Наша команда будет называться memory:check После регистрируем нашу консольную команду. Регистрация происходит в классе App\Console\Kernel в защищенном свойстве commands, который первоначально имеет значение пустой массив. Именно в этот массив нужно добавить наш класс. Что мы и делаем - CheckMemory::class.
Измерения буду проводить на версии php 7.2.1. Информация об измерениях будет записываться в лог - файл storage/logs/checkmem.log. Для логирования будем использовать штатное средство laravel  класс Monolog\Logger.
Таким образом, наш лог выдал следующую информацию:

```log
[2018-01-08 10:26:05] Checking Memory.INFO: report ["total memory on 1 million items 33558528 bytes","result of one integer set is 33.558528bytes"] []
```

2. Минимальная версия php с которой "согласился" работать laravel это 7.0. Поэтому протестировать работу более ранних версиях не получится. Надо было выбирать Yii.

3. 