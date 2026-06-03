import './bootstrap';

import Trix from 'trix';

document.addEventListener('trix-attachment-add', (event) => {
    const attachment = event.attachment;
    if (attachment.file) {
        uploadTrixAttachment(attachment);
    }
});

function uploadTrixAttachment(attachment) {
    const file = attachment.file;
    const formData = new FormData();
    formData.append('file', file);

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    fetch('/admin/media/upload-trix', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
        },
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.url) {
            attachment.setAttributes({
                url: data.url,
                href: data.url,
            });
        }
    })
    .catch(() => {
        attachment.remove();
    });
}
