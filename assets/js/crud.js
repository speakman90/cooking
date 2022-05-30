$(function(){
    var content = $('#spawn')
    $("form[name='recette']").on('change', function(e){
        let id = $("input[name='recette[id]']")
        let title = $("input[name='recette[title]']")
        let content = $("input[name='recette[content]")
        let img = $("input[name='recette[img]']")
        $.ajax({
            url: "/recettes/",
            type: "POST"
        }).done(function(data){
            content.replaceWith(`
            <div class="card" style="width: 18rem;">
                <img src="/"class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">${title.val()}</h5>
                    <p class="card-text">${content.val()}</p>
                    <a href="${id}" class="btn btn-primary">Voir cette recette</a>
                </div>
            </div>`
            )
        })
    })
})