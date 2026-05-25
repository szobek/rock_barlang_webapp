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
const openFilterBar = ()=>{
    
}
const searchBarIcon = document.querySelector('.filter-icon-js');
const closeIcon = document.querySelector('.close-icon-js');
const filterBar = document.querySelector('.filter-bar');

searchBarIcon.addEventListener('click', ()=>{
    filterBar.classList.toggle('active');
    searchBarIcon.classList.toggle('active');
    searchBarIcon.style.visibility = 'hidden';
});
closeIcon.addEventListener('click', ()=>{
    filterBar.classList.remove('active');
    searchBarIcon.classList.toggle('active');
    searchBarIcon.style.visibility = 'visible';
});
