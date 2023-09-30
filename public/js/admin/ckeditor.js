ClassicEditor
.create(document.querySelector('#editor'), {
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



let desc_editor = null;
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
.then(descEditor => {
desc_editor = descEditor;
// desc_editor.setData(projectDescription);
})
.catch(error => {
console.error(error);
});

// Handle the modal closing event
$('#editProjectModal').on('hidden.modal', function () {
    // Destroy the CKEditor instance when the modal is closed
    if (desc_editor) {
        desc_editor.destroy()
        desc_editor = null;
    }
});