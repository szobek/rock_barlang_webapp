document.querySelectorAll('.album').forEach(album => {
    album.addEventListener('click', () => {
        const albumId = album.dataset.albumId;
        window.location.href = `/album/${albumId}`;
    });
});
