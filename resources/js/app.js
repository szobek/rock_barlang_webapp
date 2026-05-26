import './album-card';
document.querySelector('.upper-js').addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

const cards = document.querySelectorAll('.filter-card');

function applyFilters() {
    const search = document.getElementById('search').value.toLowerCase().trim();
    const styleSelect = document.getElementById('style-select').value;

    const cardArr = Array.from(cards);
    // Szűrés

    cardArr.forEach(card => {
        const nameMatch = card.dataset.name.toLowerCase().includes(search);
        const styles = card.dataset.style.split(',').map(s => s.trim());
        const styleMatch = styleSelect === '' || styles.includes(styleSelect);
        console.log(styleSelect);
        

        card.classList.toggle('hidden-card', !(nameMatch && styleMatch));
    });
}

function resetFilters() {
    document.getElementById('search').value = '';
    document.getElementById('style-select').value = '';
    applyFilters();
}

document.getElementById('search').addEventListener('input', applyFilters);
document.getElementById('style-select').addEventListener('change', applyFilters);

applyFilters();

const searchBarIcon = document.querySelector('.filter-icon-js');
const closeIcon = document.querySelector('.close-icon-js');
const filterBar = document.querySelector('.filter-bar');

searchBarIcon.addEventListener('click', () => {
    filterBar.classList.toggle('active');
    searchBarIcon.classList.toggle('active');
    searchBarIcon.style.visibility = 'hidden';
});
closeIcon.addEventListener('click', () => {
    filterBar.classList.remove('active');
    searchBarIcon.classList.toggle('active');
    searchBarIcon.style.visibility = 'visible';
});
