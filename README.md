#### Cấu hình 
PHP 8.1.2

### **[Link database design](638a088dbae3ed7c45445a4c)**

Laravel Framework 9.43.0

### Các thư viện sử dụng
- Tailswind cho design 

Các file cần sửa 
- web.php
- /resources/views
- /controllers


// thư mục lang ở ngoài và cách sử dụng nó nhwu thế nào

1. confix sqlite
- chỉnh trong config folder -> sqlite
- Thêm db.sqlite trong database folder
- Thêm
    DB_CONNECTION=sqlite
    DB_DATABASE=/home/ky/PHP/final_project/database/db.sqlite
    DB_FOREIGN_KEYS=true
- Tạo lại dữ liệu:
```
php artisan migrate:refresh --seed
```
### Nếu lỗi:
- Xóa file db.sqlite

Sửa lỗi không ghi được vào model bởi đc bảo vệ 
Trong file: AppServiceProvider.php

```
public function boot()
{
    //
    Model::unguard();
}
```

#### Tham khảo
- [database design](https://www.inettutor.com/diagrams/exam-management-system-database-design/) 
- **[Link code tham khảo đầu tiên](https://github.com/hellomustaq/Online-Exam-with-laravel)**
- **[Link tham khảo để nâng cấp chương trình](https://www.campcodes.com/projects/php/online-examination-system-with-timer-using-php-mysql-free-download/)**
