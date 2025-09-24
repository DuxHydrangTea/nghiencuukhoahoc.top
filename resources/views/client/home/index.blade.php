@extends('client.app')
@section('content')
    <section class="hero min-h-screen gradient-bg-partern">
        <div class="hero-content text-center">
            <div class="max-w-4xl">
                <h2 class="text-5xl md:text-6xl font-bold text-primary mb-6 animate-float">
                    Chào mừng đến với NghienCuuKhoaHoc! 🎉
                </h2>
                <p class="text-xl md:text-2xl text-gray-700 mb-8 leading-relaxed">
                    Nơi học tập trở nên thú vị và bổ ích cho các em học sinh. Khám phá thế giới kiến thức qua các bài học
                    sinh động và trò chơi giáo dục!
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="btn btn-secondary btn-lg text-xl px-8 py-4 hover-bounce">
                        <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Bắt đầu học ngay
                    </button>
                    <button class="btn btn-outline btn-lg text-xl px-8 py-4 hover-bounce">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Xem tài liệu
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- Classes Section -->
    <section class="py-16 px-4 bg-gradient-to-r from-yellow-100/50 to-orange-100/50 ">
        <div class="container mx-auto">
            <div class="text-center mb-12">
                <h3 class="text-4xl font-bold text-primary mb-4">Các lớp học 📚</h3>
                <p class="text-xl text-gray-700">Chọn lớp học phù hợp với độ tuổi của bạn</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" x-data="{
                classes: [
                    @foreach ($classes as $class )
                        { grade: '{{$class->title}}', color: 'bg-{{ $class->color }}-100 border-{{ $class->color }}-200', icon: '{{ $class->icon }}', students: 245 },
                    @endforeach
                ]
            }">
                <template x-for="(classItem, index) in classes" :key="index">
                    <div class="card border-2 hover:scale-105 transition-all duration-300 cursor-pointer hover-bounce"
                        :class="classItem.color">
                        <div class="card-body text-center">
                            <div class="text-4xl mb-2" x-text="classItem.icon"></div>
                            <h2 class="card-title text-2xl font-bold text-primary justify-center" x-text="classItem.grade">
                            </h2>
                            <div class="flex items-center justify-center space-x-2 mb-3">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                <span class="text-sm font-medium" x-text="classItem.students + ' học sinh'"></span>
                            </div>
                            <div class="card-actions justify-center">
                                <button class="btn btn-secondary w-full">Vào lớp học</button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>

    <!-- Subjects Section -->
    <section class="py-16 px-4">
        <div class="container mx-auto">
            <div class="text-center mb-12">
                <h3 class="text-4xl font-bold text-primary mb-4">Môn học yêu thích 📖</h3>
                <p class="text-xl text-gray-700">Khám phá các môn học thú vị và bổ ích</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" x-data="{
                subjects: [
                    @foreach ($subjects as $subject )
                        { subject: '{{ $subject->title }}', icon: '{{ $subject->icon }}', description: '{{ $subject->description }}', lessons: 45, color: 'from-{{ $subject->color }}-400 to-{{ $subject->color }}-600' },
                    @endforeach
                ]
            }">
                <template x-for="(subject, index) in subjects" :key="index">
                    <div
                        class="card bg-base-100 shadow-xl border-2 hover:shadow-2xl transition-all duration-300 cursor-pointer hover-bounce overflow-hidden">
                        <div class="h-2 bg-gradient-to-r" :class="subject.color"></div>
                        <div class="card-body text-center">
                            <div class="text-5xl mb-3 animate-float" x-text="subject.icon"
                                :style="'animation-delay: ' + (index * 0.2) + 's'"></div>
                            <h2 class="card-title text-2xl font-bold text-primary justify-center" x-text="subject.subject">
                            </h2>
                            <p class="text-base text-gray-600" x-text="subject.description"></p>
                            <div class="flex items-center justify-between mb-4">
                                <div class="badge badge-secondary text-sm" x-text="subject.lessons + ' bài học'"></div>
                                <div class="flex items-center space-x-1">
                                    <template x-for="i in 5" :key="i">
                                        <svg class="w-4 h-4 fill-yellow-400 text-yellow-400" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    </template>
                                </div>
                            </div>
                            <div class="card-actions justify-center">
                                <button class="btn btn-secondary w-full">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Bắt đầu học
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>

    <!-- Quiz Section -->
    <section class="py-16 px-4 bg-gradient-to-r from-cyan-100/50 to-blue-100/50">
        <div class="container mx-auto">
            <div class="text-center mb-12">
                <h3 class="text-4xl font-bold text-primary mb-4">Trắc nghiệm vui 🎯</h3>
                <p class="text-xl text-gray-700">Kiểm tra kiến thức qua các câu hỏi thú vị</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" x-data="{
                quizzes: [
                    { title: 'Toán cơ bản', questions: 20, time: '15 phút', difficulty: 'Dễ', color: 'bg-green-100' },
                    { title: 'Tiếng Việt lớp 3', questions: 15, time: '12 phút', difficulty: 'Trung bình', color: 'bg-yellow-100' },
                    { title: 'Khoa học tự nhiên', questions: 25, time: '20 phút', difficulty: 'Khó', color: 'bg-red-100' },
                    { title: 'Tiếng Anh cơ bản', questions: 18, time: '15 phút', difficulty: 'Dễ', color: 'bg-blue-100' },
                    { title: 'Lịch sử Việt Nam', questions: 22, time: '18 phút', difficulty: 'Trung bình', color: 'bg-purple-100' },
                    { title: 'Địa lý thế giới', questions: 16, time: '14 phút', difficulty: 'Dễ', color: 'bg-pink-100' }
                ]
            }">
                <template x-for="(quiz, index) in quizzes" :key="index">
                    <div class="card border-2 hover:scale-105 transition-all duration-300 cursor-pointer hover-bounce"
                        :class="quiz.color">
                        <div class="card-body">
                            <div class="flex items-center justify-between mb-4">
                                <svg class="w-8 h-8 text-primary animate-wiggle" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                    </path>
                                </svg>
                                <div class="badge"
                                    :class="quiz.difficulty === 'Dễ' ? 'badge-success' : quiz
                                        .difficulty === 'Trung bình' ? 'badge-warning' : 'badge-error'"
                                    x-text="quiz.difficulty"></div>
                            </div>
                            <h2 class="card-title text-xl font-bold text-primary" x-text="quiz.title"></h2>
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center justify-between text-sm">
                                    <span>Số câu hỏi:</span>
                                    <span class="font-medium" x-text="quiz.questions"></span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span>Thời gian:</span>
                                    <span class="font-medium" x-text="quiz.time"></span>
                                </div>
                            </div>
                            <div class="card-actions justify-center">
                                <button class="btn btn-secondary w-full">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                        </path>
                                    </svg>
                                    Làm bài ngay
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>

    <!-- Recent Lessons -->
    <section class="py-16 px-4">
        <div class="container mx-auto">
            <div class="text-center mb-12">
                <h3 class="text-4xl font-bold text-primary mb-4">Bài học mới nhất 🆕</h3>
                <p class="text-xl text-gray-700">Cập nhật những bài học mới và thú vị nhất</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" x-data="{
                lessons: [
                    { title: 'Phép cộng trong phạm vi 100', subject: 'Toán học', views: 1234, comments: 45 },
                    { title: 'Tả cảnh thiên nhiên', subject: 'Tiếng Việt', views: 987, comments: 32 },
                    { title: 'Colors and Shapes', subject: 'Tiếng Anh', views: 756, comments: 28 },
                    { title: 'Chu trình nước trong tự nhiên', subject: 'Khoa học', views: 654, comments: 19 }
                ]
            }">
                <template x-for="(lesson, index) in lessons" :key="index">
                    <div
                        class="card bg-base-100 shadow-lg border-2 hover:shadow-xl transition-all duration-300 cursor-pointer hover-bounce">
                        <div
                            class="aspect-video bg-gradient-to-br from-yellow-200 to-orange-200 rounded-t-lg flex items-center justify-center">
                            <svg class="w-12 h-12 text-primary animate-bounce-gentle" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="card-body">
                            <div class="badge badge-outline text-xs mb-2" x-text="lesson.subject"></div>
                            <h2 class="card-title text-lg font-bold text-primary line-clamp-2" x-text="lesson.title"></h2>
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                    <span x-text="lesson.views"></span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                        </path>
                                    </svg>
                                    <span x-text="lesson.comments"></span>
                                </div>
                            </div>
                            <div class="card-actions justify-center">
                                <button class="btn btn-secondary btn-sm w-full">Xem bài học</button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>
@endsection
