## TỔng quan
1. Có 2 view 
- Giáo viên
- Học sinh
2. Tính năng của giáo viên
- Thêm bài thi 
- Xem danh sách các bài thi đã làm của học sinh
- Xem danh sách các bài thi đã tạo
- Sửa bài thi (Để đơn giản không cho phép sửa bài thi sau khi có học sinh đã làm, Nếu không khi sửa truy vấn ngược lại để chấm lại điểm rất lằng nhằng)
3. Tính năng của học sinh
- Làm bài thi
- Xem các bài thi và kết quả
### 4. Các view
    - Landing page = login page (nếu chưa đăng nhập) - Đã xong
    // login, register, edit profile dùng của laravel 
    ##### 1. Giáo viên
    - Trang xem các đề thi của mình
    - Trang xem các đề thi (Có bộ lọc)
    - Trang chỉnh sửa đê thi (đã có - cần chỉnh cho đẹp hơn)
    - Trang chỉnh sửa 1 câu (đã có) - Cái này có thể vứt di nhưng cần thiết kế phù hợp
    - Home page (Thiết kế tùy sáng tạo)
    ##### 2. Học sinh
    - Home page
    - Trang xem các đề thi (Có bộ lọc)
    - Trang làm bài thi (Đã có - chỉnh sửa cho đẹp hơn)
    - Trang xem kết quả sau khi thi xong
    - Trang xem tất cả các bài thi mình đã làm (có nút bấm -> trang xem kết quả 1 bài == trang xem kết quả sau thi xong)

### Thắc mắc
- Uniqueid dùng để làm gì 
- tại sao khi tạo exam trong đường dẫn /examinfo/create -> ấn submit -> gửi đến controller route(examinfo.store) -> gửi tới view(makequestion.create). Đáng lẽ URL = makequestion/create tại sao lại hiển thị examinfo 
- Làm bài test là view(answer.show) 
### 
exam code: JWU7r, 5619y, 6DNYy
### BUG 
- Sửa lại phần edit exam, ở view(makequestion.edit)
- Nếu exam có 0 question -> lỗi ở $questions = $_POST['question']; bên controller 