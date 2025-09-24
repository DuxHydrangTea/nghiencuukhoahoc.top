document.querySelectorAll('.upload-chunk').forEach( chunkUpload => {
    const textProgress = chunkUpload.querySelector('.textProgress');
    const confirmUploadButton = chunkUpload.querySelector(".confirmUploadButton");
    const fileUpload = chunkUpload.querySelector('.uploadFileInput');
    const fileNameText = chunkUpload.querySelector('.fileName');
    const uploadedFile = chunkUpload.querySelector('.uploadedFileValue');
    const fileType = chunkUpload.getAttribute('data-type');
    const lessonId = chunkUpload.getAttribute('data-id');
    let mimeType = [];
    if(fileType === 'video'){
        mimeType = ['mp4', 'webm'];
    }
    if(fileType === 'zip'){
        mimeType = ['zip'];
    }
    const resumable = new Resumable({
        headers: {
            "X-CSRF-TOKEN": window.csrf_token,
        },
        query: {
            mimeType: mimeType,
            lessonId: lessonId,
        },
        target: window.route("chunkUpload"),
        chunkSize: 5 * 1024 * 1024,
        simultaneousUploads: 3,
        testChunks: false,
        throttleProgressCallbacks: 1,
        fileType: mimeType,
    });

    resumable.assignBrowse(fileUpload);

    resumable.on("fileAdded", (file) => {
        fileNameText.innerHTML = file.fileName;
    });

    confirmUploadButton.addEventListener('click', function(){
        console.log(1);
        
        if(resumable.files.length === 0){
            alert('Vui chọn file để tải lên!');
            return;
        }
        resumable.upload();
    });

    resumable.on('fileProgress', function(file){
        let progress = Math.floor(file.progress() * 100);
        textProgress.innerHTML = ' <i class="fas fa-upload mr-2"></i> Đang tải lên ' + progress + '%';
    })

    resumable.on('fileSuccess', function(file, message){
        const response = JSON.parse(message);

        if (response.done) {
            uploadedFile.value = response.file_name;
            textProgress.innerHTML = '✅ Tải lên thành công: ' + response.file_name;
            fileNameText.innerHTML = 'Kéo thả file vào đây hoặc';
            fileUpload.value = '';
            resumable.cancel();
        }
    });
});