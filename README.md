# login
login all TFcis websites with one account

##install
1. configure database setting in `config/config.php` (see `config/defualt_config.php` for example)
2. Download Facebook PHP SDK 4.0.23 at https://github.com/facebook/facebook-php-sdk-v4/releases  
  `wget https://github.com/facebook/facebook-php-sdk-v4/archive/4.0.23.zip -O facebook-php-sdk-v4.zip`
  `unzip facebook-php-sdk-v4.zip && rm facebook-php-sdk-v4.zip`
3. configure Facebook App setting in `config/config.php`
4. run `install/install.php` in terminal  
  `cd install/`  
  `php install.php`  
