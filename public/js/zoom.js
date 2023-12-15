console.log('Js ok!');
function afficherImageEnGrand(url) {
    var modal = document.createElement('div');
    modal.className = 'modal';
    var image = document.createElement('img');
    image.src = url;
    modal.appendChild(image);
    document.body.appendChild(modal);
    modal.addEventListener('click', function() {
        modal.remove();
    });
}
