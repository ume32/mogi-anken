document.addEventListener("DOMContentLoaded", function () {
    function showTab(tabName) {
        document.querySelectorAll(".tab-content").forEach((content) => {
            content.classList.remove("active");
        });
        document.querySelectorAll(".tab-button").forEach((button) => {
            button.classList.remove("active");
        });

        document.getElementById(tabName).classList.add("active");
        document
            .querySelector(`button[onclick="showTab('${tabName}')"]`)
            .classList.add("active");
    }

    // 初回ロード時におすすめタブを表示
    showTab("recommend");
});
