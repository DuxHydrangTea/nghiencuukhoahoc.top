@extends('client.app')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">
                        <i class="fas fa-upload text-blue-600 mr-3"></i>
                        {{ $lesson->title }}
                    </h1>
                    <p class="text-gray-600">Tiếp tục upload video hoặc file zip bài giảng!</p>
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
                    {{-- action="{{ route('lesson.handleUpload') }}"  --}}
                    id="lessonForm"
                    method="POST">
                @csrf
                <div class="flex flex-col justify-center items-center gap-4" id="choose-upload-type">
                    <h4>Chọn thể loại bài giảng để tiếp tục!</h4>
                    <div class="flex gap-3">
                        <button class="btn btn-primary type-button" data-type="video_url" type="button"> Upload video bài giảng (MP4) </button>
                        <button class="btn btn-warning type-button" data-type="slide_file" type="button"> Upload slide Spring bài giảng (ZIP) </button>
                    </div>
                </div>
                <div class="type-block border-2 border-red-100 rounded-xl p-3 hidden" data-type-block="video_url">
                    <!-- Video File Upload -->
                    <div class="form-control upload-chunk" data-type="video" data-id="{{ $lesson->id }}">
                        <label class="label">
                            <span class="label-text text-lg font-semibold">
                                <i class="fas fa-video text-red-600 mr-2"></i>
                                Video bài giảng
                            </span>
                        </label>
                        <div class="upload-area p-8 rounded-lg text-center">
                            <div>
                                <i class="fas fa-film text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-600 mb-4 fileName">Kéo thả video MP4 vào đây hoặc</p>
                                <input type="file" accept="video/mp4"  name="video_url"
                                       class="uploadFileInput file-input file-input-bordered file-input-error w-full max-w-xs">
                            </div>
                            <p class="textProgress" id="textProgress"></p>
                        </div>
                    </div>
                </div>
                
                <div class="type-block border-2 border-blue-200 rounded-xl p-3 hidden" data-type-block="slide_file">
                    <!-- Slide File Upload -->
                    <div class="form-control upload-chunk" data-type="zip" data-id="{{ $lesson->id }}">
                        <label class="label">
                            <span class="label-text text-lg font-semibold">
                                <i class="fas fa-file-archive text-yellow-600 mr-2"></i>
                                File slide (ZIP)
                            </span>
                        </label>
                        <div class="upload-area p-8 rounded-lg text-center">
                            <div>
                                <i class="fas fa-file-archive text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-600 mb-4 fileName" id="zipFileName">Kéo thả file ZIP vào đây hoặc</p>
                                <input type="file" accept=".zip" name="slide_url"
                                       class="file-input file-input-bordered file-input-warning w-full max-w-xs uploadFileInput" id="zip-file-input">
                            </div>
                            <p class="textProgress" id="textProgress"></p>
                            {{-- <input type="text" name="slide_url" class="border-2 uploadedFileValue hidden"> --}}
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end gap-4 pt-8 border-t">
                    <button type="button" onclick="history.back()" class="btn btn-outline btn-lg">
                        <i class="fas fa-times mr-2"></i>
                        Hủy bỏ
                    </button>
                    <button type="submit" id="submit-lesson-button" class="btn btn-primary btn-lg" :disabled="isSubmitting">
                        <span>Bắt đầu upload</span>
                    </button>
                </div>
                <p class="text-end">
                    <i>Thời gian upload có thể mấy nhiều thời gian tuỳ thuộc vào kích thước file. Vui lòng đợi...</i>
                </p>
            </form>
        </div>
    </div>

    <script>
        let fieldInput = '';
        $('.type-button').on('click', function () {
            $('.type-button').addClass('scale-[0.8]')
            $(this).removeClass('scale-[0.8]')
            const dataType = fieldInput = $(this).data('type');
            $('[data-type-block]').addClass('hidden');
            $('[data-type-block]').find('input').prop('disabled', true);
            $(`[data-type-block="${dataType}"]`).removeClass('hidden');
            $(`[data-type-block="${dataType}"]`).find('input').prop('disabled', false);
        });

        $('#submit-lesson-button').on('click', function (e){
            e.preventDefault();
            console.log($(`input[name="video_url"]`)[0].files);
            
            if(fieldInput !== '' || fieldInput === 'video_url'){
                const formData = new FormData();
                formData.append(fieldInput, $(`input[name="video_url"]`)[0].files[0]);

                axios.post(window.route('lesson.handleUploadMedia', {
                    lesson: '{{$lesson->id}}'
                }), formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': window.csrf_token,
                    },
                    onUploadProgress: function (progressEvent) {
                        let percent = Math.round((progressEvent.loaded * 100) / progressEvent.total);

                        $('#submit-lesson-button').text('Tiến trình upload: ' + percent + '%');
                        if(percent === 100){
                            $('#submit-lesson-button').text('Đang upload lên server...');
                        }
                    }
                    
                }).then(response => {
                    // const res = response.data;
                    alert('Tải lên hoàn tất');
                    $('#submit-lesson-button').text('Bắt đầu upload');
                })
                .catch(error => {
                    alert('Tải lên thất bại! Vui lòng thử lại sau!');
                });;
            }
        })
    </script>
@endsection

