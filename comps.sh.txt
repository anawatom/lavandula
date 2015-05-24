mkdir yii2_issue_1165
cd yii2_issue_1165

wget https://github.com/yiisoft/yii2/archive/master.zip -O yii2.zip
unzip yii2.zip
mv yii2-master yii2
rm yii2.zip

cd yii2/apps
chmod -R g+w basic # Fix rights, may be irrelevant
cd basic
wget https://getcomposer.org/installer -O - | php
php composer.phar install --prefer-dist