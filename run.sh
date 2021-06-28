#!/bin/bash

/etc/init.d/apache2 start
a2enmod rewrite
service apache2 restart
/etc/init.d/mysql start

echo "create database wordpress_db; CREATE USER 'wordpress_admin'@'localhost' IDENTIFIED BY 'Qpf4qvnTRrz3dgIKafpfmo94Uoj1Hf7fK5AsyO0ITq'; GRANT ALL ON wordpress_db.* TO 'wordpress_admin'@'localhost';" | mysql -uroot
echo "start db import"
mysql -uroot --password='' wordpress_db < /var/dump_db
echo "end db import"
echo "USE wordpress_db; UPDATE wp_options SET option_value = 'http://localhost' WHERE option_name='siteurl' OR option_name='home';" | mysql -uroot
echo "init ok"
tail -f /dev/null
