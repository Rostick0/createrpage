<?

?>

<form class="search" method="POST" onsubmit="return false;">
    <input type="text" class="search__input input" placeholder="Поиск компании по сайту" name="search_company_input">
    <div class="search__buttons">
        <button class="search__button button-circle" name="search_company_button">
            <svg width="2rem" height="2rem" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="9.5" stroke="#fff" stroke-width="3" />
                <rect x="17" y="19.1213" width="3" height="15" transform="rotate(-45 17 19.1213)" fill="#fff" />
            </svg>
        </button>
        <a class="button-circle" href="/create">
            <svg width="2rem" height="2rem" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect y="7" width="16" height="2" fill="#fff"></rect>
                <rect x="7" width="2" height="16" fill="#fff"></rect>
            </svg>
        </a>
    </div>
</form>

<script>
    const searchButton = document.querySelector(".search__button");
    const searchInput = document.querySelector(".search__input");

    searchButton.onclick = () => window.location.href = window.location.origin + `/list?search=${searchInput.value}`;
</script>