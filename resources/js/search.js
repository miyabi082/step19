document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector('input[name="search"]');
    const postsContainer = document.querySelector(".posts-container");
    let timeoutId;

    searchInput.addEventListener("input", function (e) {
        clearTimeout(timeoutId);
        const searchValue = e.target.value;

        // 300ms待ってから検索を実行（デバウンス処理）
        timeoutId = setTimeout(() => {
            fetch(`/posts?search=${encodeURIComponent(searchValue)}`)
                .then((response) => response.text())
                .then((html) => {
                    // 検索結果を表示
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, "text/html");
                    const newPosts = doc.querySelector(".posts-container");
                    if (newPosts) {
                        postsContainer.innerHTML = newPosts.innerHTML;
                    }
                })
                .catch((error) => {
                    console.error("検索中にエラーが発生しました:", error);
                });
        }, 300);
    });
});
