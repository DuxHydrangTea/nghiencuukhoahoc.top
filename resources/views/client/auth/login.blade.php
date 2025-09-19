<!DOCTYPE html>
<html lang="vi" data-theme="light">
<head>
    @include('client.partials.head', ['title' => 'Đăng nhập - đăng ký hệ thống'])
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="container mx-auto px-4 py-8 flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md">
            <!-- Logo và tiêu đề -->
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-white text-3xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Hệ thống Giáo dục</h1>
                <p class="text-gray-600">Chào mừng bạn trở lại!</p>
            </div>

            <!-- Auth Card -->
            <div class="card bg-white shadow-xl" x-data="authForm()">
                <div class="card-body p-6">
                    <!-- Tabs -->
                    <div class="tabs tabs-boxed mb-6">
                        <a class="tab tab-active" 
                           :class="{ 'tab-active': activeTab === 'login' }"
                           @click="activeTab = 'login'">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Đăng nhập
                        </a>
                        <a class="tab" 
                           :class="{ 'tab-active': activeTab === 'register' }"
                           @click="activeTab = 'register'">
                            <i class="fas fa-user-plus mr-2"></i>
                            Đăng ký
                        </a>
                    </div>

                    <!-- Login Form -->
                    <div x-show="activeTab === 'login'" x-transition>
                        <form @submit.prevent="handleLogin('{{ route('handleLogin')}}')">
                            <div class="form-control mb-4">
                                <label class="label">
                                    <span class="label-text font-medium">Email</span>
                                </label>
                                <input type="email" 
                                       placeholder="Nhập email của bạn" 
                                       class="input input-bordered w-full"
                                       x-model="loginForm.email"
                                       required>
                            </div>
                            
                            <div class="form-control mb-4">
                                <label class="label">
                                    <span class="label-text font-medium">Mật khẩu</span>
                                </label>
                                <input type="password" 
                                       placeholder="Nhập mật khẩu" 
                                       class="input input-bordered w-full"
                                       x-model="loginForm.password"
                                       required>
                            </div>

                            <div class="flex items-center justify-between mb-6">
                                <label class="label cursor-pointer">
                                    <input type="checkbox" class="checkbox checkbox-sm mr-2">
                                    <span class="label-text">Ghi nhớ đăng nhập</span>
                                </label>
                                <a href="#" class="link link-primary text-sm">Quên mật khẩu?</a>
                            </div>

                            <button type="submit" class="btn btn-primary w-full mb-4">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Đăng nhập
                            </button>
                        </form>
                    </div>

                    <!-- Register Form -->
                    <div x-show="activeTab === 'register'" x-transition>
                        <form @submit.prevent="handleRegister('{{ route('handleRegister') }}')">
                            <div class="form-control mb-4">
                                <label class="label">
                                    <span class="label-text font-medium">Họ và tên</span>
                                </label>
                                <input type="text" 
                                       name="fullName" 
                                       placeholder="Nhập họ và tên" 
                                       class="input input-bordered w-full"
                                       x-model="registerForm.fullname"
                                       required>
                            </div>

                            <div class="form-control mb-4">
                                <label class="label">
                                    <span class="label-text font-medium">Email</span>
                                </label>
                                <input type="email" 
                                       name="email" 
                                       placeholder="Nhập email của bạn" 
                                       class="input input-bordered w-full"
                                       x-model="registerForm.email"
                                       required>
                            </div>

                            <div class="form-control mb-4">
                                <label class="label">
                                    <span class="label-text font-medium">Vai trò</span>
                                </label>
                                <select class="select select-bordered w-full" x-model="registerForm.role" name="role" required>
                                    <option value="">Chọn vai trò</option>
                                    <option value="1">Học sinh</option>
                                    <option value="2">Giáo viên</option>
                                </select>
                            </div>
                            
                            <div class="form-control mb-4">
                                <label class="label">
                                    <span class="label-text font-medium">Mật khẩu</span>
                                </label>
                                <input type="password" 
                                       name="password" 
                                       placeholder="Nhập mật khẩu" 
                                       class="input input-bordered w-full"
                                       x-model="registerForm.password"
                                       required>
                            </div>

                            <div class="form-control mb-4">
                                <label class="label">
                                    <span class="label-text font-medium">Xác nhận mật khẩu</span>
                                </label>
                                <input type="password" 
                                       placeholder="Nhập lại mật khẩu" 
                                       class="input input-bordered w-full"
                                       x-model="registerForm.confirmPassword"
                                       required>
                            </div>

                            <div class="form-control mb-6">
                                <label class="label cursor-pointer justify-start">
                                    <input type="checkbox" class="checkbox checkbox-sm mr-3" required>
                                    <span class="label-text">Tôi đồng ý với <a href="#" class="link link-primary">điều khoản sử dụng</a></span>
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary w-full mb-4">
                                <i class="fas fa-user-plus mr-2"></i>
                                Đăng ký
                            </button>
                        </form>
                    </div>

                    <!-- Divider -->
                    <div class="divider">Hoặc</div>

                    <!-- Social Login -->
                    <div class="space-y-3">
                        <button class="btn btn-outline w-full" x-data="{ route: '{{ route('auth.provider', 'google')}}' }" @click="loginWith(route, 'Google')">
                            <i class="fab fa-google text-red-500 mr-2"></i>
                            Đăng nhập với Google
                        </button>
                       
                        <button class="btn btn-outline w-full" x-data="{ route: '{{ route('auth.provider', 'facebook')}}' }" @click="loginWith(route, 'Facebook')">
                            <i class="fab fa-facebook text-blue-600 mr-2"></i>
                            Đăng nhập với Facebook
                        </button>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-6 text-gray-600 text-sm">
                <p>© 2024 Hệ thống Giáo dục. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </div>

    <script>
        function authForm() {
            return {
                activeTab: 'login',
                loginForm: {
                    email: '',
                    password: '',
                    _token: '{{ csrf_token() }}'
                },
                registerForm: {
                    fullname: '',
                    email: '',
                    role: '',
                    password: '',
                    confirmPassword: '',
                    _token: '{{ csrf_token() }}'
                },
                
                handleLogin(route) {
                    const self = this;
                    $.ajax(
                        {
                            url: route,
                            type: 'POST',
                            data: self.loginForm,
                            success: function(response) {
                                console.log(response);
                                self.showToast(response.message, response.success ? 'success' : 'error');
                                setTimeout(() => {
                                    window.location.href = '{{ route('home') }}';
                                }, 2000);
                            },
                            error: function(xhr, status, error) {
                                self.showToast('Đăng ký thất bại!', 'error');
                            }
                        }
                    )
                },
                
                handleRegister(route) {
                    if (this.registerForm.password !== this.registerForm.confirmPassword) {
                        this.showError('Mật khẩu xác nhận không khớp!');
                        return;
                    }
                    const self = this;
                    $.ajax(
                        {
                            url: route,
                            type: 'POST',
                            data: self.registerForm,
                            success: function(response) {
                                self.showToast(response.message, 'success');
                                setTimeout(() => {
                                    self.activeTab = 'login';
                                }, 1500);
                            },
                            error: function(xhr, status, error) {
                                self.showToast('Đăng ký thất bại!', 'error');
                            }
                        }
                    )
                },
                
                loginWith(route, provider) {
                    this.showInfo(`Đang chuyển hướng đến ${provider}...`);
                    setTimeout(() => {
                        window.location.href = route;
                    }, 2000);
                },
                
                showSuccess(message) {
                    this.showToast(message, 'success');
                },
                
                showError(message) {
                    this.showToast(message, 'error');
                },
                
                showInfo(message) {
                    this.showToast(message, 'info');
                },
                
                showToast(message, type) {
                    const toast = document.createElement('div');
                    toast.className = `alert alert-${type} fixed top-4 right-4 w-auto z-50`;
                    toast.innerHTML = `
                        <span>${message}</span>
                    `;
                    document.body.appendChild(toast);
                    
                    gsap.fromTo(toast, 
                        { x: 300, opacity: 0 }, 
                        { x: 0, opacity: 1, duration: 0.3 }
                    );
                    
                    setTimeout(() => {
                        gsap.to(toast, {
                            x: 300,
                            opacity: 0,
                            duration: 0.3,
                            onComplete: () => toast.remove()
                        });
                    }, 3000);
                }
            }
        }

        // GSAP animations
        gsap.from(".card", { y: 50, opacity: 0, duration: 0.8, ease: "power2.out" });
        gsap.from(".text-center > *", { y: 30, opacity: 0, duration: 0.6, stagger: 0.1, delay: 0.2 });
    </script>
</body>
</html>
