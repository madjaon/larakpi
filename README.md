# Cài đặt - Sử dụng

Framework: Laravel 5.8.

## Cài đặt

Tên Database (MySql): local_kpi

Cấu hình tại: .env

Từ thư mục gốc project chạy lệnh:
```bash
php artisan migrate --seed
```

Local Development Server:
```bash
php artisan serve
```

Đường dẫn:
```bash
http://localhost:8000
```

## Đăng nhập

Giám đốc | Trưởng phòng | Nhân viên
```bash
admin@admin.com | mod@mod.com | user@user.com
password: password
```

## Sử dụng

- Giám đốc: 

```bash
Quản lý danh sách user
Quản lý KPI từng user
Quản lý Mã KPI
Quản lý Đơn vị tính
Quản lý Tài khoản
```

- Trưởng phòng
```bash
Xem KPI của bản thân
Xem danh sách KPI theo user
Nhập tỷ trọng %
Đánh giá xếp loại
Quản lý Tài khoản
```
- Nhân viên
```bash
Xem KPI của bản thân
Nhập số liệu Thực hiện
Đánh giá xếp loại
Quản lý Tài khoản
```

## 