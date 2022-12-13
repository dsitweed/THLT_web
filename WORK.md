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
### Thắc mắc
- Uniqueid dùng để làm gì 
- tại sao khi tạo exam trong đường dẫn /examinfo/create -> ấn submit -> gửi đến controller route(examinfo.store) -> gửi tới view(makequestion.create). Đáng lẽ URL = makequestion/create tại sao lại hiển thị examinfo 
- Làm bài test là view(answer.show) 
### 
exam code: JWU7r, 5619y
### BUG 
- Sửa lại phần edit exam, ở view(makequestion.edit)
- Nếu exam có 0 question -> lỗi ở $questions = $_POST['question']; bên controller 
