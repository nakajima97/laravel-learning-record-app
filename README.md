# script
以下のスクリプトを登録している  
- `composer analyse`
  - larastanを走らせる
- `compser fixer`
  - php-cs-fixerを走らせる

# git cloneあとにやること
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

```
sail npm i
```
