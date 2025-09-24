@extends('client.app')
@section('content')
    <div x-data="uploadLesson()" class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">
                        <i class="fas fa-upload text-blue-600 mr-3"></i>
                        Upload Bài Giảng Mới
                    </h1>
                    <p class="text-gray-600">Tạo bài giảng mới cho học sinh của bạn</p>
                </div>
                <button onclick="history.back()" class="btn btn-outline btn-primary">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Quay lại
                </button>
            </div>
        </div>

        <!-- Upload Form -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form class="space-y-8" 
                    enctype="multipart/form-data" 
                    x-data="uploadLesson()" 
                    action="{{ route('lesson.handleUpload') }}" 
                    id="lessonForm"
                    method="POST">
                @csrf
                <!-- Chapter Selection -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-lg font-semibold">
                            <i class="fas fa-book text-blue-600 mr-2"></i>
                            Chọn Chương
                        </span>
                    </label>
                    <select name="chapter_id" class="select select-bordered select-lg w-full" required>
                        <option value="" disabled>Chọn chương học</option>
                        @foreach ($chapters as $chapter )
                            <option value="{{$chapter->id}}">{{ $chapter->title }}</option>
                        @endforeach
                       
                    </select>
                </div>

                <!-- Title -->
                <div class="flex gap-5">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-lg font-semibold">
                                <i class="fas fa-icons text-orange-600 mr-2"></i>
                                Biểu tượng
                            </span>
                        </label>
                        <input name="icon" type="text" placeholder="" 
                               class="input input-bordered input-lg w-[100px]">
                    </div>
                    <div class="form-control flex-1">
                        <label class="label">
                            <span class="label-text text-lg font-semibold">
                                <i class="fas fa-heading text-green-600 mr-2"></i>
                                Tiêu đề bài giảng
                            </span>
                        </label>
                        <input name="title" type="text" placeholder="Nhập tiêu đề bài giảng" 
                               class="input input-bordered input-lg w-full" required>
                    </div>
                </div>
                <!-- Description -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-lg font-semibold">
                            <i class="fas fa-align-left text-purple-600 mr-2"></i>
                            Mô tả bài giảng
                        </span>
                    </label>
                    <textarea name="description" placeholder="Mô tả chi tiết về nội dung bài giảng" 
                              class="textarea textarea-bordered textarea-lg w-full h-32" required></textarea>
                </div>

                <!-- Thumbnail Upload -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-lg font-semibold">
                            <i class="fas fa-image text-pink-600 mr-2"></i>
                            Hình ảnh đại diện
                        </span>
                    </label>
                    <div class="upload-area p-8 rounded-lg text-center" 
                         @dragover.prevent="$el.classList.add('dragover')"
                         @dragleave.prevent="$el.classList.remove('dragover')"
                         @drop.prevent="handleThumbnailDrop($event)">
                        <div x-show="!thumbnailPreview">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                            <p class="text-gray-600 mb-4">Kéo thả hình ảnh vào đây hoặc</p>
                            <input type="file" accept="image/*" @change="handleThumbnailUpload($event)" name="thumbnail"
                                   class="file-input file-input-bordered file-input-primary w-full max-w-xs">
                        </div>
                        <div x-show="thumbnailPreview" class="relative">
                            <img :src="thumbnailPreview" alt="Preview" class="max-w-xs mx-auto rounded-lg shadow-md">
                            <button type="button" @click="removeThumbnail()" 
                                    class="btn btn-circle btn-error btn-sm absolute -top-2 -right-2">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Tags -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-lg font-semibold">
                            <i class="fas fa-tags text-teal-600 mr-2"></i>
                            Thẻ từ khóa
                        </span>
                    </label>
                    <div class="flex flex-wrap gap-2 mb-4" x-show="lesson.tags.length > 0">
                        <template x-for="(tag, index) in lesson.tags" :key="index">
                            <span class="tag-item">
                                <span class="badge badge-secondary" x-text="tag"></span>
                                <input type="text" name="tags[]" :value="tag" hidden>
                                <button type="button" @click="removeTag(index)" class="text-white hover:text-red-200 hover:scale-[2] transition-all">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                            </span>
                        </template>
                    </div>
                    <div class="flex gap-2">
                        <input type="text" placeholder="Nhập thẻ từ khóa" 
                               class="input input-bordered flex-1" x-model="newTag" @keyup.enter="addTag()">
                        <button type="button" @click="addTag()" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i>Thêm
                        </button>
                    </div>
                </div>

                {{-- <!-- Video Upload -->
                <div class="form-control upload-chunk">
                    <label class="label">
                        <span class="label-text text-lg font-semibold">
                            <i class="fas fa-video text-red-600 mr-2"></i>
                            Video bài giảng
                        </span>
                    </label>
                    <div class="upload-area p-8 rounded-lg text-center"
                         @dragover.prevent="$el.classList.add('dragover')"
                         @dragleave.prevent="$el.classList.remove('dragover')"
                         @drop.prevent="handleVideoDrop($event)">
                        <div x-show="!videoFile">
                            <i class="fas fa-film text-4xl text-gray-400 mb-4"></i>
                            <p class="text-gray-600 mb-4 fileName">Kéo thả video MP4 vào đây hoặc</p>
                            <input type="file" accept="video/mp4" @change="handleVideoUpload($event)" 
                                   class="uploadFileInput file-input file-input-bordered file-input-error w-full max-w-xs">
                        </div>
                        <div x-show="videoFile" class="text-left">
                            <div class="flex items-center justify-between bg-gray-100 p-4 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-file-video text-red-600 text-2xl mr-3"></i>
                                    <div>
                                        <p class="font-semibold" x-text="videoFile?.name"></p>
                                        <p class="text-sm text-gray-600" x-text="formatFileSize(videoFile?.size)"></p>
                                    </div>
                                </div>
                                <button type="button" @click="removeVideo()" class="btn btn-circle btn-error btn-sm">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-sm mt-4 btn-primary confirmUploadButton" id="confirmZipUploadButton" type="button">Xác nhận</button>
                        <p class="textProgress" id="textProgress"></p>
                        <input type="text" name="video_url" id="uploadedVideoFile" class="hidden uploadedFileValue">
                    </div>
                </div>

                <!-- Slide File Upload -->
                <div class="form-control upload-chunk">
                    <label class="label">
                        <span class="label-text text-lg font-semibold">
                            <i class="fas fa-file-archive text-yellow-600 mr-2"></i>
                            File slide (ZIP)
                        </span>
                    </label>
                    <div class="upload-area p-8 rounded-lg text-center"
                         @dragover.prevent="$el.classList.add('dragover')"
                         @dragleave.prevent="$el.classList.remove('dragover')"
                         @drop.prevent="handleSlideDrop($event)">
                        <div x-show="!slideFile">
                            <i class="fas fa-file-archive text-4xl text-gray-400 mb-4"></i>
                            <p class="text-gray-600 mb-4 fileName" id="zipFileName">Kéo thả file ZIP vào đây hoặc</p>
                            <input type="file" accept=".zip"  
                                   class="file-input file-input-bordered file-input-warning w-full max-w-xs uploadFileInput" id="zip-file-input">
                        </div>
                        <div x-show="slideFile" class="text-left">
                            <div class="flex items-center justify-between bg-gray-100 p-4 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-file-archive text-yellow-600 text-2xl mr-3"></i>
                                    <div>
                                        <p class="font-semibold" x-text="slideFile?.name"></p>
                                        <p class="text-sm text-gray-600" x-text="formatFileSize(slideFile?.size)"></p>
                                    </div>
                                </div>
                                <button type="button" @click="removeSlide()" class="btn btn-circle btn-error btn-sm">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-sm mt-4 btn-primary confirmUploadButton" type="button">Xác nhận</button>
                        <p class="textProgress" id="textProgress"></p>
                        <input type="text" name="slide_url" class="border-2 uploadedFileValue hidden">
                    </div>
                </div> --}}

                <!-- Duration -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-lg font-semibold">
                            <i class="fas fa-clock text-indigo-600 mr-2"></i>
                            Thời lượng (phút)
                        </span>
                    </label>
                    <input x-model="lesson.duration" type="number" min="1" max="180" name="duration"
                           placeholder="Nhập thời lượng bài giảng (phút)" 
                           class="input input-bordered input-lg w-full" required>
                </div>
                <div class="flex gap-5">
                    @foreach ($colors as $color )
                        <label for="" class="flex justify-center items-center gap-1">
                            <span class="text-{{ $color->value }}-500 font-bold">{{$color->name}}</span>
                            <input type="radio" name="color" class="radio radio-primary" value="{{$color->value}}" />
                        </label>
                    @endforeach
                </div>
                <div class="flex justify-end gap-4 pt-8 border-t">
                    <button type="button" onclick="history.back()" class="btn btn-outline btn-lg">
                        <i class="fas fa-times mr-2"></i>
                        Hủy bỏ
                    </button>
                    <button type="submit" id="submit-lesson-button" class="btn btn-primary btn-lg" :disabled="isSubmitting">
                        <i class="fas fa-save mr-2"></i>
                        <span x-show="!isSubmitting">Xác nhận và chuyển sang trang upload bài giảng</span>
                        <span x-show="isSubmitting">Đang lưu...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function uploadLesson() {
            return {
                lesson: {
                    chapter_id: '',
                    title: '',
                    description: '',
                    thumbnail: null,
                    icon: '🚀',
                    tags: [],
                    video_url: null,
                    slide_file: null,
                    duration: '',
                    color: '#3b82f6'
                },
                newTag: '',
                thumbnailPreview: null,
                videoFile: null,
                slideFile: null,
                isSubmitting: false,

                progress: 0,
                videoProgress: 0,
                isUploading: false,
                r: null,

                addTag() {
                    if (this.newTag.trim() && !this.lesson.tags.includes(this.newTag.trim())) {
                        this.lesson.tags.push(this.newTag.trim());
                        this.newTag = '';
                    }
                },

                removeTag(index) {
                    this.lesson.tags.splice(index, 1);
                },

                handleThumbnailUpload(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.lesson.thumbnail = file;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.thumbnailPreview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                },

                handleThumbnailDrop(event) {
                    event.target.classList.remove('dragover');
                    const file = event.dataTransfer.files[0];
                    if (file && file.type.startsWith('image/')) {
                        this.lesson.thumbnail = file;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.thumbnailPreview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                },

                removeThumbnail() {
                    this.lesson.thumbnail = null;
                    this.thumbnailPreview = null;
                },

                handleVideoUpload(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.videoFile = file;
                        this.lesson.video_url = file;
                    }
                },

                handleVideoDrop(event) {
                    event.target.classList.remove('dragover');
                    const file = event.dataTransfer.files[0];
                    if (file && file.type === 'video/mp4') {
                        this.videoFile = file;
                        this.lesson.video_url = file;
                    }
                },

                removeVideo() {
                    this.videoFile = null;
                    this.lesson.video_url = null;
                },

                handleSlideUpload(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.slideFile = file;
                        this.lesson.slide_file = file;
                    }
                },

                handleSlideDrop(event) {
                    event.target.classList.remove('dragover');
                    const file = event.dataTransfer.files[0];
                    if (file && file.name.endsWith('.zip')) {
                        this.slideFile = file;
                        this.lesson.slide_file = file;
                    }
                },

                removeSlide() {
                    this.slideFile = null;
                    this.lesson.slide_file = null;
                },

                formatFileSize(bytes) {
                    if (!bytes) return '0 Bytes';
                    const k = 1024;
                    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
                },

                async submitLesson() {
                    this.isSubmitting = true;
                    
                    // Simulate API call
                    await new Promise(resolve => setTimeout(resolve, 2000));
                    
                    // Show success animation
                    gsap.from('.container', {
                        scale: 0.95,
                        duration: 0.5,
                        ease: "back.out(1.7)"
                    });
                    
                    alert('Bài giảng đã được tải lên thành công!');
                    this.isSubmitting = false;
                    
                    // Reset form or redirect
                    // window.location.href = 'teacher-documents.html';
                },
                
                }
        }

        // Initialize GSAP animations
        gsap.from('.container > div', {
            y: 50,
            opacity: 0,
            duration: 0.8,
            stagger: 0.2,
            ease: "power2.out"
        });
    </script>
@endsection

