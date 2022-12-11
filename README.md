### Bản nguyên thủy 
**[Link code tham khảo đầu tiên](https://github.com/hellomustaq/Online-Exam-with-laravel)**

### Bản tham khảo mở rộng 

**[Link tham khảo để nâng cấp chương trình](https://itsourcecode.com/free-projects/laravel/online-examination-system-project-in-laravel-with-source-code/)**


#### Cấu hình 
PHP 8.1.2

Laravel Framework 9.43.0


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
- Tạo lại dữ liệu: php artisan migrate:refresh --seed

Sửa lỗi không ghi được vào model bởi đc bảo vệ 
Trong file: AppServiceProvider.php

```
public function boot()
{
    //
    Model::unguard();
}
```

BUG: không thể lưu câu trả lời vào bảng answer
- Nguyên nhân đang sử dụng ajax ? Sử dụng để làm gì vì sử dụng laravel rồi. 