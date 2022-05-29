window.onload = () => {
    const navSearch = document.querySelector('#search input')

        navSearch.addEventListener('keyup', event => {

            const Url = new URL(window.location.href)

            fetch(Url.pathname + navSearch.value + "&ajax=1", {
                header: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            }).then(
                res => res.json()
            ).then(data => {
                const content = document.querySelector("#spawn");
                content.innerHTML = data.content
            })
        })
}