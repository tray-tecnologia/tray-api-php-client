## PHPMD
./vendor/bin/phpmd src/ text cleancode,codesize
./vendor/bin/phpmd tests/ text cleancode,codesize

## PHPSTAN
./vendor/bin/phpstan analyse -l 7 -c phpstan.neon src/
./vendor/bin/phpstan analyse -l 7 -c phpstan.neon tests/

## CODESNIFFER
./vendor/bin/phpcs src/ tests/ --extensions=php --standard=PSR12

## GRUMPHP
./vendor/bin/grumphp run
