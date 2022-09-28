FROM mysql:8
#Ядром СУБД MySQL. Принимает подключения из клиентских программ, выполняя запросы и возвращая результаты
RUN echo "[mysqld]" >> /etc/mysql/my.cnf
# Плагин аутентификации по умолчанию
RUN echo "default-authentication-plugin=mysql_native_password" >> /etc/mysql/my.cnf
