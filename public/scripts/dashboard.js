function showCreatePostField() {

    let createPost = document.getElementById("createPost");
    let showCreateFieldButton = document.getElementById('showCreateFieldButton');

    if (createPost.style.display === "none") {
        createPost.style.display = "block";
        showCreateFieldButton.innerHTML = 'Cancel';
    } else {
        createPost.style.display = "none";
        showCreateFieldButton.innerHTML = 'Create a new post';
    }
}

function showEditPostField(postNumber) {
    let createPost = document.getElementById("postEdit" + postNumber);
    let showEditPostButton = document.getElementById('showEditPostButton' + postNumber);
    let postText = document.getElementById('postText' + postNumber);

    if (createPost.style.display === "none") {
        createPost.style.display = "block";
        showEditPostButton.innerHTML = 'Cancel';
        postText.style.visibility = 'hidden';
        document.getElementById('postEditText' + postNumber).value = postText.innerHTML;
    } else {
        createPost.style.display = "none";
        showEditPostButton.innerHTML = 'Edit post';
        postText.style.visibility = 'visible';
    }
}

function showEditCommentField(commentNumber) {
    let commentEditTextBox = document.getElementById("commentEditTextBox" + commentNumber);
    let comment = document.getElementById('comment' + commentNumber);
    let commentEditConfirmButton = document.getElementById('submitComment' + commentNumber);
    let commentEditIcon = document.getElementById('editComment' + commentNumber);

    if (commentEditTextBox.style.display === "none") {
        commentEditTextBox.style.display = "block";
        commentEditConfirmButton.style.visibility = 'visible';
        commentEditIcon.innerHTML = '&#x2716;';

        comment.style.display = 'none';
        commentEditTextBox.value = comment.innerHTML;
    } else {
        commentEditConfirmButton.style.visibility = 'hidden';
        commentEditTextBox.style.display = "none";
        commentEditIcon.innerHTML = '&#9997;';
        comment.style.display = 'block';
    }
}
