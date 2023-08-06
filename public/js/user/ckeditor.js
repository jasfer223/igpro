ClassicEditor
        .create(document.querySelector('#user-description'), {
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'undo',
                    'redo'
                ]
            },
            removeButtons: 'Table,Image'
        })
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#editProjectDescription'), {
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'undo',
                    'redo'
                ]
            },
            removeButtons: 'Table,Image'
        })
        .catch(error => {
            console.error(error);
        });