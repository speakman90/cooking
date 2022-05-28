const vue = new Vue({
    mounted(){
        axios.get("src/Controller/RecettesController.php")
            .then((res) => res.data)
            .then((res) => console.log('test'))
    },
}).$mount("#vue-app");