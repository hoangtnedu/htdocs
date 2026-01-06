# Lab05 – Session & Cookie (PHP)

## Chạy trên XAMPP
1. Copy thư mục `lab05` vào: `C:\xampp\htdocs\lab05\`
2. Start Apache trong XAMPP
3. Mở: http://localhost/lab05/

## Tài khoản demo
- admin / admin123 (role: admin)
- student / student123 (role: user)
- user / user123 (role: user)

## Gợi ý chụp màn hình
1) Login sai -> báo lỗi  
2) Login đúng -> vào Dashboard  
3) Logout (POST + CSRF) -> về login + flash message  
4) Remember username (cookie) -> tự điền lại username  
5) Auto-login (remember token) -> mở lại trang dashboard sau khi đóng trình duyệt  
6) Cart (session) -> add/update/remove/clear

> Lưu ý: Dữ liệu remember token được lưu tại `data/tokens.json`.
