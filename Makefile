up:	do own nginxpermission chmod 


do:
	docker exec own_framework_php-fpm_1 $(COM)

own:
	docker exec own_framework_php-fpm_1 chown 1000:1000 -R ./

nginxpermission:
	docker exec own_framework_php-fpm_1 chown 1000:1000 -R ./

chmod:
	chmod 777 -R ./


