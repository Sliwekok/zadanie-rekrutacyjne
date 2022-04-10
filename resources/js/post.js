const form = document.querySelector('form');
form.addEventListener('submit', event => {
    if(confirm("Are you sure you want to delete this post?") == false){
        event.preventDefault();
    }
});