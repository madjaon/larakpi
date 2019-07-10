<?php

return [

    // Titles
    'showing-all-users'     => 'Danh sách người dùng',
    'users-menu-alt'        => 'Hiển thị menu quản lý người dùng',
    'create-new-user'       => 'Tạo người dùng mới',
    'show-deleted-users'    => 'Hiển thị người dùng đã xóa',
    'editing-user'          => 'Chỉnh sửa người dùng :name',
    'showing-user'          => 'Hiển thị người dùng :name',
    'showing-user-title'    => 'Thông tin của :name',

    // Flash Messages
    'createSuccess'   => 'Tạo người dùng thành công! ',
    'updateSuccess'   => 'Cập nhật người dùng thành công! ',
    'deleteSuccess'   => 'Xóa người dùng thành công! ',
    'deleteSelfError' => 'Bạn không thể xóa chính bạn! ',

    // Show User Tab
    'viewProfile'            => 'Xem hồ sơ',
    'editUser'               => 'Sửa người dùng',
    'deleteUser'             => 'Xóa người dùng',
    'usersBackBtn'           => 'Quay lại danh sách người dùng',
    'usersPanelTitle'        => 'Thông tin người dùng',
    'labelUserName'          => 'Tên đăng nhập:',
    'labelEmail'             => 'Email:',
    'labelFirstName'         => 'Tên:',
    'labelLastName'          => 'Họ:',
    'labelRole'              => 'Vai trò:',
    'labelStatus'            => 'Trạng thái:',
    'labelAccessLevel'       => 'Cấp độ truy cập',
    'labelPermissions'       => 'Quyền:',
    'labelCreatedAt'         => 'Tạo lúc:',
    'labelUpdatedAt'         => 'Sửa lúc:',
    'labelIpEmail'           => 'Email Signup IP:',
    'labelIpEmail'           => 'Email Signup IP:',
    'labelIpConfirm'         => 'Confirmation IP:',
    'labelIpSocial'          => 'Socialite Signup IP:',
    'labelIpAdmin'           => 'Admin Signup IP:',
    'labelIpUpdate'          => 'Last Update IP:',
    'labelDeletedAt'         => 'Đã xóa lúc',
    'labelIpDeleted'         => 'Deleted IP:',
    'usersDeletedPanelTitle' => 'Thông tin người dùng đã bị xóa',
    'usersBackDelBtn'        => 'Quay lại danh sách người dùng đã xóa',

    'successRestore'    => 'Người dùng đã khôi phục thành công.',
    'successDestroy'    => 'Hồ sơ người dùng bị phá hủy thành công.',
    'errorUserNotFound' => 'Không tìm thấy người dùng.',

    'labelUserLevel'  => 'Level',
    'labelUserLevels' => 'Levels',

    'users-table' => [
        'caption'   => '{1} :userscount tổng số người dùng|[2,*] :userscount tổng số người dùng',
        'id'        => 'ID',
        'name'      => 'Tên đăng nhập',
        'fname'     => 'Tên',
        'lname'     => 'Họ',
        'email'     => 'Email',
        'role'      => 'Vai trò',
        'created'   => 'Tạo',
        'updated'   => 'Cập nhật',
        'actions'   => 'Hành động',
        'updated'   => 'Cập nhật',
    ],

    'buttons' => [
        'create-new'    => 'Tạo người dùng mới',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Xóa</span><span class="hidden-xs hidden-sm hidden-md"> User</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Xem</span><span class="hidden-xs hidden-sm hidden-md"> User</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Sửa</span><span class="hidden-xs hidden-sm hidden-md"> User</span>',
        'back-to-users' => '<span class="hidden-sm hidden-xs">Quay lại </span><span class="hidden-xs">danh sách Users</span>',
        'back-to-user'  => 'Quay lại  <span class="hidden-xs"> thông tin User</span>',
        'delete-user'   => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs">Xóa</span><span class="hidden-xs"> User</span>',
        'edit-user'     => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Sửa</span><span class="hidden-xs"> User</span>',
    ],

    'tooltips' => [
        'delete'        => 'Xóa',
        'show'          => 'Xem',
        'edit'          => 'Sửa',
        'create-new'    => 'Tạo mới người dùng',
        'back-user'     => 'Quay lại thông tin người dùng',
        'back-users'    => 'Quay lại danh sách người dùng',
        'email-user'    => 'Email :user',
        'submit-search' => 'Tìm kiếm người dùng',
        'clear-search'  => 'Xóa kết quả tìm kiếm',
    ],

    'messages' => [
        'userNameTaken'          => 'Tên đăng nhập đã được sử dụng',
        'userNameRequired'       => 'Tên đăng nhập là bắt buộc phải nhập',
        'fNameRequired'          => 'Tên là bắt buộc phải nhập',
        'lNameRequired'          => 'Họ là bắt buộc phải nhập',
        'emailRequired'          => 'Email là bắt buộc phải nhập',
        'emailInvalid'           => 'Email không hợp lệ',
        'passwordRequired'       => 'Mật khẩu là bắt buộc phải nhập',
        'PasswordMin'            => 'Mật khẩu cần có ít nhất 6 ký tự',
        'PasswordMax'            => 'Độ dài mật khẩu tối đa là 20 ký tự',
        'captchaRequire'         => 'Captcha là bắt buộc phải nhập',
        'CaptchaWrong'           => 'Sai captcha, vui lòng thử lại.',
        'roleRequired'           => 'Vai trò người dùng là bắt buộc phải nhập.',
        'user-creation-success'  => 'Tạo người dùng thành công!',
        'update-user-success'    => 'Cập nhật người dùng thành công!',
        'delete-success'         => 'Xóa người dùng thành công!',
        'cannot-delete-yourself' => 'Bạn không thể xóa chính bạn!',
    ],

    'show-user' => [
        'id'                => 'ID người dùng',
        'name'              => 'Tên đăng nhập',
        'email'             => '<span class="hidden-xs">User </span>Email',
        'role'              => 'Vai trò người dùng',
        'created'           => 'Created <span class="hidden-xs">at</span>',
        'updated'           => 'Updated <span class="hidden-xs">at</span>',
        'labelRole'         => 'Vai trò người dùng',
        'labelAccessLevel'  => '<span class="hidden-xs">User</span> Access Level|<span class="hidden-xs">User</span> Access Levels',
    ],

    'search'  => [
        'title'             => 'Hiển thị kết quả tìm kiếm',
        'found-footer'      => ' Dữ liệu được tìm thấy',
        'no-results'        => 'Không có kết quả',
        'search-users-ph'   => 'Tìm kiếm người dùng',
    ],

    'modals' => [
        'delete_user_message' => 'Bạn có chắc chắn muốn xóa :user?',
    ],

    'showing-user-deleted' => 'Hiển thị người dùng đã xóa',
    'role' => 'Vai trò',
    'deleted' => 'Đã xóa',
    'IpDeleted' => 'Ip đã xóa',
    'actions' => 'Hành động',
];
