
# Project cuối kì môn thực hành lập trình Web

## **[Link database design](https://dbdiagram.io/d/638a088dbae3ed7c45445a4c)**


### Cấu hình yêu cầu
#### Đây là cấu hình tại máy của tôi (Kỳ)
- npm: 8.19.3 (npm -v)
- node: 19.1.0 (node -v)
- PHP: 8.1.2 (php -v)
- Laravel Framework 9.47.0
<!-- - Composer version 2.4.4 (composer -V) -->
## Database
- Hiện đang config sqlite (chuyển đổi kiểu rất dễ)
### Cách config
1. Đổi mysql thành mysql trong file config > database.php 
2. Trong file .env bỏ config liên quan tới mysql thay bằng
```
DB_CONNECTION=sqlite
DB_DATABASE=/home/ky/PHP/final_project/database/db.sqlite
<!--Đổi lại bằng địa chỉ cục bộ máy của bạn YourLocation/database/db.sqlite 
có thể lấy bằng gõ pwd ở terminal -->
```
3. Khởi tạo dabase mẫu
```
php artisan migrate
```
## Các công nghệ sử dụng, họă đã cài đặt mặc định
- Laravel
- React
- breeze (của laravel -> tạo form login logout đơn giản + chỉnh sửa profile)
- Tailwindcss (Để thay cho css thuần - mặc định khi cài Breeze)
- axios 
- inertiajs (Để có thể sử dụng react + laravel)
- Vite (để build front end nhanh tiện - không cần quan tâm)

## Cài đặt lần đầu khi clone về
```
cd Programing
cp .env.example .env
npm i
<!-- Cài đặt các dependence -->
composer install
<!-- Tạo các bảng các dữ liệu mẫu nếu có -->
php artisan migrate:fresh --seed
<!-- Run server + run FE -->
npm run dev
php artisan serve
```
### Nếu lỗi về config database:
B1. Xóa file db.sqlite
B2. Chạy lại
```
php artisan migrate:fresh --seed
```

### Sửa lỗi không ghi được vào model bởi được bảo vệ 
Trong file: AppServiceProvider.php

```
public function boot()
{
    //
    Model::unguard();
}
```
## Tổng quan
### 1. Có 2 view
- Giáo viên
- Học sinh
### 2. Tính năng của giáo viên
- Thêm bài thi
- Xem danh sách các bài thi đã làm của học sinh
- Xem danh sách các bài thi đã tạo
- Sửa bài thi (Để đơn giản không cho phép sửa bài thi sau khi có học sinh đã làm, Nếu không khi sửa truy vấn ngược lại để chấm lại điểm rất lằng nhằng)
- Tạo khóa học public và tạo khóa học private
- Chat ở các forum

### 3. Tính năng của học sinh
- Xem tất cả bài thi đã đăng kí khóa học
- Làm bài thi
- Xem các bài thi và kết quả
- Đăng ký khóa học public và private
- Chat forum ở các khóa học (khóa đã đăng ký hoặc khóa public - không cần đăng ký)
## 4. Cập nhật
- thêm thời gian hoàn thành bài thi của học sinh trong bảng result
- Chưa bảo vệ các route. Cụ thể đang đăng nhập student account nhưng truy vấn trực tiếp tới route của teacher bằng url cũng được
- Chưa có bảo vệ luồng khi đang kiểm tra back trở lại cũng ok -> sai logic

### BUG
- Note1
### Cần hoàn thiện
- Tạo khóa học private // Đã xong
- Tạo forum chat // đã xong tạo ở các khóa học, hiện tại giáo viên chưa được chat ở forum chỉ học sinh được chat

### Phân quyền dễ nhất
https://viblo.asia/p/huong-dan-phan-quyen-trong-laravel-bWrZnEQmKxw
### phân quyền sâu hơn
- https://www.honeybadger.io/blog/user-roles-permissions-in-laravel/
- https://viblo.asia/p/laravel-8-tao-roles-va-permissions-khong-su-dung-package-maGK761b5j2#_buoc-9-tao-du-lieu-de-test-8



#### Tham khảo
- [database design](https://www.inettutor.com/diagrams/exam-management-system-database-design/) 
- **[Link code tham khảo đầu tiên](https://github.com/hellomustaq/Online-Exam-with-laravel)**
- **[Link tham khảo để nâng cấp chương trình](https://www.campcodes.com/projects/php/online-examination-system-with-timer-using-php-mysql-free-download/)**
