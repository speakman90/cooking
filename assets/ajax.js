function onClickBtnLike(event){
    event.preventDefault();

    const url = this.href;
    const spanCount = this.querySelector('span.js-likes');
    const icon = this.querySelector('i.fa-heart');
    

    axios.get(url).then(function(response) {
        spanCount.textContent = response.data.likes
        
        if (icon.classList.contains('fa-solid')) {
            icon.classList.replace('fa-solid', 'fa-regular');
        }
        else {
            icon.classList.replace('fa-regular', 'fa-solid');
        }

    }).catch(function(error) {
        if(error.response.status === 403)
        {
            window.alert('Vous devez être connecté pour pouvoir liké')
        }
        else 
        {
            window.alert("Une erreur s'est produit, réessayer plus tard, ou pas.")
        }
    });
}

document.querySelectorAll('a.js-like').forEach(function(link)
{
    link.addEventListener('click', onClickBtnLike);
})

