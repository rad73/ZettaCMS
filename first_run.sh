find ./ -type d -exec chmod 0755 {} \;
find ./ -type f -exec chmod 0644 {} \;
chmod 0777 ./Configs/site.ini
chmod 0777 ./database
chmod 0777 ./Temp
chmod 0777 ./Temp/Analytics
chmod 0777 ./Temp/Cache
chmod 0777 ./Temp/Captcha
chmod 0777 ./Temp/Log
chmod 0777 ./Temp/Search
chmod 0777 ./Temp/Session
chmod -R 0777 ./UserFiles
find ./ -name ".htaccess" -exec chmod 0644 {} \;