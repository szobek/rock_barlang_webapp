document.querySelector('.upper-js').addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

const cards = document.querySelectorAll('.filter-card');

function applyFilters() {
    const search = document.getElementById('search').value.toLowerCase().trim();

    const cardArr = Array.from(cards);
    // Szűrés
    
    cardArr.forEach(card => {
        const nameMatch = card.dataset.name.toLowerCase().includes(search);
        card.classList.toggle('hidden-card', !nameMatch);
    });
}

function resetFilters() {
    document.getElementById('search').value = '';
    applyFilters();
}

document.getElementById('search').addEventListener('input', applyFilters);

applyFilters();
const searchBarIcon = document.querySelector('.filter-icon-js');

searchBarIcon.addEventListener('click', ()=>{
    const filterBar = document.querySelector('.filter-bar');
    filterBar.classList.toggle('active');
    searchBarIcon.classList.toggle('active');
});
