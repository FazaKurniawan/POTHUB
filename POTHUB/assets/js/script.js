
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#plantForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const fileInput = document.querySelector('#gambar');
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                    alert('Hanya file gambar JPG, PNG, atau JPEG yang diperbolehkan.');
                    e.preventDefault();
                }
            }
        });
    }
});