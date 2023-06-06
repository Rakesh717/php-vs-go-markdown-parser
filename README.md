Inspired by [this article](https://ryangjchandler.co.uk/posts/blazingly-fast-markdown-parsing-in-php-using-ffi-and-rust), I decided to conduct a benchmark comparing a Markdown parser written in PHP with one written in Go (using php FFI).

| Iterations | league/commonmark  | GO + github.com/yuin/goldmark |
|------------|--------------------|-------------------------------|
| 1          | 0.011753082275391  | 0.00055909156799316           |
| 1000       | 0.5683534145355223 | 0.03398084640502928           |
| 10000      | 5.522041320800781  | 0.29221653938293457           |
| 50000      | 27.79768991470337  | 1.4332077503204346            |

### How to run the test 
If you have go installed in your machine then you can run this to build the go code (optional)
```
go build -C go -mod=mod -buildmode=c-shared -o main.so main.go 
```
Then run this (make sure you have php and composer installed in your machine).
```
composer install && php index.php
```
